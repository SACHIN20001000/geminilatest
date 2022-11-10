@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Notepad</h4>
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
                    <form   action="{{isset($notepad) ? route('notepad.update',$notepad->id) : route('notepad.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($notepad) ? method_field('PUT'):'' }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div class="row row-xs align-items-center mg-b-20">
                             
                                <div class="col-md-12 mg-t-5 mg-md-t-0">
                                   <textarea name="message"  class="form-control editor">{{$message->text ?? ''}}</textarea>
                                   <input type="hidden" name="user_id" value="{{$message->user_id ?? ''}}">
                                </div>
                            </div>
              
                          
                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($notepad) ? 'Update' : 'Save' }}</button>
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
        ['insert', ['link','image', 'doc', 'video']],
        ['misc', ['codeview']],
        ],
        height: 400,
     
    });
</script>

@endsection


