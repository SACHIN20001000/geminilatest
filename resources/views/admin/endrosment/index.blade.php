@extends('admin.layouts.app')

@section('content') 

<div class="container-fluid">
  <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">All Endrosment</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ list</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
   
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0">
                    <p class="tx-12 tx-gray-500 mb-2">Listing of All Endrosment...</p>
                </div>
                <div class="card-body">

                    <!-- Listing all data in user tables -->
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                            <thead>
                                <tr>             
                                                   
                                    <th class="wd-lg-20p">Policy Holder Name</th>               
                                    <th class="wd-lg-20p">Policy Number</th>               
                                    <th class="wd-lg-20p">Endrosment Type</th>               
                                    <th class="wd-lg-20p">Attachment</th>               
                                    <th class="wd-lg-20p">Remarks</th>   
                                    <th class="wd-lg-20p">Created By</th>            
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
                    url: "{{ route('endrosment.index') }}",
                       
                    },
            columns: [
                {data: 'lead.holder_name', holder_name: 'lead.holder_name'},
            {data: 'lead.id', name: 'lead.id'},
            {data: 'type', name: 'type'},
            {data: 'attachments', name: 'attachments'},
            {data: 'message', name: 'message'},
            {data: 'users.name', name: 'users.name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
@endsection
