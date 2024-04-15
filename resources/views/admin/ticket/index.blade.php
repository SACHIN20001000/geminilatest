@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto pe-4">All Endrosment </h4>
                

            </div>
        </div>





    </div>
    <!-- breadcrumb -->

    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0">
                    <p class="tx-12 tx-gray-500 mb-2">Listing of All Endrosment</p>
                </div>
                <div class="card-body">

                    <!-- Listing all data in user tables -->
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                            <thead>
                                <tr>

                                    <th class="wd-lg-20p"><span>Policy Number</span></th>
                                    <th class="wd-lg-20p"><span>Created By</span></th>
                                    <th class="wd-lg-20p"><span>Current Value</span></th>
                                    <th class="wd-lg-20p"><span>New Value</span></th>
                                    <th class="wd-lg-20p"><span>Status</span></th>
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
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {


        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('ticket.index') }}",
              
            },
            dom: 'Blfrtip',

            columns: [
                {
                    data: 'policy.policy_no',
                    name: 'policy.policy_no',
                    render: function(data, type, row) {
                        return '<a href="policy/' + row.policy_id + '" target="_blank">' + data + '</a>';
                    }
                },
                 {
                    data: 'user.name',
                    name: 'user.name',
                    defaultContent: ''
                },
                {
                    data: 'current_value',
                    name: 'current_value',
                    defaultContent: ''
                },
                {
                    data: 'new_value',
                    name: 'new_value',
                    defaultContent: ''
                },
                {
                    data: 'status',
                    name: 'status',
                    defaultContent: ''
                },
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