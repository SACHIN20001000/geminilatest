@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Communication</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{isset($communications) ? 'Update' : 'Add New' }}</span>
            </div>
        </div>
        <a class="btn btn-main-primary ml_auto" style="margin-left: 740px;" href="{{ route('communications.index') }}">View Communication</a>


    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        {{isset($communications) ? 'Update# '.$communications->id : 'Add New' }}
                    </div>


                    <!--  start  -->
                    <form id="user-add-edit" action="{{isset($communications) ? route('communications.update',$communications->id) : route('communications.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($communications) ? method_field('PUT'):'' }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Subject</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input type="text" name="subject" class="form-control">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Messgae</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <textarea name="text" class="form-control editor" cols="30" rows="10">

                                </textarea>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Attachment</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input type="file" name="attachment[]" class="form-control" multiple>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Sent to</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="type" class="form-control" id="type">
                                        <option value="">Select Below</option>
                                        <option value="All User">All User</option>
                                        <option value="Staff Only">Staff Only</option>
                                        <option value="Broker Only">Broker Only</option>
                                        <option value="Admin Only">Admin Only</option>
                                        <option value="Client Only">Client Only</option>
                                        <option value="Group">Group </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 show-group">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Select Group</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="group_id" class="form-control">
                                        <option value="">Select Below</option>
                                        @if(isset($groups) && $groups->count())
                                        @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row mrow-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Sent Where</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <div class="col-lg-3">
                                        <label class="sentWherebox"><input name="sentWhere" value="whatsapp" type="radio" class="mb-2"> <span>Whatsapp</span></label>
                                    </div>
                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                        <label class="sentWherebox"><input checked="" value="email" name="sentWhere" type="radio" class="mb-2"> <span>Email</span></label>
                                    </div>
                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                        <label class="sentWherebox"><input name="sentWhere" value="both" type="radio" class="mb-2"> <span>Both</span></label>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">Send</button>
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
<script type="text/javascript">
    $(document).ready(function() {

        $('.editor').summernote({
            toolbar: [
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['insert', ['link', 'image', 'doc', 'video']],
                ['misc', ['codeview']],
            ],
            height: 400,

        });
        $('.show-group').hide();

        $('#type').on('change', function() {
            var type = $(this).val();
            if (type == 'Group') {
                $('.show-group').show();
            } else {
                $('.show-group').hide();
            }
        });
    });
</script>

@endsection