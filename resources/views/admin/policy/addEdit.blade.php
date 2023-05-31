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
    <style>
        .background {
            background-color: #ecf0fa !important;
            margin: 8px;
        }
    </style>
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
                        <div class="pd-30 pd-sm-40 bg-gray-400">

                            <div class="container general-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">
                                            <div class="col-sm-2">
                                                <div>General Details</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row main-row">
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Reference Type</label>
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
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label "> Reference Name</label>
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
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">INSURANCE TYPE </label>
                                                                <select name="insurance_id" class="select2 form-control" id="insurance_id">
                                                                    <option value="">Select Below</option>
                                                                    @if($insurances->count())
                                                                    @foreach($insurances as $insurance)
                                                                    <option value="{{$insurance->id}}" {{ (isset($policy) && $insurance->id == $policy->insurance_id) ? 'selected' : '' }}>{{$insurance->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">INSURANCE COMPANY</label>
                                                                <select name="company_id" class="select2 form-control common-feild feild" id="company_id">
                                                                    <option value="">Select Below</option>
                                                                    @if($companies->count())
                                                                    @foreach($companies as $company)
                                                                    <option value="{{$company->id}}" {{ (isset($policy) && $company->id == $policy->company_id) ? 'selected' : '' }}>{{$company->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PRODUCT</label>
                                                                <select name="product_id" class="select2 form-control" id="product_id">
                                                                    <option value="">Select Below</option>
                                                                    @if(isset($products) && $products->count())
                                                                    @foreach($products as $product)
                                                                    <option value="{{$product->id}}" {{ (isset($policy) && $product->id == $policy->product_id) ? 'selected' : '' }}>{{$product->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Sub Product</label>
                                                                <select name="subproduct_id" class="select2 form-control" id="subproduct_id">
                                                                    <option value="">Select Below</option>
                                                                    @if(isset($subProducts) && $subProducts->count())
                                                                    @foreach($subProducts as $subProduct)
                                                                    <option value="{{$subProduct->id}}" data-id="{{$subProduct->name}}" {{ (isset($policy) && $subProduct->id == $policy->subproduct_id) ? 'selected' : '' }}>{{$subProduct->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row main-row">
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">TYPE OF BUSINESS</label>
                                                                <select name="bussiness_type" class="form-control" id="bussiness_type">
                                                                    <option value="">Select</option>
                                                                    <option value="New" {{ (isset($policy) && "New" == $policy->bussiness_type) ? 'selected' : '' }}>New</option>
                                                                    <option value="Rollover" {{ (isset($policy) && "Rollover" == $policy->bussiness_type) ? 'selected' : '' }}>Rollover</option>
                                                                    <option value="Renewal" {{ (isset($policy) && "Renewal" == $policy->bussiness_type) ? 'selected' : '' }}>Renewal</option>
                                                                    <option value="Used" {{ (isset($policy) && "Used" == $policy->bussiness_type) ? 'selected' : '' }}>Used</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label "> TRANSACTION TYPE</label>
                                                                <select name="mis_transaction_type" class="form-control">
                                                                    <option value="">Select</option>
                                                                    <option value="Package" {{ (isset($policy->mis_transaction_type) && 'Package' == $policy->mis_transaction_type) ? 'selected' : '' }}>Package</option>
                                                                    <option value="SOAD" {{ (isset($policy->mis_transaction_type) && 'SOAD' == $policy->mis_transaction_type) ? 'selected' : '' }}>SOAD</option>
                                                                    <option value="TP" {{ (isset($policy->mis_transaction_type) && 'TP' == $policy->mis_transaction_type) ? 'selected' : '' }}>TP</option>
                                                                    <option value="Endorsement" {{ (isset($policy->mis_transaction_type) && 'Endorsement' == $policy->mis_transaction_type) ? 'selected' : '' }}>Endorsement</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Holder Name</label>
                                                                <input class="form-control" name="holder_name" placeholder="Enter your name" type="text" value="{{isset($policy) ? $policy->holder_name : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Holder Phone Number</label>
                                                                <input class="form-control" name="phone" placeholder="Enter your Number" type="text" value="{{isset($policy) ? $policy->phone : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Holder Email</label>
                                                                <input class="form-control" name="email" placeholder="Enter your email" type="email" value="{{isset($policy) ? $policy->email : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">CHANNEL NAME</label>
                                                                <select name="channel_name" class="select2 form-control common-feild feild" id="channel_name">
                                                                    <option value="">Select Below</option>
                                                                    @if($channels->count())
                                                                    @foreach($channels as $channel)
                                                                    <option value="{{$channel->name}}" {{ (isset($policy) && $channel->name == $policy->channel_name) ? 'selected' : '' }}>{{$channel->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>




                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container vehicle-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">
                                            <div class="col-sm-2">
                                                <div>Vehicle Details</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Vehicle Reg No </label>
                                                                <input type="text" name="reg_no" value="{{isset($policy) ? $policy->reg_no : ''}}" class="form-control " id="reg_no">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Make</label>
                                                                <select name="make" id="make" class="form-control ">
                                                                    <option value="">Select</option>
                                                                    @if($make->count())
                                                                    @foreach($make as $makes)
                                                                    <option value="{{$makes->id}}" {{ (isset($policy) && $makes->id == $policy->make) ? 'selected' : '' }}>{{$makes->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Model</label>
                                                                <select name="model" class="select2 form-control " id="model">
                                                                    <option value="">Select Below</option>
                                                                    @if(isset($model) && $model->count() && isset($policy) )
                                                                    @foreach($model as $models)
                                                                    <option value="{{$models->id}}" {{ (isset($policy) && $models->id == $policy->model) ? 'selected' : '' }}>{{$models->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Variant</label>
                                                                <select name="varriant" class="select2 form-control " id="varriant">
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
                                                        </div>

                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center cc-kw">
                                                            <div class="main-form-group background cc-kw">
                                                                <label class="form-label">CC/KW </label>
                                                                <select name="cc" class="select2 form-control " id="cc">
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
                                                        </div>
                                                        <div class="col-lg-3  text-center gvw">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">GVW </label>
                                                                <select name="gvw" class="form-control " id="gvw">
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
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Fuel</label>
                                                                <select name="fuel" class="select2 form-control " id="fuel">
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
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Seating Capacity</label>
                                                                <select name="seating_capacity" class="select2 form-control " id="seating">
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
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">MFR YEAR</label>
                                                                <Select name="mfr_year" id="mfr_year" class="form-control ">
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
                                                        </div>

                                                    </div>
                                                </div>





                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container motor-policy-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">
                                            <div class="col-sm-2">
                                                <div>Policy Details</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">POLICY NO </label>
                                                                <input type="text" name="policy_no" value="{{isset($policy) ? $policy->policy_no : ''}}" class="form-control " id="policy_no">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">NCB IN CURRENT POLICY</label>
                                                                <select name="ncb_in_existing_policy" id="ncb_in_existing_policy" class="form-control ">
                                                                    <option value="">Select</option>
                                                                    <option value="0" {{ (isset($policy) && "0" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>0</option>
                                                                    <option value="20" {{ (isset($policy) && "20" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>20</option>
                                                                    <option value="25" {{ (isset($policy) && "25" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>25</option>
                                                                    <option value="35" {{ (isset($policy) && "35" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>35</option>
                                                                    <option value="45" {{ (isset($policy) && "45" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>45</option>
                                                                    <option value="50" {{ (isset($policy) && "50" == $policy->ncb_in_existing_policy) ? 'selected' : '' }}>50</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">POLICY START DATE</label>
                                                                <input type="date" name="start_date" value="{{isset($policy) ? $policy->start_date : ''}}" class="form-control " id="start_date">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Expiry Date</label>
                                                                <input type="date" name="expiry_date" value="{{isset($policy) ? $policy->expiry_date : ''}}" class="form-control " id="expiry_date">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">IDV/Sum insured</label>
                                                                <input type="text" name="sum_insured" value="{{isset($policy) ? $policy->sum_insured : ''}}" class="form-control" id="sum_insured">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">OD Premium</label>
                                                                <input type="text" name="od_premium" onkeyup="grossPremium()" value="{{isset($policy) ? $policy->od_premium : ''}}" class="form-control " id="od_premium">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Add On Premium</label>
                                                                <input type="text" name="add_on_premium" onkeyup="grossPremium()" value="{{isset($policy) ? $policy->add_on_premium : ''}}" class="form-control " id="add_on_premium">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">TP Premium</label>
                                                                <select name="tp_premium" class="select2 form-control tp_premium" onkeyup="grossPremium()" id="tp_premium">
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
                                                        </div>

                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PA+OTHERS</label>
                                                                <input type="text" name="others" value="{{isset($policy) ? $policy->others : ''}}" onkeyup="grossPremium()" class="form-control " id="others">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Net Premium</label>
                                                                <input type="text" name="net_premium" value="{{isset($policy) ? $policy->net_premium : ''}}" class="form-control " id="net_premium">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">GST</label>
                                                                <input type="text" name="gst" onkeyup="grossPremium()" value="{{isset($policy) ? $policy->gst : ''}}" class="form-control " id="gst">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">GROSS PREMIUM
                                                                </label>
                                                                <input type="text" name="gross_premium" value="{{isset($policy) ? $policy->gross_premium : ''}}" class="form-control " id="gross_premium">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>





                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container non-motor-policy-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">
                                            <div class="col-sm-2">
                                                <div>Policy Details</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row main-row">
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">POLICY NO
                                                                </label>
                                                                <input type="text" name="policy_no" value="{{isset($policy) ? $policy->policy_no : ''}}" class="form-control common-feild feild" id="policy_no">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">POLICY START DATE</label>
                                                                <input type="date" name="start_date" value="{{isset($policy) ? $policy->start_date : ''}}" class="form-control " id="start_date">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Expiry Date</label>
                                                                <input type="date" name="expiry_date" value="{{isset($policy) ? $policy->expiry_date : ''}}" class="form-control " id="expiry_date">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Net Premium</label>
                                                                <input type="text" name="net_premium" value="{{isset($policy) ? $policy->net_premium : ''}}" class="form-control " id="net_premium">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">GST</label>
                                                                <input type="text" name="gst" onkeyup="grossPremium()" value="{{isset($policy) ? $policy->gst : ''}}" class="form-control " id="gst">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label "> GROSS PREMIUM
                                                                </label>
                                                                <input type="text" name="gross_premium" value="{{isset($policy) ? $policy->gross_premium : ''}}" class="form-control " id="gross_premium">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>





                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container payment-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">
                                            <div class="col-sm-2">
                                                <div>PREMIUM PAYMENT DETAILS</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PREMIUM RECEIVED </label>
                                                                <input type="number" name="mis_amount_paid" value="{{isset($policy) ? $policy->mis_amount_paid : ''}}" class="form-control" placeholder="enter amount paid" id="">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PREMIUM RECEIVED IN a/c</label>
                                                                <input type="number" name="mis_received_bank_detail" value="{{isset($policy) ? $policy->mis_received_bank_detail : ''}}" class="form-control" placeholder="enter bank details = todo ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PAYMENT METHOD</label>
                                                                <select name="mis_payment_method" class="form-control">
                                                                    <option value="">Select</option>
                                                                    <option value="Cheque" {{ (isset($policy->mis_payment_method) && 'Cheque' == $policy->mis_payment_method) ? 'selected' : '' }}>Cheque</option>
                                                                    <option value="DD/Draft" {{ (isset($policy->mis_payment_method) && 'DD/Draft' == $policy->mis_payment_method) ? 'selected' : '' }}>DD/Draft</option>
                                                                    <option value="Bank Transfer" {{ (isset($policy->mis_payment_method) && 'Bank Transfer' == $policy->mis_payment_method) ? 'selected' : '' }}>Bank Transfer</option>
                                                                    <option value="Online" {{ (isset($policy->mis_payment_method) && 'Online' == $policy->mis_payment_method) ? 'selected' : '' }}>Online</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PREMIUM SHORT
                                                                </label>
                                                                <input type="number" name="mis_short_premium" value="{{isset($policy) ? $policy->mis_short_premium : ''}}" class="form-control" placeholder="GROSS PREMIUM - PREMIUM RECEIVED AMOUNT = todo ">
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PREMIUM DEPOSITED</label>
                                                                <input type="number" name="mis_premium_deposit" value="{{isset($policy) ? $policy->mis_premium_deposit : ''}}" class="form-control" placeholder="PREMIUM DEPOSITED = todo ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PREMIUM DEPOSITED TO a/c</label>
                                                                <input type="number" name="mis_deposit_bank_detail" value="{{isset($policy) ? $policy->mis_deposit_bank_detail : ''}}" class="form-control" placeholder="enter bank details = todo ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PAYMENT METHOD</label>
                                                                <select name="mis_deposit_payment_method" class="form-control">
                                                                    <option value="">Select</option>
                                                                    <option value="Cheque" {{ (isset($policy->mis_payment_method) && 'Cheque' == $policy->mis_payment_method) ? 'selected' : '' }}>Cheque</option>
                                                                    <option value="DD/Draft" {{ (isset($policy->mis_payment_method) && 'DD/Draft' == $policy->mis_payment_method) ? 'selected' : '' }}>DD/Draft</option>
                                                                    <option value="Bank Transfer" {{ (isset($policy->mis_payment_method) && 'Bank Transfer' == $policy->mis_payment_method) ? 'selected' : '' }}>Bank Transfer</option>
                                                                    <option value="Online" {{ (isset($policy->mis_payment_method) && 'Online' == $policy->mis_payment_method) ? 'selected' : '' }}>Online</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PREMIUM PAYMENT SOURCE</label>
                                                                <input type="text" name="premium_payment_source" value="{{isset($policy) ? $policy->premium_payment_source : ''}}" class="form-control " placeholder="Remarks" id="premium_payment_source">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container payout-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">
                                            <div class="col-sm-2">
                                                <div>PAYOUT DETAILS</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">COMMISSION BASE
                                                                </label>
                                                                <select name="commission_base" class="form-control" id="">
                                                                    <option value="">Select Below</option>
                                                                    <option value="od">OD</option>
                                                                    <option value="net">Net</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">COMMISSIONABLE AMOUNT</label>
                                                                <input type="number" name="mis_commissionable_amount" value="{{isset($policy) ? $policy->mis_commissionable_amount : ''}}" onkeyup="commission()" class="form-control" placeholder="enter commission amount" id="mis_commissionable_amount">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PERCENTAGE</label>
                                                                <input type="number" name="mis_percentage" value="{{isset($policy) ? $policy->mis_percentage : ''}}" onkeyup="commission()" class="form-control" placeholder="enter percentage" id="mis_percentage">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">AMOUNT
                                                                </label>
                                                                <input type="text" name="mis_commission" value="{{isset($policy) ? $policy->mis_commission : ''}}" class="form-control" placeholder="enter commision" id="mis_commission">
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">PAYOUT SETTLED</label>
                                                                <input type="number" name="payout_settled" value="{{isset($policy) ? $policy->payout_settled : ''}}" class="form-control" placeholder="PREMIUM DEPOSITED = todo ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">INVOICE
                                                                </label>
                                                                <input type="number" name="mis_invoice" value="{{isset($policy) ? $policy->mis_invoice : ''}}" class="form-control" placeholder="enter bank details = todo ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">MONTH SETTLED</label>
                                                                <input type="number" name="month_settled" value="{{isset($policy) ? $policy->month_settled : ''}}" class="form-control" placeholder="enter bank details = todo ">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">RECOVERY</label>
                                                                <input type="text" name="payout_recovery" value="{{isset($policy) ? $policy->payout_recovery : ''}}" class="form-control " placeholder="Remarks" id="payout_recovery">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container">

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
        $("select").select2();
        $('.motor-policy-details').hide();
        $('.vehicle-details').hide();
        $('.non-motor-policy-details').hide();
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

        if (subproduct == 'others' || subproduct == 'cpm' || subproduct == 'car' || subproduct == 'miscd') {
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
            $('.gvw').hide();
            $('.cc-kw').show();
        }
        if (subproduct == 'marine') {

            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
        }
        if (subproduct == 'liability') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();

        }

        if (subproduct == 'wc') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();

        }
        if (subproduct == 'fire' || subproduct == 'burglary') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
        }
        if (subproduct == 'home') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
        }
        if (subproduct == 'health') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();

        }
        if (subproduct == 'travel') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
        }


        if (subproduct == 'pvr') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();

        }
        if (subproduct == 'pvt car') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();

        }
        if (subproduct == 'gcv') {
            $('.motor-policy-details').show();
            $('.gvw').show();
            $('.cc-kw').hide();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
        }
        if (subproduct == 'pcv') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
        }
        if (subproduct == 'tw') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
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