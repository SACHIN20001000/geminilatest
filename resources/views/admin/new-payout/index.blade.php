@extends('admin.layouts.app')

@section('content')
<style>
    /* CSS for loading indicator */
    #loadingIndicator {
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.7);
        /* Semi-transparent background */
        z-index: 9999;
    }

    .loader {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<div id="loadingIndicator" style="display: none;">
    <div class="loader"></div>
</div>
<div class="container-fluid">
    <div class="row row-sm">
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="px-3 pt-3  pb-2 pt-0">
                    <div class="">
                        <h5 class="mb-3  text-white">Payable</h5>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 fw-bold mb-1 text-white payable"></h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="px-3 pt-3  pb-2 pt-0">
                    <div class="">
                        <h5 class="mb-3  text-white ">Receivable</h5>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 fw-bold mb-1 text-white receivable"></h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="px-3 pt-3  pb-2 pt-0">
                    <div class="">
                        <h5 class="mb-3  text-white">Recovery</h5>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 fw-bold mb-1 text-white recovery"></h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- filter  -->

    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <div class="card">
            <div class="card-body">

                <div class="row row-sm">
                    <div class="col-lg-2">
                        <div id="reportrange" style="display:none"><span></span></div>
                        <button type="button" style="display: flex; gap: 8px;" class="btn btn-default float-right" id="daterange-btn">
                            <i class="far fa-calendar-alt"></i>
                            <div class="staticDays">Last 30 days</div>
                            <div id="dynamicDate"></div>
                            <i class="fas fa-caret-down"></i>
                        </button>
                    </div>

                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                        <div class="input-group">
                            <div class="input-group-text">
                                Reference:
                            </div>
                            <select name="reference_name" id="reference_name" class="form-control">
                                <option value="">Select</option>
                                @if(isset($users) && $users->count())
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div><!-- input-group -->
                    </div>
                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                        <div class="input-group">
                            <div class="input-group-text">
                                Status:
                            </div>
                            <select name="status" id="status" class="form-control">
                                <option value="">Select</option>
                                <option value="Settled">Settled</option>
                                <option value="Not Settled">Not Settled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                        <div class="input-group">
                            <button class="btn btn-primary" id="filter">Filter</button>
                        </div>
                    </div>
                    <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                        <div class="input-group">
                            <button class="btn btn-success" id="generate-invoice">Generate Invoice</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- filter  -->

    <!-- table list  -->
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">

                <div class="card-body">

                    <!-- Listing all data in user tables -->
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="all_checked" id="checkedAll" value="0"></th>
                                    <th class="wd-lg-20p"><span>Reference Type</span></th>
                                    <th class="wd-lg-20p"><span>Reference Name</span></th>
                                    <th class="wd-lg-20p"><span>Email Id</span></th>
                                    <th class="wd-lg-20p"><span>Contact No</span></th>
                                    <th class="wd-lg-20p"><span>Balance</span></th>
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
    <!-- ROW END -->
    <!-- table list  -->

</div>


@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('new-payout.index') }}",
                data(d) {
                    d.interval = $('#reportrange span').text(),
                        d.reference_name = $('#reference_name').val();
                    d.status = $('#status').val();
                },
            },
            dom: 'Blfrtip',
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    sortable: false
                },
                {
                    data: 'roles[0].name',
                    name: 'roles[0].name',
                    defaultContent: '' // Provide a default value here

                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'

                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'totalAmount',
                    name: 'totalAmount',
                    defaultContent: '' // Provide a default value here

                }

            ]
        });

        $('#filter').click(function() {
            table.draw();
            getPayouts()
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
        $('select').select2();

        function getPayouts() {
            $.ajax({
                url: "{{ route('getPayouts')}}",
                data: {
                    interval: $('#reportrange span').text(),
                    reference_name: $('#reference_name').val(),
                    status: $('#status').val()
                },
                method: "post",
                success: function(result) {
                    $('.payable').text(`Rs ${result['payable'].toFixed(2)}`)
                    $('.receivable').text(`Rs ${result['receivable'].toFixed(2)}`)
                    $('.recovery').text(`Rs ${result['recovery'].toFixed(2)}`)
                }
            });
        }
        getPayouts();



        $('#daterange-btn').daterangepicker({
                ranges: {
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                    'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                    'Financial Year': [moment().month(3).startOf('month'), moment().add(7, 'months').endOf('month')],
                    'Last Financial Year': [moment().subtract(1, 'years').month(3).startOf('month'), moment().subtract(1, 'years').add(7, 'months').endOf('month')]

                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end, range) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                $('#dynamicDate').html(range)
                $('.staticDays').hide();
            });

        //GENERATE INVOICE 
        $('#generate-invoice').click(function() {
            const ids = [];

            $("input:checkbox:checked").each(function(i) {
                ids.push($(this).val());

            });
            if (ids != '') {
                $("#loadingIndicator").show();

                $.ajax({
                    url: "{{ route('getInvoiceDetail')}}",
                    method: "get",
                    data: {
                        ids: ids,
                        interval: $('#reportrange span').text(),
                        reference_name: $('#reference_name').val(),
                        status: $('#status').val()
                    },
                    success: function(result) {
                        $("#loadingIndicator").hide();
                        if (result.success) {

                            toastr.success(result.message, 'Invoice Generated', {
                                closeButton: true,
                                progressBar: true,
                            });
                            table.draw();

                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $("#loadingIndicator").hide();
                        toastr.error('An error occurred: ' + errorThrown, 'Error', {
                            closeButton: true,
                            progressBar: true,
                        });
                    }
                });

            } else {
                toastr.error('Error', 'CheckBox must not be empty', {
                    closeButton: true,
                    progressBar: true,
                });
            }
        });


    });
</script>
@endsection