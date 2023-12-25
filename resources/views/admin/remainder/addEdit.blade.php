@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Remainder</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{isset($remainder) ? $remainder->Date : 'Add New' }}</span>
            </div>
        </div>
        <a class="btn btn-main-primary ml_auto" style="margin-left: 740px;" href="{{ route('remainder.index') }}">View Remainder</a>


    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        {{isset($remainder) ? 'Update # '.$remainder->id : 'Add New' }}
                    </div>


                    <!--  start  -->
                    <form id="user-add-edit" action="{{isset($remainder) ? route('remainder.update',$remainder->id) : route('remainder.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($remainder) ? method_field('PUT'):'' }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Interval</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <Select name="date" class="form-control">
                                        <option value="">Choose Below..</option>
                                        <option value="1" {{isset($remainder) ? ($remainder->date == '1' ? 'selected' : '') : '' }}>1 Day</option>
                                        <option value="5" {{isset($remainder) ? ($remainder->date == '5' ? 'selected' : '') : '' }}>5 Days</option>
                                        <option value="15" {{isset($remainder) ? ($remainder->date == '15' ? 'selected' : '') : '' }}>15 Days</option>
                                        <option value="30" {{isset($remainder) ? ($remainder->date == '30' ? 'selected' : '') : '' }}>30 Days</option>
                                        <option value="60" {{isset($remainder) ? ($remainder->date == '60' ? 'selected' : '') : '' }}>60 Days</option>
                                        <option value="90" {{isset($remainder) ? ($remainder->date == '90' ? 'selected' : '') : '' }}>90 Days</option>
                                    </Select>
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Status</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="status" class="form-control">
                                        <option value="">Choose Below..</option>


                                        <option value="active" {{isset($remainder) ? ($remainder->status == 'active' ? 'selected' : '') : '' }}>Active</option>
                                        
                                        <option value="inactive" {{isset($remainder) ? ($remainder->status == 'inactive' ? 'selected' : '') : '' }}>Inactive</option>

                                    </select>
                                </div>
                            </div>

                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($remainder) ? 'Update' : 'Save' }}</button>
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