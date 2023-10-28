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

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="  content-title mb-0 my-auto pe-4">Policy </h4>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a href="{{ route('policy.index',['id'=> 1]) }}" class=" @if(isset($_GET['id']) && $_GET['id'] == 1) btn btn-warning @else btn btn-info @endif ml_auto">MIS (<?php echo   new_policy() ?>)</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a href="{{ route('policy.index',['id'=> 2]) }}" class=" @if(isset($_GET['id']) && $_GET['id'] == 2) btn btn-warning @else btn btn-info @endif  ml_auto">Renewals (<?php echo   renew_policy() ?>)</a>
                    </div>
                </div>

            </div>
        </div>
        <form action="" method="get">
            <div class="d-flex my-xl-auto right-content">
                <div class="pe-1 mb-xl-0">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
                <div class="pe-1 mb-xl-0 filter-btn">

                    <button type="button" class="btn btn-info btn-icon me-2 btn-b"><i class="mdi mdi-filter-variant"></i></button>
                </div>
                <div class="pe-1 mb-xl-0">
                    <button type="button" class="btn btn-danger btn-icon me-2"><i class="mdi mdi-star"></i></button>
                </div>
                @if(isset($_GET['id']) && $_GET['id'] == 2)
                <div class="pe-1 mb-xl-0">

                    <a class="btn btn-main-primary renew-btn " style="color:#fff">Bulk email</a>

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

            <div class="row row-sm filter-box hidden">

                <div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">

                            <p class="mg-b-10">Policy Start date </p>
                            <input type="date" name="expiry_from" value="{{isset($_GET['expiry_from']) ? $_GET['expiry_from'] : ''}}" class="form-control">
                            <input type="hidden" name="id" value="{{isset($_GET['id']) ? $_GET['id'] : ''}}">
                            <p class="mg-b-10">Policy end date </p>
                            <input type="date" name="expiry_to" value="{{isset($_GET['expiry_to']) ? $_GET['expiry_to'] : ''}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">

                            <p class="mg-b-10">Product</p>
                            <select name="product[]" multiple="multiple" class="form-control">
                                <option value="">Select</option>
                                @if(isset($products) && $products->count())
                                @foreach($products as $product)
                                <option value="{{$product->id}}" {{ (isset($_GET['product']) && is_array($_GET['product']) && in_array($product->id, $_GET['product'])) ? 'selected' : '' }}>{{$product->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            <p class="mg-b-10">Reference</p>
                            <select name="users[]" multiple="multiple" class="form-control">
                                <option value="">Select</option>
                                @if(isset($users) && $users->count())
                                @foreach($users as $user)
                                <option value="{{$user->id}}" {{ (isset($_GET['users']) && (is_array($_GET['users']) ? in_array($user->id, $_GET['users']) : $_GET['users'] == $user->id)) ? 'selected' : '' }}>{{$user->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">

                            <p class="mg-b-10">Search Anything</p>
                            <input type="text" name="search_anything" value="{{isset($_GET['search_anything']) ? $_GET['search_anything'] : ''}}" class="form-control">
                            @if(isset($_GET['id']) && $_GET['id'] == 2)
                            <p class="mg-b-10">Follow Up Date</p>
                            <input type="date" name="follow_ups" id="" class="form-control" value="{{isset($_GET['follow_ups']) ? $_GET['follow_ups'] : ''}}">
                            @else
                            <p class="mg-b-10">Payment Status</p>
                            <select name="is_paid" class="form-control">
                                <option value="">Select</option>
                                <option value="1" {{ (isset($_GET['is_paid']) && (1 == $_GET['is_paid'])) ? 'selected' : '' }}>Paid</option>
                                <option value="2" {{ (isset($_GET['is_paid']) && (2 == $_GET['is_paid'])) ? 'selected' : '' }}>Pending</option>

                            </select>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
                    <div class="card ">
                        <div class="card-body">
                            @if(isset($_GET['id']) && $_GET['id'] == 2)
                            <p class="mg-b-10">Status</p>
                            <select name="renew_status_search" class="form-control ">
                                <option value="">Select</option>
                                <option value="FOLLOW UP" {{ (isset($_GET['renew_status_search']) && ("FOLLOW UP" == $_GET['renew_status_search'])) ? 'selected' : '' }}>FOLLOW UP</option>
                                <option value="VEHICLE SOLD" {{ (isset($_GET['renew_status_search']) && ("VEHICLE SOLD" == $_GET['renew_status_search'])) ? 'selected' : '' }}>VEHICLE SOLD</option>
                                <option value="NOT INTERESTED" {{ (isset($_GET['renew_status_search']) && ("NOT INTERESTED" == $_GET['renew_status_search'])) ? 'selected' : '' }}>NOT INTERESTED</option>
                                <option value="CLOSED" {{ (isset($_GET['renew_status_search']) && ("CLOSED" == $_GET['renew_status_search'])) ? 'selected' : '' }}>CLOSED</option>
                            </select>
                            @endif

                            <p class="mg-b-10">Transaction</p>
                            <select name="mis_transaction_type" class="form-control">
                                <option value="">Select</option>
                                <option value="Package" {{ (isset($_GET['mis_transaction_type']) && ("Package" == $_GET['mis_transaction_type'])) ? 'selected' : '' }}>Package</option>
                                <option value="SOAD" {{ (isset($_GET['mis_transaction_type']) && ("SOAD" == $_GET['mis_transaction_type'])) ? 'selected' : '' }}>SOAD</option>
                                <option value="TP" {{ (isset($_GET['mis_transaction_type']) && ("TP" == $_GET['mis_transaction_type'])) ? 'selected' : '' }}>TP</option>
                                <option value="Endorsement" {{ (isset($_GET['mis_transaction_type']) && ("Endorsement" == $_GET['mis_transaction_type'])) ? 'selected' : '' }}>Endorsement</option>
                            </select>

                            @if(isset($_GET['id']) && $_GET['id'] == 1)
                            <p class="mg-b-10">Insurance Company</p>
                            <select " multiple=" multiple" name="company_id[]" class="form-control ">
                                <option value="">Select Below</option>
                                @if($companies->count())
                                @foreach($companies as $company)
                                <option value="{{$company->id}}" {{ (isset($_GET['company_id']) && (is_array($_GET['company_id']) ? in_array($company->id, $_GET['company_id']) : $_GET['company_id'] == $company->id)) ? 'selected' : '' }}>{{$company->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            @endif
                        </div>
                    </div>
                </div>
                <div>

                    <!-- <button class="btn btn-info filter">Filter</button> -->

                </div>

            </div>

            <div class="card">
                <div class="card-header pb-0 " style="width: 20%;">
                    <p class="tx-12 tx-gray-500 mb-2">Listing of All Policy...</p>
                    <h6>Total records {{$count }}</h6>

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

                    <!-- Listing all data in user tables -->
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                            <thead>
                                <tr>
                                    @if(isset($_GET['id']) && $_GET['id'] == 2)
                                    <th><input type="checkbox" name="all_checked" id="checkedAll" value="0"></th>
                                    @endif
                                    @if(isset($_GET['id']) && $_GET['id'] == 1)
                                    <th><span>Created On</span></th>

                                    @endif
                                    <th><span>Reference Name</span></th>
                                    <th><span>Policy Holder Name</span></th>
                                    <th><span>Company Name</span></th>
                                    <th><span>Trasaction Type</span></th>
                                    <th><span>Sub Product</span></th>
                                    <th><span>Payment Status</span></th>
                                    @if(isset($_GET['id']) && $_GET['id'] == 2)

                                    <th><span>Expiry Date</span></th>
                                    <th><span>Followup Date</span></th>
                                    <th><span>Attachment</span></th>
                                    @endif
                                    <!-- <th><span>Premium Status</span></th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($leads->count())
                                @foreach($leads as $lead)
                                <tr style="@if($lead->mark_read == 0)  font-weight: bold; @endif">
                                    @if(isset($_GET['id']) && $_GET['id'] == 2)
                                    <td><input type="checkbox" name="checked" class="checkSingle checkLead" data-id="{{$lead->id}}"></td>
                                    @endif
                                    @if(isset($_GET['id']) && $_GET['id'] == 1)

                                    <td> <a href="{{route('policy.show',$lead->id)}}">{{!empty($lead->start_date) ? date('d-m-Y',strtotime($lead->start_date))  : ''}}</a></td>

                                    @endif

                                    <td>{{$lead->users->name ?? ''}}</td>

                                    <td> <a href="{{route('policy.show',$lead->id)}}">
                                            {{$lead->lead->holder_name ?? $lead->holder_name}} </a></td>
                                    <td> <a href="{{route('policy.show',$lead->id)}}">
                                            {{$lead->company->name ?? ''}} </a></td>
                                    <td> <a href="{{route('policy.show',$lead->id)}}">{{$lead->mis_transaction_type ?? ''}}</a></td>
                                    <td> <a href="{{route('policy.show',$lead->id)}}">{{$lead->subProduct->name ?? ''}}</a></td>
                                    <td> <a href="{{route('policy.show',$lead->id)}}">{{$lead->mis_amount_paid !== $lead->gross_premium ?'Short' : 'Paid'}}</a></td>

                                    @if(isset($_GET['id']) && $_GET['id'] == 2)

                                    <td> <a href="{{route('policy.show',$lead->id)}}">{{!empty($lead->expiry_date) ? date('d-m-Y',strtotime($lead->expiry_date))  : ''}}</a></td>
                                    <td><input type="date" name="follow_up" value="{{$lead->follow_up ?? $lead->expiry_date }}" data-id="{{$lead->id ?? ''}}" class="form-control follow_up"></td>

                                    <td>
                                        <input type="file" data-id="{{$lead->id ?? ''}}" class="form-control renew-att">
                                        @if(!empty($lead->attachments))
                                        @foreach($lead->attachments as $key => $attachment)
                                        @if($attachment->type == 'Renewal')
                                        <a class="view_files" href="{{URL::asset('attachments')}}/{{$attachment->file_name}}" target="_blank"><svg class="feather feather-file-text" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                                <polyline points="14 2 14 8 20 8" />
                                                <line x1="16" x2="8" y1="13" y2="13" />
                                                <line x1="16" x2="8" y1="17" y2="17" />
                                                <polyline points="10 9 9 9 8 9" />
                                            </svg></a>
                                        <a href="{{route('delAttachment',$attachment->id)}}" class="remove_us" title="Delete Lead" data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="Please Confirm" data-confirm-text="Are you sure that you want to delete this Attachment?" data-confirm-delete="Yes, delete it!">
                                            <svg height="512px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g>
                                                    <path d="M256,33C132.3,33,32,133.3,32,257c0,123.7,100.3,224,224,224c123.7,0,224-100.3,224-224C480,133.3,379.7,33,256,33z    M364.3,332.5c1.5,1.5,2.3,3.5,2.3,5.6c0,2.1-0.8,4.2-2.3,5.6l-21.6,21.7c-1.6,1.6-3.6,2.3-5.6,2.3c-2,0-4.1-0.8-5.6-2.3L256,289.8   l-75.4,75.7c-1.5,1.6-3.6,2.3-5.6,2.3c-2,0-4.1-0.8-5.6-2.3l-21.6-21.7c-1.5-1.5-2.3-3.5-2.3-5.6c0-2.1,0.8-4.2,2.3-5.6l75.7-76   l-75.9-75c-3.1-3.1-3.1-8.2,0-11.3l21.6-21.7c1.5-1.5,3.5-2.3,5.6-2.3c2.1,0,4.1,0.8,5.6,2.3l75.7,74.7l75.7-74.7   c1.5-1.5,3.5-2.3,5.6-2.3c2.1,0,4.1,0.8,5.6,2.3l21.6,21.7c3.1,3.1,3.1,8.2,0,11.3l-75.9,75L364.3,332.5z" />
                                                </g>
                                            </svg>
                                        </a>
                                        @endif
                                        @endforeach
                                        @endif
                                    </td>
                                    @endif



                                    @if(isset($_GET['id']) && $_GET['id'] == 2)
                                    <td>
                                        <select name="renew_status" id="renew_status" data-id="{{$lead->id}}" class="form-control renew_status">
                                            <option value="FOLLOW UP" {{isset($lead) && $lead->renew_status == 'FOLLOW UP' ? 'selected' : ''}}>FOLLOW UP</option>
                                            <option value="VEHICLE SOLD" {{isset($lead) && $lead->renew_status == 'VEHICLE SOLD' ? 'selected' : ''}}>VEHICLE SOLD</option>
                                            <option value="NOT INTERESTED" {{isset($lead) && $lead->renew_status == 'NOT INTERESTED' ? 'selected' : ''}}>NOT INTERESTED</option>

                                            <option value="CLOSED" {{isset($lead) && $lead->renew_status == 'CLOSED' ? 'selected' : ''}}>CLOSED</option>
                                        </select>
                                    </td>
                                    @else
                                    <!-- {{$lead->renew_status}} -->
                                    @endif


                                    <td class="btn-group">
                                        <!-- <a class="btn btn-sm btn-info btn-b endrosment-btn" data-id="{{$lead->id ?? ''}}" data-toggle="tooltip" title="Endrosment Sent">📜</a> -->
                                        <button class="btn btn-sm btn-info btn-b common-btn" type="button" data-id="{{$lead->id ?? ''}}" data-email="{{$lead->users->email ?? ''}}" data-expiry='{{ date("d-m-Y", strtotime($lead->expiry_date)) ?? ""}}' data-customer="{{ $lead->lead->holder_name ??$lead->holder_name }}" data-product="{{$lead->products->name ?? ''}}" data-subproduct="{{$lead->subProduct->name ?? ''}}" data-policy="{{$lead->reg_no ?? ''}}" data-name="{{$lead->users->name ?? ''}}" data-toggle="tooltip" title="Send Mail!">📩</button>
                                        @if(isset($_GET['id']) && $_GET['id'] == 1)
                                        <a href="{{route('policy.edit',$lead->id)}}" class="btn btn-sm btn-info btn-b" data-toggle="tooltip" title="Edit Policy"><i class="las la-pen"></i>
                                        </a>
                                        <a href="{{route('policy.destroy',$lead->id)}}" class="btn btn-sm btn-danger remove_us" title="Delete Lead" data-toggle="tooltip" data-placement="top" data-method="DELETE" data-confirm-title="Please Confirm" data-confirm-text="Are you sure that you want to delete this Lead?" data-confirm-delete="Yes, delete it!">
                                            <i class="las la-trash"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>

                        </table>
                        {{$leads->appends(['expiry_from' => $_GET['expiry_from']??'','expiry_to' => $_GET['expiry_to']??'','product' => $_GET['product']??'','users' => $_GET['users']??'','search_anything' => $_GET['search_anything']??'','status' => $_GET['status']??'','id'=>$_GET['id']?? '','renew_status_search'=>$_GET['renew_status_search']?? '','mis_transaction_type'=>$_GET['mis_transaction_type']?? '','sort' => $_GET['sort'] ??'10'])->links("vendor.pagination.bootstrap-4")}}



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
            <form method="POST" action="{{route('endrosment')}}">
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
                        <button class="btn ripple btn-primary save-status" type="submit">Send Email</button>
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
</div>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("select").select2();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
        $('.editor').summernote({

            height: 400,

        });
        $('.filter-btn').click(function() {
            $('.filter-box').toggleClass("hidden");
        })
        $('.filter-box').toggleClass("hidden");
        $('.filter').click(function() {
            var url = "{{url('admin/leads')}}";
            window.location.replace(url);

        })

        $('.renew_status').change(function() {
            var status = $(this).find(":selected").val();
            var policy_id = $(this).attr('data-id');
            $.ajax({
                type: "Post",
                url: "{{route('renew_status')}}",
                data: {
                    policy_id: policy_id,
                    status: status
                },
                success: function(result) {

                }
            });

        });


        $('.renew-btn').click(function() {

            const ids = [];
            $(".checkLead:checked").each(function(i) {
                ids.push($(this).data('id'));
            });

            if (ids != '') {
                $('#renew-modal').modal('show');

                $('.bulkEmail').click(function() {
                    $.ajax({
                        type: "Post",
                        url: "{{route('bulkEmail')}}",
                        data: {
                            id: ids
                        },
                        success: function(result) {
                            $('#renew-modal').modal('hide');
                            // location.reload();
                        }
                    });

                });
            } else {
                alert('CheckBox and Lead Owner must not be empty');
            }
        });
    });
    $(document).on('change', '.follow_up', function() {
        var id = $(this).data('id');
        var date = $(this).val();
        $.ajax({
            type: "Post",
            url: "{{route('renewFolloup')}}",
            data: {
                id: id,
                date: date
            },
            success: function(result) {

            }
        });
    });
    $(document).on('change', '.renew-att', function() {
        var id = $(this).data('id');
        var file = $(this).prop("files")[0];

        var form = new FormData();

        // Adding the image to the form
        form.append("image", file);
        form.append("policy_id", id);
        console.log(form, 'test', id);
        $.ajax({
            url: "{{route('renewAttachment')}}",
            type: "POST",
            data: form,
            contentType: false,
            processData: false,
            success: function(result) {
                toastr.success(result.message, 'Attachment Uploaded Successfully', {
                    closeButton: true,
                    progressBar: true,
                });
                setTimeout(function() {
                    location.reload();
                }, 500);
            }
        });
    });
    $(document).on('change', '.sort-table', function() {
        $('.submit-sort').click()

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
</script>
@endsection