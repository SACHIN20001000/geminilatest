@extends('admin.layouts.app')

@section('content') 

<div class="container-fluid">
  <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto pe-4">All Users</h4>
              @if(!($_GET['advance'] ?? ''))
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                    <a class="@if(isset($_GET['id']) && $_GET['id'] == 0) btn btn-warning @else btn btn-info @endif ml_auto" href="{{ route('users.index',['id'=> 0]) }}">All</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                    <a class="@if(isset($_GET['id']) && $_GET['id'] == 1) btn btn-warning @else btn btn-info @endif ml_auto" href="{{ route('users.index',['id'=> 1]) }}">Admin</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                    <a class="@if(isset($_GET['id']) && $_GET['id'] == 2) btn btn-warning @else btn btn-info @endif ml_auto" href="{{ route('users.index',['id'=> 2]) }}">Broker</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                    <a class="@if(isset($_GET['id']) && $_GET['id'] == 3) btn btn-warning @else btn btn-info @endif ml_auto" href="{{ route('users.index',['id'=> 3]) }}">Staff</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                    <a class="@if(isset($_GET['id']) && $_GET['id'] == 4) btn btn-warning @else btn btn-info @endif ml_auto" href="{{ route('users.index',['id'=> 4]) }}">Client</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
       

        
       
        @if(!($_GET['advance'] ?? ''))
       
        <a class="btn btn-main-primary ml_auto" href="{{ route('users.create') }}">Add User</a>
        @endif
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
                                <th class="wd-lg-20p"><span>Name</span></th>
												<th class="wd-lg-20p"><span>Role</span></th>
                                                @if(isset($_GET['id']) && $_GET['id'] == 2)
												<th class="wd-lg-20p"><span>Advance Payout</span></th>
                                                @endif
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
        let advance= '{{ $_GET['advance'] ?? ''}}';
    
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                    url: "{{ route('users.index') }}",
                        data: function(d) {
                            d.id = id;
                            d.advance = advance;

                        }
                    },
            columns: [
              {data: 'name', name: 'name'},
            {data: 'roles[0].name', name: 'roles[0].name', orderable: false,searchable: false},
            <?php if(isset($_GET['id']) && $_GET['id'] == 2) {?>
                {data: 'advance_payout', name: 'advance_payout'},
 <?php } ?>               



            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
@endsection
