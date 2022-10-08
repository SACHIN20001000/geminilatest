@extends('admin.layouts.app')

@section('content') 

<div class="container-fluid">
  <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">All Payout</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ list</span>
            </div>
        </div>
        <!-- <a class="btn btn-main-primary ml_auto" href="{{ route('payout.create') }}">Add Payout</a> -->
    </div>
    <!-- breadcrumb -->
   
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0">
                    <p class="tx-12 tx-gray-500 mb-2">Listing of All Payout...</p>
                </div>
                <div class="card-body">

                    <!-- Listing all data in user tables -->
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                            <thead>
                                <tr>
                                <th class="wd-lg-20p"><span>Client</span></th>
                                <th class="wd-lg-20p"><span>Company</span></th>
                                <th class="wd-lg-20p"><span>Transaction Type</span></th>
                                <th class="wd-lg-20p"><span>Sub Product</span></th>
                                <th class="wd-lg-20p"><span>Model</span></th>
                                <th class="wd-lg-20p"><span>VEH NO</span></th>
                                <th class="wd-lg-20p"><span>GWP</span></th>
                                <th class="wd-lg-20p"><span>Premium Received</span></th>
                                <th class="wd-lg-20p"><span>Premium Short</span></th>
                                <th class="wd-lg-20p"><span>Commissionable Amount</span></th>
                                <th class="wd-lg-20p"><span>PAYOUT %GE</span></th>
                                <th class="wd-lg-20p"><span>PAYOUT</span></th>
                                <th class="wd-lg-20p"><span>Created</span></th>
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

<!-- model end -->



@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                    url: "{{ route('payout.index') }}",
                       
                    },
            columns: [
            {data: 'clients', name: 'clients'},
            {data: 'company', name: 'company'},
            {data: 'mis_transaction_type', name: 'mis_transaction_type'},
            {data: 'subproduct', name: 'subproduct'},
            {data: 'model', name: 'model'},
            {data: 'reg_no', name: 'reg_no'},
            {data: 'gwp', name: 'gwp'},
            {data: 'mis_amount_paid', name: 'mis_amount_paid'},
            {data: 'mis_premium', name: 'mis_premium'},
            {data: 'mis_commissionable_amount', name: 'mis_commissionable_amount'},
            {data: 'mis_percentage', name: 'mis_percentage'},
            {data: 'mis_commission', name: 'mis_commission'},
            {data: 'created_at', name: 'created_at'},
            ]
        });

    });
</script>
@endsection
