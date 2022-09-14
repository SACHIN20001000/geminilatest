@extends('admin.layouts.app')

@section('content') 
	<!-- container opened -->
  <div class="container">

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
  <div class="my-auto">
    <div class="d-flex">
      <h4 class="content-title mb-0 my-auto">Profile</h4>
    </div>
  </div>

</div>
<!-- breadcrumb -->

<!-- row -->
<div class="row row-sm">
  <!-- Col -->
  <div class="col-lg-4">
    <div class="card mg-b-20">
      <div class="card-body">
        <div class="ps-0">
          <div class="main-profile-overview">
            <div class="main-img-user profile-user">
            @if(!empty(Auth::user()->profile))
            <img alt="" src="{{Auth::user()->profile}}">      
                                @else
                                <img src="../../assets/img/faces/6.jpg" alt="img">
                                @endif
             
            </div>
            <div class="d-flex justify-content-between mg-b-20">
              <div>
                <h5 class="main-profile-name">{{Auth::user()->name}}</h5>
                <p class="main-profile-name-text">{{Auth::user()->email}}</p>
              </div>
            </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <!-- Col -->
  <div class="col-lg-8">
   
  <!-- /Col -->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
@endsection


