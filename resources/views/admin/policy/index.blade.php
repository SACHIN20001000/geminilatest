@extends('admin.layouts.app')

@section('content') 

<div class="container-fluid">
  <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="  content-title mb-0 my-auto pe-4">Policy</h4>
                <div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown">
                            <a href="{{ route('policy.index',['id'=> 1]) }}" class="btn btn-info ml_auto" 
											>New Policy</a>
							</div>
						</div>
                        <div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown">
                            <a  href="{{ route('policy.index',['id'=> 2]) }}" class="btn btn-info ml_auto" 
											>Renewals</a>
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
                       
						<div class="mb-xl-0">
							<div class="btn-group dropdown">
                            <a class="btn btn-main-primary ml_auto" href="{{ route('policy.create') }}">Add Policy</a>
							</div>
						</div>
					</div>
    </div>
    <!-- breadcrumb -->
    <div class="card-body tableBody">
                  <div class="orderSearchHistory">
                    @include('admin.policy.search')
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
                                    <select name="is_paid"  class="form-control">
                                        <option value="">Select</option>
                                        <option value="1" {{ (isset($_GET['is_paid']) && (1 == $_GET['is_paid'])) ? 'selected' : '' }}>Paid</option>
                                        <option value="0" {{ (isset($_GET['is_paid']) && (0 == $_GET['is_paid'])) ? 'selected' : '' }}>Pending</option>

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
                    <p class="tx-12 tx-gray-500 mb-2">Listing of All Policy...</p>
                </div>
                <div class="card-body">
              
                    <!-- Listing all data in user tables -->
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                            <thead>
                                <tr>
                                    
                                <th class="wd-lg-20p"><span>Client</span></th>
                                <th class="wd-lg-20p"><span>Phone No</span></th>
                                <th class="wd-lg-20p"><span>Email</span></th>
                                <th class="wd-lg-20p"><span>Insurance</span></th>
                                <th class="wd-lg-20p"><span>Product</span></th>
                                <th class="wd-lg-20p"><span>Sub Product</span></th>
                                <th class="wd-lg-20p"><span>Due date</span></th>
                                <th class="wd-lg-20p"><span>Status</span></th>
                                <th class="wd-lg-20p"><span>Payment</span></th>
                                <th class="wd-lg-20p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($leads->count())
                                @foreach($leads as $lead)
                                <tr>
                                    <td>{{$lead->lead->holder_name}}</td>
                                    <td>{{$lead->lead->phone}}</td>
                                    <td>{{$lead->lead->email}}</td>
                                    <td>{{$lead->insurances->name ?? ''}}</td>
                                    <td>{{$lead->products->name ?? ''}}</td>
                                    <td>{{$lead->subProduct->name ?? ''}}</td>
                                    <td>{{!empty($lead->expiry_date) ? date('d-m-Y',strtotime($lead->expiry_date))  : ''}}</td>
                                    <td>{{$lead->renew_status}}</td>
                                    <td>{{$lead->is_paid == 0 ? 'Pending' : 'Paid'}}</td>
                                    <td><a  href="{{route('policy.show',$lead->id)}}" class="btn btn-sm btn-info btn-b"><i class="fa fa-eye"></i>
                        </a>   <a  href="{{route('policy.edit',$lead->id)}}" class="btn btn-sm btn-info btn-b"><i class="las la-pen"></i>
                        </a>  
                         <a href="{{route('policy.destroy',$lead->id)}}"
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
    });
</script>
@endsection
