@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">


    <!-- filter  -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">All Invoice</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ list</span>
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

                                    <th class="wd-lg-20p"><span>Invoice No</span></th>
                                    <th class="wd-lg-20p"><span>Reference name</span></th>
                                    <th class="wd-lg-20p"><span>Amount Transfer</span></th>
                                    <th class="wd-lg-20p"><span>Bank Details</span></th>
                                    <th class="wd-lg-20p"><span>Invoice Amount</span></th>
                                    <th class="wd-lg-20p"><span>Invoice Date</span></th>
                                    <th class="wd-lg-20p"><span>Recovery Amount</span></th>
                                    <th class="wd-lg-20p"><span>Short Premium</span></th>
                                    <th class="wd-lg-20p"><span>Tds</span></th>
                                    <th class="wd-lg-20p"><span>Total Payout</span></th>
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
                url: "{{ route('invoice') }}",

            },
            dom: 'Blfrtip',
            columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'users.name',
                    name: 'users'
                }, {
                    data: 'amount_transfer',
                    name: 'amount_transfer'
                }, {
                    data: 'bank_detail',
                    name: 'bank_detail'
                }, {
                    data: 'invoice_amount',
                    name: 'invoice_amount'
                }, {
                    data: 'invoice_date',
                    name: 'invoice_date'
                }, {
                    data: 'recovery_cases',
                    name: 'recovery_cases'
                }, {
                    data: 'short_premium',
                    name: 'short_premium'
                }, {
                    data: 'tds',
                    name: 'tds'
                }, {
                    data: 'total_Payout',
                    name: 'total_Payout'
                }


            ]
        });



    });
</script>
@endsection