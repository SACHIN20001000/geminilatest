@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Reconciliation</h4>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">


            <div class="pe-1 mb-xl-0">
                <div class="btn-group dropdown">
                    <a class="btn btn-main-primary" href="{{ route('reconciliation.index') }}">List</a>
                </div>
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
                        Upload Reconciliation
                    </div>


                    <!--  start  -->
                    <form id="report-add-edit" action="{{route('reconciliation.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Upload</label>
                                </div>

                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input type="file" name="file" class="form-control" required>
                                    <a href="{{route('downloadSampleReconciliation')}}">Download Sample File</a>
                                </div>
                            </div>


                        </div>

                        <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">Upload</button>
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
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
                'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                'Financial Year': [moment().month(3).date(1).startOf('month'), moment().month(2).date(31).endOf('month').add(1, 'year')],
                'Last Financial Year': [moment().subtract(1, 'years').startOf('year').add(3, 'months'), moment().subtract(1, 'years').endOf('year').add(3, 'months').endOf('month')]

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