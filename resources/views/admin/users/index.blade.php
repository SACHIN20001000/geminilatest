@extends('admin.layouts.app')

@section('content') 

<div class="container-fluid">
  <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto pe-4">All Users</h4>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                    <a class="btn btn-info ml_auto" href="{{ route('users.index') }}">All</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                    <a class="btn btn-info ml_auto" href="{{ route('users.index',['id'=> 1]) }}">Admin</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                    <a class="btn btn-info ml_auto" href="{{ route('users.index',['id'=> 2]) }}">Broker</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                    <a class="btn btn-info ml_auto" href="{{ route('users.index',['id'=> 3]) }}">Staff</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                    <a class="btn btn-info ml_auto" href="{{ route('users.index',['id'=> 4]) }}">Client</a>
                    </div>
                </div>
            </div>
        </div>
       

        
       
        
       
        <a class="btn btn-main-primary ml_auto" href="{{ route('users.create') }}">Add User</a>
    </div>
    <!-- breadcrumb -->
   
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0">
                    <p class="tx-12 tx-gray-500 mb-2">Listing of All Users...</p>
                </div>
                <div class="card-body">

                    <!-- Listing all data in user tables -->
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                            <thead>
                                <tr>
                                <th class="wd-lg-20p"><span>Email</span></th>
												<th class="wd-lg-20p"><span>Role</span></th>
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
        let id= '{{ $_GET['id'] ?? ''}}';
        console.log(id);
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                    url: "{{ route('users.index') }}",
                        data: function(d) {
                            d.id = id;

                        }
                    },
            columns: [
              {data: 'email', name: 'email'},
            {data: 'roles[0].name', name: 'roles[0].name', orderable: false,searchable: false},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
@endsection
