@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">


    <!-- filter  -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="  content-title mb-0 my-auto pe-4">Verified Invoice </h4>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a href="{{ route('invoice.verified',['id'=> 1]) }}" class=" @if(isset($_GET['id']) && $_GET['id'] == 1) btn btn-warning @else btn btn-info @endif ml_auto">Pending </a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a href="{{ route('invoice.verified',['id'=> 2]) }}" class=" @if(isset($_GET['id']) && $_GET['id'] == 2) btn btn-warning @else btn btn-info @endif  ml_auto">Paid</a>
                    </div>
                </div>
                <div class="pe-4 mb-xl-0">
                    <div class="btn-group dropdown">
                        <a href="{{ route('invoice.verified',['id'=> 3]) }}" class=" @if(isset($_GET['id']) && $_GET['id'] == 3) btn btn-warning @else btn btn-info @endif  ml_auto">Canceled</a>
                    </div>
                </div>

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
                        <table class=" card-table table-striped table-vcenter  mb-0" id="datatable">
                            <thead>
                                <tr>

                                    <th class="wd-lg-10p"><span>Invoice No</span></th>
                                    <th class="wd-lg-10p"><span>Reference name</span></th>
                                    <th class="wd-lg-10p"><span>Amount Transfer</span></th>
                                    <th class="wd-lg-10p"><span>Bank Details</span></th>
                                    <th class="wd-lg-10p"><span>Invoice Amount</span></th>
                                    <th class="wd-lg-10p"><span>Invoice Date</span></th>
                                    <th class="wd-lg-10p"><span>Recovery Amount</span></th>
                                    <th class="wd-lg-10p"><span>Short Premium</span></th>
                                    <th class="wd-lg-10p"><span>Tds</span></th>
                                    <th class="wd-lg-10p"><span>Total Payout</span></th>
                                    <th class="wd-lg-10p"><span>Payment Status</span></th>
                                    <th class="wd-lg-10p"><span>Action</span></th>
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

<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeStatusModalLabel">Change Status</h5>
                <!-- Replace the default close button with a custom close button -->
            </div>
            <div class="modal-body">
                <!-- Add your form elements here to change the status -->
                <form id="changeStatusForm" method="post" action="{{ route('invoice.updatePaymentStatus') }}">
                    @csrf
                    <input type="hidden" name="invoice_id" id="invoiceId">
                    <div class="form-group">
                        <label for="newStatus">New Status</label>
                        <select name="new_status" id="newStatus" class="form-control">
                            <option value="pending">Pending</option>
                            <option value="paid">Paid</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- You can keep the custom close button here -->
                <button type="button" class="btn btn-secondary customCloseButton">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitStatusChange()">Save changes</button>
            </div>
        </div>
    </div>
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
    let table;
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let id = @json(request('id', ''));
        let date = @json(request('date', ''));

         table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('invoice.verified') }}",
                data: function(d) {
                    d.id = id;

                }
            },
            dom: 'Blfrtip',
            columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'users.name',
                    name: 'users',
                    defaultContent: '' // Provide a default value here

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
                }, {
                    data: 'payment_status',
                    name: 'payment_status',
                    render: function(data, type, row) {
                        return `<span id="payment-status-${row.id}">${data}</span>`;
                    }
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }


            ],

        });



    });


    $(document).on('click', '.change-status-icon', function() {
        const id = $(this).data('id'); // Get the invoice ID from data-id attribute

        // Populate the modal with data based on the invoice ID
        const currentStatus = $(`#payment-status-${id}`).text();

        $('#invoiceId').val(id);
        $('#newStatus').val(currentStatus);
        $('#changeStatusModal').modal('show');
    });
    $(document).on('click', '.customCloseButton', function() {

        // Close the modal
        $('#changeStatusModal').modal('hide');
    });

    function submitStatusChange() {
        // Get the invoice ID and new status from the form
        const invoiceId = $('#invoiceId').val();
        const newStatus = $('#newStatus').val();

        // Send an AJAX request to update the status
        $.ajax({
            type: 'POST',
            url: "{{ route('invoice.updatePaymentStatus') }}", // Remove the line break
            data: {
                invoice_id: invoiceId,
                new_status: newStatus,
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                // Handle the response or perform any necessary actions
                // Close the modal
                $('#changeStatusModal').modal('hide');
                if (response.success) {

                    toastr.success(response.message, 'Payment Status Updated', {
                        closeButton: true,
                        progressBar: true,
                    });
                    table.draw();

                }
            },
            error: function(error) {
                // Handle any errors or display an error message
                console.log('Error: ' + error);
            }
        });
    }
</script>
@endsection