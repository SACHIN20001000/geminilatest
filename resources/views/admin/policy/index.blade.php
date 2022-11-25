@extends('admin.layouts.app')

@section('content') 

<div class="container-fluid">
  <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="  content-title mb-0 my-auto pe-4">Policy </h4>
                <div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown">
                            <a href="{{ route('policy.index',['id'=> 1]) }}" class=" @if(isset($_GET['id']) && $_GET['id'] == 1) btn btn-warning @else btn btn-info @endif ml_auto" 
											>MIS (<?php echo new_policy() ?>)</a>
							</div>
						</div>
                        <div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown">
                            <a  href="{{ route('policy.index',['id'=> 2]) }}" class=" @if(isset($_GET['id']) && $_GET['id'] == 2) btn btn-warning @else btn btn-info @endif  ml_auto" 
											>Renewals (<?php echo renew_policy() ?>)</a>
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
                     
                            <a  class="btn btn-main-primary renew-btn "
											 style="color:#fff"  
											>Mail</a>
						
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
                                    @if(isset($_GET['id']) && $_GET['id'] == 2)
                                    <p class="mg-b-10">Follow Up Date</p>
                                 <input type="date" name="follow_up" id="" class="form-control" value="{{isset($_GET['follow_up']) ? $_GET['follow_up'] : ''}}">
                                    @else
                                    <p class="mg-b-10">Status</p>
                                    <select name="is_paid"  class="form-control">
                                        <option value="">Select</option>
                                        <option value="1" {{ (isset($_GET['is_paid']) && (1 == $_GET['is_paid'])) ? 'selected' : '' }}>Paid</option>
                                        <option value="0" {{ (isset($_GET['is_paid']) && (0 == $_GET['is_paid'])) ? 'selected' : '' }}>Pending</option>

                                    </select>
                                    @endif
                             
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
                    <form action="" method="get" >
                    <select name="sort" class="sort-table">
                        <option value="10" {{ (isset($_GET['sort']) && (10 == $_GET['sort'])) ? 'selected' : '' }}>10</option>
                        <option value="50" {{ (isset($_GET['sort']) && (50 == $_GET['sort'])) ? 'selected' : '' }}>50</option>
                        <option value="100" {{ (isset($_GET['sort']) && (100 == $_GET['sort'])) ? 'selected' : '' }}>100</option>
                        <option value="200" {{ (isset($_GET['sort']) && (200 == $_GET['sort'])) ? 'selected' : '' }}>200</option>
                        <option value="all" {{ (isset($_GET['sort']) && ('all' == $_GET['sort'])) ? 'selected' : '' }}>All</option>
                    </select>
                    <input type="hidden" name="id" value="{{isset($_GET['id']) ? $_GET['id'] : ''}}">
                    <button type="submit" class="submit-sort" style="display:none;"></button>
                    </form>
                </div>
                <div class="card-body">
              
                    <!-- Listing all data in user tables -->
                    <div class="table-responsive border-top userlist-table">
                        <table class="table card-table table-striped table-vcenter text-nowrap mb-0" id="datatable">
                            <thead>
                                <tr>
                                @if(isset($_GET['id']) && $_GET['id'] == 2)
                                <th><input type="checkbox" name="all_checked" id="checkedAll" value="0"></th>
                                @endif  
                                <th class="wd-lg-20p"><span>Reference Name</span></th>
                                <th class="wd-lg-20p"><span>Policy Holder Name</span></th>
                                <th class="wd-lg-20p"><span>Trasaction Type</span></th>
                                <th class="wd-lg-20p"><span>Sub Product</span></th>
                                <th class="wd-lg-20p"><span>Due date</span></th>
                                @if(isset($_GET['id']) && $_GET['id'] == 2)
                                <th class="wd-lg-20p"><span>Followup Date</span></th>
                                <th class="wd-lg-20p"><span>Attachment</span></th>
                                @endif
                                <th class="wd-lg-20p"><span>Status</span></th>
                                <th class="wd-lg-20p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($leads->count())
                                @foreach($leads as $lead)
                                <tr style="@if($lead->mark_read == 0)  font-weight: bold; @endif">
                                @if(isset($_GET['id']) && $_GET['id'] == 2)
                                <td><input type="checkbox" name="checked"  class="checkSingle checkLead" data-id="{{$lead->id}}"></td>
                                @endif
                                <td>{{$lead->users->name ?? ''}}</td>
                                    <td> <a  href="{{route('policy.show',$lead->id)}}" >
                                    {{$lead->lead->holder_name ?? $lead->holder_name}} </a></td>
                                    <td> <a  href="{{route('policy.show',$lead->id)}}" >{{$lead->mis_transaction_type ?? ''}}</a></td>
                                    <td> <a  href="{{route('policy.show',$lead->id)}}" >{{$lead->subProduct->name ?? ''}}</a></td>
                                    <td> <a  href="{{route('policy.show',$lead->id)}}" >{{!empty($lead->expiry_date) ? date('d-m-Y',strtotime($lead->expiry_date))  : ''}}</a></td>
                                    @if(isset($_GET['id']) && $_GET['id'] == 2)
                                    <td><input type="date" name="follow_up" value="{{$lead->follow_up ?? ''}}" data-id="{{$lead->id ?? ''}}" class="form-control follow_up"></td>
                                   
                                    <td><input type="file" data-id="{{$lead->id ?? ''}}" class="form-control renew-att">
                                    @if(!empty($lead->attachments))
                                                        @foreach($lead->attachments as $key => $attachment)
                                                       @if($attachment->type == 'Renewal')
                                                        <a href="{{URL::asset('attachments')}}/{{$attachment->file_name}}" target="_blank">View</a>
                                                        <a href="{{route('delAttachment',$attachment->id)}}"
                                                class="remove_us"
                                                title="Delete Lead"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                data-method="DELETE"
                                                data-confirm-title="Please Confirm"
                                                data-confirm-text="Are you sure that you want to delete this Attachment?"
                                                data-confirm-delete="Yes, delete it!">
                                               X
                                            </a>
                                                        @endif
                                                        @endforeach
                                                    @endif
                                </td>
                                @endif
                                   
                                    <td>
                                        
                                    @if(isset($_GET['id']) && $_GET['id'] == 2)
                                        <select name="renew_status" id="renew_status" data-id="{{$lead->id}}" class="form-control renew_status">
                                           <option value="">Select Below</option>
                                            <option value="FOLLOW UP" {{isset($lead) && $lead->renew_status == 'FOLLOW UP' ? 'selected' : ''}}>FOLLOW UP</option>
                                            <option value="VEHICLE SOLD" {{isset($lead) && $lead->renew_status == 'VEHICLE SOLD' ? 'selected' : ''}}>VEHICLE SOLD</option>
                                            <option value="NOT INTERESTED" {{isset($lead) && $lead->renew_status == 'NOT INTERESTED' ? 'selected' : ''}}>NOT INTERESTED</option>
                                           
                                            <option value="CLOSED" {{isset($lead) && $lead->renew_status == 'CLOSED' ? 'selected' : ''}}>CLOSED</option>
                                        </select>
                                    @else
                                    {{$lead->renew_status}}
                                    @endif
                                    </td>
                      
                                    <td>
                                    <button class="btn btn-sm btn-info btn-b common-btn" data-id="{{$lead->id ?? ''}}" data-email="{{$lead->users->email ?? ''}}" data-expiry='{{ date("d-m-Y", strtotime($lead->expiry_date)) ?? ""}}' data-customer="{{$lead->holder_name ?? $lead->lead->holder_name}}"  data-product="{{$lead->products->name ?? ''}}" data-subproduct="{{$lead->insurances->name ?? ''}}" data-policy="{{$lead->reg_no ?? ''}}" data-name="{{$lead->users->name ?? ''}}"  data-bs-toggle="modal" data-bs-effect="effect-super-scaled"  data-toggle="tooltip" title="Send Mail!">📩</button>
                                    @if(isset($_GET['id']) && $_GET['id'] == 1)
                                    <a  href="{{route('policy.edit',$lead->id)}}" class="btn btn-sm btn-info btn-b"  data-toggle="tooltip" title="Edit Policy"><i class="las la-pen"></i>
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
                                            </a>
                                            @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                         
                        </table>
                        {{$leads->appends(['expiry_from' => $_GET['expiry_from']??'','expiry_to' => $_GET['expiry_to']??'','product' => $_GET['product']??'','users' => $_GET['users']??'','search_anything' => $_GET['search_anything']??'','status' => $_GET['status']??'','id'=>$_GET['id']?? '','sort' => $_GET['sort'] ??'10'])->links("vendor.pagination.bootstrap-4")}}
                     
                     
                  
                    </div>

                </div>
            </div>
        </div>
        <!-- COL END -->
    </div>

</div>

<div class="modal fade show" id="common-btn" aria-modal="true" role="dialog" >
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Common Email</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
					</div>
                    <form  method="POST" action="{{route('endrosment')}}" >
                        		@csrf
                        		<div class="modal-body">
                        <div class="row">
                 
                          
                            <div class="col-lg-12">
                                <h6>Type</h6>
                                <select name="type" class="form-control endrosment" required>
                                    <option value="">Select</option>
                                    <option value="email">Email</option>
                                    <option value="sms">SMS</option>
                                    <option value="whatsapp">Whatsapp</option>
                                </select>
                               
                                  <label>To </label>
                                  <input type="email" name="to" class="form-control" id="policy_single_email" >
                                
                               
                                  <label>CC </label>
                                  <input type="email" name="cc" class="form-control" >
                                  <input type="hidden" name="policy_id" id="policy_single_id">
                             
                              
                                  <label>Content </label>
                                 <textarea name="content" class="form-control " id="person_name" cols="30" rows="10">

                                 </textarea>
                               
                            </div>
                            
                        </div>
                      
                         
					<div class="modal-footer">
						<button class="btn ripple btn-primary save-status" type="submit">Save changes</button>
						<button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
					</div>
                    </form>
				</div>
			</div>
		</div>
			</div>
		</div>
    
        <div class="modal fade show" id="renew-modal" aria-modal="true" role="dialog" >
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Bulk Email</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
					</div>
                   
					<div class="modal-footer">
						<button class="btn ripple btn-primary bulkEmail" type="submit">Save</button>
						<button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
					</div>
                 
				
			</div>
		</div>
			</div>
		</div>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
    $('.editor').summernote({
   
        height: 400,
     
    });
        $('.filter-btn').click(function(){
                $('.filter-box').toggleClass("hidden");
            })
        $('.filter').click(function(){
               var url = "{{url('admin/leads')}}";
               window.location.replace(url);

            })

            $('.renew_status').change(function() {
            var status =$(this).find(":selected").val();
            var policy_id =$(this).attr('data-id');
                $.ajax
                ({
                    type: "Post",
                    url: "{{route('renew_status')}}",
                    data: {policy_id:policy_id,status:status},
                    success: function(result)
                    {
                        
                    }
                });  

             });

             $('.common-btn').click(function(){
                var policy_id =$(this).attr('data-id');
       
                var email =$(this).attr('data-email');
                var person_name =$(this).attr('data-name');
                var customer_name =$(this).attr('data-customer');
                var product_name =$(this).attr('data-product');
                var sub_product =$(this).attr('data-subproduct');
                var req_no =$(this).attr('data-policy');
                var expiry =$(this).attr('data-expiry');
                var meesage=
`Dear Sir/Madam,
This is for your information following case is due Please find details below:
    Customer Name :${customer_name} 
    Product :${product_name}
    Sub Product:${sub_product}
    Registration No. : ${req_no}
    Expiry Date : ${expiry}
This is an automated email. Please do not reply 
Regards 
GCS Services`;
                $('#policy_single_id').val(policy_id);
                $('#policy_single_email').val(email);
                $('#person_name').text(meesage);
                $('#common-btn').modal('show');
             })
            $('.endrosment').change(function() {
            var type =$(this).find(":selected").val();
           console.log('type',type);
           
            if(type == 'email'){
                // $('.dynamic-data').append('')
            }
              

             });
        $('.renew-btn').click(function() {
                    
                    const ids= [];
                    $(".checkLead:checked").each(function(i) {
                        ids.push($(this).data('id'));
                    });
                 
                    if (ids != '') {
                    $('#renew-modal').modal('show');

                        $('.bulkEmail').click(function() {
                            $.ajax
                            ({
                                type: "Post",
                                url: "{{route('bulkEmail')}}",
                                data: {id:ids},
                                success: function(result)
                                {
                                    $('#renew-modal').modal('hide');
                                }
                            });  

             });
                    } else {
                        alert('CheckBox and Lead Owner must not be empty');
                    }
                    });
    });
    $(document).on('change','.follow_up',function(){
        var id = $(this).data('id');
        var date=$(this).val();
        $.ajax
        ({
            type: "Post",
            url: "{{route('renewFolloup')}}",
            data: {id:id,date:date},
            success: function(result)
            {
                
            }
        }); 
    });
    $(document).on('change','.renew-att',function(){
        var id = $(this).data('id');
        var file  = $(this).prop("files")[0];
       
        var form = new FormData();

    // Adding the image to the form
    form.append("image", file);
    form.append("policy_id", id);
        console.log(form);
        $.ajax({
        url: "{{route('renewAttachment')}}",
        type: "POST",
        data:  form,
        contentType: false,
        processData:false,
        success: function(result){
            location.reload()
        }
    });
    });
    $(document).on('change','.sort-table',function(){
        $('.submit-sort').click()
  
    });
</script>
@endsection
