@extends('admin.layouts.app')

@section('content') 
<div class="card">
								<div class="card-header">
								</div>
								<div class="card-body">
									<div class="email-media">
										<div class="mt-0 d-sm-flex">
											
											<div class="media-body">
												<div class="float-end d-none d-md-flex fs-15">
                                                {{$endrosment->created_at}}
												</div>
												<div class="media-title  fw-bold mt-3">Created By:{{$endrosment->users->name ?? ''}} <span class="text-muted">( {{$endrosment->users->email ?? ''}} )</span></div>
												<small class="me-2 d-md-none">{{$endrosment->created_at}}</small>
												<small class="me-2 d-md-none"><i class="fe fe-star text-muted" data-bs-toggle="tooltip" title="" data-bs-original-title="Rated"></i></small>
												<small class="me-2 d-md-none"><i class="fa fa-reply text-muted" data-bs-toggle="tooltip" title="" data-bs-original-title="Reply"></i></small>
											</div>
										</div>
									</div>
									<div class="email-body mt-5">
										<h6>Previous Message</h6>
										<p>{{$endrosment->new_message  ?? ''}}</p>
										<h6>New Message</h6>

										<p>{{$endrosment->previous_message ?? ''}}</p>
									
										@if(!empty($endrosment->image))
										@foreach(json_decode($endrosment->image) as $image)
										<div class="email-attch">
											
											<div class="emai-img">
												<div class="d-sm-flex">
													<div class=" m-2">
														<a href="{{URL::asset('endrosment')}}/{{$image}}" target="_blank">View File</a>
														
													</div>
													
												</div>
											</div>
										</div>
										@endforeach
										@endif
										<hr>
									</div>
								</div>
								@if($endrosment->subEndrosment->count())
								@foreach($endrosment->subEndrosment as $endrosments)
								<div class="card-body">
								<h4 ><b>Commented</b></h4>
									<div class="email-media">
										<div class="mt-0 d-sm-flex">
											
											<div class="media-body">
												
												<div class="float-end d-none d-md-flex fs-15">
                                                {{$endrosments->created_at}}
												</div>
												<div class="media-title  fw-bold mt-3">Created By: {{$endrosment->users->name ?? ''}} <span class="text-muted">( {{$endrosment->users->email ?? ''}} )</span></div>
												<small class="me-2 d-md-none">{{$endrosments->created_at}}</small>
												<small class="me-2 d-md-none"><i class="fe fe-star text-muted" data-bs-toggle="tooltip" title="" data-bs-original-title="Rated"></i></small>
												<small class="me-2 d-md-none"><i class="fa fa-reply text-muted" data-bs-toggle="tooltip" title="" data-bs-original-title="Reply"></i></small>
											</div>
										</div>
									</div>
									<div class="eamil-body mt-5">
										<p>{{$endrosments->message??''}}</p>
									
										
										@if(!empty($endrosments->image))
										@foreach(json_decode($endrosments->image) as $Subimage)
										<div class="email-attch">
											
											<div class="emai-img">
												<div class="d-sm-flex">
													<div class=" m-2">
														<a href="{{URL::asset('endrosment')}}/{{$Subimage}}" target="_blank">View File</a>
														
													</div>
													
												</div>
											</div>
										</div>
										@endforeach
										
										@endif
										<hr>
									</div>
								</div>
								@endforeach
								@endif
								<div class="card-footer">
									<a class="btn btn-primary mt-1 mb-1 endrosment" href="#"><i class="fa fa-reply"></i> Reply</a>
									
								</div>
							</div>
        <div class="modal fade show" id="endrosment-btn" aria-modal="true" role="dialog" >
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Endrosment</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
					</div>
                    <form  method="POST" action="{{route('subEndrosment')}}"  enctype="multipart/form-data">
                        		@csrf
                        		<div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">                           
                                  <label>File </label>
                                  <input type="file" name="image[]" id="image" multiple class="form-control">
                                  <input type="hidden" name="lead_id" id="lead_id">
                             
                              
                                  <label>Message </label>
                                 <textarea name="message" class="form-control" id="message" cols="30" rows="10">

                                 </textarea>
                               
                            </div>
                            
                        </div>
                      
                         
					<div class="modal-footer">
						<button class="btn ripple btn-primary save-status" type="submit">Save</button>
						<button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
					</div>
                    </form>
				</div>
			</div>
		</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
		let id="{{$endrosment->id ?? ''}}";
        $('.endrosment').click(function(){
		$('#lead_id').val(id);
        $('#endrosment-btn').modal('show');
     })
    });
</script>
@endsection
