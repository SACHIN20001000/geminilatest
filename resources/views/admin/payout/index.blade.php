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
        <div class="btn-group dropdown generate-btn">
            <a class="modal-effect btn btn-main-primary ml_auto " data-bs-effect="effect-super-scaled" style="color:white">Generate Invoice</a>
        </div>
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
                                    <th><input type="checkbox" name="all_checked" id="checkedAll" value="0"></th>
                                    <th class="wd-lg-20p"><span>Client</span></th>
                                    <th class="wd-lg-20p"><span>Company</span></th>
                                    <th class="wd-lg-20p"><span>Transaction Type</span></th>
                                    <th class="wd-lg-20p"><span>Sub Product</span></th>
                                    <th class="wd-lg-20p"><span>Model</span></th>
                                    <th class="wd-lg-20p"><span>VEH NO</span></th>
                                    <th class="wd-lg-20p"><span>GWP</span></th>
                                    <th class="wd-lg-20p"><span>Premium Received</span></th>
                                    <th class="wd-lg-20p"><span>Premium Short</span></th>
                                    <th class="wd-lg-20p"><span>Base amount</span></th>
                                    <th class="wd-lg-20p"><span>PAYOUT %GE</span></th>
                                    <th class="wd-lg-20p"><span>PAYOUT</span></th>
                                    <th class="wd-lg-20p"><span>Recovery</span></th>
                                    <th class="wd-lg-20p"><span>Invoice Id</span></th>
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
<!-- Modal effects -->
<div class="modal fade" id="invoice-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Invoice</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('invoiceStore')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <span>TOTAL PAYOUT</span>
                            <input type="text" class="form-control" name="total_Payout" id="total_Payout">
                        </div>
                        <div class="col-lg-6">
                            <span>SHORT PREMIUM</span>
                            <input type="text" class="form-control" name="short_premium" id="short_premium">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <span>RECOVERY CASES</span>
                            <input type="text" class="form-control" name="recovery_cases" id="recovery_cases">
                        </div>
                        <div class="col-lg-6">
                            <span>Advance Payout</span>
                            <input type="text" class="form-control" name="advance_payout" id="advance_payout">
                            <input type="hidden" name="policy_id[]" id="policy_id">
                            <input type="hidden" name="user_id" id="user_id">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <span>TO BE ADJUSTED</span>
                            <input type="text" class="form-control" name="adjusted" id="adjusted">
                        </div>
                        <div class="col-lg-6">
                            <span>AMOUNT TO BE TRANSFERRED</span>
                            <input type="text" class="form-control" name="amount_transfer" id="amount_transfer">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <span>TDS %AGE</span>
                            <input type="text" class="form-control" name="tds" id="tds">
                        </div>
                        <div class="col-lg-6">
                            <span>INVOICE AMOUNT</span>
                            <input type="text" class="form-control" name="invoice_amount" id="invoice_amount">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <span>Name</span>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="col-lg-6">
                            <span>Bank Detail</span>
                            <input type="text" class="form-control" name="bank_detail" id="bank_detail">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <span>INVOICE DATE</span>
                            <input type="date" class="form-control" name="invoice_date" id="invoice_date">
                        </div>
                        <div class="col-lg-6">
                            <span>TRANSFER DATE</span>
                            <input type="date" class="form-control" name="transfer_date" id="transfer_date">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary save-assign" type="submit">Save changes</button>
                    <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal effects-->
<!-- Modal effects -->
<div class="modal fade" id="invoice-view">
    <div class="modal-dialog modal-dialog-centered" role="documents">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Invoice</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">

            </div>


        </div>
    </div>
</div>
<!-- End Modal effects-->


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
    let user_id = '{{$_GET["id"]??'
    '}}';
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
                url: "{{ route('payout.index',['id'=>$_GET['id']??'']) }}",
                data(d) {
                    d.from = '{{$_GET["from"] ?? '
                    '}}';
                    d.to = '{{$_GET["to"] ?? '
                    '}}';
                    d.status = '{{$_GET["status"] ?? '
                    '}}';

                },

            },

            dom: 'Blfrtip',
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox'
                },
                {
                    data: 'clients',
                    name: 'clients'
                },
                {
                    data: 'company',
                    name: 'company'
                },
                {
                    data: 'mis_transaction_type',
                    name: 'mis_transaction_type'
                },
                {
                    data: 'subproduct',
                    name: 'subproduct'
                },
                {
                    data: 'model',
                    name: 'model'
                },
                {
                    data: 'reg_no',
                    name: 'reg_no'
                },
                {
                    data: 'gwp',
                    name: 'gwp'
                },
                {
                    data: 'mis_amount_paid',
                    name: 'mis_amount_paid'
                },
                {
                    data: 'mis_premium',
                    name: 'mis_premium'
                },
                {
                    data: 'mis_commissionable_amount',
                    name: 'mis_commissionable_amount'
                },
                {
                    data: 'mis_percentage',
                    name: 'mis_percentage'
                },
                {
                    data: 'mis_commission',
                    name: 'mis_commission'
                },
                {
                    data: 'recovery',
                    name: 'recovery'
                },
                {
                    data: 'invoiced',
                    name: 'invoiced'
                },
            ]
        });
        $("#checkedAll").change(function() {
            if (this.checked) {
                $(".checkSingle").each(function() {
                    this.checked = true;
                });
            } else {
                $(".checkSingle").each(function() {
                    this.checked = false;
                });
            }
        });


        $('.generate-btn').click(function() {

            const ids = [];

            $("input:checkbox:checked").each(function(i) {
                ids.push($(this).val());

            });
            if (ids != '') {

                $.ajax({
                    url: "{{ route('getInvoiceDetail')}}",
                    method: "post",
                    data: {
                        ids: ids,
                        user_id: user_id
                    },
                    success: function(result) {
                        $('#advance_payout').val(result['advance_payout'])
                        $('#short_premium').val(result['short_premium'])
                        $('#total_Payout').val(result['total_Payout'])
                        $('#recovery_cases').val(result['recovery_cases'])
                        $('#user_id').val(user_id)
                        $('#policy_id').val(ids)
                    }
                });
                $('#invoice-modal').modal('show');

            } else {
                alert('CheckBox must not be empty');
            }
        });

    });
    $(document).on('click', '.get-invoice', function() {

        var id = $(this).data('id');
        if (id) {
            $.ajax({
                url: "{{ route('getInvoice')}}",
                method: "post",
                data: {
                    id: id,
                },
                success: function(result) {
                    console.log(result);
                    var html = `      <div class="row">
                        <div class="col-lg-6">
                        <span >TOTAL PAYOUT</span>
						<input type="text" class="form-control" value="${result.total_Payout}" readOnly name="total_Payout" id="total_Payout" >
                        </div>
						<div class="col-lg-6">
                        <span >SHORT PREMIUM</span>
						<input type="text" class="form-control" readOnly value="${result.short_premium}" name="short_premium" id="short_premium" >
                        </div>
						</div>
                        <div class="row">
                        <div class="col-lg-6">
						<span >RECOVERY CASES</span>
						<input type="text" class="form-control" readOnly value="${result.recovery_cases}" name="recovery_cases" id="recovery_cases" >
                        </div>
						<div class="col-lg-6">
						<span >Advance Payout</span>
						<input type="text" class="form-control" readOnly value="${result.advance_payout}" name="advance_payout" id="advance_payout" >
					
                        </div>
						</div>
                        <div class="row">
                        <div class="col-lg-6">
						<span >TO BE ADJUSTED</span>
						<input type="text" class="form-control" readOnly value="${result.adjusted}" name="adjusted" id="adjusted" >
                        </div>
						<div class="col-lg-6">
						<span >AMOUNT TO BE TRANSFERRED</span>
						<input type="text" class="form-control" readOnly value="${result.amount_transfer}" name="amount_transfer" id="amount_transfer" >
                        </div>
						</div>
                        <div class="row">
                        <div class="col-lg-6">
						<span >TDS %AGE</span>
						<input type="text" class="form-control" readOnly value="${result.tds}" name="tds" id="tds" >
                        </div>
						<div class="col-lg-6">
						<span >INVOICE AMOUNT</span>
						<input type="text" class="form-control" readOnly value="${result.invoice_amount}" name="invoice_amount" id="invoice_amount" >
                        </div>
						</div>
                        <div class="row">
                        <div class="col-lg-6">
						<span >Name</span>
						<input type="text" class="form-control" readOnly value="${result.name}" name="name" id="name" >
                        </div>
						<div class="col-lg-6">
						<span >Bank Detail</span>
						<input type="text" class="form-control" readOnly value="${result.bank_detail}" name="bank_detail" id="bank_detail" >
                        </div>
						</div>
                        <div class="row">
                        <div class="col-lg-6">
						<span >INVOICE DATE</span>
						<input type="date" class="form-control" readOnly value="${result.invoice_date}" name="invoice_date" id="invoice_date" >
                        </div>
						<div class="col-lg-6">
						<span >TRANSFER DATE</span>
						<input type="date" class="form-control" readOnly value="${result.transfer_date}" name="transfer_date" id="transfer_date" >
                        </div>
						</div>`;
                    $('#invoice-view').modal('show');
                    $('.modal-body').html(html)
                }
            });
        }
    });
    $(document).on('change', '.is_recovery', function() {
        var id = $(this).data('id');
        var value = $(this).val();
        $.ajax({
            url: "{{ route('getStatusChange')}}",
            method: "post",
            data: {
                id: id,
                value: value
            },
            success: function(result) {

            }
        });
    });
</script>
@endsection