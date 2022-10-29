@extends('admin.layouts.app')

@section('content') 

<div class="container-fluid">
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="  content-title mb-0 my-auto pe-4">All Payouts</h4>
                      
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
                
					</div>
    </div>
    <!-- breadcrumb -->
   
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
        <form action="" method="get">
                    <div class="row row-sm filter-box hidden">
       
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
                                   
                                    <p class="mg-b-10">Date from</p>
                                    <input type="date" name="from" value="{{$_GET['from'] ?? ''}}" class="form-control">
                                   
                                 
									</div>
								</div>
							</div>
       
							<div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
                                   
                                    <p class="mg-b-10">Date to</p>
                                    <input type="date" name="to" value="{{$_GET['to'] ?? ''}}" class="form-control">
                                 
									</div>
								</div>
							</div>
							
                            <div class="col-sm-12 col-xl-4 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
                                   
                                  
                                    <p class="mg-b-10">Status</p>
                                    <select name="status" class="form-control">
                                        <option value="">Select</option>
                                        <option value="PAYABLE">PAYABLE</option>
                                        <option value="RECIEVABLE">RECIEVABLE</option>
                                    </select>
									</div>
								</div>
							</div>
                            <div>
                                <button type="submit" class="btn btn-primary">Search</button>
                                <button class="btn btn-info filter">Filter</button>

                            </div>
                            
                        </div>
                    </form>
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
                                <th class="wd-lg-20p"><span>Reference</span></th>
                                <th class="wd-lg-20p"><span>Phone</span></th>
                                <th class="wd-lg-20p"><span>Email</span></th>
                                <th class="wd-lg-20p"><span>Payable/Receival</span></th>
                                <th class="wd-lg-20p"><span>Action</span></th>
                              
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
        $('.filter-btn').click(function(){
                $('.filter-box').toggleClass("hidden");
            })
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                    url: "{{ route('brokerPayout') }}",
                    data(d) {
                d.from = '{{$_GET["from"] ?? ''}}';
                d.to = '{{$_GET["to"] ?? ''}}';
                d.status = '{{$_GET["status"] ?? ''}}';
              	
            },
                    },
            columns: [
            {data: 'name', name: 'name'},
            {data: 'phone', name: 'phone'},
            {data: 'email', name: 'email'},
            {data: 'payable', name: 'payable'},
            {data: 'action', name: 'action'},
          
            ]
        });

    });
</script>
@endsection
