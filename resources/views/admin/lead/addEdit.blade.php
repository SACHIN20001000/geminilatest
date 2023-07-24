@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                @include('admin.lead.common')
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pe-1 mb-xl-0">
                <a class="btn btn-main-primary" href="{{ route('leads.index',['id'=> 1]) }}">View Leads</a>
            </div>
        </div>


        <style type="text/css">
            .background {
                margin: 10px 5px;
            }

            .main-form-group {
                padding: 10px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgb(0 0 0 / 10%);
                background: #e8eaf3;
                border: 0px solid #e3e8f7;
            }

            .main-form-group .form-label {
                font-size: 12px;
                text-align: left;
                font-weight: 700;
                color: #031b4e;
            }

            .select2-container--default .select2-selection--single {
                border-color: #ebebff;
                height: 30px;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                font-size: 12px !important;
                line-height: 1 !important;
                padding-left: 8px;
                color: #6e7f96;
            }

            .main-form-group .form-control {
                color: #6e7f96;
            }

            .formgroup-wrapper .form-control {
                height: 30px !important;
                font-size: 12px;
                padding: 8px;
                border: 1px solid #ebebff;
            }

            .card-body {
                padding: 10px;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                width: 18px;
                height: 30px;
            }
        </style>
    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        {{isset($lead) ? 'Update # '.$lead->id : 'Add New' }}
                    </div>


                    <!--  start  -->
                    <form id="user-add-edit" action="{{isset($lead) ? route('leads.update',$lead->id) : route('leads.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($lead) ? method_field('PUT'):'' }}
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
                                                                <select name="company_id" class="select2 form-control common- " id="company_id">
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
                                                                <input class="form-control" name="holder_name" placeholder="Enter your name" type="text" value="{{isset($lead) ? $lead->holder_name : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Holder Phone Number</label>
                                                                <input class="form-control" name="phone" placeholder="Enter your Number" type="text" value="{{isset($lead) ? $lead->phone : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Holder Email</label>
                                                                <input class="form-control" name="email" placeholder="Enter your email" type="email" value="{{isset($lead) ? $lead->email : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">CHANNEL NAME</label>
                                                                <select name="channel_name" class="select2 form-control common- " id="channel_name">
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
                                                                <input type="text" name="policy_no" value="{{isset($policy) ? $policy->policy_no : ''}}" class="form-control common- " id="policy_no">
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
                            <div class="container health-section">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table card-table table-striped table-vcenter text-nowrap mb-0 dataTable no-footer">
                                                    <thead>
                                                        <th>MEMBER NAME</th>
                                                        <th>DOB</th>
                                                        <th>AGE</th>
                                                        <th>RELATION</th>
                                                        <th>SUM INSURED</th>
                                                        <th>PRE EXISTING DISEASE</th>
                                                        <th>HOSPITLIZATION HISTORY</th>
                                                        <th>UPLOAD</th>
                                                        <th>
                                                            <div class="btn-info btn add-health">Add</div>
                                                        </th>
                                                    </thead>
                                                    <tbody class="health-body">
                                                        @if(isset($policy->health_type) && !empty($policy->health_type))

                                                        <?php
                                                        $health_type = json_decode($policy->health_type);
                                                        ?>
                                                        @foreach($health_type->health_name as $key=> $name)

                                                        <tr>
                                                            <td><input type="text" class="form-control" name="health_name[]" value="{{$name??''}}"></td>

                                                            <td><input type="date" class="form-control" name="health_dob[]" value="{{$health_type->health_dob[$key]??''}}"></td>

                                                            <td><input type="text" class="form-control" name="health_age[]" value="{{$health_type->health_age[$key]??''}}"></td>
                                                            <td><input type="text" class="form-control" name="health_relation[]" value="{{$health_type->health_relation[$key]??''}}"></td>
                                                            <td><input type="text" class="form-control" name="health_sum_insured[]" value="{{$health_type->health_sum_insured[$key]??''}}"></td>
                                                            <td><input type="text" class="form-control" name="health_pre_existing_disease[]" value="{{$health_type->health_pre_existing_disease[$key] ?? ''}}"></td>
                                                            <td><input type="checkbox" class="checkbox" name="health_hospitalization[]"></td>
                                                            <td><input type="file" class="form-control" name="health_hospitalization_upload[]">
                                                                @if(isset($health_type->health_hospitalization_upload[$key]))

                                                                <a href="{{URL::asset('attachments')}}/{{$health_type->health_hospitalization_upload[$key] ?? ''}}" target="_blank">{{$health_type->health_hospitalization_upload[$key] ?? ''}}</a>
                                                                @endif


                                                            </td>
                                                            <td>
                                                                <div type="button" class="btn btn-danger delete-health">Delete</div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="health_name[]"></td>

                                                            <td><input type="date" class="form-control" name="health_dob[]"></td>

                                                            <td><input type="text" class="form-control" name="health_age[]"></td>
                                                            <td><input type="text" class="form-control" name="health_relation[]"></td>
                                                            <td><input type="text" class="form-control" name="health_sum_insured[]"></td>
                                                            <td><input type="text" class="form-control" name="health_pre_existing_disease[]"></td>
                                                            <td><input type="checkbox" class="checkbox" name="health_hospitalization[]"></td>
                                                            <td><input type="file" class="form-control" name="health_hospitalization_upload[]"></td>
                                                            <td>
                                                                <div type="button" class="btn btn-danger delete-health">Delete</div>
                                                            </td>
                                                        </tr>


                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container marine-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">

                                            <div class="col-sm-12">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-4  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">COMMODITY
                                                                </label>
                                                                <input type="text" name="commodity_type" value="{{isset($policy) ? $policy->commodity_type : ''}}" class="form-control " id="commodity_type">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">VOYAGE
                                                                </label>
                                                                <select name="voyage" class="select2 form-control " id="mode_of_transport">
                                                                    <option value="">Select Below</option>
                                                                    <option value="INLAND" {{ (isset($policy) && "INLAND" == $policy->voyage) ? 'selected' : '' }}>INLAND</option>
                                                                    <option value="IMPORT" {{ (isset($policy) && "IMPORT" == $policy->voyage) ? 'selected' : '' }}>IMPORT</option>
                                                                    <option value="EXPORT" {{ (isset($policy) && "EXPORT" == $policy->voyage) ? 'selected' : '' }}>EXPORT</option>
                                                                    <option value="ALL TYPE" {{ (isset($policy) && "ALL TYPE" == $policy->voyage) ? 'selected' : '' }}>ALL TYPE</option>

                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">MODE OF TRANSIT
                                                                </label>
                                                                <select name="mode_of_transport" class="select2 form-control " id="mode_of_transport">
                                                                    <option value="">Select Below</option>
                                                                    <option value="RAIL" {{ (isset($policy) && "RAIL" == $policy->mode_of_transport) ? 'selected' : '' }}>RAIL</option>
                                                                    <option value="ROAD" {{ (isset($policy) && "ROAD" == $policy->mode_of_transport) ? 'selected' : '' }}>ROAD</option>
                                                                    <option value="AIR" {{ (isset($policy) && "AIR" == $policy->mode_of_transport) ? 'selected' : '' }}>AIR</option>
                                                                    <option value="SEA" {{ (isset($policy) && "SEA" == $policy->mode_of_transport) ? 'selected' : '' }}>SEA</option>
                                                                    <option value="COURIER" {{ (isset($policy) && "COURIER" == $policy->mode_of_transport) ? 'selected' : '' }}>COURIER</option>
                                                                    <option value="ALL" {{ (isset($policy) && "ALL" == $policy->mode_of_transport) ? 'selected' : '' }}>ALL</option>
                                                                </select>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper background">
                                                        <div class="col-lg-6 ">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Type</p>
                                                                    <select name="type" class="select2 form-control " id="type">
                                                                        <option value="">Select Below</option>
                                                                        <option value="SINGLE TRANSIT" {{ (isset($policy) && "SINGLE TRANSIT" == $policy->type) ? 'selected' : '' }}>SINGLE TRANSIT</option>
                                                                        <option value="OPEN POLICY" {{ (isset($policy) && "OPEN POLICY" == $policy->type) ? 'selected' : '' }}>OPEN POLICY</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Commodity Type</p>
                                                                    <input type="text" name="commodity_type" value="{{isset($policy) ? $policy->commodity_type : ''}}" class="form-control " id="commodity_type">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Mode Of Transport</p>
                                                                    <select name="mode_of_transport" class="select2 form-control " id="mode_of_transport">
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
                                                                    <select name="cover_type" class="select2 form-control " id="cover_type">
                                                                        <option value="">Select Below</option>
                                                                        <option value="ITC A" {{ (isset($policy) && "ITC A" == $policy->cover_type) ? 'selected' : '' }}>ITC A</option>
                                                                        <option value="ITC B" {{ (isset($policy) && "ITC B" == $policy->cover_type) ? 'selected' : '' }}>ITC B</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Sum Insured</p>
                                                                    <input type="text" name="sum_insured" value="{{isset($policy) ? $policy->sum_insured : ''}}" class="form-control " id="sum_insured">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Per Sending Limt</p>
                                                                    <input type="text" name="per_sending_limit" value="{{isset($policy) ? $policy->per_sending_limit : ''}}" class="form-control " id="per_sending_limit">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Per Location Limit</p>
                                                                    <input type="text" name="per_location_limit" value="{{isset($policy) ? $policy->per_location_limit : ''}}" class="form-control " id="per_location_limit">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Estimated Annual Sum Insured</p>
                                                                    <input type="text" name="estimate_annual_sum" value="{{isset($policy) ? $policy->estimate_annual_sum : ''}}" class="form-control " id="estimate_annual_sum">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <p class="mg-t-10 mg-b-1">Basis Of Valuation</p>
                                                                    <input type="text" name="basic_of_valuation" value="{{isset($policy) ? $policy->basic_of_valuation : ''}}" class="form-control " id="basic_of_valuation">
                                                                </div>

                                                                <div class="col-lg-6">

                                                                    <p class="mg-t-10 mg-b-1">Details Of Commodity Type</p>
                                                                    <select name="commodity_details" class="select2 form-control " id="commodity_details">
                                                                        <option value="">Select Below</option>
                                                                        <option value="BOXES" {{ (isset($policy) && "BOXES" == $policy->commodity_details) ? 'selected' : '' }}>BOXES</option>
                                                                        <option value="CONTAINER" {{ (isset($policy) && "CONTAINER" == $policy->commodity_details) ? 'selected' : '' }}>CONTAINER</option>
                                                                        <option value="WEIGHT" {{ (isset($policy) && "WEIGHT" == $policy->commodity_details) ? 'selected' : '' }}>WEIGHT</option>
                                                                        <option value="NO OF PACKAGES" {{ (isset($policy) && "NO OF PACKAGES" == $policy->commodity_details) ? 'selected' : '' }}>NO OF PACKAGES</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Remarks
                                                                </label>
                                                                <textarea name="remarks" class="form-control " cols="30" rows="30" id="remarks">{{isset($policy) ? $policy->remarks : ''}}</textarea>
                                                            </div>
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Packing Description
                                                                </label>
                                                                <input type="text" name="packing_description" value="{{isset($policy) ? $policy->packing_description : ''}}" class="form-control " id="packing_description">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container wc-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">

                                            <div class="col-sm-12">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-4  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Industry Type
                                                                </label>
                                                                <input type="text" name="industry_type" value="{{isset($policy) ? $policy->industry_type : ''}}" class="form-control feild" id="industry_type">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Total No Of Workers
                                                                </label>
                                                                <input type="text" name="worker_number" value="{{isset($policy) ? $policy->worker_number : ''}}" class="form-control feild" id="worker_number">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">DURATION OF POLICY

                                                                </label>
                                                                <input type="text" name="wc_policy" value="{{isset($policy) ? $policy->wc_policy : ''}}" class="form-control feild" id="wc_policy">
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Job Profile
                                                                </label>
                                                                <select name="job_profile" class="select2 form-control feild" id="job_profile">
                                                                    <option value="">Select Below</option>
                                                                    <option value="SKILLED" {{ (isset($policy) && "SKILLED" == $policy->job_profile) ? 'selected' : '' }}>SKILLED</option>
                                                                    <option value="SEMISKILLED" {{ (isset($policy) && "SEMISKILLED" == $policy->job_profile) ? 'selected' : '' }}>SEMISKILLED</option>
                                                                    <option value="UNSKILLED" {{ (isset($policy) && "UNSKILLED" == $policy->job_profile) ? 'selected' : '' }}>UNSKILLED</option>

                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Salery Per Month
                                                                </label>
                                                                <input type="text" name="salary_per_month" value="{{isset($policy) ? $policy->salary_per_month : ''}}" class="form-control feild" id="salary_per_month">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper background">
                                                        <div class="col-lg-6 ">
                                                            <div class="row">
                                                                <div class="col-lg-6">

                                                                    <p class="mg-t-10 mg-b-1">Medical Extension</p>
                                                                    <input type="text" name="medical_extension" value="{{isset($policy) ? $policy->medical_extension : ''}}" class="form-control feild" id="medical_extension">

                                                                </div>
                                                                <div class="col-lg-6">

                                                                    <p class="mg-t-10 mg-b-1">Occupation Disease</p>
                                                                    <input type="text" name="occupation_disease" value="{{isset($policy) ? $policy->occupation_disease : ''}}" class="form-control feild" id="occupation_disease">

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">

                                                                    <p class="mg-t-10 mg-b-1">Compressed Air Disease Extension</p>
                                                                    <input type="text" name="compressed_air_disease" value="{{isset($policy) ? $policy->compressed_air_disease : ''}}" class="form-control feild" id="compressed_air_disease">

                                                                </div>
                                                                <div class="col-lg-6">

                                                                    <p class="mg-t-10 mg-b-1">Terrorism Cover</p>
                                                                    <input type="text" name="terrorism_cover" value="{{isset($policy) ? $policy->terrorism_cover : ''}}" class="form-control feild" id="terrorism_cover">

                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">

                                                                    <p class="mg-t-10 mg-b-1">Sub Contractor Cover</p>
                                                                    <input type="text" name="sub_contractor_cover" value="{{isset($policy) ? $policy->sub_contractor_cover : ''}}" class="form-control feild" id="sub_contractor_cover">

                                                                </div>
                                                                <div class="col-lg-6">

                                                                    <p class="mg-t-10 mg-b-1">Multiple Location</p>
                                                                    <input type="text" name="multiple_location" value="{{isset($policy) ? $policy->multiple_location : ''}}" class="form-control feild" id="multiple_location">

                                                                </div>
                                                            </div>



                                                        </div>
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Remarks
                                                                </label>
                                                                <textarea name="remarks" cols="30" rows="8" id="remarks">{{isset($policy) ? $policy->remarks : ''}}</textarea>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container home-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">

                                            <div class="col-sm-12">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Measures Taken After Loss
                                                                </label>
                                                                <input type="text" name="measures_taken_after_loss" value="{{isset($policy) ? $policy->measures_taken_after_loss : ''}}" class="form-control feild" id="measures_taken_after_loss">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Loss Date
                                                                </label>
                                                                <input type="text" name="loss_date" value="{{isset($policy) ? $policy->loss_date : ''}}" class="form-control feild" id="loss_date">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Loss In Amount

                                                                </label>
                                                                <input type="text" name="loss_in_amount" value="{{isset($policy) ? $policy->loss_in_amount : ''}}" class="form-control feild" id="loss_in_amount">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Address Risk Location

                                                                </label>
                                                                <input type="text" name="address_risk_location" value="{{isset($policy) ? $policy->address_risk_location : ''}}" class="form-control feild" id="address_risk_location">
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Cover Opted
                                                                </label>
                                                                <input type="text" name="cover_opted" value="{{isset($policy) ? $policy->cover_opted : ''}}" class="form-control feild" id="cover_opted">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Policy Inception Date
                                                                </label>
                                                                <input type="text" name="policy_inception_date" value="{{isset($policy) ? $policy->policy_inception_date : ''}}" class="form-control feild" id="policy_inception_date">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Tenure

                                                                </label>
                                                                <input type="text" name="tenure" value="{{isset($policy) ? $policy->tenure : ''}}" class="form-control feild" id="tenure">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Construction Type

                                                                </label>
                                                                <select name="construction_type" class="form-control feild" id="construction_type">
                                                                    <option value="">Select</option>
                                                                    <option value="PUCCA" {{ (isset($policy) && "PUCCA" == $policy->construction_type) ? 'selected' : '' }}>PUCCA</option>
                                                                    <option value="KUTCHA" {{ (isset($policy) && "KUTCHA" == $policy->construction_type) ? 'selected' : '' }}>KUTCHA</option>
                                                                </select>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Age Of the Building
                                                                </label>
                                                                <input type="text" name="age_of_building" value="{{isset($policy) ? $policy->age_of_building : ''}}" class="form-control feild" id="age_of_building">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Basement for Building
                                                                </label>
                                                                <input type="text" name="basement_for_building" value="{{isset($policy) ? $policy->basement_for_building : ''}}" class="form-control feild" id="basement_for_building">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Basement for Content

                                                                </label>
                                                                <input type="text" name="basement_for_content" value="{{isset($policy) ? $policy->basement_for_content : ''}}" class="form-control feild" id="basement_for_content">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Claim
                                                                </label>
                                                                <input type="text" name="claims" value="{{isset($policy) ? $policy->claims : ''}}" class="form-control feild" id="claims">

                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Building Carpet Area
                                                                </label>
                                                                <input type="text" name="building_carpet_area" value="{{isset($policy) ? $policy->building_carpet_area : ''}}" class="form-control feild" id="building_carpet_area">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Building Cost Of Construction
                                                                </label>
                                                                <input type="text" name="building_cost_of_construction" value="{{isset($policy) ? $policy->building_cost_of_construction : ''}}" class="form-control feild" id="building_cost_of_construction">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Building Sum Insured

                                                                </label>
                                                                <input type="text" name="building_sum_insured" value="{{isset($policy) ? $policy->building_sum_insured : ''}}" class="form-control feild" id="building_sum_insured">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Content Sum Insured
                                                                </label>
                                                                <input type="text" name="content_sum_insured" value="{{isset($policy) ? $policy->content_sum_insured : ''}}" class="form-control feild" id="content_sum_insured">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Rent of Alternative Accommodation
                                                                </label>
                                                                <input type="text" name="rent_alternative_accommodation" value="{{isset($policy) ? $policy->rent_alternative_accommodation : ''}}" class="form-control feild" id="rent_alternative_accommodation">

                                                            </div>
                                                        </div>



                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container fire-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">

                                            <div class="col-sm-12">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">COVERAGE TYPE
                                                                </label>
                                                                <input type="text" name="measures_taken_after_loss" value="{{isset($policy) ? $policy->measures_taken_after_loss : ''}}" class="form-control feild" id="measures_taken_after_loss">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Address Risk Location

                                                                </label>
                                                                <input type="text" name="address_risk_location" value="{{isset($policy) ? $policy->address_risk_location : ''}}" class="form-control feild" id="address_risk_location">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">RISK LOCATION PINCODE


                                                                </label>
                                                                <input type="text" name="pincode" value="{{isset($policy) ? $policy->pincode : ''}}" class="form-control feild" id="pincode">
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Occupancy
                                                                </label>
                                                                <input type="text" name="occupancy" value="{{isset($policy) ? $policy->occupancy : ''}}" class="form-control feild" id="occupancy">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Occupancy Tarriff
                                                                </label>
                                                                <input type="text" name="occupancy_tarriff" value="{{isset($policy) ? $policy->occupancy_tarriff : ''}}" class="form-control feild" id="occupancy_tarriff">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Particular

                                                                </label>
                                                                <input type="text" name="particular" value="{{isset($policy) ? $policy->particular : ''}}" class="form-control feild" id="particular">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Building
                                                                </label>
                                                                <input type="text" name="building" value="{{isset($policy) ? $policy->building : ''}}" class="form-control feild" id="building">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Plant And Machinery
                                                                </label>
                                                                <input type="text" name="plant_machine" value="{{isset($policy) ? $policy->plant_machine : ''}}" class="form-control feild" id="plant_machine">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Furniture Fixture And Fittings

                                                                </label>
                                                                <input type="text" name="furniture_fixure" value="{{isset($policy) ? $policy->furniture_fixure : ''}}" class="form-control feild" id="furniture_fixure">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Stock In Process
                                                                </label>
                                                                <input type="text" name="stock_in_process" value="{{isset($policy) ? $policy->stock_in_process : ''}}" class="form-control feild" id="stock_in_process">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Finished Stock
                                                                </label>
                                                                <input type="text" name="finished_stock" value="{{isset($policy) ? $policy->finished_stock : ''}}" class="form-control feild" id="finished_stock">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Other Contents
                                                                </label>
                                                                <input type="text" name="other_contents" value="{{isset($policy) ? $policy->other_contents : ''}}" class="form-control feild" id="other_contents">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Claim In last 3 Years
                                                                </label>
                                                                <input type="radio" name="clain_in_last_three_year" value="Yes" class="feild mg-b-0" id="clain_in_last_three_year">Yes
                                                                <input type="radio" name="clain_in_last_three_year" value="No" class=" feild mg-b-0" id="clain_in_last_three_year">No

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 clain_in_last_three_year_yes">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Loss Details
                                                                </label>
                                                                <input type="text" name="loss_details" value="{{isset($policy) ? $policy->loss_details : ''}}" class="form-control feild" id="loss_details">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 clain_in_last_three_year_yes">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Loss In Amount
                                                                </label>
                                                                <input type="text" name="loss_in_amount" value="{{isset($policy) ? $policy->loss_in_amount : ''}}" class="form-control feild" id="loss_in_amount">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 clain_in_last_three_year_yes">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Loss Date
                                                                </label>
                                                                <input type="text" name="loss_date" value="{{isset($policy) ? $policy->loss_date : ''}}" class="form-control feild" id="loss_date">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 clain_in_last_three_year_yes">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Measures Taken After Loss
                                                                </label>
                                                                <input type="text" name="measures_taken_after_loss" value="{{isset($policy) ? $policy->measures_taken_after_loss : ''}}" class="form-control feild" id="measures_taken_after_loss">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 ">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Remarks
                                                                </label>
                                                                <input type="text" name="remarks" value="{{isset($policy) ? $policy->remarks : ''}}" class="form-control feild" id="remarks">
                                                            </div>
                                                        </div>


                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container travel-details">
                                <div class="card">
                                    <div class="card-body">

                                        <div class="row align-items-center ">

                                            <div class="col-sm-12">
                                                <div class="row main-row">


                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Visiting Country
                                                                </label>
                                                                <select name="visiting_country" class="form-control" id="visiting_country">
                                                                    <option value="">Select</option>
                                                                    <option value="INCUDING US/CANADA" {{ (isset($policy) && "INCUDING US/CANADA" == $policy->visiting_country) ? 'selected' : '' }}>INCUDING US/CANADA</option>
                                                                    <option value="EXCLUDING US/CANADA" {{ (isset($policy) && "EXCLUDING US/CANADA" == $policy->visiting_country) ? 'selected' : '' }}>EXCLUDING US/CANADA</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Date Of Departure

                                                                </label>
                                                                <input type="date" name="date_of_departure" value="{{isset($policy) ? $policy->date_of_departure : ''}}" class="form-control feild" id="date_of_departure">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Date of Arrival
                                                                </label>
                                                                <input type="date" name="date_of_arrival" value="{{isset($policy) ? $policy->date_of_arrival : ''}}" class="form-control feild" id="date_of_arrival">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <div class="col-lg-6  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">No Of Days
                                                                </label>
                                                                <input type="text" name="no_of_days" value="{{isset($policy) ? $policy->no_of_days : ''}}" class="form-control feild" id="no_of_days">

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3  text-center">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">No Of Person
                                                                </label>
                                                                <input type="text" name="no_person" value="{{isset($policy) ? $policy->no_person : ''}}" class="form-control feild" id="no_person">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="main-form-group background">
                                                                <label class="form-label">Passport details

                                                                </label>
                                                                <input type="text" name="passport_datails" value="{{isset($policy) ? $policy->passport_datails : ''}}" class="form-control feild" id="passport_datails">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row row-xs formgroup-wrapper">
                                                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0 dataTable no-footer">
                                                            <thead>
                                                                <th>NAME</th>
                                                                <th>DOB</th>
                                                                <th>AGE</th>
                                                                <th>SUM INSURED</th>
                                                                <th>PRE EXISTING DISEASE</th>
                                                                <th>
                                                                    <div class="btn-info btn add-travel">Add</div>
                                                                </th>
                                                            </thead>
                                                            <tbody class="travel-body">
                                                                @if(isset($policy->travel_type) && !empty($policy->travel_type))

                                                                <?php
                                                                $travel_type = json_decode($policy->travel_type);
                                                                ?>
                                                                @foreach($travel_type->travel_name as $key=> $name)

                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="travel_name[]" value="{{$name ?? ''}}"></td>

                                                                    <td><input type="date" class="form-control" name="travel_dob[]" value="{{$travel_type->travel_dob[$key] ?? ''}}"></td>

                                                                    <td><input type="text" class="form-control" name="travel_age[]" value="{{$travel_type->travel_age[$key] ?? ''}}"></td>
                                                                    <td><input type="text" class="form-control" name="travel_sum_insured[]" value="{{$travel_type->travel_sum_insured[$key] ?? ''}}"></td>
                                                                    <td><input type="text" class="form-control" name="travel_pre_existing_disease[]" value="{{$travel_type->travel_pre_existing_disease[$key] ?? ''}}"></td>

                                                                    <td>
                                                                        <div type="button" class="btn btn-danger delete-travel">Delete</div>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                @else
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="travel_name[]"></td>

                                                                    <td><input type="date" class="form-control" name="travel_dob[]"></td>

                                                                    <td><input type="text" class="form-control" name="travel_age[]"></td>
                                                                    <td><input type="text" class="form-control" name="travel_sum_insured[]"></td>
                                                                    <td><input type="text" class="form-control" name="travel_pre_existing_disease[]"></td>
                                                                    <td>
                                                                        <div type="button" class="btn btn-danger delete-travel">Delete</div>
                                                                    </td>
                                                                </tr>


                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($lead) ? 'Update' : 'Save' }}</button>
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
        $('.marine-details').hide();
        $('.health-section').hide();
        $('.wc-details').hide();
        $('.home-details').hide();
        $('.fire-details').hide();
        $('.travel-details').hide();
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
                        $('#tp').html(result['tp']);
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
        let editSubproductId = "{{$lead->subProduct->name ?? ''}}";
        if (editSubproductId != '') {
            editSubproductId = $.trim(editSubproductId).toLowerCase();
            changeFeild(editSubproductId);
            console.log(editSubproductId);
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
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.home-details').hide();
            $('.fire-details').hide();
            $('.travel-details').hide();



        }
        if (subproduct == 'marine') {

            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
            $('.health-section').hide();
            $('.marine-details').show();
            $('.wc-details').hide();
            $('.home-details').hide();
            $('.fire-details').hide();
            $('.travel-details').hide();




        }
        if (subproduct == 'liability') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.fire-details').hide();

            $('.home-details').hide();
            $('.travel-details').hide();

        }

        if (subproduct == 'wc') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
            $('.health-section').hide();
            $('.wc-details').show();
            $('.marine-details').hide();
            $('.home-details').hide();
            $('.fire-details').hide();
            $('.travel-details').hide();



        }
        if (subproduct == 'fire' || subproduct == 'burglary') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.fire-details').show();
            $('.travel-details').hide();


            $('.home-details').hide();

        }
        if (subproduct == 'home') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
            $('.health-section').hide();
            $('.wc-details').hide();
            $('.marine-details').hide();
            $('.home-details').show();
            $('.fire-details').hide();
            $('.travel-details').hide();


        }
        if (subproduct == 'health') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
            $('.health-section').show();
            $('.marine-details').hide();
            $('.wc-details').hide();

            $('.fire-details').hide();
            $('.home-details').hide();
            $('.travel-details').hide();


        }
        if (subproduct == 'travel') {
            $('.motor-policy-details').hide();
            $('.vehicle-details').hide();
            $('.non-motor-policy-details').show();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.fire-details').hide();
            $('.travel-details').show();

            $('.home-details').hide();


        }


        if (subproduct == 'pvr') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.motor-policy-details').show();
            $('.health-section').hide();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.home-details').hide();
            $('.fire-details').hide();
            $('.travel-details').hide();




        }
        if (subproduct == 'pvt car') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.travel-details').hide();

            $('.home-details').hide();
            $('.fire-details').hide();


        }
        if (subproduct == 'gcv') {
            $('.motor-policy-details').show();
            $('.gvw').show();
            $('.cc-kw').hide();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.home-details').hide();
            $('.fire-details').hide();
            $('.travel-details').hide();


        }
        if (subproduct == 'pcv') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.fire-details').hide();
            $('.travel-details').hide();

            $('.home-details').hide();

        }
        if (subproduct == 'tw') {
            $('.gvw').hide();
            $('.cc-kw').show();
            $('.motor-policy-details').show();
            $('.vehicle-details').show();
            $('.non-motor-policy-details').hide();
            $('.health-section').hide();
            $('.marine-details').hide();
            $('.wc-details').hide();
            $('.fire-details').hide();

            $('.home-details').hide();
            $('.travel-details').hide();

        }



    }
</script>

@endsection