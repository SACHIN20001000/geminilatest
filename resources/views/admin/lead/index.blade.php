@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="  content-title mb-0 my-auto pe-4">Leads</h4>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a href="{{ route('leads.index',['id'=> 1]) }}" class="@if(isset($_GET['id']) && $_GET['id'] == 1) btn btn-warning @else btn btn-info @endif ml_auto">Leads (<?php echo new_lead() ?>)</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a href="{{ route('leads.index',['id'=> 2]) }}" class="@if(isset($_GET['id']) && $_GET['id'] == 2) btn btn-warning @else btn btn-info @endif ml_auto">Quote Generated (<?php echo quote_lead() ?>)</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a href="{{ route('leads.index',['id'=> 3]) }}" class="@if(isset($_GET['id']) && $_GET['id'] == 3) btn btn-warning @else btn btn-info @endif ml_auto">Policy to be issued (<?php echo issue_lead() ?>)</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown ">
                        <a href="{{ route('leads.index',['id'=> 4]) }}" class="@if(isset($_GET['id']) && $_GET['id'] == 4) btn btn-warning @else btn btn-info @endif ml_auto">Opportunities (<?php echo reject_lead() ?>)</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex my-xl-auto right-content">
            <div class="pe-1 mb-xl-0 filter-btn">

                <button type="button" class="btn btn-info btn-icon me-2 btn-b"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pe-1 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon me-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pe-1 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon me-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="pe-1 mb-xl-0">
                <div class="btn-group dropdown assigned-btn">
                    <a class="modal-effect btn btn-main-primary ml_auto " data-bs-effect="effect-super-scaled" style="color:#fff">Assign</a>
                </div>
            </div>
            <div class="mb-xl-0">
                <div class="btn-group dropdown">
                    <a class="btn btn-main-primary ml_auto" href="{{ route('leads.create') }}">Create Lead</a>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    <div class="card-body tableBody">
        <div class="orderSearchHistory">
            @include('admin.lead.search')
        </div>

    </div>

    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <form action="" method="get">
                <div class="row row-sm filter-box hidden">

                    <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                        <div class="card ">
                            <div class="card-body">

                                <p class="mg-b-10">Expiry date from</p>
                                <input type="date" name="expiry_from" value="{{isset($_GET['expiry_from']) ? $_GET['expiry_from'] : ''}}" class="form-control">
                                <input type="hidden" name="id" value="{{isset($_GET['id']) ? $_GET['id'] : ''}}">
                                <p class="mg-b-10">Expiry date to</p>
                                <input type="date" name="expiry_to" value="{{isset($_GET['expiry_to']) ? $_GET['expiry_to'] : ''}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                        <div class="card ">
                            <div class="card-body">

                                <p class="mg-b-10">Product</p>
                                <select name="product" class="form-control">
                                    <option value="">Select</option>
                                    @if(isset($products) && $products->count())
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}" {{ (isset($_GET['product']) && $product->id == $_GET['product']) ? 'selected' : '' }}>{{$product->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <p class="mg-b-10">Broker/Staff</p>
                                <select name="users" class="form-control">
                                    <option value="">Select</option>
                                    @if(isset($users) && $users->count())
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}" {{ (isset($_GET['users']) && $user->id == $_GET['users']) ? 'selected' : '' }}>{{$user->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
                        <div class="card ">
                            <div class="card-body">

                                <p class="mg-b-10">Search Anything</p>
                                <input type="text" name="search_anything" value="{{isset($_GET['search_anything']) ? $_GET['search_anything'] : ''}}" class="form-control">
                                <p class="mg-b-10">Status</p>
                                <select name="status" class="form-control">
                                    <option value="">Select</option>
                                    @if(isset($_GET['id']) && $_GET['id'] == 1)
                                    <option value="PENDING/FRESH" {{ (isset($_GET['status']) && "PENDING/FRESH" == $_GET['status']) ? 'selected' : '' }}>PENDING/FRESH</option>
                                    <option value="IN PROCESS" {{ (isset($_GET['status']) && "IN PROCESS" == $_GET['status']) ? 'selected' : '' }}>IN PROCESS</option>
                                    <option value="MORE INFO REQUIRED" {{ (isset($_GET['status']) && "MORE INFO REQUIRED" == $_GET['status']) ? 'selected' : '' }}>MORE INFO REQUIRED</option>
                                    @endif
                                    @if(isset($_GET['id']) && $_GET['id'] == 2)
                                    <option value="QUOTE GENERATED" {{ (isset($_GET['status']) && "QUOTE GENERATED" == $_GET['status']) ? 'selected' : '' }}>QUOTE GENERATED</option>
                                    <option value="RE-QUOTE" {{ (isset($_GET['status']) && "RE-QUOTE" == $_GET['status']) ? 'selected' : '' }}>RE-QUOTE</option>
                                    @endif
                                    @if(isset($_GET['id']) && $_GET['id'] == 4)
                                    <option value="REJECTED" {{ (isset($_GET['status']) && "REJECTED" == $_GET['status']) ? 'selected' : '' }}>REJECTED</option>
                                    @endif
                                    @if(isset($_GET['id']) && $_GET['id'] == 3)
                                    <option value="POLICY TO BE ISSUED" {{ (isset($_GET['status']) && "POLICY TO BE ISSUED" == $_GET['status']) ? 'selected' : '' }}>POLICY TO BE ISSUED</option>
                                    <option value="LINK GENERATED" {{ (isset($_GET['status']) && "LINK GENERATED" == $_GET['status']) ? 'selected' : '' }}>LINK GENERATED</option>
                                    <option value="LINK GENERATED BUT NOT PAID" {{ (isset($_GET['status']) && "LINK GENERATED BUT NOT PAID" == $_GET['status']) ? 'selected' : '' }}>LINK GENERATED BUT NOT PAID</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Search</button>
                        <button class="btn btn-info filter">Filter</button>

                    </div>

                </div>

                <div class="card">
                    <div class="card-header pb-0">
                        <p class="tx-12 tx-gray-500 mb-2">Listing of All Leads...</p>

                        <select name="sort" class="sort-table">
                            <option value="10" {{ (isset($_GET['sort']) && (10 == $_GET['sort'])) ? 'selected' : '' }}>10</option>
                            <option value="50" {{ (isset($_GET['sort']) && (50 == $_GET['sort'])) ? 'selected' : '' }}>50</option>
                            <option value="100" {{ (isset($_GET['sort']) && (100 == $_GET['sort'])) ? 'selected' : '' }}>100</option>
                            <option value="200" {{ (isset($_GET['sort']) && (200 == $_GET['sort'])) ? 'selected' : '' }}>200</option>
                            <option value="all" {{ (isset($_GET['sort']) && ('all' == $_GET['sort'])) ? 'selected' : '' }}>All</option>
                        </select>
                        <input type="hidden" name="id" value="{{isset($_GET['id']) ? $_GET['id'] : ''}}">
                        <button type="submit" class="submit-sort" style="display:none;"></button>
            </form>
        </div>
        <div class="card-body">
            <style>
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
            <!-- Listing all data in user tables -->
            <div class="table-responsive border-top userlist-table">
                <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                    <thead>
                        <tr>

                            <th><input type="checkbox" name="all_checked" id="checkedAll" value="0"></th>
                            <th class="wd-lg-20p"><span>Reference Name</span></th>
                            <th class="wd-lg-20p"><span>Holder Name</span></th>
                            <th class="wd-lg-20p"><span>Transaction type</span></th>
                            <th class="wd-lg-20p"><span>Sub Product</span></th>
                            <th class="wd-lg-20p"><span>Created</span></th>
                            <th class="wd-lg-20p"><span>Status</span></th>
                            <th class="wd-lg-20p"><span>Assigned To</span></th>
                            <th class="wd-lg-20p">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($leads->count())
                        @foreach($leads as $lead)
                        <tr style="@if($lead->mark_read == 0)  font-weight: bold; @endif">
                            <td><input type="checkbox" name="checked" class="checkSingle" value="{{$lead->id}}"> </td>
                            <td>{{$lead->users->name??''}}</td>
                            <td>{{$lead->holder_name??''}}</td>
                            <td>{{$lead->policy->mis_transaction_type ??''}}</td>
                            <td>{{$lead->subProduct->name ?? ''}}</td>
                            <td>{{$lead->created_at}}</td>
                            <td>{{$lead->status}}</td>

                            <td>{{$lead->assigns->name ?? ''}}</td>
                            <td class="btn-group">
                                <!-- <a class="btn btn-sm btn-info btn-b endrosment-btn" data-id="{{$lead->id ?? ''}}" data-toggle="tooltip" title="Endrosment Sent">📜</a> -->
                                <a href="{{route('leads.show',$lead->id)}}" class="btn btn-sm btn-info btn-b"><i class="fa fa-eye" data-toggle="tooltip" title="View Lead"></i>
                                </a> <a href="{{route('leads.edit',$lead->id)}}" class="btn btn-sm btn-info btn-b" data-toggle="tooltip" title="Edit Lead"><i class="las la-pen"></i>
                                </a>
                                <a href="{{route('leads.destroy',$lead->id)}}" class="btn btn-sm btn-danger remove_us" title="Delete Lead" data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="Please Confirm" data-confirm-text="Are you sure that you want to delete this Lead?" data-confirm-delete="Yes, delete it!">
                                    <i class="las la-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                    </tbody>

                </table>
                {{$leads->appends(['expiry_from' => $_GET['expiry_from']??'','expiry_to' => $_GET['expiry_to']??'','product' => $_GET['product']??'','users' => $_GET['users']??'','search_anything' => $_GET['search_anything']??'','status' => $_GET['status']??'','id'=>$_GET['id']?? '','lead_id'=>$_GET['lead_id']?? '','sort' => $_GET['sort'] ??'10'])->links("vendor.pagination.bootstrap-4")}}



            </div>

        </div>
    </div>
</div>
<!-- COL END -->
</div>

</div>

<!-- Modal effects -->
<div class="modal fade" id="assign-model">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Assigned To Staff</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <h6>Staff</h6>
                <select name="staff_id" id="staff_id" class="form-control staff_id">
                    <option value="">Select</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary save-assign" type="button">Save changes</button>
                <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal effects-->


<div class="modal fade show" id="endrosment-btn" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Endrosment</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
            </div>
            <form method="POST" action="{{route('commonEndrosment')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Type </label>
                            <select name="type" id="change_type" class="form-control">
                                <option value="">Select</option>
                                <option data-id='1' value="NAME CORRECTION">NAME CORRECTION</option>
                                <option data-id='2' value="ADDRESS CHANGE">ADDRESS CHANGE</option>
                                <option data-id='3' value="NOMINEE">NOMINEE</option>
                                <option data-id='4' value="EMAIL/PHONE">EMAIL/PHONE</option>
                                <option data-id='5' value="VEHICLE REG NO">VEHICLE REG NO</option>
                                <option data-id='6' value="ENGINE/CHASSIS">ENGINE/CHASSIS</option>
                                <option data-id='7' value="HYPOTHECATION CHANGE/ REMOVAL">HYPOTHECATION CHANGE/ REMOVAL</option>
                                <option data-id='8' value="MAKE/MODEL/CC/MFR YEAR">MAKE/MODEL/CC/MFR YEAR</option>
                                <option data-id='9' value="RISK PERIOD">RISK PERIOD</option>
                                <option data-id='10' value="GST addition/correction">GST addition/correction</option>
                                <option data-id='11' value="IDV/electric/non electric accessories">IDV/electric/non electric accessories</option>
                                <option data-id='12' value="NCB CORRECTION">NCB CORRECTION</option>
                                <option data-id='13' value="NCB RESERVING">NCB RESERVING</option>
                                <option data-id='14' value="OWNERSHIP TRANSFER">OWNERSHIP TRANSFER</option>
                                <option data-id='15' value="OTHERS">OTHERS</option>
                            </select>
                            <label>File </label>
                            <span class="error-message" style="color:red;"></span>
                            <input type="file" name="image[]" multiple id="image" class="form-control">
                            <input type="hidden" name="lead_id" id="lead_id">

                            <label>Previous Changes </label>
                            <textarea name="previous_message" class="form-control" id="message" cols="30" rows="10">
                                 </textarea>

                            <label>New Changes </label>
                            <textarea name="new_message" class="form-control" id="message" cols="30" rows="10">

                                 </textarea>

                        </div>

                    </div>


                    <div class="modal-footer">
                        <button class="btn ripple btn-primary save-status" type="submit">Save</button>
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.filter-btn').click(function() {
            $('.filter-box').toggleClass("hidden");
        })
        $('.filter-box').toggleClass("hidden");

        $('.filter').click(function() {
            var url = "{{url('admin/leads')}}";
            window.location.replace(url);

        })

        $("#checkedAll").change(function() {
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
        $('.endrosment-btn').click(function() {

            $('#lead_id').val($(this).attr('data-id'))
            $('#endrosment-btn').modal('show');
        })
        // for ajax lead data closed
        $('.assigned-btn').click(function() {

            const ids = [];
            $("input:checkbox:checked").each(function(i) {
                ids.push($(this).val());

            });
            if (ids != '') {

                $.ajax({
                    url: "{{ route('getStaff')}}",
                    type: 'GET',
                    success: function(result) {
                        console.log(result);
                        $('.staff_id').html(result);


                    }
                });
                $('#assign-model').modal('show');
                $('.save-assign').click(function() {
                    var staffId = $("#staff_id option:selected").val();
                    if (staffId != '') {
                        $.ajax({
                            url: "{{ route('saveAssign') }}",
                            method: "post",
                            data: {
                                staffId: staffId,
                                ids: ids
                            },
                            success: function(result) {
                                window.location.href = window.location.href;
                            }

                        });
                    }

                })
            } else {
                alert('CheckBox and Lead Owner must not be empty');
            }
        });
    });
    $('#change_type').on('change', function() {
        var selected_option_value = $(this).find(":selected").data('id');
        if (selected_option_value == 1) {
            $('.error-message').text('RC/PYP and client request letter')
        }
        if (selected_option_value == 2) {
            $('.error-message').text('ADDRESS PROOF AND REQUEST LETTER')
        }
        if (selected_option_value == 3) {
            $('.error-message').text('RELATION PROOF AND CLIENT REQUEST LETTER')
        }
        if (selected_option_value == 4) {
            $('.error-message').text('REQUEST LETTER')
        }
        if (selected_option_value == 5 || selected_option_value == 6 || selected_option_value == 8) {
            $('.error-message').text('RC AND REQUEST LETTER')
        }
        if (selected_option_value == 7) {
            $('.error-message').text('RC/ Financier letter and CLIENT REQUEST LETTER')
        }
        if (selected_option_value == 9) {
            $('.error-message').text('GST CERTIFICATE. REQUEST Letter')
        }
        if (selected_option_value == 10) {
            $('.error-message').text('PYP and valuation certificate and Insection report')
        }
        if (selected_option_value == 11) {
            $('.error-message').text('Previous year policy/ncb certificate from previous insurer')
        }
        if (selected_option_value == 12) {
            $('.error-message').text('Sale Deed  or transferred RC or Form 29/30 And Client Request letter')
        }
        if (selected_option_value == 13) {
            $('.error-message').text('transferred RC or Form 29/30, proposal form,  buyer seller request letter, inspection report')
        }
        if (selected_option_value == 14) {
            $('.error-message').text('PLS SHARE RELEVANT DOCUMENTS ALONG WITH REQUEST LETTER')
        }

    });
    $(document).on('change', '.sort-table', function() {
        $('.submit-sort').click()

    });
</script>
@endsection