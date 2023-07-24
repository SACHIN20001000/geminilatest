@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Policy</h4>
                @include('admin.policy.common')
            </div>
        </div>


        <div class="d-flex my-xl-auto right-content">
            <div class="pe-1 mb-xl-0">
                <div class="btn-group dropdown">
                    <a class="btn btn-main-primary" href="{{ route('policy.index') }}">View Policy</a>
                </div>
            </div>

        </div>

    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        {{isset($policy) ? 'Update # '.$policy->id : 'Add New' }}
                    </div>


                    <!--  start  -->
                    <form id="user-add-edit" action="{{isset($policy) ? route('policy.update',$policy->id) : route('policy.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($policy) ? method_field('PUT'):'' }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row row-xs align-items-center mg-b-20">

                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Policy Holder Name</p>
                                            <input class="form-control" name="holder_name" placeholder="Enter your name" type="text" value="{{isset($policy) ? $policy->holder_name : '' }}">
                                        </div>

                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Policy Holder Phone Number </p>
                                            <input class="form-control" name="phone" placeholder="Enter your Number" type="text" value="{{isset($policy) ? $policy->phone : '' }}">
                                        </div>

                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Policy Holder Email</p>
                                            <input class="form-control" name="email" placeholder="Enter your email" type="email" value="{{isset($policy) ? $policy->email : '' }}">
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Channel Name</p>

                                            <select name="channel_name" class="select2 form-control common-feild feild" id="channel_name">
                                                <option value="">Select Below</option>
                                                @if($channels->count())
                                                @foreach($channels as $channel)
                                                <option value="{{$channel->name}}" {{ (isset($policy) && $channel->name == $policy->channel_name) ? 'selected' : '' }}>{{$channel->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Insurance Company</p>
                                            <select name="company_id" class="select2 form-control common-feild feild" id="company_id">
                                                <option value="">Select Below</option>
                                                @if($companies->count())
                                                @foreach($companies as $company)
                                                <option value="{{$company->id}}" {{ (isset($policy) && $company->id == $policy->company_id) ? 'selected' : '' }}>{{$company->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Insurance</p>
                                            <select name="insurance_id" class="select2 form-control" id="insurance_id">
                                                <option value="">Select Below</option>
                                                @if($insurances->count())
                                                @foreach($insurances as $insurance)
                                                <option value="{{$insurance->id}}" {{ (isset($policy) && $insurance->id == $policy->insurance_id) ? 'selected' : '' }}>{{$insurance->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Product</p>
                                            <select name="product_id" class="select2 form-control" id="product_id">
                                                <option value="">Select Below</option>
                                                @if(isset($products) && $products->count())
                                                @foreach($products as $product)
                                                <option value="{{$product->id}}" {{ (isset($policy) && $product->id == $policy->product_id) ? 'selected' : '' }}>{{$product->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Sub Product</p>
                                            <select name="subproduct_id" class="select2 form-control" id="subproduct_id">
                                                <option value="">Select Below</option>
                                                @if(isset($subProducts) && $subProducts->count())
                                                @foreach($subProducts as $subProduct)
                                                <option value="{{$subProduct->id}}" data-id="{{$subProduct->name}}" {{ (isset($policy) && $subProduct->id == $policy->subproduct_id) ? 'selected' : '' }}>{{$subProduct->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <!------------------------------------------------- polciy start  ------------------------------------------------>

                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Policy Number</p>
                                            <input type="text" name="policy_no" value="{{isset($policy) ? $policy->policy_no : ''}}" class="form-control common-feild feild" id="policy_no">
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Start Date</p>
                                            <input type="date" name="start_date" value="{{isset($policy) ? $policy->start_date : ''}}" class="form-control feild" id="start_date">
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Policy Expiry Date</p>
                                            <input type="date" name="expiry_date" value="{{isset($policy) ? $policy->expiry_date : ''}}" class="form-control feild" id="expiry_date">
                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">GWP</p>
                                            <input type="text" name="gwp" value="{{isset($policy) ? $policy->gwp : ''}}" class="form-control feild" id="gwp">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Net Premium</p>
                                            <input type="text" name="net_premium" value="{{isset($policy) ? $policy->net_premium : ''}}" class="form-control feild" id="net_premium">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">OD Premium</p>
                                            <input type="text" name="od_premium" onkeyup="grossPremium()" value="{{isset($policy) ? $policy->od_premium : ''}}" class="form-control feild" id="od_premium">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Add On Premium</p>
                                            <input type="text" name="add_on_premium" onkeyup="grossPremium()" value="{{isset($policy) ? $policy->add_on_premium : ''}}" class="form-control feild" id="add_on_premium">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">TP Premium</p>
                                            <select name="tp_premium" class="select2 form-control feild tp_premium" onkeyup="grossPremium()" id="tp_premium">
                                                <option value="">Select Below</option>
                                                @if(isset($varients) && $varients->count())
                                                @foreach($varients as $varient)
                                                @if($varient->type == 'tp')
                                                <option value="{{$varient->name}}" {{ (isset($policy) && $varient->name == $policy->tp_premium) ? 'selected' : '' }}>{{$varient->name}}</option>
                                                @endif
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">PA</p>
                                            <input type="text" name="pa" value="{{isset($policy) ? $policy->pa : ''}}" class="form-control feild" id="pa">

                                        </div>

                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Other</p>
                                            <input type="text" name="others" value="{{isset($policy) ? $policy->others : ''}}" onkeyup="grossPremium()" class="form-control feild" id="others">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Gross Premiun</p>
                                            <input type="text" name="gross_premium" value="{{isset($policy) ? $policy->gross_premium : ''}}" class="form-control feild" id="gross_premium">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Basic Premiun</p>
                                            <input type="text" name="basic_premium" value="{{isset($policy) ? $policy->basic_premium : ''}}" class="form-control feild" id="basic_premium">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Terrorism Premiun</p>
                                            <input type="text" name="terrorism_premium" value="{{isset($policy) ? $policy->terrorism_premium : ''}}" class="form-control feild" id="terrorism_premium">

                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">TYPE OF VEHICLE</p>
                                            <select name="case_type" class="select2 form-control feild" id="vehicle_type">
                                                <option value="">Select Below</option>
                                                <option value="3 WHEELER" {{ (isset($policy) && "3 WHEELER" == $policy->case_type) ? 'selected' : '' }}>3 WHEELER</option>
                                                <option value=" =>4 WHEELER" {{ (isset($policy) && " =>4 WHEELER" == $policy->case_type) ? 'selected' : '' }}> =>4 WHEELER</option>

                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Requirement</p>
                                            <input type="text" name="requirement" value="{{isset($policy) ? $policy->requirement : ''}}" class="form-control feild" id="requirement">
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Client Name</p>
                                            <input type="text" name="client_name" value="{{isset($policy) ? $policy->client_name : ''}}" class="form-control feild" id="client_name">
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Address</p>
                                            <input type="text" name="address" value="{{isset($policy) ? $policy->address : ''}}" class="form-control feild" id="address">
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Remarks</p>
                                            <input type="text" name="remarks" value="{{isset($policy) ? $policy->remarks : ''}}" class="form-control feild" id="remarks">
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Type</p>
                                            <select name="type" class="select2 form-control feild" id="type">
                                                <option value="">Select Below</option>
                                                <option value="SINGLE TRANSIT" {{ (isset($policy) && "SINGLE TRANSIT" == $policy->type) ? 'selected' : '' }}>SINGLE TRANSIT</option>
                                                <option value="OPEN POLICY" {{ (isset($policy) && "OPEN POLICY" == $policy->type) ? 'selected' : '' }}>OPEN POLICY</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Commodity Type</p>
                                            <input type="text" name="commodity_type" value="{{isset($policy) ? $policy->commodity_type : ''}}" class="form-control feild" id="commodity_type">
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Mode Of Transport</p>
                                            <select name="mode_of_transport" class="select2 form-control feild" id="mode_of_transport">
                                                <option value="">Select Below</option>
                                                <option value="RAIL" {{ (isset($policy) && "RAIL" == $policy->mode_of_transport) ? 'selected' : '' }}>RAIL</option>
                                                <option value="ROAD" {{ (isset($policy) && "ROAD" == $policy->mode_of_transport) ? 'selected' : '' }}>ROAD</option>
                                                <option value="AIR" {{ (isset($policy) && "AIR" == $policy->mode_of_transport) ? 'selected' : '' }}>AIR</option>
                                                <option value="SEA" {{ (isset($policy) && "SEA" == $policy->mode_of_transport) ? 'selected' : '' }}>SEA</option>
                                                <option value="COURIER" {{ (isset($policy) && "COURIER" == $policy->mode_of_transport) ? 'selected' : '' }}>COURIER</option>
                                                <option value="ALL" {{ (isset($policy) && "ALL" == $policy->mode_of_transport) ? 'selected' : '' }}>ALL</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Cover Type</p>
                                            <select name="cover_type" class="select2 form-control feild" id="cover_type">
                                                <option value="">Select Below</option>
                                                <option value="ITC A" {{ (isset($policy) && "ITC A" == $policy->cover_type) ? 'selected' : '' }}>ITC A</option>
                                                <option value="ITC B" {{ (isset($policy) && "ITC B" == $policy->cover_type) ? 'selected' : '' }}>ITC B</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Sum Insured</p>
                                            <input type="text" name="sum_insured" value="{{isset($policy) ? $policy->sum_insured : ''}}" class="form-control feild" id="sum_insured">
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Per Sending Limt</p>
                                            <input type="text" name="per_sending_limit" value="{{isset($policy) ? $policy->per_sending_limit : ''}}" class="form-control feild" id="per_sending_limit">
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Per Location Limit</p>
                                            <input type="text" name="per_location_limit" value="{{isset($policy) ? $policy->per_location_limit : ''}}" class="form-control feild" id="per_location_limit">
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Estimated Annual Sum Insured</p>
                                            <input type="text" name="estimate_annual_sum" value="{{isset($policy) ? $policy->estimate_annual_sum : ''}}" class="form-control feild" id="estimate_annual_sum">
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Basis Of Valuation</p>
                                            <input type="text" name="basic_of_valuation" value="{{isset($policy) ? $policy->basic_of_valuation : ''}}" class="form-control feild" id="basic_of_valuation">
                                        </div>
                                        <!-- <div class="col-lg-6">
											<p class="mg-t-10 mg-b-1">Policy Period</p>
                                           <input type="text" name="policy_period" value="{{isset($policy) ? $policy->policy_period : ''}}" class="form-control feild" id="policy_period">
                     </div> -->

                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Details Of Commodity Type</p>
                                            <select name="commodity_details" class="select2 form-control feild" id="commodity_details">
                                                <option value="">Select Below</option>
                                                <option value="BOXES" {{ (isset($policy) && "BOXES" == $policy->commodity_details) ? 'selected' : '' }}>BOXES</option>
                                                <option value="CONTAINER" {{ (isset($policy) && "CONTAINER" == $policy->commodity_details) ? 'selected' : '' }}>CONTAINER</option>
                                                <option value="WEIGHT" {{ (isset($policy) && "WEIGHT" == $policy->commodity_details) ? 'selected' : '' }}>WEIGHT</option>
                                                <option value="NO OF PACKAGES" {{ (isset($policy) && "NO OF PACKAGES" == $policy->commodity_details) ? 'selected' : '' }}>NO OF PACKAGES</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Packing Description</p>
                                            <input type="text" name="packing_description" value="{{isset($policy) ? $policy->packing_description : ''}}" class="form-control feild" id="packing_description">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Libaility</p>
                                            <input type="text" name="libality" value="{{isset($policy) ? $policy->libality : ''}}" class="form-control feild" id="libality">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Type Of Policy</p>
                                            <input type="text" name="policy_type" value="{{isset($policy) ? $policy->policy_type : ''}}" class="form-control feild" id="policy_type">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Public Liability Industrial</p>
                                            <input type="text" name="liability_industrial" value="{{isset($policy) ? $policy->liability_industrial : ''}}" class="form-control feild" id="liability_industrial">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Public Liability Non Industrial</p>
                                            <input type="text" name="liability_nonindustrial" value="{{isset($policy) ? $policy->liability_nonindustrial : ''}}" class="form-control feild" id="liability_nonindustrial">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Liability Act</p>
                                            <input type="text" name="liability_act" value="{{isset($policy) ? $policy->liability_act : ''}}" class="form-control feild" id="liability_act">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Professional Indeminity</p>
                                            <input type="text" name="professional_indeminity" value="{{isset($policy) ? $policy->professional_indeminity : ''}}" class="form-control feild" id="professional_indeminity">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Comprehensive General Liability</p>
                                            <input type="text" name="comprehensive_general_liability" value="{{isset($policy) ? $policy->comprehensive_general_liability : ''}}" class="form-control feild" id="comprehensive_general_liability">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">WC Policy</p>
                                            <input type="text" name="wc_policy" value="{{isset($policy) ? $policy->wc_policy : ''}}" class="form-control feild" id="wc_policy">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Pincode</p>
                                            <input type="text" name="pincode" value="{{isset($policy) ? $policy->pincode : ''}}" class="form-control feild" id="pincode">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Industry Type</p>
                                            <input type="text" name="industry_type" value="{{isset($policy) ? $policy->industry_type : ''}}" class="form-control feild" id="industry_type">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Total No Of Workers</p>
                                            <input type="text" name="worker_number" value="{{isset($policy) ? $policy->worker_number : ''}}" class="form-control feild" id="worker_number">

                                        </div>
                                        <div class="col-lg-6">
                                            <p class="mg-t-10 mg-b-1">Job Profile</p>
                                            <select name="job_profile" class="select2 form-control feild" id="job_profile">
                                                <option value="">Select Below</option>
                                                <option value="SKILLED" {{ (isset($policy) && "SKILLED" == $policy->job_profile) ? 'selected' : '' }}>SKILLED</option>
                                                <option value="SEMISKILLED" {{ (isset($policy) && "SEMISKILLED" == $policy->job_profile) ? 'selected' : '' }}>SEMISKILLED</option>
                                                <option value="UNSKILLED" {{ (isset($policy) && "UNSKILLED" == $policy->job_profile) ? 'selected' : '' }}>UNSKILLED</option>

                                            </select>

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Salery Per Month</p>
                                            <input type="text" name="salary_per_month" value="{{isset($policy) ? $policy->salary_per_month : ''}}" class="form-control feild" id="salary_per_month">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Salery Per Month</p>
                                            <input type="text" name="salary_per_month" value="{{isset($policy) ? $policy->salary_per_month : ''}}" class="form-control feild" id="salary_per_month">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Add On Cover</p>
                                            <input type="text" name="add_on_cover" value="{{isset($policy) ? $policy->add_on_cover : ''}}" class="form-control feild" id="add_on_cover">

                                        </div>

                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Medical Extension</p>
                                            <input type="text" name="medical_extension" value="{{isset($policy) ? $policy->medical_extension : ''}}" class="form-control feild" id="medical_extension">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Occupation Disease</p>
                                            <input type="text" name="occupation_disease" value="{{isset($policy) ? $policy->occupation_disease : ''}}" class="form-control feild" id="occupation_disease">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Compressed Air Disease Extension</p>
                                            <input type="text" name="compressed_air_disease" value="{{isset($policy) ? $policy->compressed_air_disease : ''}}" class="form-control feild" id="compressed_air_disease">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Terrorism Cover</p>
                                            <input type="text" name="terrorism_cover" value="{{isset($policy) ? $policy->terrorism_cover : ''}}" class="form-control feild" id="terrorism_cover">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Sub Contractor Cover</p>
                                            <input type="text" name="sub_contractor_cover" value="{{isset($policy) ? $policy->sub_contractor_cover : ''}}" class="form-control feild" id="sub_contractor_cover">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Multiple Location</p>
                                            <input type="text" name="multiple_location" value="{{isset($policy) ? $policy->multiple_location : ''}}" class="form-control feild" id="multiple_location">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Occupancy</p>
                                            <input type="text" name="occupancy" value="{{isset($policy) ? $policy->occupancy : ''}}" class="form-control feild" id="occupancy">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Occupancy Tarriff</p>
                                            <input type="text" name="occupancy_tarriff" value="{{isset($policy) ? $policy->occupancy_tarriff : ''}}" class="form-control feild" id="occupancy_tarriff">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Particular</p>
                                            <input type="text" name="particular" value="{{isset($policy) ? $policy->particular : ''}}" class="form-control feild" id="particular">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Building</p>
                                            <input type="text" name="building" value="{{isset($policy) ? $policy->building : ''}}" class="form-control feild" id="building">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Plant And Machinery</p>
                                            <input type="text" name="plant_machine" value="{{isset($policy) ? $policy->plant_machine : ''}}" class="form-control feild" id="plant_machine">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Furniture Fixture And Fittings</p>
                                            <input type="text" name="furniture_fixure" value="{{isset($policy) ? $policy->furniture_fixure : ''}}" class="form-control feild" id="furniture_fixure">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Stock In Process</p>
                                            <input type="text" name="stock_in_process" value="{{isset($policy) ? $policy->stock_in_process : ''}}" class="form-control feild" id="stock_in_process">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Finished Stock</p>
                                            <input type="text" name="finished_stock" value="{{isset($policy) ? $policy->finished_stock : ''}}" class="form-control feild" id="finished_stock">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Other Contents</p>
                                            <input type="text" name="other_contents" value="{{isset($policy) ? $policy->other_contents : ''}}" class="form-control feild" id="other_contents">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Claim In last 3 Years </p>
                                            <input type="radio" name="clain_in_last_three_year" value="Yes" class="feild mg-b-0" id="clain_in_last_three_year">Yes
                                            <input type="radio" name="clain_in_last_three_year" value="No" class=" feild mg-b-0" id="clain_in_last_three_year">No

                                        </div>
                                        <div class="col-lg-6 clain_in_last_three_year_yes">

                                            <p class="mg-t-10 mg-b-1">Loss Details</p>
                                            <input type="text" name="loss_details" value="{{isset($policy) ? $policy->loss_details : ''}}" class="form-control feild" id="loss_details">

                                        </div>
                                        <div class="col-lg-6 clain_in_last_three_year_yes">

                                            <p class="mg-t-10 mg-b-1">Loss In Amount</p>
                                            <input type="text" name="loss_in_amount" value="{{isset($policy) ? $policy->loss_in_amount : ''}}" class="form-control feild" id="loss_in_amount">

                                        </div>
                                        <div class="col-lg-6 clain_in_last_three_year_yes">

                                            <p class="mg-t-10 mg-b-1">Loss Date</p>
                                            <input type="text" name="loss_date" value="{{isset($policy) ? $policy->loss_date : ''}}" class="form-control feild" id="loss_date">

                                        </div>
                                        <div class="col-lg-6 clain_in_last_three_year_yes">

                                            <p class="mg-t-10 mg-b-1">Measures Taken After Loss</p>
                                            <input type="text" name="measures_taken_after_loss" value="{{isset($policy) ? $policy->measures_taken_after_loss : ''}}" class="form-control feild" id="measures_taken_after_loss">

                                        </div>

                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Address Risk Location</p>
                                            <input type="text" name="address_risk_location" value="{{isset($policy) ? $policy->address_risk_location : ''}}" class="form-control feild" id="address_risk_location">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Cover Opted</p>
                                            <input type="text" name="cover_opted" value="{{isset($policy) ? $policy->cover_opted : ''}}" class="form-control feild" id="cover_opted">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Policy Inception Date</p>
                                            <input type="text" name="policy_inception_date" value="{{isset($policy) ? $policy->policy_inception_date : ''}}" class="form-control feild" id="policy_inception_date">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Tenure</p>
                                            <input type="text" name="tenure" value="{{isset($policy) ? $policy->tenure : ''}}" class="form-control feild" id="tenure">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Construction Type</p>
                                            <select name="construction_type" class="form-control feild" id="construction_type">
                                                <option value="">Select</option>
                                                <option value="PUCCA" {{ (isset($policy) && "PUCCA" == $policy->construction_type) ? 'selected' : '' }}>PUCCA</option>
                                                <option value="KUTCHA" {{ (isset($policy) && "KUTCHA" == $policy->construction_type) ? 'selected' : '' }}>KUTCHA</option>
                                            </select>

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Age Of the Building</p>
                                            <input type="text" name="age_of_building" value="{{isset($policy) ? $policy->age_of_building : ''}}" class="form-control feild" id="age_of_building">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Basement for Building</p>
                                            <input type="text" name="basement_for_building" value="{{isset($policy) ? $policy->basement_for_building : ''}}" class="form-control feild" id="basement_for_building">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Basement for Content</p>
                                            <input type="text" name="basement_for_content" value="{{isset($policy) ? $policy->basement_for_content : ''}}" class="form-control feild" id="basement_for_content">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Claim</p>
                                            <input type="text" name="claims" value="{{isset($policy) ? $policy->claims : ''}}" class="form-control feild" id="claims">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Building Carpet Area</p>
                                            <input type="text" name="building_carpet_area" value="{{isset($policy) ? $policy->building_carpet_area : ''}}" class="form-control feild" id="building_carpet_area">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Building Cost Of Construction</p>
                                            <input type="text" name="building_cost_of_construction" value="{{isset($policy) ? $policy->building_cost_of_construction : ''}}" class="form-control feild" id="building_cost_of_construction">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Building Sum Insured</p>
                                            <input type="text" name="building_sum_insured" value="{{isset($policy) ? $policy->building_sum_insured : ''}}" class="form-control feild" id="building_sum_insured">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Content Sum Insured</p>
                                            <input type="text" name="content_sum_insured" value="{{isset($policy) ? $policy->content_sum_insured : ''}}" class="form-control feild" id="content_sum_insured">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Rent of Alternative Accommodation</p>
                                            <input type="text" name="rent_alternative_accommodation" value="{{isset($policy) ? $policy->rent_alternative_accommodation : ''}}" class="form-control feild" id="rent_alternative_accommodation">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Health Type</p>
                                            <select name="health_type" class="form-control feild" id="health_type">
                                                <option value="">Select</option>
                                                <option value="Individual" {{ (isset($policy) && "Individual" == $policy->health_type) ? 'selected' : '' }}>Individual</option>
                                                <option value="Family" {{ (isset($policy) && "Family" == $policy->health_type) ? 'selected' : '' }}>Family</option>
                                            </select>


                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Fresh</p>
                                            <input type="radio" name="fresh" value="Yes" {{ (isset($policy) && "Yes" == $policy->fresh) ? 'checked' : '' }} class="feild" id="fresh">Yes
                                            <input type="radio" name="fresh" value="No" {{ (isset($policy) && "No" == $policy->fresh) ? 'checked' : '' }} class="feild" id="fresh">No

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Portability</p>
                                            <input type="radio" name="portability" {{ (isset($policy) && "Yes" == $policy->portability) ? 'checked' : '' }} value="Yes" class="feild" id="portability">Yes
                                            <input type="radio" name="portability" {{ (isset($policy) && "No" == $policy->portability) ? 'checked' : '' }} value="No" class="feild" id="portability">No
                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">DOB</p>
                                            <input type="date" name="dob" value="{{isset($policy) ? $policy->dob : ''}}" class="form-control feild" id="dob">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Pre Existing Disease</p>
                                            <input type="text" name="pre_existing_disease" value="{{isset($policy) ? $policy->pre_existing_disease : ''}}" class="form-control feild" id="pre_existing_disease">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Hospitalization History</p>
                                            <input type="text" name="hospitalization_history" value="{{isset($policy) ? $policy->hospitalization_history : ''}}" class="form-control feild" id="hospitalization_history">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Upload Discharge Summary</p>
                                            <input type="text" name="upload_discharge_summary" value="{{isset($policy) ? $policy->upload_discharge_summary : ''}}" class="form-control feild" id="upload_discharge_summary">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Dob Sr Most Member</p>
                                            <input type="date" name="dob_sr_most_member" value="{{isset($policy) ? $policy->dob_sr_most_member : ''}}" class="form-control feild" id="dob_sr_most_member">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Dob Self</p>
                                            <input type="date" name="dob_self" value="{{isset($policy) ? $policy->dob_self : ''}}" class="form-control feild" id="dob_self">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Dob Spouse</p>
                                            <input type="date" name="dob_spouse" value="{{isset($policy) ? $policy->dob_spouse : ''}}" class="form-control feild" id="dob_spouse">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Dob Child</p>
                                            <input type="date" name="dob_child" value="{{isset($policy) ? $policy->dob_child : ''}}" class="form-control feild" id="dob_child">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Dob Father</p>
                                            <input type="date" name="dob_father" value="{{isset($policy) ? $policy->dob_father : ''}}" class="form-control feild" id="dob_father">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Dob Mother</p>
                                            <input type="date" name="dob_mother" value="{{isset($policy) ? $policy->dob_mother : ''}}" class="form-control feild" id="dob_mother">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Visiting Country</p>
                                            <input type="text" name="visiting_country" value="{{isset($policy) ? $policy->visiting_country : ''}}" class="form-control feild" id="visiting_country">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Date Of Departure</p>
                                            <input type="text" name="date_of_departure" value="{{isset($policy) ? $policy->date_of_departure : ''}}" class="form-control feild" id="date_of_departure">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Date of Arrival</p>
                                            <input type="text" name="date_of_arrival" value="{{isset($policy) ? $policy->date_of_arrival : ''}}" class="form-control feild" id="date_of_arrival">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">No Of Days</p>
                                            <input type="text" name="no_of_days" value="{{isset($policy) ? $policy->no_of_days : ''}}" class="form-control feild" id="no_of_days">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">No Of Person</p>
                                            <input type="text" name="no_person" value="{{isset($policy) ? $policy->no_person : ''}}" class="form-control feild" id="no_person">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Passport details</p>
                                            <input type="text" name="passport_datails" value="{{isset($policy) ? $policy->passport_datails : ''}}" class="form-control feild" id="passport_datails">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Make</p>
                                            <select name="make" id="make" class="form-control feild">
                                                <option value="">Select</option>
                                                @if($make->count())
                                                @foreach($make as $makes)
                                                <option value="{{$makes->id}}" {{ (isset($policy) && $makes->id == $policy->make) ? 'selected' : '' }}>{{$makes->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>


                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Model</p>

                                            <select name="model" class="select2 form-control feild" id="model">
                                                <option value="">Select Below</option>
                                                @if(isset($model) && $model->count() && isset($policy) )
                                                @foreach($model as $models)
                                                <option value="{{$models->id}}" {{ (isset($policy) && $models->id == $policy->model) ? 'selected' : '' }}>{{$models->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Variant</p>
                                            <select name="varriant" class="select2 form-control feild" id="varriant">
                                                <option value="">Select </option>
                                                @if(isset($varients) && $varients->count())
                                                @foreach($varients as $varriant)
                                                @if($varriant->type == 'varriant')
                                                <option value="{{$varriant->name}}" {{ (isset($policy) && $varriant->name == $policy->varriant) ? 'selected' : '' }}>{{$varriant->name}}</option>
                                                @endif
                                                @endforeach
                                                @endif
                                            </select>


                                        </div>


                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">CC/KW</p>

                                            <select name="cc" class="select2 form-control feild" id="cc">
                                                <option value="">Select Below</option>
                                                @if(isset($varients) && $varients->count())
                                                @foreach($varients as $varient)
                                                @if($varient->type == 'cc')
                                                <option value="{{$varient->name}}" {{ (isset($policy) && $varient->name == $policy->cc) ? 'selected' : '' }}>{{$varient->name}}</option>
                                                @endif
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Fuel</p>

                                            <select name="fuel" class="select2 form-control feild" id="fuel">
                                                <option value="">Select Below</option>
                                                @if(isset($varients) && $varients->count())
                                                @foreach($varients as $varient)
                                                @if($varient->type == 'fuel')
                                                <option value="{{$varient->name}}" {{ (isset($policy) && $varient->name == $policy->fuel) ? 'selected' : '' }}>{{$varient->name}}</option>
                                                @endif
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Seating Capacity</p>

                                            <select name="seating_capacity" class="select2 form-control feild" id="seating">
                                                <option value="">Select Below</option>
                                                @if(isset($varients) && $varients->count())
                                                @foreach($varients as $varient)
                                                @if($varient->type == 'seating')
                                                <option value="{{$varient->name}}" {{ (isset($policy) && $varient->name == $policy->seating_capacity) ? 'selected' : '' }}>{{$varient->name}}</option>
                                                @endif
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">EX Showroom Price</p>

                                            <select name="ex_showroom" class="select2 form-control feild" id="showroom">
                                                <option value="">Select Below</option>
                                                @if(isset($varients) && $varients->count())
                                                @foreach($varients as $varient)
                                                @if($varient->type == 'showroom')
                                                <option value="{{$varient->name}}" {{ (isset($policy) && $varient->name == $policy->ex_showroom) ? 'selected' : '' }}>{{$varient->name}}</option>
                                                @endif
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">OD Factor</p>

                                            <select name="od_factor" class="select2 form-control feild" id="od">
                                                <option value="">Select Below</option>
                                                @if(isset($varients) && $varients->count())
                                                @foreach($varients as $varient)
                                                @if($varient->type == 'od')
                                                <option value="{{$varient->name}}" {{ (isset($policy) && $varient->name == $policy->od_factor) ? 'selected' : '' }}>{{$varient->name}}</option>
                                                @endif
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Cubic Capacity</p>
                                            <input type="text" name="cubic_capacity" value="{{isset($policy) ? $policy->cubic_capacity : ''}}" class="form-control feild" id="cubic_capacity">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Type Of Business</p>
                                            <select name="bussiness_type" class="form-control feild" id="bussiness_type">
                                                <option value="">Select</option>
                                                <option value="New" {{ (isset($policy) && "New" == $policy->bussiness_type) ? 'selected' : '' }}>New</option>
                                                <option value="Rollover" {{ (isset($policy) && "Rollover" == $policy->bussiness_type) ? 'selected' : '' }}>Rollover</option>
                                                <option value="Renewal" {{ (isset($policy) && "Renewal" == $policy->bussiness_type) ? 'selected' : '' }}>Renewal</option>
                                                <option value="Used" {{ (isset($policy) && "Used" == $policy->bussiness_type) ? 'selected' : '' }}>Used</option>
                                            </select>

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Rto</p>
                                            <input type="text" name="rto" value="{{isset($policy) ? $policy->rto : ''}}" class="form-control feild" id="rto">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Vehicle Reg No</p>
                                            <input type="text" name="reg_no" value="{{isset($policy) ? $policy->reg_no : ''}}" class="form-control feild" id="reg_no">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">MFR Year</p>
                                            <Select name="mfr_year" id="mfr_year" class="form-control feild">
                                                <option value="">Select</option>
                                                <option value="2023" {{ (isset($policy) && "2023" == $policy->mfr_year) ? 'selected' : '' }}>2023</option>
                                                <option value="2022" {{ (isset($policy) && "2022" == $policy->mfr_year) ? 'selected' : '' }}>2022</option>
                                                <option value="2021" {{ (isset($policy) && "2021" == $policy->mfr_year) ? 'selected' : '' }}>2021</option>
                                                <option value="2020" {{ (isset($policy) && "2020" == $policy->mfr_year) ? 'selected' : '' }}>2020</option>
                                                <option value="2019" {{ (isset($policy) && "2019" == $policy->mfr_year) ? 'selected' : '' }}>2019</option>
                                                <option value="2018" {{ (isset($policy) && "2018" == $policy->mfr_year) ? 'selected' : '' }}>2018</option>
                                                <option value="2017" {{ (isset($policy) && "2017" == $policy->mfr_year) ? 'selected' : '' }}>2017</option>
                                                <option value="2016" {{ (isset($policy) && "2016" == $policy->mfr_year) ? 'selected' : '' }}>2016</option>
                                                <option value="2015" {{ (isset($policy) && "2015" == $policy->mfr_year) ? 'selected' : '' }}>2015</option>
                                                <option value="2014" {{ (isset($policy) && "2014" == $policy->mfr_year) ? 'selected' : '' }}>2014</option>
                                                <option value="2013" {{ (isset($policy) && "2013" == $policy->mfr_year) ? 'selected' : '' }}>2013</option>
                                                <option value="2012" {{ (isset($policy) && "2012" == $policy->mfr_year) ? 'selected' : '' }}>2012</option>
                                                <option value="2011" {{ (isset($policy) && "2011" == $policy->mfr_year) ? 'selected' : '' }}>2011</option>
                                                <option value="2010" {{ (isset($policy) && "2010" == $policy->mfr_year) ? 'selected' : '' }}>2010</option>
                                                <option value="2009" {{ (isset($policy) && "2009" == $policy->mfr_year) ? 'selected' : '' }}>2009</option>
                                                <option value="2008" {{ (isset($policy) && "2008" == $policy->mfr_year) ? 'selected' : '' }}>2008</option>
                                                <option value="2007" {{ (isset($policy) && "2007" == $policy->mfr_year) ? 'selected' : '' }}>2007</option>
                                                <option value="2006" {{ (isset($policy) && "2006" == $policy->mfr_year) ? 'selected' : '' }}>2006</option>
                                                <option value="2005" {{ (isset($policy) && "2005" == $policy->mfr_year) ? 'selected' : '' }}>2005</option>
                                                <option value="2004" {{ (isset($policy) && "2004" == $policy->mfr_year) ? 'selected' : '' }}>2004</option>
                                                <option value="2003" {{ (isset($policy) && "2003" == $policy->mfr_year) ? 'selected' : '' }}>2003</option>
                                                <option value="2002" {{ (isset($policy) && "2002" == $policy->mfr_year) ? 'selected' : '' }}>2002</option>
                                                <option value="2001" {{ (isset($policy) && "2001" == $policy->mfr_year) ? 'selected' : '' }}>2001</option>
                                                <option value="2000" {{ (isset($policy) && "2000" == $policy->mfr_year) ? 'selected' : '' }}>2000</option>
                                                <option value="1999" {{ (isset($policy) && "1999" == $policy->mfr_year) ? 'selected' : '' }}>1999</option>
                                                <option value="1998" {{ (isset($policy) && "1998" == $policy->mfr_year) ? 'selected' : '' }}>1998</option>
                                                <option value="1997" {{ (isset($policy) && "1997" == $policy->mfr_year) ? 'selected' : '' }}>1997</option>
                                                <option value="1996" {{ (isset($policy) && "1996" == $policy->mfr_year) ? 'selected' : '' }}>1996</option>
                                                <option value="1995" {{ (isset($policy) && "1995" == $policy->mfr_year) ? 'selected' : '' }}>1995</option>
                                            </Select>

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Date Of Registration</p>
                                            <input type="date" name="reg_date" value="{{isset($policy) ? $policy->reg_date : ''}}" class="form-control feild" id="reg_date">

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Claim In Existing Policy</p>
                                            <input type="radio" name="claims_in_existing_policy" {{ (isset($policy) && "Yes" == $policy->claims_in_existing_policy) ? 'checked' : '' }} value="Yes" class=" feild" id="claims_in_existing_policy">Yes
                                            <input type="radio" name="claims_in_existing_policy" {{ (isset($policy) && "No" == $policy->claims_in_existing_policy) ? 'checked' : '' }} value="No" class=" feild" id="claims_in_existing_policy">No
                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">NCB In Existing Policy</p>
                                            <select name="ncb_in_existing_policy" id="ncb_in_existing_policy" class="form-control feild">
                                                <option value="">Select</option>
                                                <option value="0" {{ (isset($policy) && "0" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>0</option>
                                                <option value="20" {{ (isset($policy) && "20" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>20</option>
                                                <option value="25" {{ (isset($policy) && "25" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>25</option>
                                                <option value="35" {{ (isset($policy) && "35" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>35</option>
                                                <option value="45" {{ (isset($policy) && "45" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>45</option>
                                                <option value="50" {{ (isset($policy) && "50" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>50</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Gcv Type</p>
                                            <select name="gcv_type" class="form-control feild" id="gcv_type">
                                                <option value="">Select</option>
                                                <option value="Public Carrier" {{ (isset($policy) && "Public Carrier" == $policy->gcv_type) ? 'selected' : '' }}>Public Carrier</option>
                                                <option value="PVT Carrier" {{ (isset($policy) && "PVT Carrier" == $policy->gcv_type) ? 'selected' : '' }}>PVT Carrier</option>
                                            </select>

                                        </div>
                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">GVW</p>
                                            <select name="gvw" class="form-control feild" id="gvw">
                                                <option value="">Select</option>
                                                <option value=">2500" {{ (isset($policy) && ">2500" == $policy->gvw) ? 'selected' : '' }}>>2500</option>
                                                <option value="2501 to 3500" {{ (isset($policy) && "2501 to 3500" == $policy->gvw) ? 'selected' : '' }}>2501 to 3500</option>
                                                <option value="3501 to 7500" {{ (isset($policy) && "3501 to 7500" == $policy->gvw) ? 'selected' : '' }}>3501 to 7500</option>
                                                <option value="7501 to 12000" {{ (isset($policy) && "7501 to 12000" == $policy->gvw) ? 'selected' : '' }}>7501 to 12000</option>
                                                <option value="12001 to 20000" {{ (isset($policy) && "12001 to 20000" == $policy->gvw) ? 'selected' : '' }}>12001 to 20000</option>
                                                <option value="20000 to 25000" {{ (isset($policy) && "20000 to 25000" == $policy->gvw) ? 'selected' : '' }}>20000 to 25000</option>
                                                <option value="25000 to 40000" {{ (isset($policy) && "25000 to 40000" == $policy->gvw) ? 'selected' : '' }}>25000 to 40000</option>
                                                <option value=">40000" {{ (isset($policy) && ">40000" == $policy->gvw) ? 'selected' : '' }}>>40000</option>
                                            </select>

                                        </div>

                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Passenger Carrying Capacity</p>
                                            <input type="text" name="passenger_carrying_capacity" value="{{isset($policy) ? $policy->passenger_carrying_capacity : ''}}" class="form-control feild" id="passenger_carrying_capacity">

                                        </div>

                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">Category</p>
                                            <input type="text" name="category" value="{{isset($policy) ? $policy->category : ''}}" class="form-control feild" id="category">

                                        </div>

                                        <div class="col-lg-6">

                                            <p class="mg-t-10 mg-b-1">GST</p>
                                            <input type="text" name="gst" onkeyup="grossPremium()" value="{{isset($policy) ? $policy->gst : ''}}" class="form-control feild" id="gst">

                                        </div>



                                    </div>
                                </div>


                                <!-- ------------------------------------------------- polciy end --------------------------------------------   -->


                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h4>Attachment</h4>
                                    <button type="button" name="add" onclick="addAttachment()" class="btn btn-success">Save</button>
                                    <table class="table table-bordered" id="attachment_dynamic">
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4>Mis</h4>

                                    <div class="row row-xs align-items-center mg-b-20 ">
                                        <div class="col-lg-6">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label mg-b-0"> Reference Type</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 tp">
                                                <select name="user_type" class="form-control reference_type">
                                                    <option value="">Select</option>
                                                    @if(isset($roles) && $roles->count())
                                                    @foreach($roles as $role)
                                                    <option value="{{$role->id}}" {{ (isset($policy->user_type) && $role->id == $policy->user_type) ? 'Selected' : '' }}>{{$role->name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label mg-b-0"> Reference Name</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 tp">
                                                <select name="user_id" class="form-control  dynamic-user-id">
                                                    <option value="">Select</option>
                                                    @if(isset($users) && $users->count())
                                                    @foreach($users as $user)
                                                    <option value="{{$user->id}}" {{ (isset($policy->user_id) && $user->id == $policy->user_id) ? 'selected' : '' }}>{{$user->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20 ">
                                        <div class="col-lg-6">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label mg-b-0"> Amount paid</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 tp">
                                                <input type="number" name="mis_amount_paid" value="{{isset($policy) ? $policy->mis_amount_paid : ''}}" class="form-control" placeholder="enter amount paid" id="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label mg-b-0"> Payment date</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 tp">
                                                <input type="date" name="mis_payment_date" value="{{isset($policy) ? $policy->mis_payment_date : ''}}" class="form-control" placeholder="enter payment date" id="">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20 ">
                                        <div class="col-lg-6">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label mg-b-0"> Payment method</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 tp">
                                                <select name="mis_payment_method" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Cheque" {{ (isset($policy->mis_payment_method) && 'Cheque' == $policy->mis_payment_method) ? 'selected' : '' }}>Cheque</option>
                                                    <option value="DD/Draft" {{ (isset($policy->mis_payment_method) && 'DD/Draft' == $policy->mis_payment_method) ? 'selected' : '' }}>DD/Draft</option>
                                                    <option value="Bank Transfer" {{ (isset($policy->mis_payment_method) && 'Bank Transfer' == $policy->mis_payment_method) ? 'selected' : '' }}>Bank Transfer</option>
                                                    <option value="Online" {{ (isset($policy->mis_payment_method) && 'Online' == $policy->mis_payment_method) ? 'selected' : '' }}>Online</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label mg-b-0"> Base amount</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 tp">
                                                <input type="number" name="mis_commissionable_amount" value="{{isset($policy) ? $policy->mis_commissionable_amount : ''}}" onkeyup="commission()" class="form-control" placeholder="enter commission amount" id="mis_commissionable_amount">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20 ">
                                        <div class="col-lg-6">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label mg-b-0"> Percentage</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 tp">
                                                <input type="number" name="mis_percentage" value="{{isset($policy) ? $policy->mis_percentage : ''}}" onkeyup="commission()" class="form-control" placeholder="enter percentage" id="mis_percentage">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label mg-b-0"> Commision</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 tp">
                                                <input type="text" name="mis_commission" value="{{isset($policy) ? $policy->mis_commission : ''}}" class="form-control" placeholder="enter commision" id="mis_commission">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20 ">
                                        <div class="col-lg-6">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label mg-b-0"> Transaction Type</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 tp">
                                                <select name="mis_transaction_type" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Package" {{ (isset($policy->mis_transaction_type) && 'Package' == $policy->mis_transaction_type) ? 'selected' : '' }}>Package</option>
                                                    <option value="SOAD" {{ (isset($policy->mis_transaction_type) && 'SOAD' == $policy->mis_transaction_type) ? 'selected' : '' }}>SOAD</option>
                                                    <option value="TP" {{ (isset($policy->mis_transaction_type) && 'TP' == $policy->mis_transaction_type) ? 'selected' : '' }}>TP</option>
                                                    <option value="Endorsement" {{ (isset($policy->mis_transaction_type) && 'Endorsement' == $policy->mis_transaction_type) ? 'selected' : '' }}>Endorsement</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label mg-b-0"> Premium</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 tp">
                                                <input type="number" name="mis_premium" value="{{isset($policy) ? $policy->mis_premium : ''}}" id="mis_premium" placeholder="enter premium" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($policy) ? 'Update' : 'Save' }}</button>
                        </div>
                </div>
                </form>
                <!-- form end  -->
            </div>
        </div>
    </div>
    <!-- /row -->
</div>


@endsection


@section('scripts')

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#insurance_id').change(function() {
            if ($(this).val() != '') {

                var insurance_id = $(this).val();
                $.ajax({
                    url: "{{ route('getProduct') }}",
                    method: "post",
                    data: {
                        insurance_id: insurance_id,
                    },
                    success: function(result) {
                        $('#product_id').html(result);
                    }

                });
            }
        });
        $('.reference_type').change(function() {
            if ($(this).val() != '') {

                var role = $(this).val();
                $.ajax({
                    url: "{{ route('getUsers') }}",
                    method: "post",
                    data: {
                        role: role,
                    },
                    success: function(result) {
                        $('.dynamic-user-id').html(result);
                    }
                });
            }
        });
        $('#make').change(function() {
            if ($(this).val() != '') {

                var make = $(this).val();
                $.ajax({
                    url: "{{ route('getModel') }}",
                    method: "post",
                    data: {
                        make: make,
                    },
                    success: function(result) {
                        $('#model').html(result['model']);
                    }

                });
            }
        });
        $('#model').change(function() {
            if ($(this).val() != '') {

                var make = $(this).val();
                $.ajax({
                    url: "{{ route('getVarient') }}",
                    method: "post",
                    data: {
                        make: make,
                    },
                    success: function(result) {
                        $('#varriant').html(result['varriant']);
                        $('#cc').html(result['cc']);
                        $('#fuel').html(result['fuel']);
                        $('#od').html(result['od']);
                        $('#seating').html(result['seating']);
                        $('#showroom').html(result['showroom']);
                        $('.tp_premium').html(result['tp']);
                    }

                });
            }
        });
        $('#product_id').change(function() {
            if ($(this).val() != '') {

                var product_id = $(this).val();
                $.ajax({
                    url: "{{ route('getSubProduct') }}",
                    method: "post",
                    data: {
                        product_id: product_id,
                    },
                    success: function(result) {
                        $('#subproduct_id').html(result);
                    }
                });
            }
        });
        $('.feild').parent('div').hide()
        $('.common-feild').parent('div').show()
        $('#subproduct_id').change(function() {
            if ($(this).val() != '') {

                var subproduct_id = $(this).val();
                $.ajax({
                    url: "{{ route('getMake') }}",
                    method: "post",
                    data: {
                        subproduct_id: subproduct_id,
                    },
                    success: function(result) {
                        console.log(result);
                        $('#make').html(result);
                    }
                });
            }
            var subproduct = $(this).find(':selected').data("id");
            if (subproduct != '') {
                subproduct = $.trim(subproduct).toLowerCase();
                changeFeild(subproduct);
            }


        });
        let editSubproductId = "{{$policy->subProduct->name ?? ''}}";
        if (editSubproductId != '') {
            editSubproductId = $.trim(editSubproductId).toLowerCase();
            changeFeild(editSubproductId);
        }
    });

    function addAttachment() {
        $("#attachment_dynamic").append('  <tr> <td><input type="file" name="attachment[]"  id="attachment"  class="form-control tableData"></td> <td><select name="type[]" class="form-control" ><option value="">Select</option><option value="Attachment">Policy Copy</option><option value="RC">RC</option><option value="Previous Year Policy">Previous Year Policy</option><option value="Invoice Copy">Invoice Copy</option> <option value="Other">Other</option> </select> </td><td><button type="button"  class="btn btn-danger deleteatt" style="background: red">Delete</button></td></tr>')
    }
    $(document).on('click', '.deleteatt', function() {
        $(this).closest('tr').remove();
    });

    function changeFeild(subproduct) {
        if (subproduct == 'others' || subproduct == 'cpm' || subproduct == 'car') {
            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#requirement').parent('div').show();
            $('#client_name').parent('div').show();
            $('#address').parent('div').show();
            $('#remarks').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();
        }
        if (subproduct == 'marine') {
            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#type').parent('div').show();
            $('#client_name').parent('div').show();
            $('#address').parent('div').show();
            $('#commodity_type').parent('div').show();
            $('#mode_of_transport').parent('div').show();
            $('#cover_type').parent('div').show();
            $('#per_sending_limit').parent('div').show();
            $('#per_location_limit').parent('div').show();
            $('#estimate_annual_sum').parent('div').show();
            $('#basic_of_valuation').parent('div').show();
            $('#policy_period').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();
            $('#commodity_details').parent('div').show();
            $('#packing_description').parent('div').show();
            $('#remarks').parent('div').show();
            $('#net_premium').parent('div').show();
            $('#gst').parent('div').show();
            $('#gwp').parent('div').show();

        }
        if (subproduct == 'liability') {
            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#libality').parent('div').show();
            $('#policy_type').parent('div').show();
            $('#liability_industrial').parent('div').show();
            $('#liability_nonindustrial').parent('div').show();
            $('#liability_act').parent('div').show();
            $('#professional_indeminity').parent('div').show();
            $('#comprehensive_general_liability').parent('div').show();
            $('#net_premium').parent('div').show();
            $('#gst').parent('div').show();
            $('#gwp').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();

        }
        if (subproduct == 'liability') {
            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#libality').parent('div').show();
            $('#policy_type').parent('div').show();
            $('#liability_industrial').parent('div').show();
            $('#liability_nonindustrial').parent('div').show();
            $('#liability_act').parent('div').show();
            $('#professional_indeminity').parent('div').show();
            $('#comprehensive_general_liability').parent('div').show();
            $('#net_premium').parent('div').show();
            $('#gst').parent('div').show();
            $('#gwp').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();

        }
        if (subproduct == 'wc') {
            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#wc_policy').parent('div').show();
            $('#client_name').parent('div').show();
            $('#address').parent('div').show();
            $('#pincode').parent('div').show();
            $('#industry_type').parent('div').show();
            $('#worker_number').parent('div').show();
            $('#policy_period').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();
            $('#job_profile').parent('div').show();
            $('#remakrs').parent('div').show();
            $('#salary_per_month').parent('div').show();
            $('#add_on_cover').parent('div').show();
            $('#medical_extension').parent('div').show();
            $('#occupation_disease').parent('div').show();
            $('#compressed_air_disease').parent('div').show();
            $('#terrorism_cover').parent('div').show();
            $('#sub_contractor_cover').parent('div').show();
            $('#multiple_location').parent('div').show();
            $('#net_premium').parent('div').show();
            $('#gst').parent('div').show();
            $('#gwp').parent('div').show();

        }
        if (subproduct == 'fire' || subproduct == 'burglary') {
            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#client_name').parent('div').show();
            $('#address').parent('div').show();
            $('#pincode').parent('div').show();
            $('#remakrs').parent('div').show();
            $('#occupancy').parent('div').show();
            $('#occupancy_tarriff').parent('div').show();
            $('#particular').parent('div').show();
            $('#building').parent('div').show();
            $('#plant_machine').parent('div').show();
            $('#furniture_fixure').parent('div').show();
            $('#stock_in_process').parent('div').show();
            $('#finished_stock').parent('div').show();
            $('#other_contents').parent('div').show();
            $('#clain_in_last_three_year').parent('div').show();
            $('#loss_details').parent('div').show();
            $('#loss_in_amount').parent('div').show();
            $('#loss_date').parent('div').show();
            $('#measures_taken_after_loss').parent('div').show();
            $('#basic_premium').parent('div').show();
            $('#terrorism_premium').parent('div').show();
            $('#net_premium').parent('div').show();
            $('#gst').parent('div').show();
            $('#gwp').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();
        }
        if (subproduct == 'home') {
            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#client_name').parent('div').show();
            $('#address_risk_location').parent('div').show();
            $('#cover_opted').parent('div').show();
            $('#policy_inception_date').parent('div').show();
            $('#tenure').parent('div').show();
            $('#construction_type').parent('div').show();
            $('#age_of_building').parent('div').show();
            $('#basement_for_building').parent('div').show();
            $('#basement_for_content').parent('div').show();
            $('#claims').parent('div').show();
            $('#building_carpet_area').parent('div').show();
            $('#building_cost_of_construction').parent('div').show();
            $('#building_sum_insured').parent('div').show();
            $('#content_sum_insured').parent('div').show();
            $('#rent_alternative_accommodation').parent('div').show();
            $('#loss_in_amount').parent('div').show();
            $('#loss_date').parent('div').show();
            $('#measures_taken_after_loss').parent('div').show();
            $('#basic_premium').parent('div').show();
            $('#terrorism_premium').parent('div').show();
            $('#net_premium').parent('div').show();
            $('#gst').parent('div').show();
            $('#gwp').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();

        }
        if (subproduct == 'health') {
            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#fresh').parent('div').show();
            $('#portability').parent('div').show();
            $('#dob').parent('div').show();
            $('#pre_existing_disease').parent('div').show();
            $('#hospitalization_history').parent('div').show();
            $('#upload_discharge_summary').parent('div').show();
            $('#dob_sr_most_member').parent('div').show();
            $('#dob_self').parent('div').show();
            $('#dob_spouse').parent('div').show();
            $('#dob_child').parent('div').show();
            $('#dob_father').parent('div').show();
            $('#dob_mother').parent('div').show();
            $('#sum_insured').parent('div').show();
            $('#net_premium').parent('div').show();
            $('#gst').parent('div').show();
            $('#gwp').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();

        }
        if (subproduct == 'travel') {
            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#sum_insured').parent('div').show();
            $('#visiting_country').parent('div').show();
            $('#date_of_departure').parent('div').show();
            $('#date_of_arrival').parent('div').show();
            $('#no_of_days').parent('div').show();
            $('#no_person').parent('div').show();
            $('#passport_datails').parent('div').show();
            $('#dob_self').parent('div').show();
            $('#dob_spouse').parent('div').show();
            $('#dob_child').parent('div').show();
            $('#dob_father').parent('div').show();
            $('#dob_mother').parent('div').show();
            $('#sum_insured').parent('div').show();
            $('#net_premium').parent('div').show();
            $('#gst').parent('div').show();
            $('#gwp').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();

        }
        if (subproduct == 'pvr') {
            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#make').parent('div').show();
            $('#varriant').parent('div').show();
            $('#model').parent('div').show();
            $('#cubic_capacity').parent('div').show();
            $('#bussiness_type').parent('div').show();
            $('#remakrs').parent('div').show();
            $('#rto').parent('div').show();
            $('#reg_no').parent('div').show();
            $('#mfr_year').parent('div').show();
            $('#reg_date').parent('div').show();
            $('#claims_in_existing_policy').parent('div').show();
            $('#ncb_in_existing_policy').parent('div').show();
            $('#od_premium').parent('div').show();
            $('#add_on_premium').parent('div').show();
            $('#tp_premium').parent('div').show();
            $('#pa').parent('div').show();
            $('#others').parent('div').show();
            $('#net_premium').parent('div').show();
            $('#gst').parent('div').show();
            $('#gross_premium').parent('div').show();
            $('#od').parent('div').show();
            $('#showroom').parent('div').show();
            $('#cc').parent('div').show();
            $('#seating').parent('div').show();
            $('#seating').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();

        }
        if (subproduct == 'pvt car') {

            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#make').parent('div').show();
            $('#varriant').parent('div').show();
            $('#model').parent('div').show();
            $('#bussiness_type').parent('div').show();
            $('#remakrs').parent('div').show();
            $('#mfr_year').parent('div').show();
            $('#reg_date').parent('div').show();
            $('#claims_in_existing_policy').parent('div').show();
            $('#ncb_in_existing_policy').parent('div').show();
            $('#od_premium').parent('div').show();
            $('#add_on_premium').parent('div').show();
            $('#tp_premium').parent('div').show();
            $('#pa').parent('div').show();
            $('#others').parent('div').show();
            $('#net_premium').parent('div').show();
            $('#gst').parent('div').show();
            $('#gross_premium').parent('div').show();
            $('#od').parent('div').show();
            $('#showroom').parent('div').show();
            $('#cc').parent('div').show();
            $('#seating').parent('div').show();
            $('#seating').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();
            $('#reg_no').parent('div').show();
        }
        if (subproduct == 'gcv') {
            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#gcv_type').parent('div').show();
            $('#gvw').parent('div').show();
            $('#make').parent('div').show();
            $('#varriant').parent('div').show();
            $('#model').parent('div').show();
            $('#bussiness_type').parent('div').show();
            $('#remakrs').parent('div').show();
            $('#mfr_year').parent('div').show();
            $('#reg_date').parent('div').show();
            $('#claims_in_existing_policy').parent('div').show();
            $('#ncb_in_existing_policy').parent('div').show();
            $('#od_premium').parent('div').show();
            $('#add_on_premium').parent('div').show();
            $('#tp_premium').parent('div').show();
            $('#pa').parent('div').show();
            $('#others').parent('div').show();
            $('#net_premium').parent('div').show();
            $('#gst').parent('div').show();
            $('#gross_premium').parent('div').show();
            $('#od').parent('div').show();
            $('#showroom').parent('div').show();
            $('#cc').parent('div').show();
            $('#seating').parent('div').show();
            $('#seating').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();
            $('#reg_no').parent('div').show();
        }
        if (subproduct == 'pcv') {
            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#fuel_type').parent('div').show();
            $('#vehicle_type').parent('div').show();
            $('#passenger_carrying_capacity').parent('div').show();
            $('#category').parent('div').show();
            $('#make').parent('div').show();
            $('#varriant').parent('div').show();
            $('#model').parent('div').show();
            $('#bussiness_type').parent('div').show();
            $('#remakrs').parent('div').show();
            $('#mfr_year').parent('div').show();
            $('#reg_date').parent('div').show();
            $('#claims_in_existing_policy').parent('div').show();
            $('#ncb_in_existing_policy').parent('div').show();
            $('#od_premium').parent('div').show();
            $('#add_on_premium').parent('div').show();
            $('#tp_premium').parent('div').show();
            $('#pa').parent('div').show();
            $('#others').parent('div').show();
            $('#net_premium').parent('div').show();
            $('#gst').parent('div').show();
            $('#gross_premium').parent('div').show();
            $('#od').parent('div').show();
            $('#showroom').parent('div').show();
            $('#cc').parent('div').show();
            $('#seating').parent('div').show();
            $('#seating').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();
            $('#reg_no').parent('div').show();
        }
        if (subproduct == 'tw') {
            $('.feild').parent('div').hide()
            $('.common-feild').parent('div').show();
            $('#make').parent('div').show();
            $('#varriant').parent('div').show();
            $('#model').parent('div').show();
            $('#bussiness_type').parent('div').show();
            $('#remakrs').parent('div').show();
            $('#mfr_year').parent('div').show();
            $('#reg_date').parent('div').show();
            $('#claims_in_existing_policy').parent('div').show();
            $('#ncb_in_existing_policy').parent('div').show();
            $('#od_premium').parent('div').show();
            $('#add_on_premium').parent('div').show();
            $('#tp_premium').parent('div').show();
            $('#pa').parent('div').show();
            $('#others').parent('div').show();
            $('#net_premium').parent('div').show();
            $('#gst').parent('div').show();
            $('#gross_premium').parent('div').show();
            $('#od').parent('div').show();
            $('#showroom').parent('div').show();
            $('#cc').parent('div').show();
            $('#seating').parent('div').show();
            $('#seating').parent('div').show();
            $('#start_date').parent('div').show();
            $('#expiry_date').parent('div').show();
            $('#reg_no').parent('div').show();
        }


    }

    function commission() {
        var commission_amount = $("#mis_commissionable_amount").val();
        var commission_perc = $("#mis_percentage").val();
        var commission_calc = commission_amount * commission_perc / 100;
        $("#mis_commission").val(commission_calc);
    }

    function grossPremium() {
        var od_premium = $("#od_premium").val();
        var tp_premium = $("#tp_premium").val();
        var add_on_premium = $("#add_on_premium").val();
        var others = $("#others").val();
        var gst = $("#gst").val();
        console.log(typeof parseFloat(od_premium))
        var gross = parseFloat(od_premium) + parseFloat(tp_premium) + parseFloat(add_on_premium); // + parseFloat(others) + parseFloat(gst);
        console.log(typeof gross, gross);
        $("#gross_premium").val(gross);
        console.log();
    }
</script>

@endsection