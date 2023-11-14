@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Global Setting</h4>
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



                    <!--  start  -->
                    <form action="{{ route('global_settings.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="pd-30 pd-sm-40 bg-gray-100">
                            <div class="row row-xs align-items-center mg-b-20">

                                <div class="col-md-12 mg-t-5 mg-md-t-0">

                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Website Title</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="title" value="{{isset($global_settings) ? $global_settings->title : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Head Title</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="head_title" value="{{isset($global_settings) ? $global_settings->head_title : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Bcc Email</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" name="bcc_email" value="{{isset($global_settings) ? $global_settings->bcc_email : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Logo Title</label>
                                            </div>
                                            <div class="col-md-9">
                                                @if(isset($global_settings) && !empty($global_settings->logo))
                                                <input type="file" class="dropify" name="logo" data-default-file="{{URL::asset('setting')}}/{{$global_settings->logo}}">
                                                @else
                                                <input type="file" class="dropify" name="logo">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Fav Icon</label>
                                            </div>
                                            <div class="col-md-9">
                                                @if(isset($global_settings) && !empty($global_settings->fav_icon))
                                                <input type="file" class="dropify" name="fav_icon" data-default-file="{{URL::asset('setting')}}/{{$global_settings->fav_icon}}">
                                                @else
                                                <input type="file" class="dropify" name="fav_icon">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Main Image</label>
                                            </div>
                                            <div class="col-md-9">
                                                @if(isset($global_settings) && !empty($global_settings->main_img))
                                                <input type="file" class="dropify" name="main_img" data-default-file="{{URL::asset('setting')}}/{{$global_settings->main_img}}">
                                                @else
                                                <input type="file" class="dropify" name="main_img">
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($global_settings) ? 'Update' : 'Save' }}</button>
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
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
    $('.editor').summernote({
        toolbar: [
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['insert', ['link', 'image', 'doc', 'video']],
            ['misc', ['codeview']],
        ],
        height: 400,

    });
    $('.dropify').dropify();
</script>


@endsection