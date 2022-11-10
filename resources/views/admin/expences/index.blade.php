@extends('admin.layouts.app')

@section('content') 

<div class="container-fluid">
  <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">All Expences</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ list</span>
            </div>
        </div>
        <a class="btn btn-main-primary ml_auto" href="{{ route('expences.create') }}">Add Expences</a>
    </div>
    <!-- breadcrumb -->
   
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0">
                    <p class="tx-12 tx-gray-500 mb-2">Listing of All Expences...</p>
                </div>
                <div class="card-body">

                    <!-- Listing all data in user tables -->
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                            <thead>
                                <tr>
												<th class="wd-lg-20p"><span>RENT</span></th>
												<th class="wd-lg-20p"><span>ELECTRICITY</span></th>
												<th class="wd-lg-20p"><span>WATER BILL</span></th>
												<th class="wd-lg-20p"><span>TEA & BEVERAGES</span></th>
												<th class="wd-lg-20p"><span>STATIONERY</span></th>
												<th class="wd-lg-20p"><span>SALARIES & INCENTIVES</span></th>
												<th class="wd-lg-20p"><span>MOBILE AND INTERNET</span></th>
												<th class="wd-lg-20p"><span>REPAIRS AND MAINTENANCE</span></th>
												<th class="wd-lg-20p"><span>COMMISSION</span></th>
												<th class="wd-lg-20p"><span>Created</span></th>
												<th class="wd-lg-20p">Action</th>
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
                    url: "{{ route('expences.index') }}",
                       
                    },
            columns: [
            {data: 'rent', name: 'rent'},
            {data: 'electricity', name: 'electricity'},
            {data: 'water_bill', name: 'water_bill'},
            {data: 'tea', name: 'tea'},
            {data: 'stationery', name: 'stationery'},
            {data: 'salery', name: 'salery'},
            {data: 'internet', name: 'internet'},
            {data: 'repair', name: 'repair'},
            {data: 'commision', name: 'commision'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
@endsection
