@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Expences</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{isset($expences) ? 'Update' : 'Add New' }}</span>
            </div>
        </div>
        <a class="btn btn-main-primary ml_auto" style="margin-left: 740px;" href="{{ route('expences.index') }}">View Expences</a>


    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        {{isset($expences) ? 'Update# '.$expences->id : 'Add New' }}
                    </div>


                    <!--  start  -->
                    <form  id="user-add-edit" action="{{isset($expences) ? route('expences.update',$expences->id) : route('expences.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($expences) ? method_field('PUT'):'' }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">CHOOSE HEAD</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                             
                               <select name="choose" class="form-control">

                               <option value="">Select</option>
                               <option value="RENT">RENT</option>
                               <option value="ELECTRICITY">ELECTRICITY</option>
                               <option value="WATER BILL">WATER BILL</option>
                               <option value="TEA & BEVERAGES">TEA & BEVERAGES</option>
                               <option value="STATIONERY">STATIONERY</option>
                               <option value="SALARIES & INCENTIVES">SALARIES & INCENTIVES</option>
                               <option value="MOBILE AND INTERNET">MOBILE AND INTERNET</option>
                               <option value="REPAIRS AND MAINTENANCE">REPAIRS AND MAINTENANCE</option>
                               <option value="COMMISSION">COMMISSION</option>
                               </select>
                            </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Date</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="date"  type="date" value="{{isset($expences) ? $expences->date : '' }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Particulars</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="particular"  type="text" value="{{isset($expences) ? $expences->particular : '' }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Amounts</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="amount"  type="text" value="{{isset($expences) ? $expences->amount : '' }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Bank Details</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="bankdetail"  type="text" value="{{isset($expences) ? $expences->bankdetail : '' }}">
                                </div>
                            </div>
                          
              
                          
                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($expences) ? 'Update' : 'Save' }}</button>
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



