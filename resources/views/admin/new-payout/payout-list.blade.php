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


    <!-- filter  -->
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">


        <button class="btn btn-main-primary ml_auto" id="generate-invoice">Generate Invoice</button>

    </div>
    <!-- breadcrumb -->


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
                                    <th class="wd-lg-20p"><span>MONTH</span></th>
                                    <th class="wd-lg-20p"><span>POLICY HOLDER NAME</span></th>
                                    <th class="wd-lg-20p"><span>POLICY TYPE</span></th>
                                    <th class="wd-lg-20p"><span>TRANSACTION TYPE</span></th>
                                    <th class="wd-lg-20p"><span>SUB PRODUCT</span></th>
                                    <th class="wd-lg-20p"><span>MODEL</span></th>
                                    <th class="wd-lg-20p"><span>VEH NO</span></th>
                                    <th class="wd-lg-20p"><span>GROSS PREMIUM</span></th>
                                    <th class="wd-lg-20p"><span>NET PREMIUM</span></th>
                                    <th class="wd-lg-20p"><span>OD PREMIUM</span></th>
                                    <th class="wd-lg-20p"><span>PREMIUM SHORT</span></th>
                                    <th class="wd-lg-20p"><span>COMMISSION BASE</span></th>
                                    <th class="wd-lg-20p"><span>BASE AMOUNT</span></th>
                                    <th class="wd-lg-20p"><span>PAYOUT %GE</span></th>
                                    <th class="wd-lg-20p"><span>PAYOUT</span></th>
                                    <th class="wd-lg-20p"><span>RECOVERY</span></th>
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
            scrollX: true, // Enable horizontal scrolling

            ajax: {
                url: "{{ route('payoutList') }}",
                data(d) {
                    d.interval = "<?php echo $_GET['interval'] ?? '' ?>",
                        d.reference_name = "<?php echo $_GET['reference_name'] ?? '' ?>"
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
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, row) {
                        return moment(data).format('MMM D, YYYY');
                    }
                }, {
                    data: 'holder_name',
                    name: 'holder_name',
                }, {
                    data: 'products.name',
                    name: 'products.name',
                    defaultContent: '' // Provide a default value here

                }, {
                    data: 'mis_transaction_type',
                    name: 'mis_transaction_type',
                }, {
                    data: 'sub_product.name',
                    name: 'sub_product.name',
                    defaultContent: '' // Provide a default value here

                }, {
                    data: 'models.name',
                    name: 'models.name',
                    defaultContent: '' // Provide a default value here

                },
                {
                    data: 'reg_no',
                    name: 'reg_no',
                }, {
                    data: 'gross_premium',
                    name: 'gross_premium',
                }, {
                    data: 'net_premium',
                    name: 'net_premium',
                }, {
                    data: 'od_premium',
                    name: 'od_premium',
                }, {
                    data: 'mis_short_premium',
                    name: 'mis_short_premium',
                }, {
                    data: 'commission_base',
                    name: 'commission_base',
                }, {
                    data: 'mis_commissionable_amount',
                    name: 'mis_commissionable_amount',
                }, {
                    data: 'mis_percentage',
                    name: 'mis_percentage',
                }, {
                    data: 'mis_commission',
                    name: 'mis_commission',
                }, {
                    data: 'payout_recovery',
                    name: 'payout_recovery',
                }

            ]
        });

        $('#filter').click(function() {
            table.draw();
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






        //GENERATE INVOICE 
        $('#generate-invoice').click(function() {

            const ids = [];

            $("input:checkbox:checked").each(function(i) {
                ids.push($(this).val());

            });
            if (ids != '') {
                $("#loadingIndicator").show();

                $.ajax({
                    url: "{{ route('generateInvoice')}}",
                    method: "get",
                    data: {
                        ids: ids,
                        user_id: "<?php echo $_GET['reference_name'] ?? '' ?>",
                        interval: "<?php echo $_GET['interval'] ?? '' ?>",

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