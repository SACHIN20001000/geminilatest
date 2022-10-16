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
                            <a  class="modal-effect btn btn-main-primary ml_auto "
											data-bs-effect="effect-super-scaled"  
											>Generate Invoice</a>
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
                                <th class="wd-lg-20p"><span>Commissionable Amount</span></th>
                                <th class="wd-lg-20p"><span>PAYOUT %GE</span></th>
                                <th class="wd-lg-20p"><span>PAYOUT</span></th>
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
						<h6 class="modal-title">Invoice</h6><button aria-label="Close" class="close"
							data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
                 <form   action="{{ route('invoiceStore')}}" method="POST" enctype="multipart/form-data">
                        @csrf
					<div class="modal-body">
                        <div class="row">
                        <div class="col-lg-6">
                        <h6 class="mg-t-10 mg-b-0">TOTAL PAYOUT</h6>
						<input type="text" class="form-control" name="total_Payout" id="total_Payout" >
                        </div>
						<div class="col-lg-6">
                        <h6 class="mg-t-10 mg-b-0">SHORT PREMIUM</h6>
						<input type="text" class="form-control" name="short_premium" id="short_premium" >
                        </div>
						</div>
                        <div class="row">
                        <div class="col-lg-6">
						<h6 class="mg-t-10 mg-b-0">RECOVERY CASES</h6>
						<input type="text" class="form-control" name="recovery_cases" id="recovery_cases" >
                        </div>
						<div class="col-lg-6">
						<h6 class="mg-t-10 mg-b-0">Advance Payout</h6>
						<input type="text" class="form-control" name="advance_payout" id="advance_payout" >
						<input type="hidden"  name="policy_id[]" id="policy_id">
						<input type="hidden"  name="user_id" id="user_id">
                        </div>
						</div>
                        <div class="row">
                        <div class="col-lg-6">
						<h6 class="mg-t-10 mg-b-0">TO BE ADJUSTED</h6>
						<input type="text" class="form-control" name="adjusted" id="adjusted" >
                        </div>
						<div class="col-lg-6">
						<h6 class="mg-t-10 mg-b-0">AMOUNT TO BE TRANSFERRED</h6>
						<input type="text" class="form-control" name="amount_transfer" id="amount_transfer" >
                        </div>
						</div>
                        <div class="row">
                        <div class="col-lg-6">
						<h6 class="mg-t-10 mg-b-0">TDS %AGE</h6>
						<input type="text" class="form-control" name="tds" id="tds" >
                        </div>
						<div class="col-lg-6">
						<h6 class="mg-t-10 mg-b-0">INVOICE AMOUNT</h6>
						<input type="text" class="form-control" name="invoice_amount" id="invoice_amount" >
                        </div>
						</div>
                        <div class="row">
                        <div class="col-lg-6">
						<h6 class="mg-t-10 mg-b-0">Name</h6>
						<input type="text" class="form-control" name="name" id="name" >
                        </div>
						<div class="col-lg-6">
						<h6 class="mg-t-10 mg-b-0">Bank Detail</h6>
						<input type="text" class="form-control" name="bank_detail" id="bank_detail" >
                        </div>
						</div>
                        <div class="row">
                        <div class="col-lg-6">
						<h6 class="mg-t-10 mg-b-0">INVOICE DATE</h6>
						<input type="date" class="form-control" name="invoice_date" id="invoice_date" >
                        </div>
						<div class="col-lg-6">
						<h6 class="mg-t-10 mg-b-0">TRANSFER DATE</h6>
						<input type="date" class="form-control" name="transfer_date" id="transfer_date" >
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


@endsection

@section('scripts')
<script type="text/javascript">
     let user_id='{{$_GET["id"]??''}}';
    $(document).ready(function () {
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
                       
                    },
            columns: [
            {data: 'checkbox', name: 'checkbox'},
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
            {data: 'invoice_id', name: 'invoice_id'},
            ]
        });
        $("#checkedAll").change(function() {
    if (this.checked) {
        $(".checkSingle").each(function() {
            this.checked=true;
        });
    } else {
        $(".checkSingle").each(function() {
            this.checked=false;
        });
    }
    });
    $('.generate-btn').click(function() {
 
 const ids= [];

 $("input:checkbox:checked").each(function(i) {
     ids.push($(this).val());

 });
 if (ids != '') {
   
     $.ajax({
         url: "{{ route('getInvoiceDetail')}}",
         method: "post",
                    data: {
                       ids: ids, 
                       user_id:user_id
                    },
         success: function(result) {
             $('#advance_payout').val(result['advance_payout'])
             $('#short_premium').val(result['short_premium'])
             $('#total_Payout').val(result['total_Payout']) 
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
    
</script>
@endsection
