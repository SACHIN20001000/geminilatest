@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Model</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{isset($makeModel) ? $makeModel->name : 'Add New' }}</span>
            </div>
        </div>
        <a class="btn btn-main-primary ml_auto" style="margin-left: 740px;" href="{{ route('model.index') }}">View Model</a>


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
                    <form  id="user-add-edit" action="{{isset($makeModel) ? route('model.update',$makeModel->id) : route('model.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($makeModel) ? method_field('PUT'):'' }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                          
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Type</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <select name="make_id"  class="form-control">
                                      <option value="">Choose Below..</option>
                                      @if($make->count())
                                     @foreach($make as $makes )
                                <option value="{{$makes->id}}">{{$makes->name}}</option>
                                     @endforeach
                                     @endif
                              </select>
                                </div>
                            </div>
                            <div class="btn btn-primary" id="add-variant"> Add Variant</div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0"> Variant</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0 vairants">
                                    
                                    <input class="form-control" name="model_id[]"  placeholder="Enter your Variants name" type="text" value="{{isset($makeModel) ? $makeModel->name : '' }}">
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
<script>
      $(document).ready(function() {
        $('#add-variant').click(function(){
            
            $('.vairants').append('<input class="form-control" name="model_id[]"  placeholder="Enter your Variants name" type="text">')
        })
      });
</script>
@endsection


