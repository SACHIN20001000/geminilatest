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
class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leads= Lead::with('users','insurances','products','subProduct','policy','assigns')->paginate(5);
       return view('admin.lead.index',compact('leads'));
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
        return view('admin.lead.addEdit',compact('insurances','companies','make'));

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
        'subproduct_id'
        );
        $leadData['user_id'] = Auth::User()->id;
        $lead = Lead::create($leadData);
        $policyInputs= $request->except('holder_name', '_token','phone','email',);
        $policyInputs['lead_id']= $lead->id;
        Policy::create($policyInputs);
        return back()->with('success', 'Lead added successfully!');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead)
    {
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
        return view('admin.lead.addEdit',compact('insurances','companies','lead','policy','make','products','subProducts'));
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
        'subproduct_id'
        );
        $lead->update($leadData);
        $policyInputs= $request->except('holder_name', '_token','_method','phone','email');
        Policy::where('lead_id',$lead->id)->update($policyInputs);
        return back()->with('success', 'Lead Update successfully!');
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
        $output1="<option>Select </option>";
        foreach ($product as $val1) {
            $output1 .= '<option value="' . $val1->id . '">' . $val1->name . '</option>';
        }
        echo $output1;
    }
    public function getSubProduct(Request $request){
        
        $product= SubProduct::where('product_id',$request->product_id)->get();
        $output1="<option>Select </option>";
        foreach ($product as $val1) {
            $output1 .= '<option value="' . $val1->id . '" data-id="'.$val1->name.'">' . $val1->name . '</option>';
        }
        echo $output1;
    }
    public function getVarient(Request $request){
        
        $model= MakeModel::where('make_id',$request->make)->get();
        $output1="<option>Select </option>";
        foreach ($model as $val1) {
            $output1 .= '<option value="' . $val1->id . '">' . $val1->name . '</option>';
        }
        echo $output1;
    }
    public function getStaff(){
            
        $staff=  $query = User::with('roles')->whereHas(
                'roles', function ($q)
                {
                    $q->where('name', '=', 'Staff');
                })->get();

        $output1="<option>Select </option>";
        foreach ($staff as $val1) {
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
       
       if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
        $attachment_filename = preg_replace('/\s+/', '', $request->file('attachment')->getClientOriginalName());
        try{

            $request->file('attachment')->move(public_path('/attachments'), $attachment_filename);
          
            Attachment::create([
                'lead_id'=> $request->lead_id ??'',
                'policy_id'=> $request->policy_id ??'',
                'user_id'=> Auth::user()->id ??'',
                'file_name'=> $attachment_filename ??'',
                'type'=> 'Attachment'
            ]);
            return back()->with('success', 'Attachment Created successfully!');
        }catch(FileException $e) {
            return back()->with('error', 'Please try again!');
           
        }
    }
    return back()->with('error', 'File Is Required!');
    }
    public function leadQuotes(Request $request){
   
            $quote= Quote::create([
                    'lead_id'=> $request->lead_id ??'',
                    'company_id'=> $request->company ??'',
                    'user_id'=> Auth::user()->id ??'',
                    'remark'=> $request->remarks
                ]);
            if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
                $attachment_filename = preg_replace('/\s+/', '', $request->file('attachment')->getClientOriginalName());
                $request->file('attachment')->move(public_path('/quotes'), $attachment_filename);
                $quote->update(['file_name'=> $attachment_filename]);
            }
            $listQuote=Quote::where('lead_id',$request->lead_id)->count();
            if($listQuote >= 2){
                Lead::find($request->lead_id)->update(['status'=>'RE-QUOTE']);
            }else{
                Lead::find($request->lead_id)->update(['status'=>'QUOTE GENERATED']);
            }
            return back()->with('success', 'Quote Created successfully!');
    }
}
