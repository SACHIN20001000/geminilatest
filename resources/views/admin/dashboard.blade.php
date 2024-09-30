@extends('admin.layouts.app') @section('content')
<style>
    #users-box {
        min-width: 140px;
        max-width: 220px;
        overflow: auto;
        max-height: 60px !important;
    }

    .filter-chart-box {
        display: flex;
        position: absolute;
        right: 24px;
        top: 16px;
        z-index: 1;
    }

    span.active-date {
        background: #fff;
        padding: 10px;
        position: absolute;
        margin-top: 14px;
        z-index: 10;
        border-radius: 6px;
        box-shadow: -8px 12px 18px 0 #dadee8;
        right: 20px;
    }

    span.active-date:before {
        content: "";
        position: absolute;
        bottom: 100%;
        right: 10px;
        margin-left: -5px;
        border-width: 8px;
        border-style: solid;
        border-color: transparent transparent #fff transparent;
        right: 20px;
    }
</style>
<!-- container -->
<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header my-3 justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">
                    Hi, welcome back!
                </h2>
                <p class="mg-b-0">Sales monitoring dashboard.</p>
            </div>
        </div>
        <div class="main-dashboard-header-right">
            @if(Auth::user()->hasRole('Staff') || Auth::user()->hasRole('Admin'))
            <div>
                <label class="tx-13">Total User</label>
                <h5 id="totalUser">0</h5>
            </div>
            <div>
                <label class="tx-13">Total Sales</label>
                <h5 id="totalSales">0</h5>
            </div>
            @endif
         
            <div class="date_picker">
                <div class="mb-xl-0 card p-2 mb-lg-2 mb-0">
                    <button
                        type="button"
                        class="bg-white btn btn-default float-right d-flex align-items-center gap-2 p-0"
                        id="daterange-btn">
                        <i class="far fa-calendar-alt"></i>
                        <div class="staticDays">Financial Year</div>
                        <div id="dynamicDate"></div>
                        <i class="fas fa-caret-down"></i>
                    </button>
                </div>
                <div id="reportrange"><span></span></div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 policy-click">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="row">
                        <h3 class="mb-2 tx-18 text-white">Sales</h3>
                        <div class="col">
                            <p class="mb-0 tx-12 text-white">Count</p>
                            <h4
                                class="tx-20 fw-bold mb-1 text-white"
                                id="policyCount">
                                0
                            </h4>
                        </div>
                        <div class="col">
                            <p class="mb-0 tx-12 text-white">Amount</p>
                            <h4
                                class="tx-20 fw-bold mb-1 text-white"
                                id="policyAmount">
                                0
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 renewal-click">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="row">
                        <h3 class="mb-2 tx-18 text-white">Renewal Details</h3>
                        <div class="col">
                            <p class="mb-0 tx-12 text-white">Count</p>
                            <h4
                                class="tx-20 fw-bold mb-1 text-white"
                                id="renewalCount">
                                0
                            </h4>
                        </div>
                        <div class="col">
                            <p class="mb-0 tx-12 text-white">Amount</p>
                            <h4
                                class="tx-20 fw-bold mb-1 text-white"
                                id="renewalAmount">
                                0
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 short-click">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="row">
                        <h3 class="mb-2 tx-18 text-white">Premium Short</h3>
                        <div class="col">
                            <p class="mb-0 tx-12 text-white">Count</p>
                            <h4
                                class="tx-20 fw-bold mb-1 text-white"
                                id="premiumShortCount">
                                0
                            </h4>
                        </div>
                        <div class="col">
                            <p class="mb-0 tx-12 text-white">Amount</p>
                            <h4
                                class="tx-20 fw-bold mb-1 text-white"
                                id="premiumShortAmount">
                                0
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12 premium-deposit-click">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="row">
                        <h3 class="mb-2 tx-18 text-white">Premium Deposit</h3>
                        <div class="col">
                            <p class="mb-0 tx-12 text-white">Count</p>
                            <h4
                                class="tx-20 fw-bold mb-1 text-white"
                                id="premiumDepositCount">
                                0
                            </h4>
                        </div>
                        <div class="col">
                            <p class="mb-0 tx-12 text-white">Amount</p>
                            <h4
                                class="tx-20 fw-bold mb-1 text-white"
                                id="premiumDepositAmount">
                                0
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <div class="row row-sm">
        <div class="col-xl-4 col-md-12 col-lg-6">
            <div class="card">
                <div class="product-timeline card-body pt-2 mt-1">
                    <ul class="timeline-1 mb-0">
                        <li class="mt-0 mrg-8 closed-renewal-click">
                            <i
                                class="si si-eye bg-purple-gradient text-white product-icon"></i>
                            <span class="fw-semibold mb-4 tx-14">Closed Renewals</span>
                            <p
                                class="mb-0 text-muted tx-12"
                                id="closedRenewal"></p>
                        </li>
                    </ul>
                    <div id="pie-container"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-md-12 col-lg-6">
            <div class="filter-chart-box">
                <div>
                    <select
                        name="chart_type"
                        id="chart_type"
                        class="form-control chart_type">
                        <option value="SubProduct">Product</option>
                        <option value="ChannelName">Channel Wise</option>
                        <option value="CompanyName">Company Wise</option>
                        <option value="UserName">User Wise</option>
                    </select>
                </div>
                <div id="users-box">
                    <select
                        name="users[]"
                        id="users"
                        multiple="multiple"
                        class="form-control users">
                        <option value="SubProduct">Select User</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="chart-container"></div>
        </div>
    </div>
    <!-- row closed -->
</div>
<!-- /Container -->
@endsection @section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    $(document).ready(function() {
        $("#users-box").hide();
        $("#users").select2({
            closeOnSelect: false, // Keep the dropdown open when a selection is made
        });
        $("#daterange-btn").daterangepicker({
                ranges: {
                    Today: [moment(), moment()],
                    Yesterday: [
                        moment().subtract(1, "days"),
                        moment().subtract(1, "days"),
                    ],
                    "Last 7 Days": [moment().subtract(6, "days"), moment()],
                    "This Month": [
                        moment().startOf("month"),
                        moment().endOf("month"),
                    ],
                    "Last Month": [
                        moment().subtract(1, "month").startOf("month"),
                        moment().subtract(1, "month").endOf("month"),
                    ],
                    "Financial Year": [
                        moment()
                        .subtract(1, "years")
                        .startOf("year")
                        .add(3, "months"),
                        moment()
                        .subtract(1, "years")
                        .endOf("year")
                        .add(3, "months")
                        .endOf("month"),
                    ],
                    "Last Financial Year": [
                        moment()
                        .subtract(2, "years")
                        .startOf("year")
                        .add(3, "months"),
                        moment()
                        .subtract(2, "years")
                        .endOf("year")
                        .add(3, "months")
                        .endOf("month"),
                    ],
                },
                startDate: moment()
                    .subtract(0, "years")
                    .startOf("year")
                    .add(3, "months"),
                endDate: moment()
                    .subtract(0, "years")
                    .endOf("year")
                    .add(3, "months")
                    .endOf("month"),
            },
            function(start, end, range) {
                $("#reportrange span").html(
                    start.format("MMMM D, YYYY") +
                    " - " +
                    end.format("MMMM D, YYYY")
                );
                $("#reportrange span").addClass("active-date");
                $("#dynamicDate").html(range);
                $(".staticDays").hide();
            }
        );

        $("#daterange-btn").on("apply.daterangepicker", function(ev, picker) {
            var start = picker.startDate.format("YYYY-MM-DD");
            var end = picker.endDate.format("YYYY-MM-DD");
            var range = $("#dynamicDate").html();

            ajaxCall(
                start,
                end,
                range,
                $("#chart_type").val(),
                $("#users").val()
            );
        });

        $(".chart_type").on("change", function() {
            var start = $("#daterange-btn")
                .data("daterangepicker")
                .startDate.format("YYYY-MM-DD");
            var end = $("#daterange-btn")
                .data("daterangepicker")
                .endDate.format("YYYY-MM-DD");
            var range = $("#dynamicDate").html();
            if ($(this).val() == "UserName") {
                $("#users-box").show();
            } else {
                $("#users-box").hide();
            }
            ajaxCall(start, end, range, $(this).val(), $("#users").val());
        });

        $(".users").on("change", function() {
            var start = $("#daterange-btn")
                .data("daterangepicker")
                .startDate.format("YYYY-MM-DD");
            var end = $("#daterange-btn")
                .data("daterangepicker")
                .endDate.format("YYYY-MM-DD");
            var range = $("#dynamicDate").html();
            ajaxCall(start, end, range, $("#chart_type").val(), $(this).val());
        });

        $(".policy-click").on("click", function() {
            var start = $("#daterange-btn")
                .data("daterangepicker")
                .startDate.format("YYYY-MM-DD");
            var end = $("#daterange-btn")
                .data("daterangepicker")
                .endDate.format("YYYY-MM-DD");
            var range = $("#dynamicDate").html();
            var url = "{{ route('policy.index',['id'=> 1]) }}";
            window.location.href =
                url + "&expiry_from=" + start + "&expiry_to=" + end;
        });

        $(".renewal-click").on("click", function() {
            var start = $("#daterange-btn")
                .data("daterangepicker")
                .startDate.format("YYYY-MM-DD");
            var end = $("#daterange-btn")
                .data("daterangepicker")
                .endDate.format("YYYY-MM-DD");
            var range = $("#dynamicDate").html();
            var url = "{{ route('policy.index',['id'=> 2]) }}";
            window.location.href =
                url + "&expiry_from=" + start + "&expiry_to=" + end;
        });

        $(".short-click").on("click", function() {
            var start = $("#daterange-btn")
                .data("daterangepicker")
                .startDate.format("YYYY-MM-DD");
            var end = $("#daterange-btn")
                .data("daterangepicker")
                .endDate.format("YYYY-MM-DD");
            var range = $("#dynamicDate").html();
            var url = "{{ route('policy.index',['id'=> 1]) }}";
            window.location.href =
                url +
                "&expiry_from=" +
                start +
                "&expiry_to=" +
                end +
                "&type=premium_short";
        });

        $(".premium-deposit-click").on("click", function() {
            var start = $("#daterange-btn")
                .data("daterangepicker")
                .startDate.format("YYYY-MM-DD");
            var end = $("#daterange-btn")
                .data("daterangepicker")
                .endDate.format("YYYY-MM-DD");
            var range = $("#dynamicDate").html();
            var url = "{{ route('policy.index',['id'=> 1]) }}";
            window.location.href =
                url +
                "&expiry_from=" +
                start +
                "&expiry_to=" +
                end +
                "&type=premium_deposit";
        });

        $(".closed-renewal-click").on("click", function() {
            var start = $("#daterange-btn")
                .data("daterangepicker")
                .startDate.format("YYYY-MM-DD");
            var end = $("#daterange-btn")
                .data("daterangepicker")
                .endDate.format("YYYY-MM-DD");
            var range = $("#dynamicDate").html();
            var url = "{{ route('policy.index',['id'=> 2]) }}";
            window.location.href =
                url +
                "&expiry_from=" +
                start +
                "&expiry_to=" +
                end +
                "&renew_status_search=CLOSED";
        });

        function ajaxCall(start, end, range, chartType, users) {
            if (!start || !end || !range) {
                start = moment().startOf("month").format("YYYY-MM-DD");
                end = moment().endOf("month").format("YYYY-MM-DD");
                range = "Last 30 Days";
            }
            if (!chartType) {
                var chartType = $("#chart_type").val();
            }
            if (!users) {
                var users = $("#users").val();
            }

            $.ajax({
                url: "{{ route('dashboard.ajax') }}",
                type: "GET",
                data: {
                    start: start,
                    end: end,
                    range: range,
                    chartType: chartType,
                    users: users,
                },
                success: function(data) {
                    $("#totalSubProduct").html(data.totalSubProduct);
                    $("#totalPolicy").html(data.totalPolicy);
                    $("#totalUser").html(data.totalUser);
                    $("#totalInvoice").html(data.totalInvoice);
                    $("#totalSales").html(
                        "₹" + data.totalSales.toLocaleString()
                    );
                    $("#policyCount").html(data.policyCount);
                    $("#policyAmount").html(
                        "₹" + data.policyAmount.toLocaleString()
                    );
                    $("#renewalCount").html(data.renewalCount);
                    $("#renewalAmount").html(
                        "₹" + data.renewalAmount.toLocaleString()
                    );
                    $("#premiumShortCount").html(data.premiumShortCount);
                    $("#premiumShortAmount").html(
                        "₹" + data.premiumShortAmount.toLocaleString()
                    );
                    $("#premiumDepositCount").html(data.premiumDepositCount);
                    $("#premiumDepositAmount").html(
                        "₹" + data.premiumDepositAmount.toLocaleString()
                    );
                    $("#closedRenewal").html(data.closedRenewal);

                    highChart(data.categories, data.chartData);

                    pieChart(data.pieChart);
                },
            });
        }
        ajaxCall();

        function highChart(categories, data) {
            // Abbreviate long channel names
            const abbreviatedCategories = categories.map((category) => {
                return category.length > 10 ?
                    category.substring(0, 10) + "..." :
                    category;
            });

            // Chart configuration with improvements
            Highcharts.chart("chart-container", {
                chart: {
                    type: "column",
                },
                title: {
                    text: "Policies details",
                    align: "left",
                },
                xAxis: {
                    categories: abbreviatedCategories,
                    crosshair: true,
                    accessibility: {
                        description: "Product wise policy details",
                    },
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: "12px",
                        },
                    },
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: "Premium (₹)",
                    },
                },
                tooltip: {
                    valuePrefix: "₹ ",
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0,
                    },
                },
                legend: {
                    layout: "vertical",
                    align: "right",
                    verticalAlign: "middle",
                },
                chart: {
                    zoomType: "xy",
                },
                series: [{
                        name: "Premium",
                        data: data.price,
                    },
                    {
                        name: "NOP",
                        data: data.count,
                    },
                ],
            });
        }

        function pieChart(chartData) {
            Highcharts.chart("pie-container", {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: "pie",
                    height: 310, // Set the desired height here
                },
                title: {
                    text: "",
                },

                tooltip: {
                    pointFormat: "{series.name}: <b>{point.y}</b>",
                },
                accessibility: {
                    point: {
                        valueSuffix: "%",
                    },
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: "pointer",
                        dataLabels: {
                            enabled: false,
                        },
                        showInLegend: true,
                    },
                },
                series: [{
                    name: "Policy Count",
                    colorByPoint: true,
                    data: chartData,
                }, ],
            });
        }
    });
</script>

@endsection