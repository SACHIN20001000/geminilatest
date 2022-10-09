@extends('admin.layouts.app')

@section('content') 

<div class="container-fluid">

				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Policy</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ Profile</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
                        <div class="pe-1 mb-xl-0">
							<div class="btn-group dropdown">
								<button  class="modal-effect btn btn-main-primary ml_auto "
											data-bs-toggle="modal" href="#attachments"
											data-bs-effect="effect-super-scaled">Attachment</button>
							</div>
						</div>
                      
					</div>
				</div>
				<!-- breadcrumb -->


				<!-- row -->
				<div class="row row-sm">
				
					<div class="col-lg-12">
						<!-- <div class="row row-sm">
							<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="counter-icon bg-primary-transparent">
												<i class="icon-layers text-primary"></i>
											</div>
											<div class="ms-auto">
												<h5 class="tx-13">Orders</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">1,587</h2>
												<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success me-1"></i>increase</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="counter-icon bg-danger-transparent">
												<i class="icon-paypal text-danger"></i>
											</div>
											<div class="ms-auto">
												<h5 class="tx-13">Revenue</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">46,782</h2>
												<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success me-1"></i>increase</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="counter-icon bg-success-transparent">
												<i class="icon-rocket text-success"></i>
											</div>
											<div class="ms-auto">
												<h5 class="tx-13">Product sold</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">1,890</h2>
												<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success me-1"></i>increase</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-xl-3 col-lg-12 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="counter-status d-flex md-mb-0">
											<div class="counter-icon bg-success-transparent">
												<i class="icon-rocket text-success"></i>
											</div>
											<div class="ms-auto">
												<h5 class="tx-13">Product sold</h5>
												<h2 class="mb-0 tx-22 mb-1 mt-1">1,890</h2>
												<p class="text-muted mb-0 tx-11"><i class="si si-arrow-up-circle text-success me-1"></i>increase</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
						<div class="card">
							<div class="card-body">
								<div class="tabs-menu ">
									<!-- Tabs -->
									<ul class="nav nav-tabs profile navtab-custom panel-tabs">
										<li class="">
											<a href="#home" data-bs-toggle="tab" class="active" aria-expanded="true"> <span class="visible-xs"><i class="las la-user-circle tx-16 me-1"></i></span> <span class="hidden-xs">Details</span> </a>
										</li>
										<li class="">
											<a href="#profile" data-bs-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="las la-images tx-15 me-1"></i></span>
												<span class="hidden-xs">Attachment</span> </a>
										</li>
										
									</ul>
								</div>
								<div class="tab-content border-start border-bottom border-right border-top-0 p-4 br-dark">
									<div class="tab-pane active" id="home">
                                    <div class="row row-xs align-items-center mg-b-20">
                                            @if(!empty($policy->lead->holder_name))
                                            <div class="col-lg-4">
                                                            <p class="mg-b-10 fw-bolder" id="holder_name">Polciy Holder Name</p>
                                                                            <p class="mg-b-10"> {{$policy->lead->holder_name}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->lead->phone))
                                            <div class="col-lg-4">
                                                            <p class="mg-b-10 fw-bolder" id="phone">Phone Number</p>
                                                                            <p class="mg-b-10"> {{$policy->lead->phone}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->lead->email))
                                            <div class="col-lg-4">
                                                            <p class="mg-b-10 fw-bolder" id="email">Email</p>
                                                                            <p class="mg-b-10"> {{$policy->lead->email}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->lead->insurance_id))
                                            <div class="col-lg-4">
                                                            <p class="mg-b-10 fw-bolder" id="insurance_id">Insurance</p>
                                                                            <p class="mg-b-10"> {{$policy->lead->insurances->name ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->lead->product_id))
                                            <div class="col-lg-4">
                                                            <p class="mg-b-10 fw-bolder" id="product_id">Product</p>
                                                                            <p class="mg-b-10"> {{$policy->lead->products->name ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->lead->subproduct_id))
                                            <div class="col-lg-4">
                                                            <p class="mg-b-10 fw-bolder" id="subproduct_id">Sub Product</p>
                                                                            <p class="mg-b-10"> {{$policy->lead->subProduct->name ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->lead->remark))
                                            <div class="col-lg-4">
                                                            <p class="mg-b-10 fw-bolder" id="remark">Remarks</p>
                                                                            <p class="mg-b-10"> {{$policy->lead->remark ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->company_id))
                                            <div class="col-lg-4">
                                                            <p class="mg-b-10 fw-bolder" id="company_id">Company</p>
                                                                            <p class="mg-b-10"> {{$policy->company->name ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->channel_name))
                                            <div class="col-lg-4">
                                                            <p class="mg-b-10 fw-bolder" id="channel_name">Channel Name</p>
                                                                            <p class="mg-b-10"> {{$policy->channel_name ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->policy_no))
                                            <div class="col-lg-4">
                                                            <p class="mg-b-10 fw-bolder" id="policy_no">Polciy Number</p>
                                                                            <p class="mg-b-10"> {{$policy->policy_no ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->case_type))
                                            <div class="col-lg-4">
                                                            <p class="mg-b-10 fw-bolder" id="case_type">Case Type</p>
                                                                            <p class="mg-b-10"> {{$policy->case_type ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->net_premium))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="net_premium">Net Premium</p>
                                                                            <p class="mg-b-10"> {{$policy->net_premium ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->gst))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="gst">GST</p>
                                                                            <p class="mg-b-10"> {{$policy->gst ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->gwp))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="gwp">GWP</p>
                                                                            <p class="mg-b-10"> {{$policy->gwp ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->od_premium))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="od_premium">OD Premium</p>
                                                                            <p class="mg-b-10"> {{$policy->od_premium ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->add_on_premium))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="add_on_premium">Add On Premium</p>
                                                                            <p class="mg-b-10"> {{$policy->add_on_premium ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->tp_premium))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="tp_premium">Tp Premium</p>
                                                                            <p class="mg-b-10"> {{$policy->tp_premium ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->pa))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="pa">PA</p>
                                                                            <p class="mg-b-10"> {{$policy->pa ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->others))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="others">Others</p>
                                                                            <p class="mg-b-10"> {{$policy->others ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->gross_premium))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="gross_premium">Gross Premium</p>
                                                                            <p class="mg-b-10"> {{$policy->gross_premium ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->basic_premium))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="basic_premium">Basic Premium</p>
                                                                            <p class="mg-b-10"> {{$policy->basic_premium ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->terrorism_premium))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="terrorism_premium">Terrorism Premium</p>
                                                                            <p class="mg-b-10"> {{$policy->terrorism_premium ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->requirement))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="requirement">Requirement</p>
                                                                            <p class="mg-b-10"> {{$policy->requirement ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->client_name))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="client_name">Client Name</p>
                                                                            <p class="mg-b-10"> {{$policy->client_name ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->address))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="address">Address</p>
                                                                            <p class="mg-b-10"> {{$policy->address ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->remarks))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="remarks">Remarks</p>
                                                                            <p class="mg-b-10"> {{$policy->remarks ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->type))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="type">Type</p>
                                                                            <p class="mg-b-10"> {{$policy->type ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->commodity_type))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="commodity_type">Commodity Type</p>
                                                                            <p class="mg-b-10"> {{$policy->commodity_type ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->mode_of_transport))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="mode_of_transport">Mode of Transport </p>
                                                                            <p class="mg-b-10"> {{$policy->mode_of_transport ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->cover_type))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="cover_type">Cover Type </p>
                                                                            <p class="mg-b-10"> {{$policy->cover_type ?? ''}}</p>

                                            </div>
                                            @endif
                                           
                                            @if(!empty($policy->per_sending_limit))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="per_sending_limit">Per Sending Limit </p>
                                                                            <p class="mg-b-10"> {{$policy->per_sending_limit ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->per_location_limit))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="per_location_limit">Per Location Limit </p>
                                                                            <p class="mg-b-10"> {{$policy->per_location_limit ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->estimate_annual_sum))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="estimate_annual_sum">Estimate Annual Sum </p>
                                                                            <p class="mg-b-10"> {{$policy->estimate_annual_sum ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->basic_of_valuation))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="basic_of_valuation">Basic Of Valuation</p>
                                                                            <p class="mg-b-10"> {{$policy->basic_of_valuation ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->policy_period))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="policy_period">Policy Period</p>
                                                                            <p class="mg-b-10"> {{$policy->policy_period ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->start_date))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="start_date">Start Date</p>
                                                                            <p class="mg-b-10"> {{$policy->start_date ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->expiry_date))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="expiry_date">Expiry Date</p>
                                                                            <p class="mg-b-10"> {{$policy->expiry_date ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->commodity_details))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="commodity_details">Commodity Details</p>
                                                                            <p class="mg-b-10"> {{$policy->commodity_details ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->packing_description))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="packing_description">Packing Description</p>
                                                                            <p class="mg-b-10"> {{$policy->packing_description ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->libality))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="libality">Liability</p>
                                                                            <p class="mg-b-10"> {{$policy->libality ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->policy_type))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="policy_type">Polciy Type</p>
                                                                            <p class="mg-b-10"> {{$policy->policy_type ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->liability_industrial))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="liability_industrial">Liability Industrial</p>
                                                                            <p class="mg-b-10"> {{$policy->liability_industrial ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->liability_nonindustrial))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="liability_nonindustrial">Liability Non Industrial</p>
                                                                            <p class="mg-b-10"> {{$policy->liability_nonindustrial ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->liability_act))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="liability_act">Liability Act</p>
                                                                            <p class="mg-b-10"> {{$policy->liability_act ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->professional_indeminity))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="professional_indeminity">Professional Indeminity</p>
                                                                            <p class="mg-b-10"> {{$policy->professional_indeminity ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->comprehensive_general_liability))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="comprehensive_general_liability">Comprehensive General Liability</p>
                                                                            <p class="mg-b-10"> {{$policy->comprehensive_general_liability ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->wc_policy))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="wc_policy">Wc Policy</p>
                                                                            <p class="mg-b-10"> {{$policy->wc_policy ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->pincode))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="pincode">Pincode</p>
                                                                            <p class="mg-b-10"> {{$policy->pincode ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->industry_type))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="industry_type">Industry Type</p>
                                                                            <p class="mg-b-10"> {{$policy->industry_type ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->worker_number))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="worker_number">Number Of Worker</p>
                                                                            <p class="mg-b-10"> {{$policy->worker_number ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->job_profile))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="job_profile">Job Profile</p>
                                                                            <p class="mg-b-10"> {{$policy->job_profile ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->salary_per_month))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="salary_per_month">Salery Per Month</p>
                                                                            <p class="mg-b-10"> {{$policy->salary_per_month ?? ''}}</p>

                                            </div>
                                            @endif
                                           
                                            @if(!empty($policy->add_on_cover))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="add_on_cover">Add On Cover</p>
                                                                            <p class="mg-b-10"> {{$policy->add_on_cover ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->medical_extension))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="medical_extension">Medical Extension</p>
                                                                            <p class="mg-b-10"> {{$policy->medical_extension ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->occupation_disease))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="occupation_disease">Occupation diseases</p>
                                                                            <p class="mg-b-10"> {{$policy->occupation_disease ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->compressed_air_disease))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="compressed_air_disease">Compressed Air diseases</p>
                                                                            <p class="mg-b-10"> {{$policy->compressed_air_disease ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->terrorism_cover))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="terrorism_cover">Terrorism Cover</p>
                                                                            <p class="mg-b-10"> {{$policy->terrorism_cover ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->sub_contractor_cover))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="sub_contractor_cover">Sub Contrator Cover</p>
                                                                            <p class="mg-b-10"> {{$policy->sub_contractor_cover ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->multiple_location))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="multiple_location">Multiple Location</p>
                                                                            <p class="mg-b-10"> {{$policy->multiple_location ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->occupancy))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="occupancy">Occupancy</p>
                                                                            <p class="mg-b-10"> {{$policy->occupancy ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->occupancy_tarriff))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="occupancy_tarriff">Occupancy Tarriff</p>
                                                                            <p class="mg-b-10"> {{$policy->occupancy_tarriff ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->particular))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="particular">Particular</p>
                                                                            <p class="mg-b-10"> {{$policy->particular ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->building))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="building">Building</p>
                                                                            <p class="mg-b-10"> {{$policy->building ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->plant_machine))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="plant_machine">Plant Machine</p>
                                                                            <p class="mg-b-10"> {{$policy->plant_machine ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->furniture_fixure))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="furniture_fixure">Furniture Fixure</p>
                                                                            <p class="mg-b-10"> {{$policy->furniture_fixure ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->stock_in_process))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="stock_in_process">Stock In Process</p>
                                                                            <p class="mg-b-10"> {{$policy->stock_in_process ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->finished_stock))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="finished_stock">Finished Stock</p>
                                                                            <p class="mg-b-10"> {{$policy->finished_stock ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->other_contents))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="other_contents">Other Contents</p>
                                                                            <p class="mg-b-10"> {{$policy->other_contents ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->clain_in_last_three_year))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="clain_in_last_three_year">Clain In Last Three  Year</p>
                                                                            <p class="mg-b-10"> {{$policy->clain_in_last_three_year ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->loss_details))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="loss_details">Loss Details</p>
                                                                            <p class="mg-b-10"> {{$policy->loss_details ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->loss_in_amount))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="loss_in_amount">Loss Amount</p>
                                                                            <p class="mg-b-10"> {{$policy->loss_in_amount ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->loss_date))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="loss_date">Loss Date</p>
                                                                            <p class="mg-b-10"> {{$policy->loss_date ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->measures_taken_after_loss))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="measures_taken_after_loss">Measures Taken After Loss</p>
                                                                            <p class="mg-b-10"> {{$policy->measures_taken_after_loss ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->address_risk_location))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="address_risk_location">Address Risk Location</p>
                                                                            <p class="mg-b-10"> {{$policy->address_risk_location ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->cover_opted))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="cover_opted">Cover Opted</p>
                                                                            <p class="mg-b-10"> {{$policy->cover_opted ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->policy_inception_date))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="policy_inception_date">Policy Inception Date</p>
                                                                            <p class="mg-b-10"> {{$policy->policy_inception_date ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->tenure))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="tenure">Tenure</p>
                                                                            <p class="mg-b-10"> {{$policy->tenure ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->construction_type))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="construction_type">Construction Type</p>
                                                                            <p class="mg-b-10"> {{$policy->construction_type ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->age_of_building))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="age_of_building">Age Of Building</p>
                                                                            <p class="mg-b-10"> {{$policy->age_of_building ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->basement_for_building))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="basement_for_building">Basement For Building</p>
                                                                            <p class="mg-b-10"> {{$policy->basement_for_building ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->basement_for_content))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="basement_for_content">Basement For Content</p>
                                                                            <p class="mg-b-10"> {{$policy->basement_for_content ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->claims))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="claims">Claims</p>
                                                                            <p class="mg-b-10"> {{$policy->claims ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->building_carpet_area))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="building_carpet_area">Building Carpet Area</p>
                                                                            <p class="mg-b-10"> {{$policy->building_carpet_area ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->building_cost_of_construction))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="building_cost_of_construction">Building Cost Of Construction</p>
                                                                            <p class="mg-b-10"> {{$policy->building_cost_of_construction ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->building_sum_insured))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="building_sum_insured">Building Sum Insured</p>
                                                                            <p class="mg-b-10"> {{$policy->building_sum_insured ?? ''}}</p>

                                            </div>
                                            @endif
                                           
                                            @if(!empty($policy->content_sum_insured))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="content_sum_insured">Content Sum Insured</p>
                                                                            <p class="mg-b-10"> {{$policy->content_sum_insured ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->rent_alternative_accommodation))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="rent_alternative_accommodation">Rent Alternative Accommodation</p>
                                                                            <p class="mg-b-10"> {{$policy->rent_alternative_accommodation ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->health_type))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="health_type">Health Type</p>
                                                                            <p class="mg-b-10"> {{$policy->health_type ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->fresh))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="fresh">Fresh</p>
                                                                            <p class="mg-b-10"> {{$policy->fresh ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->portability))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="portability">Portability</p>
                                                                            <p class="mg-b-10"> {{$policy->portability ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->dob))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="dob">Date Of Birth</p>
                                                                            <p class="mg-b-10"> {{$policy->dob ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->pre_existing_disease))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="pre_existing_disease">Pre Existing Disease</p>
                                                                            <p class="mg-b-10"> {{$policy->pre_existing_disease ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->hospitalization_history))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="hospitalization_history">Hospitalization History</p>
                                                                            <p class="mg-b-10"> {{$policy->hospitalization_history ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->upload_discharge_summary))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="upload_discharge_summary">Upload Discharge Summary</p>
                                                                            <p class="mg-b-10"> {{$policy->upload_discharge_summary ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->dob_sr_most_member))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="dob_sr_most_member">Dob Of Senior Most Member</p>
                                                                            <p class="mg-b-10"> {{$policy->dob_sr_most_member ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->dob_self))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="dob_self">Dob Of Self</p>
                                                                            <p class="mg-b-10"> {{$policy->dob_self ?? ''}}</p>

                                            </div>
                                            @endif
                                           
                                            @if(!empty($policy->dob_spouse))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="dob_spouse">Dob Of Spouse</p>
                                                                            <p class="mg-b-10"> {{$policy->dob_spouse ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->dob_child))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="dob_child">Dob Of Child</p>
                                                                            <p class="mg-b-10"> {{$policy->dob_child ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->dob_father))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="dob_father">Dob Of Father</p>
                                                                            <p class="mg-b-10"> {{$policy->dob_father ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->dob_mother))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="dob_mother">Dob Of Mother</p>
                                                                            <p class="mg-b-10"> {{$policy->dob_mother ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->sum_insured))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="sum_insured">Sum Insured</p>
                                                                            <p class="mg-b-10"> {{$policy->sum_insured ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->visiting_country))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="visiting_country">Visiting Country</p>
                                                                            <p class="mg-b-10"> {{$policy->visiting_country ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->date_of_departure))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="date_of_departure">Date Of Departure</p>
                                                                            <p class="mg-b-10"> {{$policy->date_of_departure ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->date_of_arrival))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="date_of_arrival">Date Of Arrival</p>
                                                                            <p class="mg-b-10"> {{$policy->date_of_arrival ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->no_of_days))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="no_of_days">No Of Days</p>
                                                                            <p class="mg-b-10"> {{$policy->no_of_days ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->no_person))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="no_person">No Of Person</p>
                                                                            <p class="mg-b-10"> {{$policy->no_person ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->passport_datails))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="passport_datails">Passport Details</p>
                                                                            <p class="mg-b-10"> {{$policy->passport_datails ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->make))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="make">Make</p>
                                                                            <p class="mg-b-10"> {{$policy->makes->name ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->model))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="model">Model</p>
                                                                            <p class="mg-b-10"> {{$policy->model ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->cubic_capacity))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="cubic_capacity">Cubic Capacity</p>
                                                                            <p class="mg-b-10"> {{$policy->cubic_capacity ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->bussiness_type))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="bussiness_type">Bussiness Type</p>
                                                                            <p class="mg-b-10"> {{$policy->bussiness_type ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->rto))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="rto">RTO</p>
                                                                            <p class="mg-b-10"> {{$policy->rto ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->reg_no))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="reg_no">Registration Number</p>
                                                                            <p class="mg-b-10"> {{$policy->reg_no ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->mfr_year))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="mfr_year">MFR Year</p>
                                                                            <p class="mg-b-10"> {{$policy->mfr_year ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->reg_date))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="reg_date">Registration Date</p>
                                                                            <p class="mg-b-10"> {{$policy->reg_date ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->claims_in_existing_policy))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="claims_in_existing_policy">Claims In Existing Policy</p>
                                                                            <p class="mg-b-10"> {{$policy->claims_in_existing_policy ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->ncb_in_existing_policy))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="ncb_in_existing_policy">NCB In Existing Policy</p>
                                                                            <p class="mg-b-10"> {{$policy->ncb_in_existing_policy ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->gcv_type))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="gcv_type">GCV Type</p>
                                                                            <p class="mg-b-10"> {{$policy->gcv_type ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->gvw))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="gvw">GVW</p>
                                                                            <p class="mg-b-10"> {{$policy->gvw ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->fuel_type))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="fuel_type">Fuel Type</p>
                                                                            <p class="mg-b-10"> {{$policy->fuel_type ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->passenger_carrying_capacity))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="passenger_carrying_capacity">Passenger Carrying Capacity</p>
                                                                            <p class="mg-b-10"> {{$policy->passenger_carrying_capacity ?? ''}}</p>

                                            </div>
                                            @endif
                                           
                                            @if(!empty($policy->category))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="category">Category</p>
                                                                            <p class="mg-b-10"> {{$policy->category ?? ''}}</p>

                                            </div>
                                            @endif
                                            @if(!empty($policy->varriant))
                                            <div class="col-lg-4 feild">
                                                            <p class="mg-b-10 fw-bolder" id="varriant">Varriant</p>
                                                                            <p class="mg-b-10"> {{$policy->varriants->name ?? ''}}</p>

                                            </div>
                                            @endif
                                           
                                   
                                    </div>
									</div>
									<div class="tab-pane" id="profile">
										<div class="row">
											<table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Creted By 
                                                        </th>
                                                        <th>
                                                            Creted At 
                                                        </th>
                                                        <th>
                                                            File Name 
                                                        </th>
                                                        <th>
                                                          Type 
                                                        </th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($policy->attachments))
                                                        @foreach($policy->attachments as $attachment)
                                                        <tr>
                                                        <td>{{$attachment->users->name ?? ''}}</td>
                                                        <td>{{$attachment->created_at}}</td>
                                                        <td><a href="{{URL::asset('attachments')}}/{{$attachment->file_name}}" target="_blank">{{$attachment->file_name}}</a></td>
                                                        <td>{{$attachment->type}}</td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
										</div>
									</div>
							
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>   
          
           	<!-- attachment effects -->
    <div class="modal fade" id="attachments">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Attachments</h6><button aria-label="Close" class="close"
							data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
                    <form action="{{route('leadAttachment')}}" method="POST" enctype="multipart/form-data">
                        @csrf
					<div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h6>Upload</h6>
                                <input type="file" name="attachment[]" required id="attachment" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <h6>Type</h6>
                                
                                <select name="type[]" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="Attachment">Attachment</option>
                                    <option value="RC">RC</option>
                                    <option value="Previous Year Policy">Previous Year Policy</option>
                                    <option value="Invoice Copy">Invoice Copy</option>
                                    <option value="Renewals">Renewals</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="attach-content"></div>
                         <span id="add-attach-multi" class="btn btn-info">
                            Add More
                         </span>
                         
                         <input type="hidden" name="lead_id" value="{{$policy->lead->id ?? ''}}">
                         <input type="hidden" name="policy_id" value="{{$policy->id ?? ''}}">
					</div>
					<div class="modal-footer">
						<button class="btn ripple btn-primary save-status" type="submit">Save changes</button>
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
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.table').dataTable();
    let subproduct= "{{$policy->subProduct->name ?? ''}}";
    if(subproduct != ''){
                subproduct= $.trim(subproduct).toLowerCase();
                changeFeild(subproduct);    
            }
            $('.filter-btn').click(function(){
                $('.filter-box').toggleClass("hidden");
            })
            $('#add-attach-multi').click(function(){
                $('.attach-content').append('<div class="row"><div class="col-lg-6"><h6>Upload</h6><input type="file" required name="attachment[]" id="attachment" class="form-control"></div><div class="col-lg-6"><h6>Type</h6><select name="type[]"required class="form-control"><option value="">Select</option> <option value="Attachment">Attachment</option><option value="RC">RC</option><option value="Previous Year Policy">Previous Year Policy</option><option value="Invoice Copy">Invoice Copy</option><option value="Renewals">Renewals</option><option value="Other">Other</option></select></div></div>');
            })



    });
    function changeFeild(subproduct){
    if(subproduct == 'others' || subproduct == 'cpm' || subproduct == 'car'){
                 $('.feild').hide()
                 $('#requirement').parent('div').show();   
                 $('#client_name').parent('div').show();   
                 $('#address').parent('div').show();      
                 $('#remarks').parent('div').show();      
                }
                if(subproduct == 'marine'){
                 $('.feild').hide()
                 $('#type').parent('div').show();   
                 $('#client_name').parent('div').show();   
                 $('#address').parent('div').show(); 
                 $('#commodity_type').parent('div').show(); 
                 $('#mode_of_transport').parent('div').show(); 
                 $('#cover_type').parent('div').show(); 
                 $('#per_sending_limit').parent('div').show(); 
                 $('#per_location_limit').parent('div').show(); 
                 $('#estimate_annual_sum').parent('div').show(); 
                 $('#basic_of_valuation').parent('div').show(); 
                 $('#policy_period').parent('div').show(); 
                 $('#start_date').parent('div').show(); 
                 $('#expiry_date').parent('div').show(); 
                 $('#commodity_details').parent('div').show(); 
                 $('#packing_description').parent('div').show(); 
                 $('#remarks').parent('div').show(); 
                 $('#net_premium').parent('div').show(); 
                 $('#gst').parent('div').show(); 
                 $('#gwp').parent('div').show(); 
                  
                }
                if(subproduct == 'liability'){
                 $('.feild').hide()
                 $('#libality').parent('div').show();   
                 $('#policy_type').parent('div').show();   
                 $('#liability_industrial').parent('div').show(); 
                 $('#liability_nonindustrial').parent('div').show(); 
                 $('#liability_act').parent('div').show(); 
                 $('#professional_indeminity').parent('div').show(); 
                 $('#comprehensive_general_liability').parent('div').show(); 
                 $('#net_premium').parent('div').show(); 
                 $('#gst').parent('div').show(); 
                 $('#gwp').parent('div').show(); 
                  
                }
                if(subproduct == 'wc'){
                 $('.feild').hide()
                 $('#wc_policy').parent('div').show();   
                 $('#client_name').parent('div').show();   
                 $('#address').parent('div').show();      
                 $('#pincode').parent('div').show(); 
                 $('#industry_type').parent('div').show(); 
                 $('#worker_number').parent('div').show(); 
                 $('#policy_period').parent('div').show(); 
                 $('#start_date').parent('div').show(); 
                 $('#expiry_date').parent('div').show(); 
                 $('#job_profile').parent('div').show();
                 $('#remakrs').parent('div').show();
                 $('#salary_per_month').parent('div').show();
                 $('#add_on_cover').parent('div').show();
                 $('#medical_extension').parent('div').show();
                 $('#occupation_disease').parent('div').show();
                 $('#compressed_air_disease').parent('div').show();
                 $('#terrorism_cover').parent('div').show();
                 $('#sub_contractor_cover').parent('div').show();
                 $('#multiple_location').parent('div').show();
                 $('#net_premium').parent('div').show(); 
                 $('#gst').parent('div').show(); 
                 $('#gwp').parent('div').show(); 
                  
                }
                if(subproduct == 'fire' || subproduct == 'burglary'){
                 $('.feild').hide()
                 $('#client_name').parent('div').show();   
                 $('#address').parent('div').show();      
                 $('#pincode').parent('div').show(); 
                 $('#remakrs').parent('div').show(); 
                 $('#occupancy').parent('div').show(); 
                 $('#occupancy_tarriff').parent('div').show(); 
                 $('#particular').parent('div').show(); 
                 $('#building').parent('div').show(); 
                 $('#plant_machine').parent('div').show();
                 $('#furniture_fixure').parent('div').show();
                 $('#stock_in_process').parent('div').show();
                 $('#finished_stock').parent('div').show();
                 $('#other_contents').parent('div').show();
                 $('#clain_in_last_three_year').parent('div').show();
                 $('#loss_details').parent('div').show();
                 $('#loss_in_amount').parent('div').show();
                 $('#loss_date').parent('div').show();
                 $('#measures_taken_after_loss').parent('div').show();
                 $('#basic_premium').parent('div').show(); 
                 $('#terrorism_premium').parent('div').show(); 
                 $('#net_premium').parent('div').show(); 
                 $('#gst').parent('div').show(); 
                 $('#gwp').parent('div').show(); 
                  
                }
                if(subproduct == 'home'){
                 $('.feild').hide()
                 $('#client_name').parent('div').show();   
                 $('#address_risk_location').parent('div').show();      
                 $('#cover_opted').parent('div').show(); 
                 $('#policy_inception_date').parent('div').show(); 
                 $('#tenure').parent('div').show(); 
                 $('#construction_type').parent('div').show(); 
                 $('#age_of_building').parent('div').show(); 
                 $('#basement_for_building').parent('div').show(); 
                 $('#basement_for_content').parent('div').show();
                 $('#claims').parent('div').show();
                 $('#building_carpet_area').parent('div').show();
                 $('#building_cost_of_construction').parent('div').show();
                 $('#building_sum_insured').parent('div').show();
                 $('#content_sum_insured').parent('div').show();
                 $('#rent_alternative_accommodation').parent('div').show();
                 $('#loss_in_amount').parent('div').show();
                 $('#loss_date').parent('div').show();
                 $('#measures_taken_after_loss').parent('div').show();
                 $('#basic_premium').parent('div').show(); 
                 $('#terrorism_premium').parent('div').show(); 
                 $('#net_premium').parent('div').show(); 
                 $('#gst').parent('div').show(); 
                 $('#gwp').parent('div').show(); 
                  
                }
                if(subproduct == 'health'){
                 $('.feild').hide()
                 $('#fresh').parent('div').show();   
                 $('#portability').parent('div').show();      
                 $('#dob').parent('div').show(); 
                 $('#pre_existing_disease').parent('div').show(); 
                 $('#hospitalization_history').parent('div').show(); 
                 $('#upload_discharge_summary').parent('div').show(); 
                 $('#dob_sr_most_member').parent('div').show(); 
                 $('#dob_self').parent('div').show(); 
                 $('#dob_spouse').parent('div').show();
                 $('#dob_child').parent('div').show();
                 $('#dob_father').parent('div').show();
                 $('#dob_mother').parent('div').show();
                 $('#sum_insured').parent('div').show();
                 $('#net_premium').parent('div').show(); 
                 $('#gst').parent('div').show(); 
                 $('#gwp').parent('div').show(); 
                  
                }
                if(subproduct == 'travel'){
                 $('.feild').hide()
                 $('#sum_insured').parent('div').show();   
                 $('#visiting_country').parent('div').show();      
                 $('#date_of_departure').parent('div').show(); 
                 $('#date_of_arrival').parent('div').show(); 
                 $('#no_of_days').parent('div').show(); 
                 $('#no_person').parent('div').show(); 
                 $('#passport_datails').parent('div').show(); 
                 $('#dob_self').parent('div').show(); 
                 $('#dob_spouse').parent('div').show();
                 $('#dob_child').parent('div').show();
                 $('#dob_father').parent('div').show();
                 $('#dob_mother').parent('div').show();
                 $('#sum_insured').parent('div').show();
                 $('#net_premium').parent('div').show(); 
                 $('#gst').parent('div').show(); 
                 $('#gwp').parent('div').show(); 
                  
                }
                if(subproduct == 'pvr'){
                 $('.feild').hide()
                 $('#make').parent('div').show();   
                 $('#varriant').parent('div').show(); 
                 $('#model').parent('div').show();      
                 $('#cubic_capacity').parent('div').show(); 
                 $('#bussiness_type').parent('div').show(); 
                 $('#remakrs').parent('div').show(); 
                 $('#rto').parent('div').show(); 
                 $('#reg_no').parent('div').show(); 
                 $('#mfr_year').parent('div').show(); 
                 $('#reg_date').parent('div').show();
                 $('#claims_in_existing_policy').parent('div').show();
                 $('#ncb_in_existing_policy').parent('div').show();
                 $('#od_premium').parent('div').show();
                 $('#add_on_premium').parent('div').show();
                 $('#tp_premium').parent('div').show();
                 $('#pa').parent('div').show();
                 $('#others').parent('div').show();
                 $('#net_premium').parent('div').show(); 
                 $('#gst').parent('div').show(); 
                 $('#gross_premium').parent('div').show(); 
                  
                }
                if(subproduct == 'gcv'){
                 $('.feild').hide()
                 $('#gcv_type').parent('div').show();   
                 $('#gvw').parent('div').show();   
                 $('#make').parent('div').show();  
                 $('#varriant').parent('div').show();  
                 $('#model').parent('div').show();      
                 $('#bussiness_type').parent('div').show(); 
                 $('#remakrs').parent('div').show();
                 $('#mfr_year').parent('div').show(); 
                 $('#reg_date').parent('div').show();
                 $('#claims_in_existing_policy').parent('div').show();
                 $('#ncb_in_existing_policy').parent('div').show();
                 $('#od_premium').parent('div').show();
                 $('#add_on_premium').parent('div').show();
                 $('#tp_premium').parent('div').show();
                 $('#pa').parent('div').show();
                 $('#others').parent('div').show();
                 $('#net_premium').parent('div').show(); 
                 $('#gst').parent('div').show(); 
                 $('#gross_premium').parent('div').show(); 
                  
                }
                if(subproduct == 'pcv'){
                 $('.feild').hide()
                 $('#fuel_type').parent('div').show();   
                 $('#passenger_carrying_capacity').parent('div').show();   
                 $('#category').parent('div').show();   
                 $('#make').parent('div').show();  
                 $('#varriant').parent('div').show();  
                 $('#model').parent('div').show();      
                 $('#bussiness_type').parent('div').show(); 
                 $('#remakrs').parent('div').show();
                 $('#mfr_year').parent('div').show(); 
                 $('#reg_date').parent('div').show();
                 $('#claims_in_existing_policy').parent('div').show();
                 $('#ncb_in_existing_policy').parent('div').show();
                 $('#od_premium').parent('div').show();
                 $('#add_on_premium').parent('div').show();
                 $('#tp_premium').parent('div').show();
                 $('#pa').parent('div').show();
                 $('#others').parent('div').show();
                 $('#net_premium').parent('div').show(); 
                 $('#gst').parent('div').show(); 
                 $('#gross_premium').parent('div').show(); 
                  
                }
                if(subproduct == 'tw'){
                 $('.feild').hide()
                 
                 $('#make').parent('div').show();
                 $('#varriant').parent('div').show();    
                 $('#model').parent('div').show();      
                 $('#bussiness_type').parent('div').show(); 
                 $('#remakrs').parent('div').show();
                 $('#mfr_year').parent('div').show(); 
                 $('#reg_date').parent('div').show();
                 $('#claims_in_existing_policy').parent('div').show();
                 $('#ncb_in_existing_policy').parent('div').show();
                 $('#od_premium').parent('div').show();
                 $('#add_on_premium').parent('div').show();
                 $('#tp_premium').parent('div').show();
                 $('#pa').parent('div').show();
                 $('#others').parent('div').show();
                 $('#net_premium').parent('div').show(); 
                 $('#gst').parent('div').show(); 
                 $('#gross_premium').parent('div').show(); 
                  
                }
     

}
</script>
@endsection