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
                <h4 class="  content-title mb-0 my-auto pe-4">Reconciliation </h4>

            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">

            <div class="pe-1 mb-xl-0">

                <select name="internal_commission" class="form-control internal_commission">
                    <option value="">Select Commission</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div class="pe-1 mb-xl-0 card">

                <div id="reportrange"><span></span></div>
                <button type="button" style="display: flex; gap: 8px;" class="btn btn-default float-right" id="daterange-btn">
                    <i class="far fa-calendar-alt"></i>
                    <div class="staticDays">Financial Year</div>
                    <div id="dynamicDate"></div>
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>

            <div class="pe-1 mb-xl-0">
                <div class="btn-group dropdown">
                    <a class="btn btn-main-primary" href="{{ route('reconciliation.upload') }}">Upload</a>
                </div>
            </div>

        </div>
    </div>

    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">



            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-body">



                        <div class="table-responsive border-top userlist-table">
                            <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                                <thead>
                                    <tr>

                                        <th><span>Channel name</span></th>
                                        <th><span>Insurance company</span></th>
                                        <th><span>Policy holder name</span></th>
                                        <th><span>Transaction type</span></th>
                                        <th><span>Sub product</span></th>
                                        <th><span>Gross premium</span></th>
                                        <th><span>Policy no</span></th>
                                        <th><span>Veh reg no</span></th>
                                        <th><span>Payout expected</span></th>
                                        <th><span>Payout recd</span></th>
                                        <th><span>Commission status</span></th>
                                        <th><span>Outgoing payout</span></th>
                                        <th><span>Payout saved</span></th>


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
<link rel="stylesheet" href="ttps://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {


        $("select").select2();
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'Financial Year': [moment().subtract(1, 'years').startOf('year').add(3, 'months'), moment().subtract(1, 'years').endOf('year').add(3, 'months').endOf('month')],
                    'Last Financial Year': [moment().subtract(2, 'years').startOf('year').add(3, 'months'), moment().subtract(2, 'years').endOf('year').add(3, 'months').endOf('month')]

                },
                startDate: moment().subtract(0, 'years').startOf('year').add(3, 'months'),
                endDate: moment().subtract(0, 'years').endOf('year').add(3, 'months').endOf('month')
            },
            function(start, end, range) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
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
        $('.internal_commission').on('change', function() {
            var internal_commission = $(this).val();
            updateDataTableFilters();
        });



        var start = $('#daterange-btn').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var end = $('#daterange-btn').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var internal_commission = $('.internal_commission').val();

        function updateDataTableFilters() {

            start = $('#daterange-btn').data('daterangepicker').startDate.format('YYYY-MM-DD');
            end = $('#daterange-btn').data('daterangepicker').endDate.format('YYYY-MM-DD');
            internal_commission = $('.internal_commission').val();
            table.draw();
        }
        var tableConfig = {
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('reconciliation.index') }}",
                data: function(d) {
                    d.expiry_from = start;
                    d.expiry_to = end;
                    d.internal_commission = internal_commission;
                }
            },
            dom: 'Blfrtip',
            lengthMenu: [
                [10, 25, 50, 100, 200, -1],
                ['10 rows', '25 rows', '50 rows', '100 rows', '200 rows', 'Show all']
            ],
            columns: [{
                    data: 'channel_name',
                    name: 'channel_name',
                    defaultContent: '',
                },
                {
                    data: 'company.name',
                    name: 'company.name',
                    defaultContent: '',
                },
                {
                    data: 'holder_name',
                    name: 'holder_name',
                    defaultContent: '',
                },
                {
                    data: 'mis_transaction_type',
                    name: 'mis_transaction_type',
                    defaultContent: '',
                }, {
                    data: 'sub_product.name',
                    name: 'sub_product.name',
                    defaultContent: '',
                }, {
                    data: 'gross_premium',
                    name: 'gross_premium',
                    defaultContent: '',
                }, {
                    data: 'policy_no',
                    name: 'policy_no',
                    defaultContent: '',
                }, {
                    data: 'reg_no',
                    name: 'reg_no',
                    defaultContent: '',
                }, {
                    data: 'internal_payout_expected',
                    name: 'internal_payout_expected',
                    defaultContent: '',
                }, {
                    data: 'internal_payout_received',
                    name: 'internal_payout_received',
                    defaultContent: '',
                }, {
                    data: 'internalCommission',
                    name: 'internalCommission',
                    defaultContent: '',
                }, {
                    data: 'mis_commission',
                    name: 'mis_commission',
                    defaultContent: '',
                }, {
                    data: 'internal_payout_saved',
                    name: 'internal_payout_saved',
                    defaultContent: '',
                },
                {
                    data: 'phone',
                    name: 'phone'
                }



            ],
            columnDefs: [
        {
            targets: [13], // index of the 'phone' column (zero-based index)
            visible: false
        }
    ]

        };

        var table = $('#datatable').DataTable(tableConfig);





        $(document).on('change', '.commission_change', function() {

            var id = $(this).data('id');
            var value = $(this).val();
            $.ajax({
                url: "{{ route('reconciliation-update') }}",
                type: 'POST',
                data: {
                    id: id,
                    value: value
                },
                success: function(response) {
                    toastr.success('Updated successfully');
                },
                error: function(response) {
                    toastr.error('Error: ' + response);
                }
            });
        });

    });
</script>
@endsection