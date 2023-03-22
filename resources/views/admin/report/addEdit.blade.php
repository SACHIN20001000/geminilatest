@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Report</h4>
            </div>
        </div>


    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        Report
                    </div>


                    <!--  start  -->
                    <form id="report-add-edit" action="{{route('report.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Type</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="type" id="type" class="form-control">
                                        <option value="">Select Below</option>
                                        <option value="lead">Lead</option>
                                        <option value="quote">Quote Lead</option>
                                        <option value="policy_issue">Policy Issue</option>
                                        <option value="opportunities">Opportunities</option>
                                        <option value="policy">Policy</option>
                                        <option value="renewal">Renewal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">User</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="user" id="user" class="form-control">
                                        <option value="">Select Below</option>
                                        @if($user->count())

                                        @foreach($user as $userr)
                                        <option value="{{$userr->id}}">{{$userr->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Date Range</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <div id="reportrange" style="display:none"><span></span></div>
                                    <input type="text" name="daterange" class="form-control" id="daterange-btn">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($user) ? 'Download' : 'Save' }}</button>
                </div>
            </div>
            </form>
            <!-- form end  -->
        </div>
    </div>
</div>
<!-- /row -->
</div>


@endsection


@section('scripts')

{!! JsValidator::formRequest('App\Http\Requests\Admin\Report\ReportRequest','#report-add-edit') !!}

<script>
    $('#daterange-btn').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
        },
        // function (start, end,range) {
        //   $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        //   $('#dynamicDate').html(range)
        //   $('.staticDays').hide();
        // }
    )
</script>
@endsection