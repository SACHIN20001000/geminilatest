@extends('admin.layouts.app')

@section('content') 

<div class="container-fluid">

				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Remainder</h4>
						 
                        </div>
					</div>
				
				</div>
				<!-- breadcrumb -->


				<!-- row -->
				<div class="row row-sm">
				
					<div class="col-lg-12">
						
						<div class="card">
							<div class="card-body">
								<div class="tabs-menu ">
									<!-- Tabs -->
									<ul class="nav nav-tabs profile navtab-custom panel-tabs">
									
                                    <li class="">
										
                                                <a href="#one" data-bs-toggle="tab" class="active" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 me-1"></i></span> <span class="hidden-xs">Remainder 1 Day</span> </a>
										</li>
										<li class="">
											<a href="#five" data-bs-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-images tx-15 me-1"></i></span>
												<span class="hidden-xs">Remainder 5 Days</span> </a>
										</li>
										<li class="">
											<a href="#fifteen" data-bs-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-images tx-15 me-1"></i></span>
												<span class="hidden-xs">Remainder 15 Days</span> </a>
										</li>
										<li class="">
											<a href="#thirty" data-bs-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-images tx-15 me-1"></i></span>
												<span class="hidden-xs">Remainder 30 Days</span> </a>
										</li>
										
									</ul>
								</div>
								<div class="tab-content border-start border-bottom border-right border-top-0 p-4 br-dark">
                                <div class="tab-pane active" id="one">
                                            <form action="{{route('remainder.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                            
                                                        <div class="col-lg-12">
                                                            <h6>Message</h6>
                                                            
                                                            <textarea name="message" class="form-control editor"cols="30" rows="10">{{isset($remainderone) && $remainderone->type ==1 ? $remainderone->message : ''}}</textarea>
                                                            <input type="hidden" name="days" value="1">
                                                        </div>
                                                        
                                                </div>
                                                <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">Save changes</button>
                                        </form>
									</div>
									<div class="tab-pane" id="five">
                                            <form action="{{route('remainder.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                            
                                                        <div class="col-lg-12">
                                                            <h6>Message</h6>
                                                            
                                                            <textarea name="message" class="form-control editor"cols="30" rows="10">{{isset($remainder) && $remainder->type ==5 ? $remainder->message : ''}}</textarea>
                                                            <input type="hidden" name="days" value="5">
                                                        </div>
                                                        
                                                </div>
                                                <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">Save changes</button>
                                        </form>
									</div>
									<div class="tab-pane" id="fifteen">
                                            <form action="{{route('remainder.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                            
                                                        <div class="col-lg-12">
                                                            <h6>Message</h6>
                                                            
                                                            <textarea name="message" class="form-control editor"cols="30" rows="10">{{isset($remainderfifteen) && $remainderfifteen->type == 15 ? $remainderfifteen->message : ''}}</textarea>
                                                            <input type="hidden" name="days" value="15">
                                                        </div>
                                                        
                                                </div>
                                                <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">Save changes</button>
                                        </form>
									</div>
									<div class="tab-pane" id="thirty">
                                            <form action="{{route('remainder.store')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                            
                                                        <div class="col-lg-12">
                                                            <h6>Message</h6>
                                                            
                                                            <textarea name="message" class="form-control editor"cols="30" rows="10">{{isset($remainderthirty) && $remainderthirty->type ==30 ? $remainderthirty->message : ''}}</textarea>
                                                            <input type="hidden" name="days" value="30">
                                                        </div>
                                                        
                                                </div>
                                                <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">Save changes</button>
                                        </form>
									</div>
								
							
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>   
          
       
          
@endsection
@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
        $('.editor').summernote({
        toolbar: [
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['insert', ['link','image', 'doc', 'video']],
        ['misc', ['codeview']],
        ],
        height: 400,
     
    });
</script>

@endsection
