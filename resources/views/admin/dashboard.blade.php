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
        <!-- <div class="main-dashboard-header-right">
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
    </div> -->
    </div>
    <!-- breadcrumb -->

    <!-- row -->
    <div class="row row-sm">

        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <a href="{{ route('policy.index',['id'=> 1 , 'date' => 'today']) }}">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">TODAY NEW POLICY</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">{{$todayNewPolicy}}</h4>
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
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <a href="{{route('users.index',['id'=> 0, 'date' => 'today'])}}">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">TODAY NEW USER</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">{{$todayNewUser}}</h4>
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
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <a href="{{ route('policy.index',['id'=> 2 , 'date' => 'today']) }}">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">TODAY RENEWAL</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">{{$todayRenewal}}</h4>
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
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <a href="{{ route('invoice.verified',['id'=> 1,'date'=>'today'])  }}">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">TODAY INVOICE</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">{{$todayInvoice}}</h4>
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
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <a href="{{ route('policy.index',['id'=> 1 , 'date' => 'month']) }}">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">THIS MONTH POLICY</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">{{$thisMonthNewPolicy}}</h4>
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
        <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <a href="{{ route('policy.index',['id'=> 2 , 'date' => 'month']) }}">
                        <div class="">
                            <h6 class="mb-3 tx-12 text-white">THIS MONTH RENEWALS</h6>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex">
                                <div class="">
                                    <h4 class="tx-20 fw-bold mb-1 text-white">{{$thisMonthRenewal}}</h4>
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



    </div>
    <!-- row closed -->

    <div class="row row-sm">
        <div class="col-xl-4 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header pb-1">
                    <h3 class="card-title mb-2">Sales Activity</h3>
                    <p class="tx-12 mb-0 text-muted">Sales activities are the tactics that salespeople use to achieve their goals and objective</p>
                </div>
                <div class="product-timeline card-body pt-2 mt-1">
                    <ul class="timeline-1 mb-0">
                        <li class="mt-0 mrg-8"> <i class="ti-pie-chart bg-primary-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Total Products</span>
                            <p class="mb-0 text-muted tx-12">{{$totalSubProduct}} Products</p>
                        </li>
                        <li class="mt-0 mrg-8"> <i class="mdi mdi-cart-outline bg-danger-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Total Sales</span>
                            <p class="mb-0 text-muted tx-12">₹{{$totalSales}} Sales</p>
                        </li>
                        <li class="mt-0 mrg-8"> <i class="ti-bar-chart-alt bg-success-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Total Policy</span>
                            <p class="mb-0 text-muted tx-12">{{$totalPolicy}} </p>
                        </li>
                        <li class="mt-0 mrg-8"> <i class="ti-wallet bg-warning-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Total User</span>
                            <p class="mb-0 text-muted tx-12">{{$totalUser}} </p>
                        </li>
                        <li class="mt-0 mrg-8"> <i class="si si-eye bg-purple-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Total Invoice</span>
                            <p class="mb-0 text-muted tx-12">{{$totalInvoice}}</p>
                        </li>
                       
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12 col-lg-6">
            <div class="card">


                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">Today Policy Sales</p>
                                </div>
                                <h4 class="fw-bold mb-2">₹{{$todayPolicy ?? 0}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-primary-gradient wd-80p" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4 mt-md-0">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">Today Renewals Sales</p>
                                </div>
                                <h4 class="fw-bold mb-2">₹{{$todayRenewalPolicy ?? 0}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-danger-gradient wd-75" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">This Month Policy Sales</p>
                                </div>
                                <h4 class="fw-bold mb-2">₹{{$thisMonthPolicy ?? 0}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-primary-gradient wd-80p" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4 mt-md-0">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">Thi Month Renewals Sales</p>
                                </div>
                                <h4 class="fw-bold mb-2">₹{{$thisMonthRenewalPolicy ?? 0}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-danger-gradient wd-75" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">This Year Policy Sales</p>
                                </div>
                                <h4 class="fw-bold mb-2">₹{{$thisYearPolicy ?? 0}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-primary-gradient wd-80p" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4 mt-md-0">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">This year Renewals Sales</p>
                                </div>
                                <h4 class="fw-bold mb-2">₹{{$thisYearRenewalPolicy ?? 0}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-danger-gradient wd-75" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12 col-lg-6">
            <div class="card">


                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">Total Invoice</p>
                                </div>
                                <h4 class="fw-bold mb-2">{{$todayInvoice}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-primary-gradient wd-80p" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4 mt-md-0">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">Today Invoice Amount</p>
                                </div>
                                <h4 class="fw-bold mb-2">₹{{$todayInvoiceAmount}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-danger-gradient wd-75" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">This Month Invoice</p>
                                </div>
                                <h4 class="fw-bold mb-2">{{$thisMonthInvoice}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-primary-gradient wd-80p" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4 mt-md-0">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">This Month Amount</p>
                                </div>
                                <h4 class="fw-bold mb-2">₹{{$thisMonthInvoiceAmount}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-danger-gradient wd-75" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">This Year Invoice</p>
                                </div>
                                <h4 class="fw-bold mb-2">{{$thisYearInvoice}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-primary-gradient wd-80p" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="78"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4 mt-md-0">
                                <div class="d-flex align-items-center pb-2">
                                    <p class="mb-0">This Year Invoice Amount</p>
                                </div>
                                <h4 class="fw-bold mb-2">₹{{$thisYearInvoiceAmount}}</h4>
                                <div class="progress progress-style progress-sm">
                                    <div class="progress-bar bg-danger-gradient wd-75" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="45"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row row-sm row-deck">
            <div class="col-md-12 col-lg-4 col-xl-4">
                <div class="card card-dashboard-eight pb-2">
                    <h6 class="card-title">Your Top Countries</h6><span class="d-block mg-b-10 text-muted tx-12">Sales performance revenue based by country</span>
                    <div class="list-group border">
                        <div class="list-group-item border-top-0" id="br-t-0">
                            <i class="flag-icon flag-icon-us flag-icon-squared"></i>
                            <p>United States</p><span>₹1,671.10</span>
                        </div>
                        <div class="list-group-item">
                            <i class="flag-icon flag-icon-nl flag-icon-squared"></i>
                            <p>Netherlands</p><span>₹1,064.75</span>
                        </div>
                        <div class="list-group-item">
                            <i class="flag-icon flag-icon-gb flag-icon-squared"></i>
                            <p>United Kingdom</p><span>₹1,055.98</span>
                        </div>
                        <div class="list-group-item">
                            <i class="flag-icon flag-icon-ca flag-icon-squared"></i>
                            <p>Canada</p><span>₹1,045.49</span>
                        </div>
                        <div class="list-group-item">
                            <i class="flag-icon flag-icon-in flag-icon-squared"></i>
                            <p>India</p><span>₹1,930.12</span>
                        </div>
                        <div class="list-group-item border-bottom-0 mb-0">
                            <i class="flag-icon flag-icon-au flag-icon-squared"></i>
                            <p>Australia</p><span>₹1,042.00</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-8 col-xl-8">
                <div class="card card-table-two">
                    <div class=" card-header p-0 d-flex justify-content-between">
                        <h4 class="card-title mb-1">Your Most Recent Earnings</h4>
                        <a href="javascript:void(0);" class="tx-inverse" data-bs-toggle="dropdown"><i class="mdi mdi-dots-horizontal text-gray"></i></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);">Action</a>
                            <a class="dropdown-item" href="javascript:void(0);">Another
                                Action</a>
                            <a class="dropdown-item" href="javascript:void(0);">Something Else
                                Here</a>
                        </div>
                    </div>
                    <span class="tx-12 tx-muted mb-3 ">This is your most recent earnings for today's date.</span>
                    <div class="table-responsive country-table">
                        <table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-lg-25p">Date</th>
                                    <th class="wd-lg-25p tx-right">Sales Count</th>
                                    <th class="wd-lg-25p tx-right">Earnings</th>
                                    <th class="wd-lg-25p tx-right">Tax Witheld</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>05 Dec 2019</td>
                                    <td class="tx-right tx-medium tx-inverse">34</td>
                                    <td class="tx-right tx-medium tx-inverse">₹658.20</td>
                                    <td class="tx-right tx-medium tx-danger">-₹45.10</td>
                                </tr>
                                <tr>
                                    <td>06 Dec 2019</td>
                                    <td class="tx-right tx-medium tx-inverse">26</td>
                                    <td class="tx-right tx-medium tx-inverse">₹453.25</td>
                                    <td class="tx-right tx-medium tx-danger">-₹15.02</td>
                                </tr>
                                <tr>
                                    <td>07 Dec 2019</td>
                                    <td class="tx-right tx-medium tx-inverse">34</td>
                                    <td class="tx-right tx-medium tx-inverse">₹653.12</td>
                                    <td class="tx-right tx-medium tx-danger">-₹13.45</td>
                                </tr>
                                <tr>
                                    <td>08 Dec 2019</td>
                                    <td class="tx-right tx-medium tx-inverse">45</td>
                                    <td class="tx-right tx-medium tx-inverse">₹546.47</td>
                                    <td class="tx-right tx-medium tx-danger">-₹24.22</td>
                                </tr>
                                <tr>
                                    <td>09 Dec 2019</td>
                                    <td class="tx-right tx-medium tx-inverse">31</td>
                                    <td class="tx-right tx-medium tx-inverse">₹425.72</td>
                                    <td class="tx-right tx-medium tx-danger">-₹25.01</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <!-- row closed -->




</div>
<!-- /Container -->
@endsection