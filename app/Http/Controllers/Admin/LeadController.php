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
        $leads= Lead::with('users','insurances','products','subProduct','policy')->paginate(5);
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
        return view('admin.lead.one',compact('lead'));
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
}
