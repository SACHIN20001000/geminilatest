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
                <select name="chart_type" id="chart_type" class="form-control chart_type">
                    <option value="SubProduct">Product</option>
                    <option value="ChannelName">Channel Wise</option>
                </select>
            </div>
            <div class="card">
                <div id="reportrange" style="display:none"><span></span></div>
                <button type="button" style="display: flex; gap: 8px;" class="btn btn-default float-right" id="daterange-btn">
                    <i class="far fa-calendar-alt"></i>
                    <div class="staticDays">Last 30 days</div>
                    <div id="dynamicDate"></div>
                    <i class="fas fa-caret-down"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- row -->
    <div class="row row-sm">

        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="row">
                        <h3 class="mb-3 tx-18 text-white">Policy Details</h3>
                        <div class="col-lg-6">
                            <p class="mb-0 tx-12 text-white ">Count</p>
                            <h4 class="tx-20 fw-bold mb-1 text-white" id="policyCount">0</h4>
                        </div>
                        <div class="col-lg-6">
                            <p class="mb-0 tx-12 text-white ">Amount</p>
                            <h4 class="tx-20 fw-bold mb-1 text-white" id="policyAmount">0</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="row">
                        <h3 class="mb-3 tx-18 text-white">Renewal Details</h3>
                        <div class="col-lg-6">
                            <p class="mb-0 tx-12 text-white ">Count</p>
                            <h4 class="tx-20 fw-bold mb-1 text-white" id="renewalCount">0</h4>
                        </div>
                        <div class="col-lg-6">
                            <p class="mb-0 tx-12 text-white ">Amount</p>
                            <h4 class="tx-20 fw-bold mb-1 text-white" id="renewalAmount">0</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="row">
                        <h3 class="mb-3 tx-18 text-white">Premium Short</h3>
                        <div class="col-lg-6">
                            <p class="mb-0 tx-12 text-white ">Count</p>
                            <h4 class="tx-20 fw-bold mb-1 text-white" id="premiumShortCount">0</h4>
                        </div>
                        <div class="col-lg-6">
                            <p class="mb-0 tx-12 text-white ">Amount</p>
                            <h4 class="tx-20 fw-bold mb-1 text-white" id="premiumShortAmount">0</h4>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="ps-3 pt-3 pe-3 pb-2 pt-0">
                    <div class="row">
                        <h3 class="mb-3 tx-18 text-white">Premium Deposit</h3>
                        <div class="col-lg-6">
                            <p class="mb-0 tx-12 text-white ">Count</p>
                            <h4 class="tx-20 fw-bold mb-1 text-white" id="premiumDepositCount">0</h4>
                        </div>
                        <div class="col-lg-6">
                            <p class="mb-0 tx-12 text-white ">Amount</p>
                            <h4 class="tx-20 fw-bold mb-1 text-white" id="premiumDepositAmount">0</h4>
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
                <div class="card-header pb-1">
                    <h3 class="card-title mb-2">Sales Activity</h3>
                    <p class="tx-12 mb-0 text-muted">Sales activities are the tactics that salespeople use to achieve their goals and objective</p>
                </div>
                <div class="product-timeline card-body pt-2 mt-1">
                    <ul class="timeline-1 mb-0">
                        <li class="mt-0 mrg-8"> <i class="ti-pie-chart bg-primary-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Total Products</span>
                            <p class="mb-0 text-muted tx-12" id="totalSubProduct"></p>
                        </li>
                        <li class="mt-0 mrg-8"> <i class="mdi mdi-cart-outline bg-danger-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Total Sales</span>
                            <p class="mb-0 text-muted tx-12" id="totalSales"></p>
                        </li>
                        <li class="mt-0 mrg-8"> <i class="ti-bar-chart-alt bg-success-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Total Policy</span>
                            <p class="mb-0 text-muted tx-12" id="totalPolicy"></p>
                        </li>
                        <li class="mt-0 mrg-8"> <i class="ti-wallet bg-warning-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Total User</span>
                            <p class="mb-0 text-muted tx-12" id="totalUser"></p>
                        </li>
                        <li class="mt-0 mrg-8"> <i class="si si-eye bg-purple-gradient text-white product-icon"></i> <span class="fw-semibold mb-4 tx-14 ">Total Invoice</span>
                            <p class="mb-0 text-muted tx-12" id="totalInvoice"></p>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-md-12 col-lg-6">
            <div id="chart-container"></div>

        </div>



    </div>
    <!-- row closed -->




</div>
<!-- /Container -->
@endsection
@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    $(document).ready(function() {
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('year')],
                    'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                    'Financial Year': [moment().month(3).startOf('month'), moment().add(7, 'months').endOf('month')],
                    'Last Financial Year': [moment().subtract(1, 'years').month(3).startOf('month'), moment().subtract(1, 'years').add(7, 'months').endOf('month')]

                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end, range) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                $('#dynamicDate').html(range)
                $('.staticDays').hide();
            });


        $('#daterange-btn').on('apply.daterangepicker', function(ev, picker) {
            var start = picker.startDate.format('YYYY-MM-DD');
            var end = picker.endDate.format('YYYY-MM-DD');
            var range = $('#dynamicDate').html();

            ajaxCall(start, end, range, $('#chart_type').val());
        });

        $('.chart_type').on('change', function() {
            var start = $('#daterange-btn').data('daterangepicker').startDate.format('YYYY-MM-DD');
            var end = $('#daterange-btn').data('daterangepicker').endDate.format('YYYY-MM-DD');
            var range = $('#dynamicDate').html();
            ajaxCall(start, end, range, $(this).val());
        });

        function ajaxCall(start, end, range, chartType) {
            if (!start || !end || !range) {
                start = moment().subtract(29, 'days').format('YYYY-MM-DD');
                end = moment().format('YYYY-MM-DD');
                range = 'Last 30 Days';
            }
            if (!chartType) {
                var chartType = $('#chart_type').val();
            }

            $.ajax({
                url: "{{ route('dashboard.ajax') }}",
                type: "GET",
                data: {
                    start: start,
                    end: end,
                    range: range,
                    chartType: chartType
                },
                success: function(data) {
                    $('#totalSubProduct').html(data.totalSubProduct);
                    $('#totalPolicy').html(data.totalPolicy);
                    $('#totalUser').html(data.totalUser);
                    $('#totalInvoice').html(data.totalInvoice);
                    $('#totalSales').html('₹' + data.totalSales.toLocaleString());
                    $('#policyCount').html(data.policyCount);
                    $('#policyAmount').html('₹' + data.policyAmount.toLocaleString());
                    $('#renewalCount').html(data.renewalCount);
                    $('#renewalAmount').html('₹' + data.renewalAmount.toLocaleString());
                    $('#premiumShortCount').html(data.premiumShortCount);
                    $('#premiumShortAmount').html('₹' + data.premiumShortAmount.toLocaleString());
                    $('#premiumDepositCount').html(data.premiumDepositCount);
                    $('#premiumDepositAmount').html('₹' + data.premiumDepositAmount.toLocaleString());

                    highChart(data.categories, data.chartData)
                }
            });
        }
        ajaxCall();

        function highChart(categories, data) {
            console.log(data, ':sachinkumar')
            //Chart
            Highcharts.chart('chart-container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Policies details',
                    align: 'left'
                },

                xAxis: {
                    categories: categories,
                    crosshair: true,
                    accessibility: {
                        description: 'Countries'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Price'
                    }
                },
                tooltip: {
                    valueSuffix: ' (1000 MT)'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                        name: 'Price',
                        data: data.price
                    },
                    {
                        name: 'Count',
                        data: data.count
                    }
                ]
            });
        }

    });
</script>


@endsection