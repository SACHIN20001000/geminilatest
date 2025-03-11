@extends('admin.layouts.app')

@section('content')

<style>
    .filter-box .card-body {
        padding: 10px 15px !important;
    }

    .filter-box .form-control {
        height: 30px;
        line-height: 1.25;
        margin-bottom: 5px;
    }

    .filter-box .mg-b-10 {
        margin-bottom: 5px;
    }

    label[for="file-up"] {
        text-align: center;
        display: block;
    }

    label[for="file-up"] svg {
        width: 24px;
        cursor: pointer;
    }

    input#file-up {
        display: none;
    }

    .dtfc-fixed-left {
        z-index: 999 !important;
        background-color: white !important;
    }

    .dtfc-fixed-right {
        z-index: 999 !important;
        background-color: white !important;
    }

    a.remove_us svg {
        width: 12px;
        height: 12px;
        fill: #dd0909;
        /* transform: translateY(-6px) translateX(-5px); */
        cursor: pointer;
    }

    a.view_files,
    a.remove_us {
        cursor: pointer !important;
    }

    a.view_files svg {
        width: 18px;
        stroke: #363636;
        cursor: pointer;
    }

    .truncate-text {
        max-width: 110px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .truncate-text-small {
        max-width: 50px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;

    }

    .renew_status {
        max-width: 70px;
        min-width: 70px;
        height: 24px !important;
        line-height: 10px;
        font-size: 12px;
        font-weight: 600;
        padding: 5px 8px;
        text-align: center
    }

    /* Add this CSS code for the spinner */
    #loader-wrapper {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    #loader {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* New CSS */
    span.select2-selection.select2-selection--multiple,
    .select2-container--default .select2-selection--single {
        height: 32px;
        min-height: 32px;
    }

    div.dt-buttons {
        float: right !important;
    }

    .main-content-label.mg-b-5 {
        font-size: 20px;
        font-weight: 700;
        line-height: 28px;
        margin-bottom: 16px;
    }

    .text-sm {
        font-size: 12px;
        /* 12px */
        line-height: 16px;
        /* 16px */
    }

    .dataTables_filter label {
        border: 1px solid #f1f1f1;
        background: #f9f9f9;
        border-radius: 8px;
        padding: 0px 0px 0 10px;
    }

    .dataTables_filter label input[type="search"] {
        border: 0;
    }

    .dataTables_filter label input[type="search"]:focus {
        outline: unset;
    }

    .dataTables_wrapper .dataTables_filter {
        float: left !important;
    }

    div#datatable_length {
        bottom: 0;
        position: absolute;
        z-index: 10;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fff;
    }

    div#datatable_info {
        float: right;
    }

    div#datatable_paginate {
        display: flex;
        float: unset;
        justify-content: center;
        transform: translateY(-8px);
    }

    table#datatable {
        display: block;
        width: 100% !important;
        overflow: scroll !important;
        height: 100%;
        min-height: 265px;
        max-height: 265px;
    }

    #datatable::-webkit-scrollbar {
        height: 10px;
    }

    aside.app-sidebar.sidebar-scroll::-webkit-scrollbar {
        width: 10px;
    }


    .table-responsive.userlist-table {
        overflow: hidden !important;
        width: 100%;
    }


    .dt-button.buttons-html5 {
        background: #2a52be;
        color: #fff;
        border-color: #3451b7;
        min-width: 60px;
        border-radius: 6px;
        padding: 3px 16px;
    }

    .dt-button.buttons-html5:hover {
        background: #1d3c92 !important;
        color: #fff;
        border-color: #1d3c92 !important;
    }

    table.dataTable thead th {
        font-size: 13px;
        color: #242f48;
        font-weight: 600 !important;
        text-transform: capitalize;
    }

    table.dataTable thead td a {
        font-size: 13px;
        color: #242f48 !important;
        font-weight: 400;
        text-transform: capitalize;
    }

    /* .userlist-table .table td a {
        font-size: 14px;
    } */

    button.btn,
    .btn-main-primary {
        background: #2a52be;
    }

    div#datatable_paginate .paginate_button {
        padding: 5px 10px;
        border: 1px solid #f1f1f1;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #3653b8 !important;
        color: #fff !important;
    }

    table .btn-sm,
    .userlist-table .btn-group-sm>.btn {
        padding: .25rem .7rem !important;
        margin: 0 4px !important;
    }

    .dataTables_wrapper .dataTables_filter label {
        margin-bottom: 0 !important;
    }

    .iconBtn svg {
        width: 16px;
        height: 16px;
        fill: #02b9ff;
    }

    svg.open-attachment {
        width: 16px;
        height: 16px;
        fill: #53b6f9
    }

    .dataTables_wrapper .dataTables_paginate a.paginate_button.current {
        color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #3c52b2;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 6px;
    }

    input[type="date"],
    input[type="time"],
    input[type="datetime-local"],
    input[type="month"] {
        height: 32px;
        min-height: 32px;
    }

    td.-small.no-click.truncate-text {
        max-width: 140px;
    }

    .form-control.follow_up {
        min-height: auto;
        padding: 0 5px !important;
        height: auto !important;
    }

    @media (max-width: 1650px) {
        td {
            font-size: 12px !important;
            padding: 0 9px !important;
        }

        .userlist-table .table th {
            padding: 6px 6px !important;
            /* white-space: nowrap; */
            line-height: 1;
        }

        .userlist-table .table th:first-child {
            padding: 6px !important;
        }

        .userlist-table .table td {
            padding: 6px 6px !important;
            /* white-space: nowrap; */
            line-height: 1;
        }

        .userlist-table .table tbody {
            min-height: 90px !important;
            max-width: 100px !important;
            height: 100px !important;
            overflow: auto;
        }

        .userlist-table .table {
            white-space: unset !important;
        }

        .btn-group {
            white-space: nowrap !important;
        }
    }

    @media (max-width: 1400px) {
        td {
            padding: 0 5px !important;
        }

        .userlist-table .table th {
            padding: 0 5px !important;
        }
    }

    @media all and (max-width: 767px) {
        .header-btn {
            flex-wrap: wrap;
        }

        .date_picker {
            display: block;
            width: 100%;
        }

        .date_picker .card {
            box-shadow: unset;
        }

        button#daterange-btn {
            width: 100%;
        }

        .dt-button.buttons-html5 {
            min-width: 31%;
        }

        .dataTables_wrapper .dataTables_filter label {
            display: flex;
            align-items: center;
        }

        .dataTables_wrapper .dataTables_filter {
            width: 100%;
        }

        div.dataTables_wrapper div.dataTables_filter input {
            margin-left: 0px;
        }

        div#datatable_info {
            float: unset;
            margin-bottom: 20px;
        }

        div#datatable_length {
            position: unset;
            margin-top: 20px;
        }

        .userlist-table .table th {
            padding: 6px 12px !important;
        }

        .dtfc-fixed-left,
        .dtfc-fixed-right {
            position: unset !important;
        }

        div#datatable_paginate {
            flex-wrap: wrap;
        }

        .truncate-text {
            max-width: 126px;
        }
    }
</style>
<div id="loader-wrapper" style="display: none;">
    <div id="loader"></div>
</div>
<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header my-3 justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto pe-lg-4 pe-2">Policy </h4>
                <div class="pe-lg-4 pe-2 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a href="{{ route('new-policy.index', ['id' => 1]) }}" class=" @if (isset($_GET['id']) && $_GET['id'] == 1) btn btn-warning @else btn btn-info @endif ml_auto">MIS
                            (<?php echo new_policy(); ?>)</a>
                    </div>
                </div>
                <div class="pe-gl-4 pe-2 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a href="{{ route('new-policy.index', ['id' => 2]) }}" class=" @if (isset($_GET['id']) && $_GET['id'] == 2) btn btn-warning @else btn btn-info @endif  ml_auto">Renewals
                            (<?php echo renew_policy(); ?>)</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="d-flex gap-2 my-xl-auto right-content header-btn">
            <div class="date_picker">
                <div class="mb-xl-0 card p-2 mb-lg-2 mb-0">
                    <button type="button" class="bg-white btn btn-default float-right d-flex align-items-center gap-2 p-0" id="daterange-btn">
                        <i class="far fa-calendar-alt"></i>
                        <div class="staticDays">Financial Year</div>
                        <div id="dynamicDate"></div>
                        <i class="fas fa-caret-down"></i>
                    </button>
                </div>
                <div id="reportrange"><span></span></div>
            </div>
            @if(Auth::user()->hasRole('Staff') || Auth::user()->hasRole('Admin'))
            <div class="mb-xl-0">
                <button type="button" class="btn btn-danger duplicate-record">Duplicate</button>
            </div>

            @if (isset($_GET['id']) && $_GET['id'] == 2)
            <div class="mb-xl-0">

                <a class="btn btn-main-primary renew-btn " style="color:#fff">Bulk email</a>

            </div>
            @else
            <div class="mb-xl-0">

                <a class="btn btn-main-primary bulk-delete " style="color:#fff">Delete</a>

            </div>
            @endif
            @endif
            <div class="mb-xl-0">
                <div class="btn-group dropdown">
                    <a class="btn btn-main-primary ml_auto" href="{{ route('policy.create') }}">Add Policy</a>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <!-- <div class="card-body tableBody">
                                                                                    <div class="orderSearchHistory">
                                                                                        @include('admin.policy.search')
                                                                                    </div>

                                                                                </div>
                                                                             -->
    <div class="row row-sm gx-0">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <!-- <div class="main-content-label mg-b-5">
                        Listing of All Policy...
                    </div> -->
                    <!-- filter start  -->
                    <div class="row row-sm mb-3">
                        <div class="col-lg mb-lg-0 mb-2">
                            <p class="mb-2 text-sm fw-bold">Product</p>

                            <select name="product[]" multiple="multiple" class="form-control select-2">
                                @if (isset($products) && $products->count())
                                @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ isset($_GET['product']) && is_array($_GET['product']) && in_array($product->id, $_GET['product']) ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg mb-lg-0 mb-2">
                            <p class="mb-2 text-sm fw-bold">User</p>

                            <select name="users[]" multiple="multiple" class="form-control select-2">
                                @if (isset($users) && $users->count())
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ isset($_GET['users']) && (is_array($_GET['users']) ? in_array($user->id, $_GET['users']) : $_GET['users'] == $user->id) ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg mb-lg-0 mb-2">
                            @if (isset($_GET['id']) && $_GET['id'] == 2)
                            <p class="mb-2 text-sm fw-bold">Followup</p>

                            <input type="date" name="follow_ups" id="" class="form-control" value="{{ isset($_GET['follow_ups']) ? $_GET['follow_ups'] : '' }}">
                            @else
                            <p class="mb-2 text-sm fw-bold">Payment Status</p>

                            <select name="is_paid" class="form-control select-2">
                                <option value="">Select</option>
                                <option value="1" {{ isset($_GET['is_paid']) && 1 == $_GET['is_paid'] ? 'selected' : '' }}>
                                    Paid</option>
                                <option value="2" {{ isset($_GET['is_paid']) && 2 == $_GET['is_paid'] ? 'selected' : '' }}>
                                    Pending</option>

                            </select>
                            @endif
                        </div>
                        <div class="col-lg mb-lg-0 mb-2">
                            <p class="mb-2 text-sm fw-bold"> Transaction Type</p>
                            <select name="mis_transaction_type[]" multiple=" multiple" class="form-control select-2">
                                <option value="">Select</option>
                                <option value="Package" {{ isset($_GET['mis_transaction_type']) && (is_array($_GET['mis_transaction_type']) ? in_array('Package', $_GET['mis_transaction_type']) : $_GET['mis_transaction_type'] == 'Package') ? 'selected' : '' }}>
                                    Package</option>
                                <option value="SOAD" {{ isset($_GET['mis_transaction_type']) && (is_array($_GET['mis_transaction_type']) ? in_array('SOAD', $_GET['mis_transaction_type']) : $_GET['mis_transaction_type'] == 'SOAD') ? 'selected' : '' }}>
                                    SOAD</option>
                                <option value="TP" {{ isset($_GET['mis_transaction_type']) && (is_array($_GET['mis_transaction_type']) ? in_array('TP', $_GET['mis_transaction_type']) : $_GET['mis_transaction_type'] == 'TP') ? 'selected' : '' }}>
                                    TP</option>
                                <option value="Endorsement" {{ isset($_GET['mis_transaction_type']) && (is_array($_GET['mis_transaction_type']) ? in_array('Endorsement', $_GET['mis_transaction_type']) : $_GET['mis_transaction_type'] == 'Endorsement') ? 'selected' : '' }}>
                                    Endorsement</option>
                            </select>
                        </div>
                        @if (isset($_GET['id']) && $_GET['id'] == 2)
                        <div class="col-lg mb-lg-0 mb-2">
                            <p class="mb-2 text-sm fw-bold">Renew Status</p>
                            <select name="renew_status_search" class="form-control select-2">
                                <option value="">Select</option>
                                <option value="FOLLOW UP" {{ isset($_GET['renew_status_search']) && 'FOLLOW UP' == $_GET['renew_status_search'] ? 'selected' : '' }}>
                                    FOLLOW UP</option>
                                <option value="VEHICLE SOLD" {{ isset($_GET['renew_status_search']) && 'VEHICLE SOLD' == $_GET['renew_status_search'] ? 'selected' : '' }}>
                                    VEHICLE SOLD</option>
                                <option value="NOT INTERESTED" {{ isset($_GET['renew_status_search']) && 'NOT INTERESTED' == $_GET['renew_status_search'] ? 'selected' : '' }}>
                                    NOT INTERESTED</option>
                                <option value="CLOSED" {{ isset($_GET['renew_status_search']) && 'CLOSED' == $_GET['renew_status_search'] ? 'selected' : '' }}>
                                    CLOSED</option>
                            </select>
                        </div>
                        @endif

                        <div class="col-lg mb-lg-0 mb-2">
                            <p class="mb-2 text-sm fw-bold">Company</p>
                            <select multiple=" multiple" name="company_id[]" class="form-control select-2">
                                <option value="">Select Below</option>
                                @if ($companies->count())
                                @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ isset($_GET['company_id']) && (is_array($_GET['company_id']) ? in_array($company->id, $_GET['company_id']) : $_GET['company_id'] == $company->id) ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>


                    </div>
                    <!-- filter end  -->

                    <div class="table-responsive border-top userlist-table pt-3">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0 pt-3" id="datatable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="all_checked" id="checkedAll" value="0"></th>
                                    @if (isset($_GET['id']) && $_GET['id'] == 1)
                                    <th><span>Created<br class="d-lg-block d-none" /> On</span></th>
                                    @endif
                                    <th><span>Reference<br class="d-lg-block d-none" /> Name</span></th>
                                    <th><span>Holder<br class="d-lg-block d-none" /> Name</span></th>
                                    <th><span>Company<br class="d-lg-block d-none" /> Name</span></th>
                                    <th><span>Trasaction<br class="d-lg-block d-none" /> Type</span></th>
                                    <th>Policy<br class="d-lg-block d-none" /> number</th>
                                    <th><span>Sub<br class="d-lg-block d-none" /> Product</span></th>
                                    <th><span>Payment<br class="d-lg-block d-none" /> Status</span></th>
                                    <th><span>Reg<br class="d-lg-block d-none" /> No.</span></th>
                                    @if (isset($_GET['id']) && $_GET['id'] == 2)
                                    <th><span>Expiry<br class="d-lg-block d-none" /> Date</span></th>
                                    <th><span>Followup<br class="d-lg-block d-none" /> Date</span></th>
                                    <th><span>Attachment</span></th>
                                    @endif
                                    @if (isset($_GET['duplicate']) && $_GET['duplicate'] == true)
                                    <th>Policy No</th>
                                    @endif
                                    <th>Product</th>
                                    <th>Business type</th>
                                    <th>Channel</th>
                                    <th>Start Date</th>
                                    <th>Expiry Date</th>
                                    <th>Make</th>
                                    <th>Modal</th>
                                    <th>Variant</th>
                                    <th>Reg No</th>
                                    <th>Cc</th>
                                    <th>Fuel</th>
                                    <th>Seating Capacity</th>
                                    <th>Mfr year</th>
                                    <th>Sum Insured</th>
                                    <th>OD Premium</th>
                                    <th>Add On Premium</th>
                                    <th>TP Premium</th>
                                    <th>Others</th>
                                    <th>Net Premium</th>
                                    <th>GST</th>
                                    <th>Gross Premium</th>
                                    <th> PREMIUM RECEIVED </th>
                                    <th> PREMIUM IN A/C
                                    </th>
                                    <th> PAYMENT METHOD
                                    </th>
                                    <th> PREMIUM SHORT
                                    </th>
                                    <th> PREMIUM DEPOSITED
                                    </th>
                                    <th> TO A/C
                                    </th>
                                    <th> PAYMENT METHOD
                                    </th>
                                    <th> PAYMENT SOURCE
                                    </th>
                                    <th> PAYOUT COMMISSION BASE
                                    </th>
                                    <th> PAYOUT Base amount
                                    </th>
                                    <th> PAYOUT PERCENTAGE </th>
                                    <th> PAYOUT AMOUNT
                                    </th>
                                    <th> PAYOUT PAYOUT SETTLED
                                    </th>
                                    <th> PAYOUT INVOICE </th>
                                    <th> PAYOUT MONTH SETTLED
                                    </th>
                                    <th> PAYOUT RECOVERY </th>


                                    <th> INTERNAL PAYOUT PERCENTAGE</th>
                                    <th> INTERNAL PAYOUT Payout expected
                                    </th>
                                    <th> INTERNAL PAYOUT Payout received
                                    </th>
                                    <th> INTERNAL PAYOUT PERCENTAGE</th>
                                    <th> INTERNAL PAYOUT Commission</th>
                                    <th> INTERNAL PAYOUT Payout Saved
                                    </th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- COL END -->
    </div>

</div>

<div class="modal fade show" id="common-btn" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Common Email</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
            </div>
            <form id="endorsementForm" method="POST" action="{{ route('endrosment') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">


                        <div class="col-lg-12">


                            <label>To </label>
                            <input type="email" name="to" class="form-control" id="policy_single_email">


                            <label>CC </label>
                            <input type="email" name="cc" class="form-control">
                            <input type="hidden" name="policy_id" id="policy_single_id">


                            <label>Content </label>
                            <textarea name="content" class="form-control " id="person_name" cols="30" rows="10">

                                 </textarea>

                        </div>

                    </div>


                    <div class="modal-footer">
                        <button class="btn ripple btn-primary save-status" type="button" id="endrosmentBtn">Send
                            Email</button>
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<div class="modal fade show" id="renew-modal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Bulk Email</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
            </div>

            <div class="modal-footer">
                <button class="btn ripple btn-primary bulkEmail" type="submit">Send</button>
                <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
            </div>


        </div>
    </div>
</div>

<div class="modal fade show" id="ticket-system-btn" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">
                    Endorsement
                </h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
            </div>
            <form id="endorsementForm" method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">


                        <div class="col-lg-12">

                            <label for="changeType">Endorsement Type:</label>
                            <select id="changeType" class="form-control" name="type">
                                <option value="NAME CORRECTION">NAME CORRECTION</option>
                                <option value="ADDRESS CHANGE">ADDRESS CHANGE</option>
                                <option value="NOMINEE">NOMINEE</option>
                                <option value="EMAIL/PHONE">EMAIL/PHONE</option>
                                <option value="VEHICLE REG NO">VEHICLE REG NO</option>
                                <option value="ENGINE/CHASSIS">ENGINE/CHASSIS</option>
                                <option value="HYPOTHECATION CHANGE/ REMOVAL">HYPOTHECATION CHANGE/ REMOVAL</option>
                                <option value="MAKE/MODEL/CC/MFR YEAR">MAKE/MODEL/CC/MFR YEAR</option>
                                <option value="RISK PERIOD">RISK PERIOD</option>
                                <option value="GST addition/correction">GST addition/correction</option>
                                <option value="IDV/electric/non electric accessories">IDV/electric/non electric accessories</option>
                                <option value="NCB CORRECTION">NCB CORRECTION</option>
                                <option value="NCB RESERVING">NCB RESERVING</option>
                                <option value="OWNERSHIP TRANSFER">OWNERSHIP TRANSFER</option>
                                <option value="OTHERS">OTHERS</option>
                            </select><br>

                            <label for="requiredDocuments">Required Documents:</label>
                            <select id="requiredDocuments" class="form-control" name="document">
                                <option value="RC/PYP and client request letter">RC/PYP and client request letter</option>
                                <option value="ADDRESS PROOF AND REQUEST LETTER">ADDRESS PROOF AND REQUEST LETTER</option>
                                <option value="RELATION PROOF AND CLIENT REQUEST LETTER">RELATION PROOF AND CLIENT REQUEST LETTER</option>
                                <option value="REQUEST LETTER">REQUEST LETTER</option>
                                <option value="RC AND REQUEST LETTER">RC AND REQUEST LETTER</option>
                                <option value="Previous year policy/ncb certificate from previous insurer">Previous year policy/ncb certificate from previous insurer</option>
                                <option value="Sale Deed or transferred RC or Form 29/30 And Client Request letter">Sale Deed or transferred RC or Form 29/30 And Client Request letter</option>
                                <option value="transferred RC or Form 29/30, proposal form, buyer seller request letter, inspection report">transferred RC or Form 29/30, proposal form, buyer seller request letter, inspection report</option>
                                <option value="PLS SHARE RELEVANT DOCUMENTS ALONG WITH REQUEST LETTER">PLS SHARE RELEVANT DOCUMENTS ALONG WITH REQUEST LETTER</option>
                            </select><br>

                            <label for="currentValue">Current Value:</label>
                            <input type="text" class="form-control" id="currentValue" name="current_value"><br>

                            <label for="newValue">New Value:</label>
                            <input type="text" class="form-control" id="newValue" name="new_value"><br>
                            <label for="newValue">Remark:</label>
                            <textarea name="remark" class="form-control" id="remark"></textarea>
                            <input type="hidden" name="policy_id" id="policy_ticket_id">
                            <label>Attachment</label>
                            <input type="file" class="form-control" name="file[]" multiple>
                        </div>

                    </div>


                    <div class="modal-footer">
                        <button class="btn ripple btn-primary save-status" type="submit" id="endrosmentBtn">Submit</button>

                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<!-- Summernote CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<!-- Toastr CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

<!-- DataTables FixedColumns CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.0.1/css/fixedColumns.dataTables.min.css">
<script src="https://cdn.datatables.net/fixedcolumns/4.0.1/js/dataTables.fixedColumns.min.js"></script>

<script type="text/javascript">
    var table;

    $(document).ready(function() {


        $(".select-2").select2();
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')],
                    'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')],

                    'Current Financial Year': [
                                            moment().month() < 3 
                                                ? moment().subtract(1, 'year').startOf('year').add(3, 'months') // April 1 of the previous year
                                                : moment().startOf('year').add(3, 'months'),                     // April 1 of the current year
                                            moment().month() < 3 
                                                ? moment().subtract(1, 'year').endOf('year').add(3, 'months')   // March 31 of the current year
                                                : moment().endOf('year').add(3, 'months')                       // March 31 of the next year
                                        ],
                    'Last Financial Year': [
                                            moment().month() < 3 
                                                ? moment().subtract(2, 'year').startOf('year').add(3, 'months') // April 1 of two years ago
                                                : moment().subtract(1, 'year').startOf('year').add(3, 'months'),// April 1 of the previous year
                                            moment().month() < 3 
                                                ? moment().subtract(2, 'year').endOf('year').add(3, 'months')   // March 31 of the previous year
                                                : moment().subtract(1, 'year').endOf('year').add(3, 'months')   // March 31 of the current year
                                        ]

                },
                startDate: moment().subtract(0, 'years').startOf('year').add(3, 'months'),
                endDate: moment().subtract(0, 'years').endOf('year').add(3, 'months').endOf('month')
            },
            function(start, end, range) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#reportrange span').addClass('active-date');
                $('#dynamicDate').html(range);
                $('.staticDays').hide();
            });



        $('#daterange-btn').on('apply.daterangepicker', function(ev, picker) {
            var start = picker.startDate.format('YYYY-MM-DD');
            var end = picker.endDate.format('YYYY-MM-DD');
            var range = $('#dynamicDate').html();
            updateDataTableFilters()
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let urlParams = new URLSearchParams(window.location.search);

        // Get the value of 'id' parameter and set it in the variable
        let id = @json(request('id', ''));

        // Get the values of other parameters and set them in the respective fields
        let product = urlParams.get('product');

        if (product && product != 'undefined') {
            let productValues = product.split(',');
            // Set the values in the Select2 picker
            $('select[name="product[]"]').val(productValues);
            // Trigger the change event to update the Select2 picker
            $('select[name="product[]"]').trigger('change');
        }

        let users = urlParams.get('users');
        if (users && users != 'undefined') {
            let usersValues = users.split(',');
            // Set the values in the Select2 picker
            $('select[name="users[]"]').val(users);
            // Trigger the change event to update the Select2 picker
            $('select[name="users[]"]').trigger('change');
        }

        let follow_ups = urlParams.get('follow_ups');

        if (follow_ups && follow_ups != 'undefined') {
            $('input[name="follow_ups"]').val(follow_ups);
        }

        let is_paid = urlParams.get('is_paid');
        if (is_paid && is_paid != 'undefined') {
            $('select[name="is_paid"]').val(is_paid);
        }

        let mis_transaction_type = urlParams.get('mis_transaction_type');
        if (mis_transaction_type && mis_transaction_type != 'undefined') {
            let misValues = mis_transaction_type.split(',');
            // Set the values in the Select2 picker
            $('select[name="mis_transaction_type[]"]').val(misValues);
            // Trigger the change event to update the Select2 picker
            $('select[name="mis_transaction_type[]"]').trigger('change');
        }

        let company_id = urlParams.get('company_id');
        if (company_id && company_id != 'undefined') {
            $('select[name="company_id[]"]').val(company_id);
        }

        let requestPage = urlParams.get('page');

        let renew_status_search = urlParams.get('renew_status_search');
        if (renew_status_search && renew_status_search != 'undefined') {
            let renew_statusValues = renew_status_search.split(',');
            // Set the values in the Select2 picker
            $('select[name="renew_status_search[]"]').val(renew_statusValues);
            // Trigger the change event to update the Select2 picker
            $('select[name="renew_status_search[]"]').trigger('change');
        }

        // // Get the start and end date parameters
        let expiry_from = urlParams.get('expiry_from');
        let expiry_to = urlParams.get('expiry_to');

        if (expiry_from && expiry_to) {
            // Set the start and end dates in the date range picker
            $('#daterange-btn').data('daterangepicker').setStartDate(expiry_from);
            $('#daterange-btn').data('daterangepicker').setEndDate(expiry_to);
        }

        let tableLength = urlParams.get('length') ?? 10;

        let duplicate = @json(request('duplicate', ''));

        product = $('select[name="product[]"]').val();
        users = $('select[name="users[]"]').val();
        follow_ups = $('input[name="follow_ups"]').val();
        is_paid = $('select[name="is_paid"]').val();
        mis_transaction_type = $('select[name="mis_transaction_type[]"]').val();
        company_id = $('select[name="company_id[]"]').val();
        renew_status_search = $('select[name="renew_status_search"]').val();
        start = expiry_from ?? $('#daterange-btn').data('daterangepicker').startDate.format('YYYY-MM-DD');
        end = expiry_to ?? $('#daterange-btn').data('daterangepicker').endDate.format('YYYY-MM-DD');
        $('select[name="company_id[]"], select[name="mis_transaction_type[]"], select[name="is_paid"], input[name="follow_ups"], select[name="users[]"], select[name="product[]"], select[name="renew_status_search"]')
            .on('change', function() {
                requestPage = 1;
                updateDataTableFilters();
            });


        var tableConfig = {
            processing: true,
            serverSide: true,

            ajax: {
                url: "{{ route('new-policy.index') }}",
                type: 'POST',
                data: function(d) {
                    d.duplicate = duplicate;
                    d.id = id;
                    d.product = product;
                    d.users = users;
                    d.follow_ups = follow_ups;
                    d.is_paid = is_paid;
                    d.mis_transaction_type = mis_transaction_type;
                    d.company_id = company_id;
                    d.renew_status_search = renew_status_search;
                    d.expiry_from = start;
                    d.expiry_to = end;
                    // d.length = tableLength ?? 10;   
                }
            },
            drawCallback: function(settings) {
                var api = this.api();
                var pageInfo = api.page.info();
                var recordsDisplayed = pageInfo.end - pageInfo.start;
                var totalPages = pageInfo.pages;
                var currentPage = pageInfo.page + 1; // Add 1 to make it 1-based index
                if (pageInfo.end - pageInfo.start < tableLength && (currentPage != totalPages && pageInfo.recordsDisplay == pageInfo.end)) {
                    requestPage = 0
                    updateDataTableFilters(false);
                }
            },
            pageLength: tableLength ?? 10,
            displayStart: typeof requestPage != 'undefined' && requestPage ? (requestPage * tableLength - tableLength) : 0,
            dom: 'Blfrtip',
            fixedColumns: {
                leftColumns: 2,
                rightColumns: 1
            },

            buttons: [{
                    extend: 'csv',
                    exportOptions: {
                        columns: ':not(.no-export)'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':not(.no-export)'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':not(.no-export)'
                    }
                }
            ],
            lengthMenu: [
                [10, 25, 50, 100, 200, -1],
                ['10 rows', '25 rows', '50 rows', '100 rows', '200 rows', 'Show all']
            ],
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false,
                    className: 'no-click'
                },
                @if(isset($_GET['id']) && $_GET['id'] == 1) {
                    data: 'created_at',
                    name: 'created_at',
                    className: 'truncate-text'

                },
                @endif {
                    data: 'users.name',
                    name: 'users.name',
                    defaultContent: '',
                    className: 'truncate-text'
                },
                {
                    data: 'holder_name',
                    name: 'holder_name',
                    defaultContent: '',
                    className: 'truncate-text'
                },
                {
                    data: 'company.name',
                    name: 'company.name',
                    defaultContent: '',
                    className: 'truncate-text'
                },
                {
                    data: 'mis_transaction_type',
                    name: 'mis_transaction_type',
                    defaultContent: '',
                    className: '-small truncate-text'
                },
                {
                    data: 'policy_no',
                    name: 'policy_no',
                    visible: false
                },
                {
                    data: 'sub_product.name',
                    name: 'sub_product.name',
                    defaultContent: '',
                    className: '-small truncate-text'
                },
                {
                    data: 'is_paid',
                    name: 'is_paid',
                    defaultContent: '',
                    className: '-small truncate-text'
                },
                {
                    data: 'reg_no',
                    name: 'reg_no',
                    defaultContent: '',
                    className: 'truncate-text'
                },
                @if(isset($_GET['id']) && $_GET['id'] == 2) {
                    data: 'expiry_date',
                    name: 'expiry_date',
                    defaultContent: '',
                    className: 'truncate-text'
                }, {
                    data: 'followDate',
                    name: 'followDate',
                    defaultContent: '',
                    className: ' no-click truncate-text'
                }, {
                    data: 'attachment',
                    name: 'attachment',
                    defaultContent: '',
                    className: '-small no-click truncate-text d-flex align-items-center gap-1'
                },
                @endif
                @if(isset($_GET['duplicate']) && $_GET['duplicate'] == true) {
                    data: 'policy_no',
                    name: 'policy_no',
                    defaultContent: '',
                    className: 'truncate-text'
                },
                @endif {
                    data: 'products.name',
                    name: 'products.name',
                    defaultContent: '',
                    visible: false
                }, {
                    data: 'bussiness_type',
                    name: 'bussiness_type',
                    visible: false
                }, {
                    data: 'channel_name',
                    name: 'channel_name',
                    visible: false
                }, {
                    data: 'start_date',
                    name: 'start_date',
                    visible: false
                }, {
                    data: 'expiry_date',
                    name: 'expiry_date',
                    visible: false
                }, {
                    data: 'makes.name',
                    name: 'makes.name',
                    defaultContent: '',
                    visible: false
                }, {
                    data: 'models.name',
                    name: 'models.name',
                    defaultContent: '',
                    visible: false
                }, {
                    data: 'varriants.name',
                    name: 'varriants.name',
                    defaultContent: '',
                    visible: false
                }, {
                    data: 'reg_no',
                    name: 'reg_no',
                    visible: false
                }, {
                    data: 'cc',
                    name: 'cc',
                    visible: false
                }, {
                    data: 'fuel',
                    name: 'fuel',
                    visible: false
                }, {
                    data: 'seating_capacity',
                    name: 'seating_capacity',
                    visible: false
                }, {
                    data: 'mfr_year',
                    name: 'mfr_year',
                    visible: false
                }, {
                    data: 'sum_insured',
                    name: 'sum_insured',
                    visible: false
                }, {
                    data: 'od_premium',
                    name: 'od_premium',
                    visible: false
                }, {
                    data: 'add_on_premium',
                    name: 'add_on_premium',
                    visible: false
                }, {
                    data: 'tp_premium',
                    name: 'tp_premium',
                    visible: false
                }, {
                    data: 'others',
                    name: 'others',
                    visible: false
                },
                {
                    data: 'net_premium',
                    name: 'net_premium',
                    visible: false
                },
                {
                    data: 'gst',
                    name: 'gst',
                    visible: false
                },
                {
                    data: 'gross_premium',
                    name: 'gross_premium',
                    visible: false
                },
                {
                    data: 'mis_amount_paid',
                    name: 'mis_amount_paid',
                    visible: false
                },
                {
                    data: 'mis_received_bank_detail',
                    name: 'mis_received_bank_detail',
                    visible: false
                },
                {
                    data: 'mis_payment_method',
                    name: 'mis_payment_method',
                    visible: false
                },
                {
                    data: 'mis_short_premium',
                    name: 'mis_short_premium',
                    visible: false
                },
                {
                    data: 'mis_premium_deposit',
                    name: 'mis_premium_deposit',
                    visible: false
                },
                {
                    data: 'mis_deposit_bank_detail',
                    name: 'mis_deposit_bank_detail',
                    visible: false
                },
                {
                    data: 'mis_deposit_payment_method',
                    name: 'mis_deposit_payment_method',
                    visible: false
                },
                {
                    data: 'premium_payment_source',
                    name: 'premium_payment_source',
                    visible: false
                },
                {
                    data: 'commission_base',
                    name: 'commission_base',
                    visible: false
                },
                {
                    data: 'mis_commissionable_amount',
                    name: 'mis_commissionable_amount',
                    visible: false
                },
                {
                    data: 'mis_percentage',
                    name: 'mis_percentage',
                    visible: false
                },
                {
                    data: 'mis_commission',
                    name: 'mis_commission',
                    visible: false
                },
                {
                    data: 'payout_settled',
                    name: 'payout_settled',
                    visible: false
                },
                {
                    data: 'mis_invoice',
                    name: 'mis_invoice',
                    visible: false
                },
                {
                    data: 'month_settled',
                    name: 'month_settled',
                    visible: false
                },
                {
                    data: 'payout_recovery',
                    name: 'payout_recovery',
                    visible: false
                },


                {
                    data: 'internal_percentage',
                    name: 'internal_percentage',
                    visible: false
                },
                {
                    data: 'internal_payout_expected',
                    name: 'internal_payout_expected',
                    visible: false
                },
                {
                    data: 'internal_payout_received',
                    name: 'internal_payout_received',
                    visible: false
                },
                {
                    data: 'internal_payout_percentage',
                    name: 'internal_payout_percentage',
                    visible: false
                }, {
                    data: 'internal_commission',
                    name: 'internal_commission',
                    visible: false
                }, {
                    data: 'internal_payout_saved',
                    name: 'internal_payout_saved',
                    visible: false
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'no-click no-export'

                }
            ],
            rowCallback: function(row, data) {
                $(row).find('td:not(.no-click)').each(function() {
                    var policyLink = "{{ route('policy.show', '') }}/" + data.id;
                    $(this).html('<a href="' + policyLink + '" target="_blank">' + $(this).html() + '</a>');
                });
            }
        };


        table = $('#datatable').DataTable(tableConfig);

        table.on('length.dt', function(e, settings, len) {
            tableLength = len
            requestPage = table.page.info().page;
            updateDataTableFilters(false);
        });

        function updateDataTableFilters(drawTable = true) {
            company_id = $('select[name="company_id[]"]').val();
            mis_transaction_type = $('select[name="mis_transaction_type[]"]').val();
            is_paid = $('select[name="is_paid"]').val();
            follow_ups = $('input[name="follow_ups"]').val();
            users = $('select[name="users[]"]').val();
            product = $('select[name="product[]"]').val();
            renew_status_search = $('select[name="renew_status_search"]').val();
            start = expiry_from ?? $('#daterange-btn').data('daterangepicker').startDate.format('YYYY-MM-DD');
            end = expiry_to ?? $('#daterange-btn').data('daterangepicker').endDate.format('YYYY-MM-DD');

            // Construct the query string with the parameters
            const queryParams = new URLSearchParams();
            if (company_id && company_id.length) {
                queryParams.set('company_id', company_id);
            }
            if (mis_transaction_type && mis_transaction_type.length) {
                queryParams.set('mis_transaction_type', mis_transaction_type);
            }

            if (is_paid) {
                queryParams.set('is_paid', is_paid);
            }

            if (follow_ups && follow_ups != 'undefined') {
                queryParams.set('follow_ups', follow_ups);
            }
            if (users && users.length) {
                queryParams.set('users', users);
            }
            if (product && product.length) {
                queryParams.set('product', product);
            }

            if (renew_status_search && renew_status_search != 'renew_status_search') {
                queryParams.set('renew_status_search', renew_status_search);
            }

            if (start != 'Invalid date' && end != 'Invalid date') {
                queryParams.set('expiry_from', start);
                queryParams.set('expiry_to', end);
            }

            // var currentPage = table.page();
            var searchValue = table.search();

            if (requestPage && requestPage != 'undefined') {
                queryParams.set("page", requestPage);
            }

            if (tableLength && tableLength != 'undefined') {
                queryParams.set("length", tableLength);
            }

            // Get the current URL and append the new query string
            const originalUrl = window.location.href;
            const originalParams = new URLSearchParams(originalUrl.split('?')[1]); // Extract original query parameters

            originalParams.forEach((value, key) => {
                queryParams.append(key, value); // Append original parameters to the new query parameters
            });

            // Construct the updated URL with combined parameters
            const updatedUrl = `${originalUrl.split('?')[0]}?${queryParams.toString()}`;

            // Update the browser's address bar
            window.history.pushState({
                path: updatedUrl
            }, '', updatedUrl);
            if (drawTable) {
                table.draw();
            }
        }

        $('#datatable').on('page.dt', function() {
            requestPage = table.page.info().page + 1
            updateDataTableFilters(false);
        });

        $(document).on('change', '#checkedAll', function() {
            if (this.checked) {
                $(".checkSingle").each(function() {
                    this.checked = true;
                });
            } else {
                $(".checkSingle").each(function() {
                    this.checked = false;
                });
            }
        });







        $('.filter-btn').click(function() {
            $('.filter-box').toggleClass("hidden");
        })
        $('.filter-box').toggleClass("hidden");
        $('.filter').click(function() {
            var url = "{{ url('admin/leads') }}";
            window.location.replace(url);

        })
        $('.export-record').click(function() {
            $.ajax({
                type: "Post",
                url: "{{ route('exportPolicies') }}",
                data: {
                    end: end,
                    start: start,
                    renew_status_search: renew_status_search,
                    product: product,
                    users: users,
                    follow_ups: follow_ups,
                    is_paid: is_paid,
                    mis_transaction_type: mis_transaction_type,
                    company_id: company_id

                },
                success: function(result) {
                    toastr.success('Data Exported Successfully', 'Success', {
                        closeButton: true,
                        progressBar: true,
                    });
                },
                error: function() {
                    $('#loader-wrapper').hide();
                    toastr.error('Something went wrong', 'Error', {
                        closeButton: true,
                        progressBar: true,
                    });
                }
            });
        })


        $('.renew-btn').click(function() {

            const ids = [];
            $(".checkLead:checked").each(function(i) {
                ids.push($(this).data('id'));
            });

            if (ids != '') {

                $('#renew-modal').modal('show');

                $('.bulkEmail').click(function() {
                    $('#loader-wrapper').show();
                    $('#renew-modal').modal('hide');

                    $.ajax({
                        type: "Post",
                        url: "{{ route('bulkEmail') }}",
                        data: {
                            id: ids
                        },
                        success: function(result) {
                            $('#loader-wrapper').hide();
                            toastr.success('Email Sent Successfully', 'Success', {
                                closeButton: true,
                                progressBar: true,
                            });
                        },
                        error: function() {
                            $('#loader-wrapper').hide();
                            toastr.error('Something went wrong', 'Error', {
                                closeButton: true,
                                progressBar: true,
                            });
                        }
                    });

                });
            } else {
                toastr.error(
                    'Please select policies to send email', '', {
                        closeButton: true,
                        progressBar: true,
                    });
            }
        });

        $('.bulk-delete').click(function() {

            const ids = [];
            $(".checkLead:checked").each(function(i) {
                ids.push($(this).data('id'));
            });

            if (ids != '') {
                $.ajax({
                    type: "Post",
                    url: "{{ route('bulkDelete') }}",
                    data: {
                        id: ids
                    },
                    success: function(result) {
                        toastr.success(result.message, 'Deleted Successfully', {
                            closeButton: true,
                            progressBar: true,
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    }
                });
            } else {
                toastr.error(
                    'Please select policies to send email', '', {
                        closeButton: true,
                        progressBar: true,
                    });
            }
        });


        $(document).on('click', '.folder-icon', function() {
            $(this).next('.renew-att').click();

        })

        $(document).on('change', '.renew_status', function() {
            var status = $(this).find(":selected").val();
            var policy_id = $(this).data('id');
            $.ajax({
                type: "Post",
                url: "{{ route('renew_status') }}",
                data: {
                    policy_id: policy_id,
                    status: status
                },
                success: function(result) {
                    toastr.success(result.message, 'Status Updated Successfully', {
                        closeButton: true,
                        progressBar: true,
                    });
                    table.draw();
                }
            });
        });



        $(document).on('change', '.follow_up', function() {
            var id = $(this).data('id');
            var date = $(this).val();
            $.ajax({
                type: "Post",
                url: "{{ route('renewFolloup') }}",
                data: {
                    id: id,
                    date: date
                },
                success: function(result) {
                    toastr.success(result.message, 'Followup Date Updated Successfully', {
                        closeButton: true,
                        progressBar: true,
                    });
                }
            });
        });

        $(document).on('change', '.sort-table', function() {
            $('.submit-sort').click()

            var form = new FormData();

            // Adding the image to the form
            form.append("image", file);
            form.append("policy_id", id);
            console.log(form, 'test', id);
            $.ajax({
                url: "{{ route('renewAttachment') }}",
                type: "POST",
                data: form,
                contentType: false,
                processData: false,
                success: function(result) {
                    toastr.success(result.message, 'Attachment Uploaded Successfully', {
                        closeButton: true,
                        progressBar: true,
                    });
                    var currentPage = table.page();

                    setTimeout(function() {
                        // table.ajax.reload();
                        console.log('currentPage', currentPage)
                        table.ajax.reload();

                    }, 500);

                }
            });
        });
        $(document).on('click', '.common-btn', function() {
            var policy_id = $(this).attr('data-id');
            var email = $(this).attr('data-email');
            var person_name = $(this).attr('data-name');
            var customer_name = $(this).attr('data-customer');
            var product_name = $(this).attr('data-product');
            var sub_product = $(this).attr('data-subproduct');
            var req_no = $(this).attr('data-policy');
            var expiry = $(this).attr('data-expiry');
            var meesage =
                `<h4>Dear Sir/Madam,</h4>
            <p>This is for your information following case is due Please find details below:</p>
            <ul>
                <li>Customer Name :${customer_name}</li> 
                <li>Product :${product_name}</li>
                <li>Sub Product:${sub_product}</li>
                <li>Registration No. : ${req_no}</li>
                <li>Expiry Date : ${expiry}</li>
                </ul>
            <p>This is an automated email. Please do not reply </p>
            <p>Regards </p>
            <h5>GCS Services</h5>`;
            $('#person_name').summernote({
                height: 400,
            });
            $('#policy_single_id').val(policy_id);
            $('#policy_single_email').val(email);
            $("#person_name").summernote('code', meesage);
            $('#common-btn').modal('show');
        })
        $(document).on('click', '.endrosment-btn', function() {
            var policy_id = $(this).attr('data-id');
            $('#policy_ticket_id').val(policy_id);
            $('#ticket-system-btn').modal('show');
        })
        $(document).ready(function() {
            $('.duplicate-record').click(function() {
                var currentUrl = window.location.href;
                var hasDuplicateParam = currentUrl.includes('duplicate=true');
                var newUrl = hasDuplicateParam ? removeURLParameter(currentUrl, 'duplicate') :
                    addURLParameter(currentUrl, 'duplicate', 'true');
                window.location.href = newUrl;
            });

            function addURLParameter(url, key, value) {
                var separator = url.includes('?') ? '&' : '?';
                return url + separator + key + '=' + value;
            }

            function removeURLParameter(url, key) {
                var urlParts = url.split('?');
                if (urlParts.length >= 2) {
                    var prefix = encodeURIComponent(key) + '=';
                    var queryParams = urlParts[1].split(/[&;]/g);

                    for (var i = queryParams.length; i-- > 0;) {
                        if (queryParams[i].lastIndexOf(prefix, 0) !== -1) {
                            queryParams.splice(i, 1);
                        }
                    }

                    url = urlParts[0] + (queryParams.length > 0 ? '?' + queryParams.join('&') : '');
                    return url;
                } else {
                    return url;
                }
            }

        });
        $(document).on('click', '.open-attachment', function(e) {
            $(this).siblings('.renew-att').trigger('click');
        });
        $('#endrosmentBtn').click(function() {
            $('#loader-wrapper').show();
            $.ajax({
                type: 'POST',
                url: "{{ route('endrosment') }}",
                data: $('#endorsementForm').serialize(), // Serialize form data
                success: function(result) {
                    $('#loader-wrapper').hide();
                    toastr.success('Email Sent Successfully', 'Success', {
                        closeButton: true,
                        progressBar: true,
                    });
                    $('#common-btn').modal('hide');
                },
                error: function() {
                    $('#loader-wrapper').hide();
                    toastr.error('Something went wrong', 'Error', {
                        closeButton: true,
                        progressBar: true,
                    });
                    $('#common-btn').modal('hide');
                }
            });
        });

        $(document).on('click', '.remove_us', function(e) {
            e.preventDefault();
            var userId = $(this).data('id');
            var currentPage = table.page();
            var searchValue = table.search();
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this user!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                $.ajax({
                    url: $(this).attr('href'),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success('Policy Deleted successfully', 'Success', {
                            closeButton: true,
                            progressBar: true,
                        });

                        table.ajax.reload(function() {
                            // Restore pagination and search
                            table.page(currentPage).search(searchValue)
                                .draw('page');
                        });
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Something went wrong', 'Error', {
                            closeButton: true,
                            progressBar: true,
                        });
                    }
                });
            });
        });
    });
    $(document).on('click', '.remove_attachment', function(e) {
        e.preventDefault();
        var attachmentId = $(this).data('attachment-id');
        var currentPage = table.page();
        var searchValue = table.search();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this user!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            $.ajax({
                url: $(this).attr('href'),
                type: "DELETE",
                success: function(response) {
                    toastr.success('Policy Deleted successfully', 'Success', {
                        closeButton: true,
                        progressBar: true,
                    });

                    table.ajax.reload(function() {
                        // Restore pagination and search
                        table.page(currentPage).search(searchValue).draw('page');
                    });
                    $(this).closest('.remove_attachment').remove();
                },
                error: function(xhr, status, error) {
                    toastr.error('Something went wrong', 'Error', {
                        closeButton: true,
                        progressBar: true,
                    });
                }
            });
        });
    });
    $(document).on('change', '.renew-att', function() {
        var id = $(this).data('id');
        var file = $(this).prop("files")[0];

        var form = new FormData();
        var currentPage = table.page();
        var searchValue = table.search();

        // Adding the image to the form
        form.append("image", file);
        form.append("policy_id", id);
        console.log(form, 'test', id);
        $.ajax({
            url: "{{ route('renewAttachment') }}",
            type: "POST",
            data: form,
            contentType: false,
            processData: false,
            success: function(result) {
                toastr.success(result.message, 'Attachment Uploaded Successfully', {
                    closeButton: true,
                    progressBar: true,
                });
                table.ajax.reload(function() {
                    // Restore pagination and search
                    table.page(currentPage).search(searchValue)
                        .draw('page');
                });
                // setTimeout(function() {
                // }, 500);

            }
        });
    });
</script>
<script>
    const changeTypeSelect = document.getElementById('changeType');
    const requiredDocumentsSelect = document.getElementById('requiredDocuments');

    // Define the options for the second select field based on the selection in the first field
    const optionsMap = {
        "NAME CORRECTION": ["RC/PYP and client request letter"],
        "ADDRESS CHANGE": ["ADDRESS PROOF AND REQUEST LETTER"],
        "NOMINEE": ["RELATION PROOF AND CLIENT REQUEST LETTER"],
        "EMAIL/PHONE": ["REQUEST LETTER"],
        "VEHICLE REG NO": ["RC AND REQUEST LETTER"],
        "ENGINE/CHASSIS": ["RC AND REQUEST LETTER"],
        "HYPOTHECATION CHANGE/ REMOVAL": ["RC/ Financier letter and CLIENT REQUEST LETTER"],
        "MAKE/MODEL/CC/MFR YEAR": ["RC AND REQUEST LETTER"],
        "RISK PERIOD": ["PYP AND REQUEST LETTER"],
        "GST addition/correction": ["GST CERTIFICATE. REQUEST Letter"],
        "IDV/electric/non electric accessories": ["PYP and valuation certificate and Insection report"],
        "NCB CORRECTION": ["Previous year policy/ncb certificate from previous insurer"],
        "NCB RESERVING": ["Sale Deed or transferred RC or Form 29/30 And Client Request letter"],
        "OWNERSHIP TRANSFER": ["transferred RC or Form 29/30, proposal form, buyer seller request letter, inspection report"],
        "OTHERS": ["PLS SHARE RELEVANT DOCUMENTS ALONG WITH REQUEST LETTER"],
    };

    // Function to update the options in the second select field based on the selection in the first field
    function updateRequiredDocuments() {
        const selectedChangeType = changeTypeSelect.value;
        requiredDocumentsSelect.innerHTML = "";
        optionsMap[selectedChangeType].forEach(option => {
            const optionElement = document.createElement('option');
            optionElement.value = option;
            optionElement.textContent = option;
            requiredDocumentsSelect.appendChild(optionElement);
        });
    }

    // Event listener to update the options when the first select field changes
    changeTypeSelect.addEventListener('change', updateRequiredDocuments);

    // Initialize options for the second select field
    updateRequiredDocuments();
</script>

@endsection