@extends('admin.layouts.app')

@section('content') 

<div class="container-fluid">
  <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="  content-title mb-0 my-auto pe-4">Leads</h4>
                <div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown">
                            <a href="{{ route('leads.index',['id'=> 1]) }}" class="btn btn-info ml_auto" 
											>New Leads</a>
							</div>
						</div>
                        <div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown">
                            <a  href="{{ route('leads.index',['id'=> 2]) }}" class="btn btn-info ml_auto" 
											>Quote Lead</a>
							</div>
						</div>
                        <div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown">
                            <a  href="{{ route('leads.index',['id'=> 3]) }}" class="btn btn-info ml_auto">Policy Issued</a>
							</div>
						</div>
                        <div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown ">
                            <a  href="{{ route('leads.index',['id'=> 4]) }}" class="btn btn-info ml_auto">Opportunities</a>
							</div>
						</div>
            </div>
        </div>
       
        <div class="d-flex my-xl-auto right-content">
						<div class="pe-1 mb-xl-0 filter-btn">
                        
							<button type="button" class="btn btn-info btn-icon me-2 btn-b"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pe-1 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon me-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pe-1 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon me-2"><i class="mdi mdi-refresh"></i></button>
						</div>
                        <div class="pe-1 mb-xl-0">
							<div class="btn-group dropdown assigned-btn">
                            <a  class="modal-effect btn btn-main-primary ml_auto "
											data-bs-effect="effect-super-scaled"  
											>Assign</a>
							</div>
						</div>
						<div class="mb-xl-0">
							<div class="btn-group dropdown">
                            <a class="btn btn-main-primary ml_auto" href="{{ route('leads.create') }}">Add Leads</a>
							</div>
						</div>
					</div>
    </div>
    <!-- breadcrumb -->
    <div class="card-body tableBody">
                  <div class="orderSearchHistory">
                    @include('admin.lead.search')
                  </div>
                  
              </div>

    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
        <form action="" method="get" >
        <div class="row row-sm filter-box hidden">
       
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
                                   
                                    <p class="mg-b-10">Expiry date from</p>
                                    <input type="date" name="expiry_from" value="{{isset($_GET['expiry_from']) ? $_GET['expiry_from'] : ''}}" class="form-control">
                                    <input type="hidden" name="id" value="{{isset($_GET['id']) ? $_GET['id'] : ''}}">
                                    <p class="mg-b-10">Expiry date to</p>
                                    <input type="date" name="expiry_to" value="{{isset($_GET['expiry_to']) ? $_GET['expiry_to'] : ''}}" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
                                   
                                    <p class="mg-b-10">Product</p>
                                  <select name="product" class="form-control">
                                    <option value="">Select</option>
                                    @if(isset($products) && $products->count())
                                                @foreach($products as $product)
                                                       <option value="{{$product->id}}" {{ (isset($_GET['product']) && $product->id == $_GET['product']) ? 'selected' : '' }}>{{$product->name}}</option>             
                                        @endforeach
                                    @endif
                                  </select>
                                    <p class="mg-b-10">Broker/Staff</p>
                                    <select name="users" class="form-control">
                                    <option value="">Select</option>
                                    @if(isset($users) && $users->count())
                                                @foreach($users as $user)
                                                       <option value="{{$user->id}}" {{ (isset($_GET['users']) && $user->id == $_GET['users']) ? 'selected' : '' }}>{{$user->name}}</option>             
                                        @endforeach
                                    @endif
                                  </select>
									</div>
								</div>
							</div>
                            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
                                   
                                    <p class="mg-b-10">Search Anything</p>
                                    <input type="text" name="search_anything" value="{{isset($_GET['search_anything']) ? $_GET['search_anything'] : ''}}" class="form-control">
                                    <p class="mg-b-10">Status</p>
                                    <select name="status"  class="form-control">
                                        <option value="">Select</option>
                                        <option value="PENDING/FRESH" {{ (isset($_GET['search_anything']) && "PENDING/FRESH" == $_GET['search_anything']) ? 'selected' : '' }} >PENDING/FRESH</option>
                                        <option value="IN PROCESS" {{ (isset($_GET['search_anything']) && "IN PROCESS" == $_GET['search_anything']) ? 'selected' : '' }}>IN PROCESS</option>
                                        <option value="MORE INFO REQUIRED" {{ (isset($_GET['search_anything']) && "MORE INFO REQUIRED" == $_GET['search_anything']) ? 'selected' : '' }} >MORE INFO REQUIRED</option>
                                        <option value="QUOTE GENERATED" {{ (isset($_GET['search_anything']) && "QUOTE GENERATED" == $_GET['search_anything']) ? 'selected' : '' }}>QUOTE GENERATED</option>
                                        <option value="RE-QUOTE" {{ (isset($_GET['search_anything']) && "RE-QUOTE" == $_GET['search_anything']) ? 'selected' : '' }}>RE-QUOTE</option>
                                        <option value="REJECTED" {{ (isset($_GET['search_anything']) && "REJECTED" == $_GET['search_anything']) ? 'selected' : '' }}>REJECTED</option>
                                        <option value="POLICY TO BE ISSUED" {{ (isset($_GET['search_anything']) && "POLICY TO BE ISSUED" == $_GET['search_anything']) ? 'selected' : '' }}>POLICY TO BE ISSUED</option>
                                        <option value="LINK GENERATED" {{ (isset($_GET['search_anything']) && "LINK GENERATED" == $_GET['search_anything']) ? 'selected' : '' }}>LINK GENERATED</option>
                                        <option value="LINK GENERATED BUT NOT PAID" {{ (isset($_GET['search_anything']) && "LINK GENERATED BUT NOT PAID" == $_GET['search_anything']) ? 'selected' : '' }}>LINK GENERATED BUT NOT PAID</option>
                                    
                                    </select>
									</div>
								</div>
							</div>
                            <div>
                                <button type="submit" class="btn btn-primary">Search</button>
                                <button  class="btn btn-info filter">Filter</button>

                            </div>
                            
                        </div>
                    </form>
            <div class="card">
                <div class="card-header pb-0">
                    <p class="tx-12 tx-gray-500 mb-2">Listing of All Leads...</p>
                </div>
                <div class="card-body">
              
                    <!-- Listing all data in user tables -->
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                            <thead>
                                <tr>
                                    
                                <th><input type="checkbox" name="all_checked" id="checkedAll" value="0"></th>
                                <th class="wd-lg-20p"><span>Holder Name</span></th>
                                <th class="wd-lg-20p"><span>Phone No</span></th>
                                <th class="wd-lg-20p"><span>Email</span></th>
                                <th class="wd-lg-20p"><span>Insurance</span></th>
                                <th class="wd-lg-20p"><span>Product</span></th>
                                <th class="wd-lg-20p"><span>Sub Product</span></th>
                                <th class="wd-lg-20p"><span>Created</span></th>
                                <th class="wd-lg-20p"><span>Status</span></th>
                                <th class="wd-lg-20p"><span>Assigned To</span></th>
                                <th class="wd-lg-20p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($leads->count())
                                @foreach($leads as $lead)
                                <tr>
                                    <td><input type="checkbox" name="checked"  class="checkSingle" value="{{$lead->id}}"> </td>
                                    <td>{{$lead->holder_name}}</td>
                                    <td>{{$lead->phone}}</td>
                                    <td>{{$lead->email}}</td>
                                    <td>{{$lead->insurances->name ?? ''}}</td>
                                    <td>{{$lead->products->name ?? ''}}</td>
                                    <td>{{$lead->subProduct->name ?? ''}}</td>
                                    <td>{{$lead->created_at}}</td>
                                    <td>{{$lead->status}}</td>
                                    <td>{{$lead->assigns->name ?? ''}}</td>
                                    <td><a  href="{{route('leads.show',$lead->id)}}" class="btn btn-sm btn-info btn-b"><i class="fa fa-eye"></i>
                        </a>   <a  href="{{route('leads.edit',$lead->id)}}" class="btn btn-sm btn-info btn-b"><i class="las la-pen"></i>
                        </a>  
                         <a href="{{route('leads.destroy',$lead->id)}}"
                                class="btn btn-sm btn-danger remove_us"
                                title="Delete Lead"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-method="DELETE"
                                data-confirm-title="Please Confirm"
                                data-confirm-text="Are you sure that you want to delete this Lead?"
                                data-confirm-delete="Yes, delete it!">
                                <i class="las la-trash"></i>
                            </a></td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                    {{$leads->appends(['expiry_from' => $_GET['expiry_from']??'','expiry_to' => $_GET['expiry_to']??'','product' => $_GET['product']??'','users' => $_GET['users']??'','search_anything' => $_GET['search_anything']??'','status' => $_GET['status']??'','id'=>$_GET['id']?? ''])->links("vendor.pagination.bootstrap-4")}}
                                    </td>
                                </tr>
                          
                            </tfoot>
                        </table>
                     
                     
                  
                    </div>

                </div>
            </div>
        </div>
        <!-- COL END -->
    </div>

</div>

	<!-- Modal effects -->
    <div class="modal fade" id="assign-model">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Assigned To Staff</h6><button aria-label="Close" class="close"
							data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<h6>Staff</h6>
						<select name="staff_id" id="staff_id" class="form-control staff_id">
                            <option value="">Select</option>
                        </select>
					</div>
					<div class="modal-footer">
						<button class="btn ripple btn-primary save-assign" type="button">Save changes</button>
						<button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal effects-->



@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('.filter-btn').click(function(){
                $('.filter-box').toggleClass("hidden");
            })
        $('.filter').click(function(){
               var url = "{{url('admin/leads')}}";
               window.location.replace(url);

            })

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
    // for ajax lead data closed
$('.assigned-btn').click(function() {
 
    const ids= [];
    $("input:checkbox:checked").each(function(i) {
        ids.push($(this).val());

    });
    if (ids != '') {
      
        $.ajax({
            url: "{{ route('getStaff')}}",
            type:'GET',
            success: function(result) {
                console.log(result);
                $('.staff_id').html(result);
                
                
            }
        });
        $('#assign-model').modal('show');
            $('.save-assign').click(function() {
            var staffId=  $("#staff_id option:selected").val();
            if(staffId != ''){
                $.ajax({
                    url: "{{ route('saveAssign') }}",
                    method: "post",
                    data: {
                        staffId: staffId,ids: ids
                    },
                    success: function(result) {
                        window.location.href =  window.location.href; 
                    }

                });
            }
              
            })
    } else {
        alert('CheckBox and Lead Owner must not be empty');
    }
});
    });
</script>
@endsection
