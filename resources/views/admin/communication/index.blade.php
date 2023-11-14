@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">All Communication</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ list</span>
            </div>
        </div>
        <a class="btn btn-main-primary ml_auto" href="{{ route('communications.create') }}">Add Communication</a>
    </div>
    <!-- breadcrumb -->

    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header pb-0">
                    <p class="tx-12 tx-gray-500 mb-2">Listing of All Communication...</p>
                </div>
                <div class="card-body">

                    <!-- Listing all data in user tables -->
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                            <thead>
                                <tr>

                                    <th class="wd-lg-20p"><span>Created By</span></th>
                                    <th class="wd-lg-20p"><span>Send to</span></th>
                                    <th class="wd-lg-20p"><span>Group</span></th>
                                    <th class="wd-lg-20p"><span>Message</span></th>
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
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('communications.index') }}",

            },
            columns: [

                {
                    data: 'users.name',
                    name: 'users.name',
                    defaultContent: ''

                },
                {
                    data: 'type',
                    name: 'type',
                    defaultContent: ''

                },
                {
                    data: 'group.name',
                    name: 'group.name',
                    defaultContent: ''
                },
                {
                    data: 'text',
                    name: 'text',
                    defaultContent: '',
                    render: function(data, type, row) {
                        var tempElement = $('<div/>').html(data);
                        return tempElement.text();
                    }


                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    defaultContent: ''
                },
            ]
        });

    });
</script>
@endsection