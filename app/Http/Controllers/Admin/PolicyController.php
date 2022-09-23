<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\User;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\MakeModel;
use App\Models\Make;
use App\Models\Policy;
use App\Models\Insurance;
use App\Models\Company;
use App\Models\Attachment;
use App\Models\Quote;
use DataTables;
use Auth;
use App\Http\Requests\Admin\Lead\StoreLeadRequest;

class PolicyController extends Controller
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
        $query= Policy::with('users','lead','insurances','products','subProduct','lead.assigns')
        ->whereHas('lead', function ($q) use ($request){
           
        
        if(isset($request->search_anything)   && !empty($request->search_anything)){
            $searchParam=['holder_name','phone','email'];
            foreach ($searchParam as $key => $value) {
                $q->orwhere($value, 'like','%' . $request->search_anything . '%');
            }
            
    }
            
        })
        ->whereHas('insurances', function ($q) use ($request){
            if(isset($request->search_anything)   && !empty($request->search_anything)){
                    $q->where('name',  $request->search_anything );
        }
            
        })
        ->whereHas('products', function ($q) use ($request){
            if(isset($request->search_anything)   && !empty($request->search_anything)){
                    $q->where('name',  $request->search_anything );
        }
            
        })
        ->whereHas('subProduct', function ($q) use ($request){
            if(isset($request->search_anything)   && !empty($request->search_anything)){
                    $q->where('name',  $request->search_anything );
        }
            
        });
        if(isset($request->expiry_from) && !empty($request->expiry_from) && !empty($request->expiry_to) && isset($request->expiry_to) ){
            $query->whereBetween('expiry_date', [$request->expiry_from,$request->expiry_to]);
       }
       if(isset($request->product)   && !empty($request->product)){
            $query->where('product_id', $request->product);
       }
       if(isset($request->search_anything)   && !empty($request->search_anything)){
           $searchParam=['user_id','insurance_id','product_id','net_premium','case_type','policy_no','channel_name','lead_id','company_id','attachment_id','subproduct_id','gross_premium','others','pa','tp_premium','add_on_premium','od_premium','gwp','gst','basic_premium','terrorism_premium','requirement','client_name','address','remarks','type','commodity_type','mode_of_transport','cover_type','per_sending_limit','per_location_limit','estimate_annual_sum','basic_of_valuation','policy_period','start_date','expiry_date','commodity_details','packing_description','libality','policy_type','liability_industrial','liability_nonindustrial','liability_act','professional_indeminity','comprehensive_general_liability','wc_policy','pincode','industry_type','worker_number','job_profile','salary_per_month','add_on_cover','medical_extension','occupation_disease','compressed_air_disease','terrorism_cover','terrorism_cover','multiple_location','occupancy','occupancy_tarriff','particular','building','plant_machine','furniture_fixure','stock_in_process','finished_stock','other_contents','clain_in_last_three_year','loss_details','loss_in_amount','loss_date','measures_taken_after_loss','address_risk_location','cover_opted','policy_inception_date','tenure','construction_type','age_of_building','basement_for_building','basement_for_content','claims','building_carpet_area','building_cost_of_construction','building_sum_insured','content_sum_insured','rent_alternative_accommodation','health_type','fresh','portability','dob','pre_existing_disease','hospitalization_history','upload_discharge_summary','dob_sr_most_member','dob_self','dob_spouse','dob_child','dob_father','dob_mother','sum_insured','visiting_country','date_of_departure','date_of_arrival','no_of_days','no_person','passport_datails','make','model','cubic_capacity','bussiness_type','rto','reg_no','mfr_year','reg_date','claims_in_existing_policy','ncb_in_existing_policy','gcv_type','gvw','fuel_type','passenger_carrying_capacity','category','varriant'];
           foreach ($searchParam as $key => $value) {
               $query->orwhere($value, 'like','%' . $request->search_anything . '%');
           }
           if(isset($request->users)   && !empty($request->users)){
            $query->where('assigned', $request->users);
       }
           
      }  
        // if(isset($request->id) && !empty($request->id)){
        //     if($request->id == 1){
        //         $query->whereIn('status', ['PENDING/FRESH','IN PROCESS','MORE INFO REQUIRED']);
        //     }elseif($request->id == 2){
        //         $query->whereIn('status', ['QUOTE GENERATED','RE-QUOTE']);
        //     }elseif($request->id == 3){
        //         $query->whereIn('status', ['LINK GENERATED BUT NOT PAID','LINK GENERATED','POLICY TO BE ISSUED']);
        //     }else{
        //         $query->whereIn('status', ['REJECTED']);
        //     }
            
        // }
        if(isset($request->users)   && !empty($request->users)){
            $query->where('user_id', $request->users);
       }
            if(isset($request->status)   && !empty($request->status)){
                $query->where('status', $request->status);
        }
          
       $leads =  $query->paginate(10);
      
        
        
       return view('admin.policy.index',compact('leads','products','users'));
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
        $make = Make::all();
        return view('admin.policy.addEdit',compact('insurances','companies','make'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    
        $policyInputs= $request->except('holder_name', '_token','phone','email',);
        Policy::create($policyInputs);
        return back()->with('success', 'Policy added successfully!');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        
        $company= Company::all();
        return view('admin.policy.one',compact('policy','company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Policy $policy)
    {
        $insurances = Insurance::all();
        $products = Product::all();
        $subProducts = SubProduct::where('product_id',$policy->product_id)->get();
        $companies = Company::all();
        $make = Make::all();
        $varriant = MakeModel::where('make_id',$policy->make)->get();
        return view('admin.policy.addEdit',compact('insurances','companies','policy','make','products','subProducts','varriant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policy $policy)
    {
   
        $policyInputs= $request->except('holder_name', '_token','_method','phone','email');
        $policy->update($policyInputs);
        return back()->with('success', 'Policy Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policy $policy)
    {
        
        $policy->delete();
        return back()->with('success', 'Policy Deleted successfully!');
    }


   
}
