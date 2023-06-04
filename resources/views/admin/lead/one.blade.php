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

            @if(in_array($lead->status,['REJECTED','LINK GENERATED BUT NOT PAID','LINK GENERATED','POLICY TO BE ISSUED','QUOTE GENERATED']))
            <div class="pe-1 mb-xl-0">
                <div class="btn-group dropdown">
                    <button class="modal-effect btn btn-main-primary ml_auto " data-bs-toggle="modal" href="#attachments" data-bs-effect="effect-super-scaled">
                        @if(in_array($lead->status ,['LINK GENERATED BUT NOT PAID','LINK GENERATED','POLICY TO BE ISSUED']))
                        Share Policy
                        @else
                        Attachment
                        @endif
                    </button>
                </div>
            </div>
            @endif
            @if(in_array($lead->status,['QUOTE GENERATED','PENDING/FRESH','IN PROCESS','MORE INFO REQUIRED','RE-QUOTE']))
            <div class="pe-1 mb-xl-0">
                <div class="btn-group dropdown">
                    <button class="modal-effect btn btn-main-primary ml_auto " data-bs-toggle="modal" href="#quotes" data-bs-effect="effect-super-scaled">Share Quote</button>
                </div>
            </div>
            @endif
            <div class="pe-1 mb-xl-0">
                <div class="btn-group dropdown change-status">
                    <button class="modal-effect btn btn-main-primary ml_auto " data-bs-effect="effect-super-scaled">Change Status</button>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <style type="text/css">
        #home .row.main-row {
            border-radius: 5px;
            box-shadow: 0 0 10px rgb(0 0 0 / 10%);
            background: #e8eaf3;
            margin-bottom: 15px;
        }

        #home .select2-container--default.select2-container--disabled .select2-selection--single {
            background-color: transparent;
        }

        #home.select2-container--default .select2-selection--single {
            height: 18px;
        }

        #home .select2-container--default .select2-selection--single .select2-selection__arrow {
            opacity: 0;
        }

        #home .main-form-group {
            padding: 10px;
            border: 0px solid #e3e8f7;
        }

        #home .formgroup-wrapper .main-form-group .form-label {
            margin-bottom: 8px;
            font-size: 12px;
            text-align: left;
            font-weight: 700;
            color: #031b4e;
        }

        #home .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding: 0;
            font-size: 12px;
        }

        #home .formgroup-wrapper .form-control {
            height: 20px !important;
            font-size: 12px;
            background: transparent;
            color: #6e7f96;
        }
    </style>
    <!-- row -->
    <div class="row row-sm">

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs profile navtab-custom panel-tabs">
                            <li class="">
                                <a href="#home" data-bs-toggle="tab" class="active" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 me-1"></i></span> <span class="hidden-xs">Details</span> </a>
                            </li>
                            <li class="">
                                <a href="#profile" data-bs-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-images tx-15 me-1"></i></span>
                                    <span class="hidden-xs">Attachment</span> </a>
                            </li>
                            <li class="">
                                <a href="#policy" data-bs-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-images tx-15 me-1"></i></span>
                                    <span class="hidden-xs">Policy</span> </a>
                            </li>
                            <li class="">
                                <a href="#settings" data-bs-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-cog tx-16 me-1"></i></span>
                                    <span class="hidden-xs">Quotes</span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content border-start border-bottom border-right border-top-0 p-4 br-dark">
                        <div class="tab-pane active" id="home">
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
                                                                        <option value="{{$role->id}}" {{ (isset($lead->policy->user_type) && $role->id == $lead->policy->user_type) ? 'Selected' : '' }}>{{$role->name }}</option>
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
                                                                        <option value="{{$user->id}}" {{ (isset($lead->policy->user_id) && $user->id == $lead->policy->user_id) ? 'selected' : '' }}>{{$user->name}}</option>
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
                                                                        <option value="{{$insurance->id}}" {{ (isset($lead->policy) && $insurance->id == $lead->policy->insurance_id) ? 'selected' : '' }}>{{$insurance->name}}</option>
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
                                                                        @if($companiess->count())
                                                                        @foreach($companiess as $company)
                                                                        <option value="{{$company->id}}" {{ (isset($lead->policy) && $company->id == $lead->policy->company_id) ? 'selected' : '' }}>{{$company->name}}</option>
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
                                                                        <option value="{{$product->id}}" {{ (isset($lead->policy) && $product->id == $lead->policy->product_id) ? 'selected' : '' }}>{{$product->name}}</option>
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
                                                                        <option value="{{$subProduct->id}}" data-id="{{$subProduct->name}}" {{ (isset($lead->policy) && $subProduct->id == $lead->policy->subproduct_id) ? 'selected' : '' }}>{{$subProduct->name}}</option>
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
                                                                        <option value="New" {{ (isset($lead->policy) && "New" == $lead->policy->bussiness_type) ? 'selected' : '' }}>New</option>
                                                                        <option value="Rollover" {{ (isset($lead->policy) && "Rollover" == $lead->policy->bussiness_type) ? 'selected' : '' }}>Rollover</option>
                                                                        <option value="Renewal" {{ (isset($lead->policy) && "Renewal" == $lead->policy->bussiness_type) ? 'selected' : '' }}>Renewal</option>
                                                                        <option value="Used" {{ (isset($lead->policy) && "Used" == $lead->policy->bussiness_type) ? 'selected' : '' }}>Used</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label "> TRANSACTION TYPE</label>
                                                                    <select name="mis_transaction_type" class="form-control">
                                                                        <option value="">Select</option>
                                                                        <option value="Package" {{ (isset($lead->policy->mis_transaction_type) && 'Package' == $lead->policy->mis_transaction_type) ? 'selected' : '' }}>Package</option>
                                                                        <option value="SOAD" {{ (isset($lead->policy->mis_transaction_type) && 'SOAD' == $lead->policy->mis_transaction_type) ? 'selected' : '' }}>SOAD</option>
                                                                        <option value="TP" {{ (isset($lead->policy->mis_transaction_type) && 'TP' == $lead->policy->mis_transaction_type) ? 'selected' : '' }}>TP</option>
                                                                        <option value="Endorsement" {{ (isset($lead->policy->mis_transaction_type) && 'Endorsement' == $lead->policy->mis_transaction_type) ? 'selected' : '' }}>Endorsement</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row row-xs formgroup-wrapper">
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Policy Holder Name</label>
                                                                    <input class="form-control" name="holder_name" type="text" value="{{isset($lead) ? $lead->holder_name : '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Policy Holder Phone Number</label>
                                                                    <input class="form-control" name="phone" type="text" value="{{isset($lead) ? $lead->phone : '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Policy Holder Email</label>
                                                                    <input class="form-control" name="email" type="email" value="{{isset($lead) ? $lead->email : '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">CHANNEL NAME</label>
                                                                    <select name="channel_name" class="select2 form-control common- " id="channel_name">
                                                                        <option value="">Select Below</option>
                                                                        @if($channels->count())
                                                                        @foreach($channels as $channel)
                                                                        <option value="{{$channel->name}}" {{ (isset($lead->policy) && $channel->name == $lead->policy->channel_name) ? 'selected' : '' }}>{{$channel->name}}</option>
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
                                                                    <input type="text" name="reg_no" value="{{isset($lead->policy) ? $lead->policy->reg_no : ''}}" class="form-control " id="reg_no">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Make</label>
                                                                    <select name="make" id="make" class="form-control ">
                                                                        <option value="">Select</option>
                                                                        @if($make->count())
                                                                        @foreach($make as $makes)
                                                                        <option value="{{$makes->id}}" {{ (isset($lead->policy) && $makes->id == $lead->policy->make) ? 'selected' : '' }}>{{$makes->name}}</option>
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
                                                                        @if(isset($model) && $model->count() && isset($lead->policy) )
                                                                        @foreach($model as $models)
                                                                        <option value="{{$models->id}}" {{ (isset($lead->policy) && $models->id == $lead->policy->model) ? 'selected' : '' }}>{{$models->name}}</option>
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
                                                                        <option value="{{$varriant->name}}" {{ (isset($lead->policy) && $varriant->name == $lead->policy->varriant) ? 'selected' : '' }}>{{$varriant->name}}</option>
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
                                                                        <option value="{{$varient->name}}" {{ (isset($lead->policy) && $varient->name == $lead->policy->cc) ? 'selected' : '' }}>{{$varient->name}}</option>
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
                                                                        <option value=">2500" {{ (isset($lead->policy) && ">2500" == $lead->policy->gvw) ? 'selected' : '' }}>>2500</option>
                                                                        <option value="2501 to 3500" {{ (isset($lead->policy) && "2501 to 3500" == $lead->policy->gvw) ? 'selected' : '' }}>2501 to 3500</option>
                                                                        <option value="3501 to 7500" {{ (isset($lead->policy) && "3501 to 7500" == $lead->policy->gvw) ? 'selected' : '' }}>3501 to 7500</option>
                                                                        <option value="7501 to 12000" {{ (isset($lead->policy) && "7501 to 12000" == $lead->policy->gvw) ? 'selected' : '' }}>7501 to 12000</option>
                                                                        <option value="12001 to 20000" {{ (isset($lead->policy) && "12001 to 20000" == $lead->policy->gvw) ? 'selected' : '' }}>12001 to 20000</option>
                                                                        <option value="20000 to 25000" {{ (isset($lead->policy) && "20000 to 25000" == $lead->policy->gvw) ? 'selected' : '' }}>20000 to 25000</option>
                                                                        <option value="25000 to 40000" {{ (isset($lead->policy) && "25000 to 40000" == $lead->policy->gvw) ? 'selected' : '' }}>25000 to 40000</option>
                                                                        <option value=">40000" {{ (isset($lead->policy) && ">40000" == $lead->policy->gvw) ? 'selected' : '' }}>>40000</option>
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
                                                                        <option value="{{$varient->name}}" {{ (isset($lead->policy) && $varient->name == $lead->policy->fuel) ? 'selected' : '' }}>{{$varient->name}}</option>
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
                                                                        <option value="{{$varient->name}}" {{ (isset($lead->policy) && $varient->name == $lead->policy->seating_capacity) ? 'selected' : '' }}>{{$varient->name}}</option>
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
                                                                        <option value="2023" {{ (isset($lead->policy) && "2023" == $lead->policy->mfr_year) ? 'selected' : '' }}>2023</option>
                                                                        <option value="2022" {{ (isset($lead->policy) && "2022" == $lead->policy->mfr_year) ? 'selected' : '' }}>2022</option>
                                                                        <option value="2021" {{ (isset($lead->policy) && "2021" == $lead->policy->mfr_year) ? 'selected' : '' }}>2021</option>
                                                                        <option value="2020" {{ (isset($lead->policy) && "2020" == $lead->policy->mfr_year) ? 'selected' : '' }}>2020</option>
                                                                        <option value="2019" {{ (isset($lead->policy) && "2019" == $lead->policy->mfr_year) ? 'selected' : '' }}>2019</option>
                                                                        <option value="2018" {{ (isset($lead->policy) && "2018" == $lead->policy->mfr_year) ? 'selected' : '' }}>2018</option>
                                                                        <option value="2017" {{ (isset($lead->policy) && "2017" == $lead->policy->mfr_year) ? 'selected' : '' }}>2017</option>
                                                                        <option value="2016" {{ (isset($lead->policy) && "2016" == $lead->policy->mfr_year) ? 'selected' : '' }}>2016</option>
                                                                        <option value="2015" {{ (isset($lead->policy) && "2015" == $lead->policy->mfr_year) ? 'selected' : '' }}>2015</option>
                                                                        <option value="2014" {{ (isset($lead->policy) && "2014" == $lead->policy->mfr_year) ? 'selected' : '' }}>2014</option>
                                                                        <option value="2013" {{ (isset($lead->policy) && "2013" == $lead->policy->mfr_year) ? 'selected' : '' }}>2013</option>
                                                                        <option value="2012" {{ (isset($lead->policy) && "2012" == $lead->policy->mfr_year) ? 'selected' : '' }}>2012</option>
                                                                        <option value="2011" {{ (isset($lead->policy) && "2011" == $lead->policy->mfr_year) ? 'selected' : '' }}>2011</option>
                                                                        <option value="2010" {{ (isset($lead->policy) && "2010" == $lead->policy->mfr_year) ? 'selected' : '' }}>2010</option>
                                                                        <option value="2009" {{ (isset($lead->policy) && "2009" == $lead->policy->mfr_year) ? 'selected' : '' }}>2009</option>
                                                                        <option value="2008" {{ (isset($lead->policy) && "2008" == $lead->policy->mfr_year) ? 'selected' : '' }}>2008</option>
                                                                        <option value="2007" {{ (isset($lead->policy) && "2007" == $lead->policy->mfr_year) ? 'selected' : '' }}>2007</option>
                                                                        <option value="2006" {{ (isset($lead->policy) && "2006" == $lead->policy->mfr_year) ? 'selected' : '' }}>2006</option>
                                                                        <option value="2005" {{ (isset($lead->policy) && "2005" == $lead->policy->mfr_year) ? 'selected' : '' }}>2005</option>
                                                                        <option value="2004" {{ (isset($lead->policy) && "2004" == $lead->policy->mfr_year) ? 'selected' : '' }}>2004</option>
                                                                        <option value="2003" {{ (isset($lead->policy) && "2003" == $lead->policy->mfr_year) ? 'selected' : '' }}>2003</option>
                                                                        <option value="2002" {{ (isset($lead->policy) && "2002" == $lead->policy->mfr_year) ? 'selected' : '' }}>2002</option>
                                                                        <option value="2001" {{ (isset($lead->policy) && "2001" == $lead->policy->mfr_year) ? 'selected' : '' }}>2001</option>
                                                                        <option value="2000" {{ (isset($lead->policy) && "2000" == $lead->policy->mfr_year) ? 'selected' : '' }}>2000</option>
                                                                        <option value="1999" {{ (isset($lead->policy) && "1999" == $lead->policy->mfr_year) ? 'selected' : '' }}>1999</option>
                                                                        <option value="1998" {{ (isset($lead->policy) && "1998" == $lead->policy->mfr_year) ? 'selected' : '' }}>1998</option>
                                                                        <option value="1997" {{ (isset($lead->policy) && "1997" == $lead->policy->mfr_year) ? 'selected' : '' }}>1997</option>
                                                                        <option value="1996" {{ (isset($lead->policy) && "1996" == $lead->policy->mfr_year) ? 'selected' : '' }}>1996</option>
                                                                        <option value="1995" {{ (isset($lead->policy) && "1995" == $lead->policy->mfr_year) ? 'selected' : '' }}>1995</option>
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
                                                                    <input type="text" name="policy_no" value="{{isset($lead->policy) ? $lead->policy->policy_no : ''}}" class="form-control " id="policy_no">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">NCB IN CURRENT POLICY</label>
                                                                    <select name="ncb_in_existing_policy" id="ncb_in_existing_policy" class="form-control ">
                                                                        <option value="">Select</option>
                                                                        <option value="0" {{ (isset($lead->policy) && "0" == $lead->policy->ncb_in_existing_policy) ? 'selected' : '' }}>0</option>
                                                                        <option value="20" {{ (isset($lead->policy) && "20" == $lead->policy->ncb_in_existing_policy) ? 'selected' : '' }}>20</option>
                                                                        <option value="25" {{ (isset($lead->policy) && "25" == $lead->policy->ncb_in_existing_policy) ? 'selected' : '' }}>25</option>
                                                                        <option value="35" {{ (isset($lead->policy) && "35" == $lead->policy->ncb_in_existing_policy) ? 'selected' : '' }}>35</option>
                                                                        <option value="45" {{ (isset($lead->policy) && "45" == $lead->policy->ncb_in_existing_policy) ? 'selected' : '' }}>45</option>
                                                                        <option value="50" {{ (isset($lead->policy) && "50" == $lead->policy->ncb_in_existing_policy) ? 'selected' : '' }}>50</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 ">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">POLICY START DATE</label>
                                                                    <input type="date" name="start_date" value="{{isset($lead->policy) ? $lead->policy->start_date : ''}}" class="form-control " id="start_date">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 ">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Policy Expiry Date</label>
                                                                    <input type="date" name="expiry_date" value="{{isset($lead->policy) ? $lead->policy->expiry_date : ''}}" class="form-control " id="expiry_date">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row row-xs formgroup-wrapper">
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">IDV/Sum insured</label>
                                                                    <input type="text" name="sum_insured" value="{{isset($lead->policy) ? $lead->policy->sum_insured : ''}}" class="form-control" id="sum_insured">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">OD Premium</label>
                                                                    <input type="text" name="od_premium" onkeyup="grossPremium()" value="{{isset($lead->policy) ? $lead->policy->od_premium : ''}}" class="form-control " id="od_premium">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 ">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Add On Premium</label>
                                                                    <input type="text" name="add_on_premium" onkeyup="grossPremium()" value="{{isset($lead->policy) ? $lead->policy->add_on_premium : ''}}" class="form-control " id="add_on_premium">
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
                                                                        <option value="{{$varient->name}}" {{ (isset($lead->policy) && $varient->name == $lead->policy->tp_premium) ? 'selected' : '' }}>{{$varient->name}}</option>
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
                                                                    <input type="text" name="others" value="{{isset($lead->policy) ? $lead->policy->others : ''}}" onkeyup="grossPremium()" class="form-control " id="others">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Net Premium</label>
                                                                    <input type="text" name="net_premium" value="{{isset($lead->policy) ? $lead->policy->net_premium : ''}}" class="form-control " id="net_premium">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 ">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">GST</label>
                                                                    <input type="text" name="gst" onkeyup="grossPremium()" value="{{isset($lead->policy) ? $lead->policy->gst : ''}}" class="form-control " id="gst">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 ">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">GROSS PREMIUM
                                                                    </label>
                                                                    <input type="text" name="gross_premium" value="{{isset($lead->policy) ? $lead->policy->gross_premium : ''}}" class="form-control " id="gross_premium">

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
                                                                    <input type="text" name="policy_no" value="{{isset($lead->policy) ? $lead->policy->policy_no : ''}}" class="form-control common- " id="policy_no">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3 ">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">POLICY START DATE</label>
                                                                    <input type="date" name="start_date" value="{{isset($lead->policy) ? $lead->policy->start_date : ''}}" class="form-control " id="start_date">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 ">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Policy Expiry Date</label>
                                                                    <input type="date" name="expiry_date" value="{{isset($lead->policy) ? $lead->policy->expiry_date : ''}}" class="form-control " id="expiry_date">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row row-xs formgroup-wrapper">
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Net Premium</label>
                                                                    <input type="text" name="net_premium" value="{{isset($lead->policy) ? $lead->policy->net_premium : ''}}" class="form-control " id="net_premium">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 ">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">GST</label>
                                                                    <input type="text" name="gst" onkeyup="grossPremium()" value="{{isset($lead->policy) ? $lead->policy->gst : ''}}" class="form-control " id="gst">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label "> GROSS PREMIUM
                                                                    </label>
                                                                    <input type="text" name="gross_premium" value="{{isset($lead->policy) ? $lead->policy->gross_premium : ''}}" class="form-control " id="gross_premium">
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

                                                        </thead>
                                                        <tbody class="health-body">
                                                            @if(isset($lead->policy->health_type) && !empty($lead->policy->health_type))

                                                            <?php
                                                            $health_type = json_decode($lead->policy->health_type);
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
                                                                    <input type="text" name="commodity_type" value="{{isset($lead->policy) ? $lead->policy->commodity_type : ''}}" class="form-control " id="commodity_type">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">VOYAGE
                                                                    </label>
                                                                    <select name="voyage" class="select2 form-control " id="mode_of_transport">
                                                                        <option value="">Select Below</option>
                                                                        <option value="INLAND" {{ (isset($lead->policy) && "INLAND" == $lead->policy->voyage) ? 'selected' : '' }}>INLAND</option>
                                                                        <option value="IMPORT" {{ (isset($lead->policy) && "IMPORT" == $lead->policy->voyage) ? 'selected' : '' }}>IMPORT</option>
                                                                        <option value="EXPORT" {{ (isset($lead->policy) && "EXPORT" == $lead->policy->voyage) ? 'selected' : '' }}>EXPORT</option>
                                                                        <option value="ALL TYPE" {{ (isset($lead->policy) && "ALL TYPE" == $lead->policy->voyage) ? 'selected' : '' }}>ALL TYPE</option>

                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">MODE OF TRANSIT
                                                                    </label>
                                                                    <select name="mode_of_transport" class="select2 form-control " id="mode_of_transport">
                                                                        <option value="">Select Below</option>
                                                                        <option value="RAIL" {{ (isset($lead->policy) && "RAIL" == $lead->policy->mode_of_transport) ? 'selected' : '' }}>RAIL</option>
                                                                        <option value="ROAD" {{ (isset($lead->policy) && "ROAD" == $lead->policy->mode_of_transport) ? 'selected' : '' }}>ROAD</option>
                                                                        <option value="AIR" {{ (isset($lead->policy) && "AIR" == $lead->policy->mode_of_transport) ? 'selected' : '' }}>AIR</option>
                                                                        <option value="SEA" {{ (isset($lead->policy) && "SEA" == $lead->policy->mode_of_transport) ? 'selected' : '' }}>SEA</option>
                                                                        <option value="COURIER" {{ (isset($lead->policy) && "COURIER" == $lead->policy->mode_of_transport) ? 'selected' : '' }}>COURIER</option>
                                                                        <option value="ALL" {{ (isset($lead->policy) && "ALL" == $lead->policy->mode_of_transport) ? 'selected' : '' }}>ALL</option>
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
                                                                            <option value="SINGLE TRANSIT" {{ (isset($lead->policy) && "SINGLE TRANSIT" == $lead->policy->type) ? 'selected' : '' }}>SINGLE TRANSIT</option>
                                                                            <option value="OPEN POLICY" {{ (isset($lead->policy) && "OPEN POLICY" == $lead->policy->type) ? 'selected' : '' }}>OPEN POLICY</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p class="mg-t-10 mg-b-1">Commodity Type</p>
                                                                        <input type="text" name="commodity_type" value="{{isset($lead->policy) ? $lead->policy->commodity_type : ''}}" class="form-control " id="commodity_type">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <p class="mg-t-10 mg-b-1">Mode Of Transport</p>
                                                                        <select name="mode_of_transport" class="select2 form-control " id="mode_of_transport">
                                                                            <option value="">Select Below</option>
                                                                            <option value="RAIL" {{ (isset($lead->policy) && "RAIL" == $lead->policy->mode_of_transport) ? 'selected' : '' }}>RAIL</option>
                                                                            <option value="ROAD" {{ (isset($lead->policy) && "ROAD" == $lead->policy->mode_of_transport) ? 'selected' : '' }}>ROAD</option>
                                                                            <option value="AIR" {{ (isset($lead->policy) && "AIR" == $lead->policy->mode_of_transport) ? 'selected' : '' }}>AIR</option>
                                                                            <option value="SEA" {{ (isset($lead->policy) && "SEA" == $lead->policy->mode_of_transport) ? 'selected' : '' }}>SEA</option>
                                                                            <option value="COURIER" {{ (isset($lead->policy) && "COURIER" == $lead->policy->mode_of_transport) ? 'selected' : '' }}>COURIER</option>
                                                                            <option value="ALL" {{ (isset($lead->policy) && "ALL" == $lead->policy->mode_of_transport) ? 'selected' : '' }}>ALL</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p class="mg-t-10 mg-b-1">Cover Type</p>
                                                                        <select name="cover_type" class="select2 form-control " id="cover_type">
                                                                            <option value="">Select Below</option>
                                                                            <option value="ITC A" {{ (isset($lead->policy) && "ITC A" == $lead->policy->cover_type) ? 'selected' : '' }}>ITC A</option>
                                                                            <option value="ITC B" {{ (isset($lead->policy) && "ITC B" == $lead->policy->cover_type) ? 'selected' : '' }}>ITC B</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <p class="mg-t-10 mg-b-1">Sum Insured</p>
                                                                        <input type="text" name="sum_insured" value="{{isset($lead->policy) ? $lead->policy->sum_insured : ''}}" class="form-control " id="sum_insured">
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p class="mg-t-10 mg-b-1">Per Sending Limt</p>
                                                                        <input type="text" name="per_sending_limit" value="{{isset($lead->policy) ? $lead->policy->per_sending_limit : ''}}" class="form-control " id="per_sending_limit">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <p class="mg-t-10 mg-b-1">Per Location Limit</p>
                                                                        <input type="text" name="per_location_limit" value="{{isset($lead->policy) ? $lead->policy->per_location_limit : ''}}" class="form-control " id="per_location_limit">
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <p class="mg-t-10 mg-b-1">Estimated Annual Sum Insured</p>
                                                                        <input type="text" name="estimate_annual_sum" value="{{isset($lead->policy) ? $lead->policy->estimate_annual_sum : ''}}" class="form-control " id="estimate_annual_sum">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <p class="mg-t-10 mg-b-1">Basis Of Valuation</p>
                                                                        <input type="text" name="basic_of_valuation" value="{{isset($lead->policy) ? $lead->policy->basic_of_valuation : ''}}" class="form-control " id="basic_of_valuation">
                                                                    </div>

                                                                    <div class="col-lg-6">

                                                                        <p class="mg-t-10 mg-b-1">Details Of Commodity Type</p>
                                                                        <select name="commodity_details" class="select2 form-control " id="commodity_details">
                                                                            <option value="">Select Below</option>
                                                                            <option value="BOXES" {{ (isset($lead->policy) && "BOXES" == $lead->policy->commodity_details) ? 'selected' : '' }}>BOXES</option>
                                                                            <option value="CONTAINER" {{ (isset($lead->policy) && "CONTAINER" == $lead->policy->commodity_details) ? 'selected' : '' }}>CONTAINER</option>
                                                                            <option value="WEIGHT" {{ (isset($lead->policy) && "WEIGHT" == $lead->policy->commodity_details) ? 'selected' : '' }}>WEIGHT</option>
                                                                            <option value="NO OF PACKAGES" {{ (isset($lead->policy) && "NO OF PACKAGES" == $lead->policy->commodity_details) ? 'selected' : '' }}>NO OF PACKAGES</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-6  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Remarks
                                                                    </label>
                                                                    <textarea name="remarks" class="form-control " cols="30" rows="30" id="remarks">{{isset($lead->policy) ? $lead->policy->remarks : ''}}</textarea>
                                                                </div>
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Packing Description
                                                                    </label>
                                                                    <input type="text" name="packing_description" value="{{isset($lead->policy) ? $lead->policy->packing_description : ''}}" class="form-control " id="packing_description">
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
                                                                    <input type="text" name="industry_type" value="{{isset($lead->policy) ? $lead->policy->industry_type : ''}}" class="form-control feild" id="industry_type">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Total No Of Workers
                                                                    </label>
                                                                    <input type="text" name="worker_number" value="{{isset($lead->policy) ? $lead->policy->worker_number : ''}}" class="form-control feild" id="worker_number">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">DURATION OF POLICY

                                                                    </label>
                                                                    <input type="text" name="wc_policy" value="{{isset($lead->policy) ? $lead->policy->wc_policy : ''}}" class="form-control feild" id="wc_policy">
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
                                                                        <option value="SKILLED" {{ (isset($lead->policy) && "SKILLED" == $lead->policy->job_profile) ? 'selected' : '' }}>SKILLED</option>
                                                                        <option value="SEMISKILLED" {{ (isset($lead->policy) && "SEMISKILLED" == $lead->policy->job_profile) ? 'selected' : '' }}>SEMISKILLED</option>
                                                                        <option value="UNSKILLED" {{ (isset($lead->policy) && "UNSKILLED" == $lead->policy->job_profile) ? 'selected' : '' }}>UNSKILLED</option>

                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Salery Per Month
                                                                    </label>
                                                                    <input type="text" name="salary_per_month" value="{{isset($lead->policy) ? $lead->policy->salary_per_month : ''}}" class="form-control feild" id="salary_per_month">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row row-xs formgroup-wrapper background">
                                                            <div class="col-lg-6 ">
                                                                <div class="row">
                                                                    <div class="col-lg-6">

                                                                        <p class="mg-t-10 mg-b-1">Medical Extension</p>
                                                                        <input type="text" name="medical_extension" value="{{isset($lead->policy) ? $lead->policy->medical_extension : ''}}" class="form-control feild" id="medical_extension">

                                                                    </div>
                                                                    <div class="col-lg-6">

                                                                        <p class="mg-t-10 mg-b-1">Occupation Disease</p>
                                                                        <input type="text" name="occupation_disease" value="{{isset($lead->policy) ? $lead->policy->occupation_disease : ''}}" class="form-control feild" id="occupation_disease">

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">

                                                                        <p class="mg-t-10 mg-b-1">Compressed Air Disease Extension</p>
                                                                        <input type="text" name="compressed_air_disease" value="{{isset($lead->policy) ? $lead->policy->compressed_air_disease : ''}}" class="form-control feild" id="compressed_air_disease">

                                                                    </div>
                                                                    <div class="col-lg-6">

                                                                        <p class="mg-t-10 mg-b-1">Terrorism Cover</p>
                                                                        <input type="text" name="terrorism_cover" value="{{isset($lead->policy) ? $lead->policy->terrorism_cover : ''}}" class="form-control feild" id="terrorism_cover">

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">

                                                                        <p class="mg-t-10 mg-b-1">Sub Contractor Cover</p>
                                                                        <input type="text" name="sub_contractor_cover" value="{{isset($lead->policy) ? $lead->policy->sub_contractor_cover : ''}}" class="form-control feild" id="sub_contractor_cover">

                                                                    </div>
                                                                    <div class="col-lg-6">

                                                                        <p class="mg-t-10 mg-b-1">Multiple Location</p>
                                                                        <input type="text" name="multiple_location" value="{{isset($lead->policy) ? $lead->policy->multiple_location : ''}}" class="form-control feild" id="multiple_location">

                                                                    </div>
                                                                </div>



                                                            </div>
                                                            <div class="col-lg-6  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Remarks
                                                                    </label>
                                                                    <textarea name="remarks" cols="30" rows="8" id="remarks">{{isset($lead->policy) ? $lead->policy->remarks : ''}}</textarea>
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
                                                                    <input type="text" name="measures_taken_after_loss" value="{{isset($lead->policy) ? $lead->policy->measures_taken_after_loss : ''}}" class="form-control feild" id="measures_taken_after_loss">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Loss Date
                                                                    </label>
                                                                    <input type="text" name="loss_date" value="{{isset($lead->policy) ? $lead->policy->loss_date : ''}}" class="form-control feild" id="loss_date">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Loss In Amount

                                                                    </label>
                                                                    <input type="text" name="loss_in_amount" value="{{isset($lead->policy) ? $lead->policy->loss_in_amount : ''}}" class="form-control feild" id="loss_in_amount">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Address Risk Location

                                                                    </label>
                                                                    <input type="text" name="address_risk_location" value="{{isset($lead->policy) ? $lead->policy->address_risk_location : ''}}" class="form-control feild" id="address_risk_location">
                                                                </div>
                                                            </div>



                                                        </div>
                                                        <div class="row row-xs formgroup-wrapper">
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Cover Opted
                                                                    </label>
                                                                    <input type="text" name="cover_opted" value="{{isset($lead->policy) ? $lead->policy->cover_opted : ''}}" class="form-control feild" id="cover_opted">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Policy Inception Date
                                                                    </label>
                                                                    <input type="text" name="policy_inception_date" value="{{isset($lead->policy) ? $lead->policy->policy_inception_date : ''}}" class="form-control feild" id="policy_inception_date">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Tenure

                                                                    </label>
                                                                    <input type="text" name="tenure" value="{{isset($lead->policy) ? $lead->policy->tenure : ''}}" class="form-control feild" id="tenure">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Construction Type

                                                                    </label>
                                                                    <select name="construction_type" class="form-control feild" id="construction_type">
                                                                        <option value="">Select</option>
                                                                        <option value="PUCCA" {{ (isset($lead->policy) && "PUCCA" == $lead->policy->construction_type) ? 'selected' : '' }}>PUCCA</option>
                                                                        <option value="KUTCHA" {{ (isset($lead->policy) && "KUTCHA" == $lead->policy->construction_type) ? 'selected' : '' }}>KUTCHA</option>
                                                                    </select>
                                                                </div>
                                                            </div>



                                                        </div>
                                                        <div class="row row-xs formgroup-wrapper">
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Age Of the Building
                                                                    </label>
                                                                    <input type="text" name="age_of_building" value="{{isset($lead->policy) ? $lead->policy->age_of_building : ''}}" class="form-control feild" id="age_of_building">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Basement for Building
                                                                    </label>
                                                                    <input type="text" name="basement_for_building" value="{{isset($lead->policy) ? $lead->policy->basement_for_building : ''}}" class="form-control feild" id="basement_for_building">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Basement for Content

                                                                    </label>
                                                                    <input type="text" name="basement_for_content" value="{{isset($lead->policy) ? $lead->policy->basement_for_content : ''}}" class="form-control feild" id="basement_for_content">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Claim
                                                                    </label>
                                                                    <input type="text" name="claims" value="{{isset($lead->policy) ? $lead->policy->claims : ''}}" class="form-control feild" id="claims">

                                                                </div>
                                                            </div>



                                                        </div>
                                                        <div class="row row-xs formgroup-wrapper">
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Building Carpet Area
                                                                    </label>
                                                                    <input type="text" name="building_carpet_area" value="{{isset($lead->policy) ? $lead->policy->building_carpet_area : ''}}" class="form-control feild" id="building_carpet_area">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Building Cost Of Construction
                                                                    </label>
                                                                    <input type="text" name="building_cost_of_construction" value="{{isset($lead->policy) ? $lead->policy->building_cost_of_construction : ''}}" class="form-control feild" id="building_cost_of_construction">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Building Sum Insured

                                                                    </label>
                                                                    <input type="text" name="building_sum_insured" value="{{isset($lead->policy) ? $lead->policy->building_sum_insured : ''}}" class="form-control feild" id="building_sum_insured">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Content Sum Insured
                                                                    </label>
                                                                    <input type="text" name="content_sum_insured" value="{{isset($lead->policy) ? $lead->policy->content_sum_insured : ''}}" class="form-control feild" id="content_sum_insured">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Rent of Alternative Accommodation
                                                                    </label>
                                                                    <input type="text" name="rent_alternative_accommodation" value="{{isset($lead->policy) ? $lead->policy->rent_alternative_accommodation : ''}}" class="form-control feild" id="rent_alternative_accommodation">

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
                                                                    <input type="text" name="measures_taken_after_loss" value="{{isset($lead->policy) ? $lead->policy->measures_taken_after_loss : ''}}" class="form-control feild" id="measures_taken_after_loss">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Address Risk Location

                                                                    </label>
                                                                    <input type="text" name="address_risk_location" value="{{isset($lead->policy) ? $lead->policy->address_risk_location : ''}}" class="form-control feild" id="address_risk_location">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">RISK LOCATION PINCODE


                                                                    </label>
                                                                    <input type="text" name="pincode" value="{{isset($lead->policy) ? $lead->policy->pincode : ''}}" class="form-control feild" id="pincode">
                                                                </div>
                                                            </div>



                                                        </div>
                                                        <div class="row row-xs formgroup-wrapper">
                                                            <div class="col-lg-6  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Occupancy
                                                                    </label>
                                                                    <input type="text" name="occupancy" value="{{isset($lead->policy) ? $lead->policy->occupancy : ''}}" class="form-control feild" id="occupancy">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Occupancy Tarriff
                                                                    </label>
                                                                    <input type="text" name="occupancy_tarriff" value="{{isset($lead->policy) ? $lead->policy->occupancy_tarriff : ''}}" class="form-control feild" id="occupancy_tarriff">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Particular

                                                                    </label>
                                                                    <input type="text" name="particular" value="{{isset($lead->policy) ? $lead->policy->particular : ''}}" class="form-control feild" id="particular">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row row-xs formgroup-wrapper">
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Building
                                                                    </label>
                                                                    <input type="text" name="building" value="{{isset($lead->policy) ? $lead->policy->building : ''}}" class="form-control feild" id="building">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Plant And Machinery
                                                                    </label>
                                                                    <input type="text" name="plant_machine" value="{{isset($lead->policy) ? $lead->policy->plant_machine : ''}}" class="form-control feild" id="plant_machine">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Furniture Fixture And Fittings

                                                                    </label>
                                                                    <input type="text" name="furniture_fixure" value="{{isset($lead->policy) ? $lead->policy->furniture_fixure : ''}}" class="form-control feild" id="furniture_fixure">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Stock In Process
                                                                    </label>
                                                                    <input type="text" name="stock_in_process" value="{{isset($lead->policy) ? $lead->policy->stock_in_process : ''}}" class="form-control feild" id="stock_in_process">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Finished Stock
                                                                    </label>
                                                                    <input type="text" name="finished_stock" value="{{isset($lead->policy) ? $lead->policy->finished_stock : ''}}" class="form-control feild" id="finished_stock">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Other Contents
                                                                    </label>
                                                                    <input type="text" name="other_contents" value="{{isset($lead->policy) ? $lead->policy->other_contents : ''}}" class="form-control feild" id="other_contents">

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
                                                                    <input type="text" name="loss_details" value="{{isset($lead->policy) ? $lead->policy->loss_details : ''}}" class="form-control feild" id="loss_details">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 clain_in_last_three_year_yes">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Loss In Amount
                                                                    </label>
                                                                    <input type="text" name="loss_in_amount" value="{{isset($lead->policy) ? $lead->policy->loss_in_amount : ''}}" class="form-control feild" id="loss_in_amount">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 clain_in_last_three_year_yes">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Loss Date
                                                                    </label>
                                                                    <input type="text" name="loss_date" value="{{isset($lead->policy) ? $lead->policy->loss_date : ''}}" class="form-control feild" id="loss_date">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 clain_in_last_three_year_yes">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Measures Taken After Loss
                                                                    </label>
                                                                    <input type="text" name="measures_taken_after_loss" value="{{isset($lead->policy) ? $lead->policy->measures_taken_after_loss : ''}}" class="form-control feild" id="measures_taken_after_loss">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 ">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Remarks
                                                                    </label>
                                                                    <input type="text" name="remarks" value="{{isset($lead->policy) ? $lead->policy->remarks : ''}}" class="form-control feild" id="remarks">
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
                                                                    <input type="text" name="visiting_country" value="{{isset($lead->policy) ? $lead->policy->visiting_country : ''}}" class="form-control feild" id="visiting_country">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Date Of Departure

                                                                    </label>
                                                                    <input type="date" name="date_of_departure" value="{{isset($lead->policy) ? $lead->policy->date_of_departure : ''}}" class="form-control feild" id="date_of_departure">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Date of Arrival
                                                                    </label>
                                                                    <input type="date" name="date_of_arrival" value="{{isset($lead->policy) ? $lead->policy->date_of_arrival : ''}}" class="form-control feild" id="date_of_arrival">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row row-xs formgroup-wrapper">
                                                            <div class="col-lg-6  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">No Of Days
                                                                    </label>
                                                                    <input type="text" name="no_of_days" value="{{isset($lead->policy) ? $lead->policy->no_of_days : ''}}" class="form-control feild" id="no_of_days">

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3  text-center">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">No Of Person
                                                                    </label>
                                                                    <input type="text" name="no_person" value="{{isset($lead->policy) ? $lead->policy->no_person : ''}}" class="form-control feild" id="no_person">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="main-form-group background">
                                                                    <label class="form-label">Passport details

                                                                    </label>
                                                                    <input type="text" name="passport_datails" value="{{isset($lead->policy) ? $lead->policy->passport_datails : ''}}" class="form-control feild" id="passport_datails">

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

                                                                </thead>
                                                                <tbody class="travel-body">
                                                                    @if(isset($lead->policy->travel_type) && !empty($lead->policy->travel_type))

                                                                    <?php
                                                                    $travel_type = json_decode($lead->policy->travel_type);
                                                                    ?>
                                                                    @foreach($travel_type->travel_name as $key=> $name)

                                                                    <tr>
                                                                        <td><input type="text" class="form-control" name="travel_name[]" value="{{$name ?? ''}}"></td>

                                                                        <td><input type="date" class="form-control" name="travel_dob[]" value="{{$travel_type->travel_dob[$key] ?? ''}}"></td>

                                                                        <td><input type="text" class="form-control" name="travel_age[]" value="{{$travel_type->travel_age[$key] ?? ''}}"></td>
                                                                        <td><input type="text" class="form-control" name="travel_sum_insured[]" value="{{$travel_type->travel_sum_insured[$key] ?? ''}}"></td>
                                                                        <td><input type="text" class="form-control" name="travel_pre_existing_disease[]" value="{{$travel_type->travel_pre_existing_disease[$key] ?? ''}}"></td>

                                                                    </tr>
                                                                    @endforeach


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




                            </div>
                        </div>
                        <div class="tab-pane" id="profile">
                            <div class="row">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                Creted By
                                            </th>
                                            <th>
                                                Creted At
                                            </th>
                                            <th>
                                                File Name
                                            </th>
                                            <th>
                                                Type
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($lead->attachments))
                                        @foreach($lead->attachments as $attachment)
                                        @if($attachment->type != 'Policy')
                                        <tr>
                                            <td>{{$attachment->users->name ?? ''}}</td>
                                            <td>{{$attachment->created_at}}</td>
                                            <td><a href="{{URL::asset('attachments')}}/{{$attachment->file_name}}" target="_blank">{{$attachment->file_name}}</a></td>
                                            <td>{{$attachment->type}}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="policy">
                            <div class="row">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                Creted By
                                            </th>
                                            <th>
                                                Creted At
                                            </th>
                                            <th>
                                                File Name
                                            </th>
                                            <th>
                                                Type
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($lead->attachments))
                                        @foreach($lead->attachments as $attachment)
                                        @if($attachment->type == 'Policy')
                                        <tr>
                                            <td>{{$attachment->users->name ?? ''}}</td>
                                            <td>{{$attachment->created_at}}</td>
                                            <td><a href="{{URL::asset('attachments')}}/{{$attachment->file_name}}" target="_blank">{{$attachment->file_name}}</a></td>
                                            <td>{{$attachment->type}}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="settings">
                            <div class="row">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                Creted By
                                            </th>
                                            <th>
                                                Creted At
                                            </th>
                                            <th>
                                                Company
                                            </th>
                                            <th>
                                                File Name
                                            </th>
                                            <th>
                                                Remarks
                                            </th>
                                            <th>
                                                Action
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($lead->quotes))
                                        @foreach($lead->quotes as $quotes)
                                        <tr>
                                            <td>{{$quotes->users->name ?? ''}}</td>
                                            <td>{{$quotes->created_at}}</td>
                                            <td>{{$quotes->company->name ?? ''}}</td>
                                            <td><a href="{{URL::asset('quotes')}}/{{$quotes->file_name}}" target="_blank">{{$quotes->file_name}}</a></td>
                                            <td>{!! $quotes->remark !!}</td>
                                            <td>
                                                @if(empty($quotes->type))
                                                <a href="{{ route('acceptLead',['id'=>$lead->id,'quote'=> $quotes->id]) }}" class="btn btn-sm btn-primary remove_us" title="Accept" data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="Please Confirm" data-confirm-text="Are you sure that you want to accept this quotes?" data-confirm-delete="Yes, Accept it!">
                                                    Accept
                                                </a>
                                                <a href="{{route('rejectLead',['id'=>$lead->id,'quote'=> $quotes->id])}}" class="btn btn-sm btn-danger remove_us" title="Reject" data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="Please Confirm" data-confirm-text="Are you sure that you want to reject this quotes?" data-confirm-delete="Yes, Reject it!">
                                                    Reject
                                                </a>
                                                @else
                                                <button class="btn @if($quotes->type =='Accept')btn-primary @else btn-danger @endif">{{$quotes->type}}</button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
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
    <!-- row closed -->
</div>
<!-- Modal effects -->
<div class="modal fade" id="status-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Change Status</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h6>Status</h6>
                <select name="changeStatus" id="changeStatus" class="form-control changeStatus">
                    <option value="">Select</option>
                    <option value="PENDING/FRESH">PENDING/FRESH</option>
                    <option value="IN PROCESS">IN PROCESS</option>
                    <option value="MORE INFO REQUIRED">MORE INFO REQUIRED</option>
                    <option value="QUOTE GENERATED">QUOTE GENERATED</option>
                    <option value="RE-QUOTE">RE-QUOTE</option>
                    <option value="REJECTED">REJECTED</option>
                    <option value="POLICY TO BE ISSUED">POLICY TO BE ISSUED</option>
                    <option value="LINK GENERATED">LINK GENERATED</option>
                    <option value="LINK GENERATED BUT NOT PAID">LINK GENERATED BUT NOT PAID</option>

                </select>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary save-status" type="button">Save changes</button>
                <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal effects-->
<!-- attachment effects -->
<div class="modal fade" id="attachments">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Attachments</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('leadAttachment')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6>Upload</h6>
                            <input type="file" name="attachment[]" id="attachment" class="form-control">

                        </div>
                        <div class="col-lg-6">
                            <h6>Type</h6>

                            <select name="type[]" class="form-control" required>
                                <option value="">Select</option>
                                <option value="Attachment">Attachment</option>
                                <option value="Policy">Policy</option>
                                <option value="RC">RC</option>
                                <option value="Previous Year Policy">Previous Year Policy</option>
                                <option value="Invoice Copy">Invoice Copy</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="attach-content"></div>
                    <span id="add-attach-multi" class="btn btn-info">
                        Add More
                    </span>

                    <input type="hidden" name="lead_id" value="{{$lead->id ?? ''}}">
                    <input type="hidden" name="policy_id" value="{{$lead->policy->id ?? ''}}">
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary save-status" type="submit">Save changes</button>
                    <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal effects-->
<!-- quotes effects -->
<div class="modal fade" id="quotes">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo" style="min-width: 800px">
            <div class="modal-header">
                <h6 class="modal-title">Quotes</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('leadQuotes')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6>Insurance Company</h6>
                            <select name="company[]" id="company" class="form-control">
                                <option value="">Select</option>
                                @if($companiess->count())
                                @foreach($companiess as $companies)
                                <option value="{{$companies->id ?? ''}}">{{$companies->name ?? ''}}</option>
                                @endforeach
                                @endif

                            </select>
                            <h6>Attachment</h6>
                            <input type="file" name="attachment[]" id="attachment" class="form-control">
                        </div>

                        <div class="col-lg-6">
                            <h6>Remarks</h6>
                            <textarea name="remarks[]" id="remarks" class="form-control editor"></textarea>

                        </div>
                    </div>
                    <input type="hidden" name="lead_id" value="{{$lead->id}}">
                    <div class="dynamic-quote"></div>
                </div>

                <div class="modal-footer">
                    <button class="btn ripple btn-primary add-more" type="button">Add More</button>

                    <button class="btn ripple btn-primary save-status" type="submit">Save changes</button>
                    <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal effects-->
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#home input").prop("disabled", true);
        $("#home select").prop("disabled", true);

        $("#home select").select2();
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
        $('.editor').summernote({
            toolbar: [
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['insert', ['link', 'image', 'doc', 'video']],
                ['misc', ['codeview']],
            ],
            height: 100,

        });
        $('.table').dataTable();
        $('#add-attach-multi').click(function() {
            $('.attach-content').append('<div class="row"><div class="col-lg-6"><h6>Upload</h6><input type="file" name="attachment[]" id="attachment" class="form-control"></div><div class="col-lg-6"><h6>Type</h6><select name="type[]"required class="form-control"><option value="">Select</option> <option value="Attachment">Attachment</option><option value="Policy">Policy</option><option value="RC">RC</option><option value="Previous Year Policy">Previous Year Policy</option><option value="Invoice Copy">Invoice Copy</option><option value="Other">Other</option></select></div></div>');
        })
        $('.add-more').click(function() {

            $.ajax({
                url: "{{ route('getCompany') }}",
                method: "get",
                success: function(result) {

                    $('.dynamic-quote').append(`<div class="row">
                            <div class="col-lg-6">
                                <h6>Insurance Company</h6>
                                <select name="company[]" id="company" class="form-control">  
                               ${result}
                                </select>
                                <h6>Attachment</h6>
                                <input type="file" name="attachment[]" id="attachment" class="form-control">
                            </div>
                    
                            <div class="col-lg-6">
                                <h6>Remarks</h6>
                            <textarea name="remarks[]" id="remarks" class="form-control editor"></textarea>

                            </div>
					</div>`);
                    $('.editor').summernote({
                        toolbar: [
                            ['font', ['bold', 'italic', 'underline', 'clear']],
                            ['insert', ['link', 'image', 'doc', 'video']],
                            ['misc', ['codeview']],
                        ],
                        height: 100,

                    });

                }

            });
        })
        let subproduct = "{{$lead->subProduct->name ?? ''}}";
        if (subproduct != '') {
            subproduct = $.trim(subproduct).toLowerCase();
            changeFeild(subproduct);
        }
        $('.filter-btn').click(function() {
            $('.filter-box').toggleClass("hidden");
        })
        $('.change-status').click(function() {
            $('#status-modal').modal("show");
            $('.save-status').click(function() {

                var status = $("#changeStatus option:selected").val();
                var lead_id = '{{$lead->id ?? '
                '}}';
                if (status != '') {
                    $.ajax({
                        url: "{{ route('changeStatus') }}",
                        method: "post",
                        data: {
                            lead_id: lead_id,
                            status: status
                        },
                        success: function(result) {
                            window.location.href = window.location.href;
                        }

                    });
                }

            })
        })


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