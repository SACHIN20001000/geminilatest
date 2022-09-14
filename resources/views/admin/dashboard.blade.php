@extends('admin.layouts.app')

@section('content')
	<!-- container -->
    <div class="container-fluid">

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
          <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
          <p class="mg-b-0">Sales monitoring dashboard.</p>
        </div>
    </div>
    <div class="main-dashboard-header-right">
        <div>
            <label class="tx-13">Customer Ratings</label>
            <div class="main-star">
                <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i> <span>(1)</span>
            </div>
        </div>
           <div>
               <a href="#">
            <label class="tx-13">Total Users</label>
            <h5>1 </h5>
            </a>
        </div>
    </div>
</div>
<!-- breadcrumb -->

    <!-- row -->
    <div class="row row-sm">

    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                <a href="#">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">TOTAL CATEGORY</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 fw-bold mb-1 text-white">1 Records</h4>
                                <!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
                            </div>
                            <span class="float-end my-auto ms-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <!-- <span class="text-white op-7"> +427</span> -->
                            </span>
                        </div>
                    </div>
                    </a>
                </div>
                <!-- <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span> -->
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                <a href="#">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">TOTAL PRODUCT</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 fw-bold mb-1 text-white">1 Records</h4>
                                <!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
                            </div>
                            <span class="float-end my-auto ms-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                                <!-- <span class="text-white op-7"> -23.09%</span> -->
                            </span>
                        </div>
                    </div>
                    </a>
                </div>
                <!-- <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span> -->
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                <a href="#">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">TOTAL CHOWHUB PRODUCT</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 fw-bold mb-1 text-white">1 Records</h4>
                                <!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
                            </div>
                            <span class="float-end my-auto ms-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <!-- <span class="text-white op-7"> 52.09%</span> -->
                            </span>
                        </div>
                    </div>
                    </a>
                </div>
                <!-- <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span> -->
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                <a href="#">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">TOTAL ORDER</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 fw-bold mb-1 text-white">1 Records</h4>
                                <!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
                            </div>
                            <span class="float-end my-auto ms-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                                <!-- <span class="text-white op-7"> -152.3</span> -->
                            </span>
                        </div>
                    </div>
                    </a>
                </div>
                <!-- <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span> -->
            </div>
        </div>

    </div>
    <!-- row closed -->
  <!-- row -->
  <div class="row row-sm">

<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
            <a href="#">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">TOTAL LITTERHUB PRODUCTS</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 fw-bold mb-1 text-white">1 Records</h4>
                            <!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
                        </div>
                        <span class="float-end my-auto ms-auto">
                            <i class="fas fa-arrow-circle-up text-white"></i>
                            <!-- <span class="text-white op-7"> +427</span> -->
                        </span>
                    </div>
                </div>
                </a>
            </div>
            <!-- <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span> -->
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
            <a href="#">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">TOTAL SOLUTIONHUB PRODUCT</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 fw-bold mb-1 text-white">1 Records</h4>
                            <!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
                        </div>
                        <span class="float-end my-auto ms-auto">
                            <i class="fas fa-arrow-circle-down text-white"></i>
                            <!-- <span class="text-white op-7"> -23.09%</span> -->
                        </span>
                    </div>
                </div>
                </a>
            </div>
            <!-- <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span> -->
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
            <a href="#">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">TOTAL PAGES</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 fw-bold mb-1 text-white">1 Records</h4>
                            <!-- <p class="mb-0 tx-12 text-white op-7">Compared to last week</p> -->
                        </div>
                        <span class="float-end my-auto ms-auto">
                            <i class="fas fa-arrow-circle-up text-white"></i>
                            <!-- <span class="text-white op-7"> 52.09%</span> -->
                        </span>
                    </div>
                </div>
                </a>
            </div>
            <!-- <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span> -->
        </div>
    </div>


</div>
<!-- row closed -->
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Order status</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 text-muted mb-0">Order Status and Tracking. Track your order from ship date to arrival. To begin, enter your order number.</p>
                </div>
                <div class="card-body">
                    <div class="total-revenue">
                        <div>
                          <h4>1</h4>
                          <label><span class="bg-primary"></span>success</label>
                        </div>
                        <div>
                          <h4>1</h4>
                          <label><span class="bg-danger"></span>Processing</label>
                        </div>
                        <div>
                          <h4>1</h4>
                          <label><span class="bg-warning"></span>Pending</label>
                        </div>
                      </div>
                    <div id="bar" class="sales-bar mt-4"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xl-5">
							<div class="card">
								<div class="card-header pb-1">
									<h3 class="card-title mb-2">Sales Activity</h3>
									<p class="tx-12 mb-0 text-muted">Sales activities are the tactics that salespeople use to achieve their goals and objective</p>
								</div>
								<div class="product-timeline card-body pt-2 mt-1">
									<ul class="timeline-1 mb-0">
										<li class="mt-0" id="mrg-8"> <i class="ti-pie-chart bg-primary-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Total Products From All Type </span> <a href="#" class="float-end tx-11 text-muted"></a>
											<p class="mb-0 text-muted tx-12">1 Products</p>
										</li>
										<li class="mt-0" id="mrg-8"> <i class="mdi mdi-cart-outline bg-danger-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Total Orders</span> <a href="#" class="float-end tx-11 text-muted"></a>
											<p class="mb-0 text-muted tx-12">1 Orders</p>
										</li>
										<li class="mt-0" id="mrg-8"> <i class="ti-bar-chart-alt bg-success-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Customer Reviews</span> <a href="#" class="float-end tx-11 text-muted"></a>
											<p class="mb-0 text-muted tx-12">1 reviews</p>
										</li>
										<li class="mt-0" id="mrg-8"> <i class="ti-wallet bg-warning-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Customer Visits</span> <a href="#" class="float-end tx-11 text-muted"></a>
											<p class="mb-0 text-muted tx-12">1 Users</p>
										</li>


									</ul>
								</div>
							</div>
						</div>
        </div>
    </div>
    <!-- row closed -->




</div>
<!-- /Container -->
@endsection
