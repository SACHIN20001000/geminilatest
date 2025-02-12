@extends('admin.layouts.app')

@section('content')
<style>
    .dataTables_wrapper .dataTables_filter {
    float: left !important;
}
.dataTables_filter label {
    border: 1px solid #f1f1f1;
    background: #f9f9f9;
    border-radius: 8px;
    padding: 0px 0px 0 10px;
}
div.dt-buttons {
    float: right !important;
}
.dataTables_filter label input[type="search"] {
    border: 0;
}
.dt-button.buttons-html5, .dt-button.buttons-print {
    background: #2a52be;
    color: #fff;
    border-color: #3451b7;
    min-width: 60px;
    border-radius: 6px;
    padding: 3px 16px;
}
button.dt-button,div.dt-button,a.dt-button,input.dt-button {
    position: relative;
    display: inline-block;
    box-sizing: border-box;
    margin-left: .167em;
    margin-right: .167em;
    margin-bottom: .333em;
    padding: .5em 1em;
    border: 1px solid rgba(0, 0, 0, 0.3);
    border-radius: 2px;
    cursor: pointer;
    font-size: .88em;
    line-height: 1.6em;
    color: black;
    white-space: nowrap;
    overflow: hidden;
    background-color: rgba(0, 0, 0, 0.1);
    background: linear-gradient(to bottom, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr="rgba(230, 230, 230, 0.1)", EndColorStr="rgba(0, 0, 0, 0.1)");
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    text-decoration: none;
    outline: none;
    text-overflow: ellipsis
}
div#datatable_length {
    bottom: 0;
    position: absolute;
    z-index: 10;
}
div#datatable_info {
    float: right;
}
div#datatable_paginate {
    display: flex;
    float: unset;
    justify-content: center;
    transform: translateY(-8px);
}
div#datatable_paginate .paginate_button {
    padding: 5px 10px;
    border: 1px solid #f1f1f1;
}
.dataTables_wrapper .dataTables_paginate a.paginate_button.current {
    color: #fff !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #3653b8 !important;
    color: #fff !important;
}
.table-responsive.userlist-table {
    overflow: hidden !important;
    width: 100%;
}
#datatable_wrapper .table td {
        padding: 6px 6px !important;
        line-height: 1;
    }
    table.dataTable thead th {
    font-size: 13px;
    color: #242f48;
    font-weight: 600 !important;
    text-transform: capitalize;
}
table.dataTable thead th {
    font-size: 12px !important;
}
    .iconBtn svg {
        width: 16px;
        height: 16px;
        fill: #02b9ff;
    }
    a.remove_us svg {
    width: 12px;
    height: 12px;
    fill: #dd0909;
    /* transform: translateY(-6px) translateX(-5px); */
    cursor: pointer;
}
.action-buttons {
    gap: 12px;
}

</style>

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header my-3 justify-content-between">
        <div class="my-auto">
            <div class="d-flex gap-3">
                <h4 class="content-title mb-0 my-auto pe-4">All Users</h4>
                @if(!($_GET['advance'] ?? ''))
                <div class="mb-xl-0">
                    <div class="btn-group dropdown">
                        <a class="@if(isset($_GET['id']) && $_GET['id'] == 0) btn btn-warning @else btn btn-info @endif ml_auto" href="{{ route('users.index',['id'=> 0]) }}">All</a>
                    </div>
                </div>
                <div class="mb-xl-0">
                    <div class="btn-group dropdown">
                        <a class="@if(isset($_GET['id']) && $_GET['id'] == 1) btn btn-warning @else btn btn-info @endif ml_auto" href="{{ route('users.index',['id'=> 1]) }}">Admin</a>
                    </div>
                </div>
                <div class="mb-xl-0">
                    <div class="btn-group dropdown">
                        <a class="@if(isset($_GET['id']) && $_GET['id'] == 2) btn btn-warning @else btn btn-info @endif ml_auto" href="{{ route('users.index',['id'=> 2]) }}">Broker</a>
                    </div>
                </div>
                <div class="mb-xl-0">
                    <div class="btn-group dropdown">
                        <a class="@if(isset($_GET['id']) && $_GET['id'] == 3) btn btn-warning @else btn btn-info @endif ml_auto" href="{{ route('users.index',['id'=> 3]) }}">Staff</a>
                    </div>
                </div>
                <div class="mb-xl-0">
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
                <!-- <div class="card-header pb-0">
                    <p class="tx-12 tx-gray-500 mb-2">Listing of All Users...</p>
                </div> -->
                <div class="card-body">

                    <!-- Listing all data in user tables -->
                    <div class="table-responsive userlist-table">
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
        let id = @json(request('id', ''));
        let advance = @json(request('advance', ''));
        let date = @json(request('date', ''));

        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('users.index') }}",
                data: function(d) {
                    d.id = id;
                    d.advance = advance;
                    d.date = date;

                }
            },
            dom: 'Blfrtip',

            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'roles[0].name',
                    name: 'roles[0].name',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        if (data === 'Broker') {
                            return 'Agent';
                        }
                        return data;
                    }
                },
                <?php if (isset($_GET['id']) && $_GET['id'] == 2) { ?> {
                        data: 'advance_payout',
                        name: 'advance_payout'
                    },
                <?php } ?>



                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });
</script>
@endsection