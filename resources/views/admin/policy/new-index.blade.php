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

    a.remove_us svg {
        width: 12px;
        height: 12px;
        fill: #dd0909;
        transform: translateY(-4px) translateX(-3px);
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
        max-width: 100px;
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
        min-width: 100px
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


    @media (max-width: 1650px) {
        td {
            font-size: 12px !important;
            padding: 0 9px !important;
        }

        .userlist-table .table th {
            padding: 0 9px !important;
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
</style>
<div id="loader-wrapper" style="display: none;">
    <div id="loader"></div>
</div>
<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="  content-title mb-0 my-auto pe-4">Policy </h4>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a href="{{ route('new-policy.index', ['id' => 1]) }}" class=" @if (isset($_GET['id']) && $_GET['id'] == 1) btn btn-warning @else btn btn-info @endif ml_auto">MIS
                            (<?php echo new_policy(); ?>)</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a href="{{ route('new-policy.index', ['id' => 2]) }}" class=" @if (isset($_GET['id']) && $_GET['id'] == 2) btn btn-warning @else btn btn-info @endif  ml_auto">Renewals
                            (<?php echo renew_policy(); ?>)</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pe-1 mb-xl-0 card">

                <div id="reportrange"><span></span></div>
                <button type="button" style="display: flex; gap: 8px;" class="btn btn-default float-right" id="daterange-btn">
                    <i class="far fa-calendar-alt"></i>
                    <div class="staticDays">This Month</div>
                    <div id="dynamicDate"></div>
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>

            <div class="pe-1 mb-xl-0">
                <button type="button" class="btn btn-danger duplicate-record">Duplicate</button>
            </div>
            @if (isset($_GET['id']) && $_GET['id'] == 2)
            <div class="pe-1 mb-xl-0">

                <a class="btn btn-main-primary renew-btn " style="color:#fff">Bulk email</a>

            </div>
            @else
            <div class="pe-1 mb-xl-0">

                <a class="btn btn-main-primary bulk-delete " style="color:#fff">Delete</a>

            </div>
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
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">



            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label mg-b-5">
                            Listing of All Policy...
                        </div>
                        <!-- filter start  -->
                        <div class="row row-sm">
                            <div class="col-lg">
                                <p class="mg-b-10">Product</p>

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
                            <div class="col-lg">
                                <p class="mg-b-10">User</p>

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
                            <div class="col-lg">
                                @if (isset($_GET['id']) && $_GET['id'] == 2)
                                <p class="mg-b-10">Followup</p>

                                <input type="date" name="follow_ups" id="" class="form-control" value="{{ isset($_GET['follow_ups']) ? $_GET['follow_ups'] : '' }}">
                                @else
                                <p class="mg-b-10">Payment Status</p>

                                <select name="is_paid" class="form-control select-2">
                                    <option value="">Select</option>
                                    <option value="1" {{ isset($_GET['is_paid']) && 1 == $_GET['is_paid'] ? 'selected' : '' }}>
                                        Paid</option>
                                    <option value="2" {{ isset($_GET['is_paid']) && 2 == $_GET['is_paid'] ? 'selected' : '' }}>
                                        Pending</option>

                                </select>
                                @endif
                            </div>
                            <div class="col-lg">
                                <p class="mg-b-10"> Transaction Type</p>
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
                            <div class="col-lg">
                                <p class="mg-b-10">Renew Status</p>
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

                            <div class="col-lg">
                                <p class="mg-b-10">Company</p>
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

                        <div class="table-responsive border-top userlist-table">
                            <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" name="all_checked" id="checkedAll" value="0"></th>
                                        @if (isset($_GET['id']) && $_GET['id'] == 1)
                                        <th><span>Created On</span></th>
                                        @endif
                                        <th><span>Reference Name</span></th>
                                        <th><span>Holder Name</span></th>
                                        <th><span>Company Name</span></th>
                                        <th><span>Trasaction Type</span></th>
                                        <th><span>Sub Product</span></th>
                                        <th><span>Payment Status</span></th>
                                        <th><span>Reg No.</span></th>
                                        @if (isset($_GET['id']) && $_GET['id'] == 2)
                                        <th><span>Expiry Date</span></th>
                                        <th><span>Followup Date</span></th>
                                        <th><span>Attachment</span></th>
                                        @endif
                                        @if (isset($_GET['duplicate']) && $_GET['duplicate'] == true)
                                        <th>Policy No</th>
                                        @endif
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
                            <textarea name="remark" class="form-control" id="remark" ></textarea>
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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
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
                    'Financial Year': [moment().subtract(1, 'years').startOf('year').add(3, 'months'),
                        moment().subtract(1, 'years').endOf('year').add(3, 'months').endOf('month')
                    ],
                    'Last Financial Year': [moment().subtract(2, 'years').startOf('year').add(3, 'months'),
                        moment().subtract(2, 'years').endOf('year').add(3, 'months').endOf('month')
                    ]

                },
                startDate: moment().startOf('month'),
                endDate: moment().endOf('month')
            },
            function(start, end, range) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'))
                $('#dynamicDate').html(range)
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



        let duplicate = @json(request('duplicate', ''));
        let id = @json(request('id', ''));
        let product = $('select[name="product[]"]').val();
        let users = $('select[name="users[]"]').val();
        let follow_ups = $('input[name="follow_ups"]').val();
        let is_paid = $('select[name="is_paid"]').val();
        let mis_transaction_type = $('select[name="mis_transaction_type[]"]').val();
        let company_id = $('select[name="company_id[]"]').val();
        let renew_status_search = $('select[name="renew_status_search"]').val();
        var start = $('#daterange-btn').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var end = $('#daterange-btn').data('daterangepicker').endDate.format('YYYY-MM-DD');
        $('select[name="company_id[]"], select[name="mis_transaction_type[]"], select[name="is_paid"], input[name="follow_ups"], select[name="users[]"], select[name="product[]"], select[name="renew_status_search"]')
            .on('change', function() {
                updateDataTableFilters();
            });

        function updateDataTableFilters() {
            company_id = $('select[name="company_id[]"]').val();
            mis_transaction_type = $('select[name="mis_transaction_type[]"]').val();
            is_paid = $('select[name="is_paid"]').val();
            follow_ups = $('input[name="follow_ups"]').val();
            users = $('select[name="users[]"]').val();
            product = $('select[name="product[]"]').val();
            renew_status_search = $('select[name="renew_status_search"]').val();
            start = $('#daterange-btn').data('daterangepicker').startDate.format('YYYY-MM-DD');
            end = $('#daterange-btn').data('daterangepicker').endDate.format('YYYY-MM-DD');
            table.draw();
        }
        var tableConfig = {
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('new-policy.index') }}",
                cache: false,
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
                }
            },
            dom: 'Blfrtip',
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
                    className: 'truncate-text-small'
                },
                {
                    data: 'sub_product.name',
                    name: 'sub_product.name',
                    defaultContent: '',
                    className: 'truncate-text-small'
                },
                {
                    data: 'is_paid',
                    name: 'is_paid',
                    defaultContent: '',
                    className: 'truncate-text-small'
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
                    className: 'truncate-text no-click'
                }, {
                    data: 'attachment',
                    name: 'attachment',
                    defaultContent: '',
                    className: 'truncate-text-small no-click'
                },
                @endif
                @if(isset($_GET['duplicate']) && $_GET['duplicate'] == true) {
                    data: 'policy_no',
                    name: 'policy_no',
                    defaultContent: '',
                    className: 'truncate-text'
                },
                @endif {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'no-click'
                }
            ],
            rowCallback: function(row, data) {
                $(row).find('td:not(.no-click)').on('click', function() {
                    window.location.href = "{{ route('policy.show', '') }}" + '/' + data.id;
                });

            }
        };


        table = $('#datatable').DataTable(tableConfig);

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