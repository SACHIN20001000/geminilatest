<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\User;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\Channel;
use App\Models\MakeModel;
use App\Models\ModelMake;
use App\Models\Make;
use App\Models\Policy;
use App\Models\Insurance;
use App\Models\Company;
use App\Models\Attachment; 
use App\Models\Quote;

use DataTables;
use Auth;
use App\Http\Requests\Admin\Lead\StoreLeadRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Mail;
ini_set('max_execution_time', 1500); // 5 minutes

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
     
        $products= SubProduct::all();
        $users= User::all();
        $query= Lead::with('users','insurances','products','subProduct','policy','assigns')
        ->whereHas('policy', function ($q) use ($request){
           
            if(isset($request->expiry_from) && !empty($request->expiry_from) && !empty($request->expiry_to) && isset($request->expiry_to) ){
                 $q->whereBetween('expiry_date', [$request->expiry_from,$request->expiry_to]);
            }
            if(isset($request->product)   && !empty($request->product)){
                 $q->where('product_id', $request->product);
            }
             $q->where('is_policy',0);
            if(isset($request->search_anything)   && !empty($request->search_anything)){
                $searchParam=['user_id','insurance_id','product_id','net_premium','case_type','policy_no','channel_name','lead_id','company_id','attachment_id','subproduct_id','gross_premium','others','pa','tp_premium','add_on_premium','od_premium','gwp','gst','basic_premium','terrorism_premium','requirement','client_name','address','remarks','type','commodity_type','mode_of_transport','cover_type','per_sending_limit','per_location_limit','estimate_annual_sum','basic_of_valuation','policy_period','start_date','expiry_date','commodity_details','packing_description','libality','policy_type','liability_industrial','liability_nonindustrial','liability_act','professional_indeminity','comprehensive_general_liability','wc_policy','pincode','industry_type','worker_number','job_profile','salary_per_month','add_on_cover','medical_extension','occupation_disease','compressed_air_disease','terrorism_cover','terrorism_cover','multiple_location','occupancy','occupancy_tarriff','particular','building','plant_machine','furniture_fixure','stock_in_process','finished_stock','other_contents','clain_in_last_three_year','loss_details','loss_in_amount','loss_date','measures_taken_after_loss','address_risk_location','cover_opted','policy_inception_date','tenure','construction_type','age_of_building','basement_for_building','basement_for_content','claims','building_carpet_area','building_cost_of_construction','building_sum_insured','content_sum_insured','rent_alternative_accommodation','health_type','fresh','portability','dob','pre_existing_disease','hospitalization_history','upload_discharge_summary','dob_sr_most_member','dob_self','dob_spouse','dob_child','dob_father','dob_mother','sum_insured','visiting_country','date_of_departure','date_of_arrival','no_of_days','no_person','passport_datails','make','model','cubic_capacity','bussiness_type','rto','reg_no','mfr_year','reg_date','claims_in_existing_policy','ncb_in_existing_policy','gcv_type','gvw','fuel_type','passenger_carrying_capacity','category','varriant'];
                foreach ($searchParam as $key => $value) {
                    $q->orwhere($value, 'like','%' . $request->search_anything . '%');
                }     
        } 
        });
 
        if(isset($request->id) && !empty($request->id)){
            if($request->id == 1){
                $query->whereIn('status', ['PENDING/FRESH','IN PROCESS','MORE INFO REQUIRED','RE-QUOTE']);
            }elseif($request->id == 2){
                $query->whereIn('status', ['QUOTE GENERATED']);
            }elseif($request->id == 3){
                $query->whereIn('status', ['LINK GENERATED BUT NOT PAID','LINK GENERATED','POLICY TO BE ISSUED']);
            }else{
                $query->whereIn('status', ['REJECTED']);
            }
            
        }
        if(isset($request->users)   && !empty($request->users)){
            $query->where('user_id', $request->users)->orwhere('assigned', $request->users);
       }
        if(isset($request->lead_id)   && !empty($request->lead_id)){
            $query->where('user_id', $request->lead_id)->orwhere('assigned', $request->lead_id);
       }

            if(isset($request->status)   && !empty($request->status)){
                    $query->where('status', $request->status);
            }
            if(isset($request->search_anything)   && !empty($request->search_anything)){
                $searchParam=['holder_name','phone','email'];
                foreach ($searchParam as $key => $value) {
                    $query->orwhere($value, 'like','%' . $request->search_anything . '%');
                }
                
        }
        if(isset($request->search_anything)   && !empty($request->search_anything)){
        $query ->orwhereHas('insurances', function ($q) use ($request){
                    $q->where('name',  $request->search_anything );
            
        })
        ->orwhereHas('products', function ($q) use ($request){
           
                    $q->where('name',  $request->search_anything );

            
        })
        ->orwhereHas('subProduct', function ($q) use ($request){
           
                    $q->where('name',  $request->search_anything );
            
        });  
    }
       $leads =  $query->orderby('id','DESC')->paginate(10);
      
       return view('admin.lead.index',compact('leads','products','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insurances = Insurance::all();
        $companies = Company::all();
        $channels = Channel::all();
        $make = Make::all();
        $users= User::all();
        $roles= Role::all();
 
        return view('admin.lead.addEdit',compact('insurances','companies','make','channels','users','roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $leadData=  $request->only(
        'holder_name',
        'phone',
        'email',
        'insurance_id',
        'product_id',
        'subproduct_id',
        'user_type'
        );
        $leadData['user_id'] = $request->user_id ?? auth()->user()->id;
        $lead = Lead::create($leadData);

        $policyInputs= $request->except('holder_name', '_token','phone','email','type','user_type');
        $policyInputs['lead_id']= $lead->id;
        $policyInputs['user_id'] = $request->user_id ?? auth()->user()->id;

        $policy=  Policy::create($policyInputs);
        
        if(isset($request->attachment) && (!empty($request->attachment))){
            foreach ($request->attachment as $key => $value) {
                    if(!empty($value)){
                        $attachment_filename = preg_replace('/\s+/', '', $value->getClientOriginalName());
                        $value->move(public_path('/attachments'), $attachment_filename);
                        Attachment::create([
                            'lead_id'=> $lead->id ?? 0,
                            'policy_id'=> $policy->id ??'',
                            'user_id'=> Auth::user()->id ??'',
                            'file_name'=> $attachment_filename ??'',
                            'type'=> $request->type[$key] ??  ''
                        ]);
                    }
                }
            }
            return redirect ()->route ('leads.index', ['id' => 1])->with ('success', 'Lead added successfully!');
     
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
        $lead->update(['mark_read'=>1]);
        $company= Company::all();
        return view('admin.lead.one',compact('lead','company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead)
    {
       
        $insurances = Insurance::all();
        $products = Product::all();
        $subProducts = SubProduct::where('product_id',$lead->product_id)->get();
        $companies = Company::all();
        $policy= Policy::where('lead_id',$lead->id)->first();
        $make = Make::all();
        $model=ModelMake::all();
        $varients=MakeModel::where('make_id',$policy->model)->get();
        $channels = Channel::all();
        $roles= Role::all();
        $users=  User::with('roles')->whereHas(
            'roles', function ($q)use ($lead)
            {
                $q->where('id', '=', $lead->user_type);
            })->get();
        return view('admin.lead.addEdit',compact('roles','model','insurances','companies','lead','users','policy','make','products','subProducts','channels','varients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead)
    {
   
       $leadData=  $request->only(
        'holder_name',
        'phone',
        'email',
        'insurance_id',
        'product_id',
        'subproduct_id',
        'user_type'
        );
        $lead->update($leadData);
        $policyInputs= $request->except('holder_name', '_token','_method','phone','email','type','user_type');
        $policyInputs['user_id'] = $request->user_id ?? auth()->user()->id;
        $policy= Policy::where('lead_id',$lead->id)->update($policyInputs);
        if(isset($request->attachment) && (!empty($request->attachment))){
            foreach ($request->attachment as $key => $value) {
                    if(!empty($value)){
                        $attachment_filename = preg_replace('/\s+/', '', $value->getClientOriginalName());
                        $value->move(public_path('/attachments'), $attachment_filename);
                        Attachment::create([
                            'lead_id'=> $lead->id ?? 0,
                            'policy_id'=> $policy->id ??'',
                            'user_id'=> Auth::user()->id ??'',
                            'file_name'=> $attachment_filename ??'',
                            'type'=> $request->type[$key] ??  ''
                        ]);
                    }
                }
            }
        return redirect ()->route ('leads.index', ['id' => 1])->with ('success', 'Lead Update successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead)
    {
        if(!empty($lead->policy)){
            $lead->policy->delete();
        }
        $lead->delete();
        return back()->with('success', 'Lead Deleted successfully!');
    }


    public function getProduct(Request $request){
        
        $product= Product::where('insurance_id',$request->insurance_id)->get();
        $output1="<option value=''>Select </option>";
        foreach ($product as $val1) {
            $output1 .= '<option value="' . $val1->id . '">' . $val1->name . '</option>';
        }
        echo $output1;
    }
    public function getSubProduct(Request $request){
        
        $product= SubProduct::where('product_id',$request->product_id)->get();
        $output1="<option value=''>Select </option>";
        foreach ($product as $val1) {
            $output1 .= '<option value="' . $val1->id . '" data-id="'.$val1->name.'">' . $val1->name . '</option>';
        }
        echo $output1;
    }
    public function getModel(Request $request){
    $model= ModelMake::where('make_id',$request->make)->get();
    $response=[];
    $response['model']=[
        0=>"<option value=''>Select </option>"

    ];
    foreach ($model as $val) {
          array_push($response['model'],'<option value="' . $val->id . '">' . $val->name . '</option>'); 
      }
   
      return $response;
    }
    public function getVarient(Request $request){
        
        $model= MakeModel::where('make_id',$request->make)->get();
        // $output1="<option>Select </option>";
        $response=[];
        $response['varriant']=[
            0=>"<option value=''>Select </option>"
        ];
        $response['model']=[
            0=>"<option value=''>Select </option>"

        ];
        $response['fuel']=[
            0=>"<option value=''>Select </option>"

        ];
        $response['cc']=[
            0=>"<option value=''>Select </option>"

        ];
        $response['seating']=[
            0=>"<option value=''>Select </option>"

        ];
        $response['showroom']=[
            0=>"<option value=''>Select </option>"

        ];
        $response['od']=[
            0=>"<option value=''>Select </option>"

        ];
        $response['tp']=[
            0=>"<option value=''>Select </option>"

        ];
       
        foreach ($model as $val) {
          if(!empty($val->type)){
            array_push($response[$val->type],'<option value="' . $val->name . '">' . $val->name . '</option>');

          }
            
        }
     
        return $response;
    }
    public function getStaff(){
            
        $staff=  $query = User::with('roles')->whereHas(
                'roles', function ($q)
                {
                    $q->where('name', '=', 'Staff');
                })->get();

        $output1="<option value=''>Select </option>";
        foreach ($staff as $val1) {
            $output1 .= '<option value="' . $val1->id . '">' . $val1->name . '</option>';
        }
        echo $output1;
    }
    public function getUsers(Request $request){
            
        $staff=  $query = User::with('roles')->whereHas(
                'roles', function ($q)use ($request)
                {
                    $q->where('id', '=', $request->role);
                })->get();

        $output1="<option value=''>Select </option>";
        foreach ($staff as $val1) {
            $output1 .= '<option value="' . $val1->id . '">' . $val1->name . '</option>';
        }
        echo $output1;
    }
    public function getCompany(){
            
        $companies = Company::all();

        $output1="<option value=''>Select </option>";
        foreach ($companies as $val1) {
            $output1 .= '<option value="' . $val1->id . '">' . $val1->name . '</option>';
        }
        echo $output1;
    }
    public function saveAssign(Request $request){
            
        $lead = Lead::whereIn('id', $request->ids)->get();
       
        if($lead->count()){
            foreach ($lead as $key => $value) {
                $value->assigned = $request->staffId;
                $value->save();
            }
        }
        echo 1;
    }
    public function changeStatus(Request $request){
        $lead = Lead::find($request->lead_id);
        if($lead){
            $lead->update(['status'=>$request->status]);  
        }
        
        echo 1;
    }
    public function leadAttachment(Request $request){
       
        foreach ($request->attachment as $key => $value) {
            if(!empty($value)){
                $attachment_filename = preg_replace('/\s+/', '', $value->getClientOriginalName());
                $value->move(public_path('/attachments'), $attachment_filename);
                Attachment::create([
                    'lead_id'=> $request->lead_id ?? 0,
                    'policy_id'=> $request->policy_id ??0,
                    'user_id'=> Auth::user()->id ??'',
                    'file_name'=> $attachment_filename ??'',
                    'type'=> $request->type[$key] ??  ''
                ]);
                if($request->type[$key] == 'Policy'){
                    if(isset($request->lead_id)  && !empty($request->lead_id)){
                     $lead=   Lead::find($request->lead_id);
                     $user= User::where('email',$lead->email)->first();
                     if(empty($user)){
                        $client = Role::updateOrCreate(['name' => 'Client']);
                        $userClient =   User::create(
                            [
                                'name'=>  $lead->holder_name,
                                'email'=>  $lead->email,
                                'phone'=>  $lead->phone,
                                'password'=> bcrypt('12345678')
                            ]
                            );
                            $userClient->assignRole($client);
                            try {
                                Mail::send('admin.email.newPolicy',['lead' => $lead],function($messages) use ($lead) {            
                                       $messages->to($lead->email);
                                       $subject ='Policy Issued,'.($lead->holder_name??'').' ' . ($lead->subProduct->name??'');
                                       $messages->subject($subject);     
                               }); 
                              } catch (Exception $e) {
                                 
                               }
                     }
                       
                    } 
                    if(isset($request->policy_id)  && !empty($request->policy_id)){
                      Policy::find($request->policy_id)->update(['is_policy' =>1,'attachment_id'=>$userClient->id?? 0 ]);
                    } 
                   
                }
            }
          }

          return back()->with('success', 'Attachment Created successfully!');

    }
    public function leadQuotes(Request $request){
   
      
        if(isset($request->company) && !empty($request->company)){
            foreach ($request->company as $key => $company) {
            
                    $quote= Quote::create([
                        'lead_id'=> $request->lead_id ??'',
                        'company_id'=> $company ??'',
                        'user_id'=> Auth::user()->id ??'',
                        'remark'=> $request->remarks[$key]?? ''
                    ]);

                if (isset($request->attachment[$key])) {
                    $attachment_filename = preg_replace('/\s+/', '', $request->attachment[$key]->getClientOriginalName());
                    $request->attachment[$key]->move(public_path('/quotes'), $attachment_filename);
                    $quote->update(['file_name'=> $attachment_filename]);
                }
            }
        }
        $finalQuotes= Quote::where(['lead_id'=>$request->lead_id,'user_id'=>auth()->user()->id])->get();
            $lead = Lead::find($request->lead_id);
                try {
                    Mail::send('admin.email.commonemail',['policy' => $lead],function($messages) use ($lead,$finalQuotes) {
                        $messages->to($lead->users->email);
                        $subject ='Quote ' .$lead->holder_name.' '.$lead->subProduct->name;
                        if($finalQuotes->count()){
                            foreach ($finalQuotes as $key => $quotes) {
                                if(isset($quotes->file_name) && !empty($quotes->file_name)){
                                    $fileurls = url('quotes',$quotes->file_name);
                                    $messages->attach($fileurls);
                                }  
                            }
                        }
                     
                      
                    
                        $messages->subject($subject);                 
                });
                } catch (\Exception $e) {
                    //throw $th;
                }    
         
            Lead::find($request->lead_id)->update(['status'=>'QUOTE GENERATED','mark_read'=>0]);
          
            return back()->with('success', 'Quote Created successfully!');
    }
    public function dummyMail(){
        $info = array(
            'name' => "Alex"
        );
        Mail::send(['text' => 'mail'], $info, function ($message)
        {
            $message->to('sachindts98@gmail.com', 'W3SCHOOLS')
                ->subject('Basic test eMail from W3schools.');
            // $message->from('sender@example.com', 'Alex');
        });
        echo "Successfully sent the email";  
    }
    public function rejectLead(Request $request){
        Quote::where('lead_id',$request->id)->whereNotIn('id', [$request->quote])->update(['type'=>'Accept']);
        Quote::find($request->quote)->update(['type'=>'Reject']);
        Lead::find($request->id)->update(['status'=> 'REJECTED','mark_read'=>0]);
        return back()->with('success', 'Quote Rejected!');

    }
    public function acceptLead(Request $request){
        Quote::where('lead_id',$request->id)->whereNotIn('id', [$request->quote])->update(['type'=>'Reject']);

        Quote::find($request->quote)->update(['type'=>'Accept']);
        Lead::find($request->id)->update(['status'=> 'POLICY TO BE ISSUED','mark_read'=>0]);
        return back()->with('success', 'Quote Accepted!');


    }
    
}
