@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Policy Import...</h4>
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
                    <form   action="{{route('exportPolicy')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                      
                        <div class="p-3 bg-gray-200 d-flex align-items-center justify-content-between">
                            <div class="row row-xs align-items-center">                             
                                <div class="col-md-12 mg-t-5 mg-md-t-0">
                                  <input type="file" name="policy" id="">
                                   <a href="{{route('download')}}">Download Sample File</a>
                                </div>
                            </div>
                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">Import</button>
                        </div>
                </div>
                </form>
                <!-- form end  -->
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Error File</th>
                        <th>Date</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($errorFile as $error)
                    <tr>
                        <td> <a href="{{asset('error/'.$error->file_name)}}" target="_blank">Download</a></td>
                        <td> {{$error->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
        </div>
    </div>
    <!-- /row -->
</div>


@endsection



