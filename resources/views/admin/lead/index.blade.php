@extends('admin.layouts.app')

@section('content') 

<div class="container-fluid">
  <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">All Leads</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ list</span>
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
        <div class="row row-sm filter-box hidden">
							<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
                                    <p class="mg-b-10">Basic Premiun</p>
                                    <input type="text" name="basic_premium" value="{{isset($policy) ? $policy->basic_premium : ''}}" class="form-control">
                                    <p class="mg-b-10">Basic Premiun</p>
                                    <input type="text" name="basic_premium" value="{{isset($policy) ? $policy->basic_premium : ''}}" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
                                        <p class="mg-b-10">Basic Premiun</p>
                                        <input type="text" name="basic_premium" value="{{isset($policy) ? $policy->basic_premium : ''}}" class="form-control">
                                        <p class="mg-b-10">Basic Premiun</p>
                                        <input type="text" name="basic_premium" value="{{isset($policy) ? $policy->basic_premium : ''}}" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
                                        <p class="mg-b-10">Basic Premiun</p>
                                        <input type="text" name="basic_premium" value="{{isset($policy) ? $policy->basic_premium : ''}}" class="form-control">
                                        <p class="mg-b-10">Basic Premiun</p>
                                        <input type="text" name="basic_premium" value="{{isset($policy) ? $policy->basic_premium : ''}}" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
                                    <p class="mg-b-10">Basic Premiun</p>
                                        <input type="text" name="basic_premium" value="{{isset($policy) ? $policy->basic_premium : ''}}" class="form-control">
                                        <p class="mg-b-10">Basic Premiun</p>
                                        <input type="text" name="basic_premium" value="{{isset($policy) ? $policy->basic_premium : ''}}" class="form-control">
									</div>
								</div>
							</div>
						</div>
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
                                <th class="wd-lg-20p"><span>Holder Name</span></th>
                                <th class="wd-lg-20p"><span>Phone No</span></th>
                                <th class="wd-lg-20p"><span>Email</span></th>
                                <th class="wd-lg-20p"><span>Insurance</span></th>
                                <th class="wd-lg-20p"><span>Product</span></th>
                                <th class="wd-lg-20p"><span>Sub Product</span></th>
                                <th class="wd-lg-20p"><span>Created</span></th>
                                <th class="wd-lg-20p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($leads->count())
                                @foreach($leads as $lead)
                                <tr>
                                    <td>{{$lead->holder_name}}</td>
                                    <td>{{$lead->phone}}</td>
                                    <td>{{$lead->email}}</td>
                                    <td>{{$lead->insurances->name ?? ''}}</td>
                                    <td>{{$lead->products->name ?? ''}}</td>
                                    <td>{{$lead->subProduct->name ?? ''}}</td>
                                    <td>{{$lead->created_at}}</td>
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
                                    {{$leads->appends(['storeId' => '1'])->links("vendor.pagination.bootstrap-4")}}
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

<!-- model end -->



@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('.filter-btn').click(function(){
                $('.filter-box').toggleClass("hidden");
            })
    //     var table = $('#datatable').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         ajax: {
    //                 url: "{{ route('insurance.index') }}",
                       
    //                 },
    //         columns: [
    //           {data: 'name', name: 'name'},
    //         {data: 'created_at', name: 'created_at'},
    //         {data: 'action', name: 'action', orderable: false, searchable: false},
    //         ]
    //     });

    });
</script>
@endsection
