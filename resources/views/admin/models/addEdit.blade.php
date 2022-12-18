@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Make</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{isset($makeModel) ? $makeModel->name : 'Add New' }}</span>
            </div>
        </div>
        <a class="btn btn-main-primary ml_auto" style="margin-left: 740px;" href="{{ route('make.index') }}">View Make</a>


    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        {{isset($makeModel) ? 'Update # '.$makeModel->id : 'Add New' }}
                    </div>


                    <!--  start  -->
                    <form  id="user-add-edit" action="{{isset($makeModel) ? route('make.update',$makeModel->id) : route('make.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($makeModel) ? method_field('PUT'):'' }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                          
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Name</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                               <input type="text" name="name" class="form-control" value="{{isset($makeModel) ? $makeModel->name : '' }}">
                              </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Sub Product</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <select name="subproduct_id" class="select2 form-control" id="subproduct_id">
                                            <option value="">Select Below</option>
                                            @if(isset($subProducts) && $subProducts->count())
                                                @foreach($subProducts as $subProduct)
                                                       <option value="{{$subProduct->id}}" data-id="{{$subProduct->name}}" {{ (isset($makeModel) && $subProduct->id == $makeModel->subproduct_id) ? 'selected' : '' }}>{{$subProduct->name}}</option>             
                                                @endforeach
                                            @endif
                                           </select>
                              </div>
                            </div>
                           
                          
                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($makeModel) ? 'Update' : 'Save' }}</button>
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

{!! JsValidator::formRequest('App\Http\Requests\Admin\Make\StoreModelRequest','#user-add-edit') !!}

@endsection


