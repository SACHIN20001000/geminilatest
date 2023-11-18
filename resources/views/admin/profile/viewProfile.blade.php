@extends('admin.layouts.app')

@section('content')
<!-- container opened -->
<div class="container">

  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">User-Profile</h4>
      </div>
    </div>

  </div>
  <!-- breadcrumb -->

  <!-- row -->
  <div class="row row-sm">
    <!-- Col -->

    <!-- Col -->
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="mb-4 main-content-label">Personal Information</div>

          <div class="mb-4 main-content-label">Name</div>

          <div class="form-group ">
            <div class="row">
              <div class="col-md-2">
                <label class="form-label">User Name</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" readOnly name="name" value="{{isset($user->name)? $user->name : ''}}">
              </div>
              <div class="col-md-2">
                <label class="form-label">Upi</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" readOnly name="upi" value="{{isset($user->upi)? $user->upi : ''}}">
              </div>

            </div>
          </div>
          <div class="form-group ">
            <div class="row">
              <div class="col-md-2">
                <label class="form-label">Birthday</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" readOnly name="birthday" value="{{isset($user->birthday)? $user->birthday : ''}}">
              </div>
              <div class="col-md-2">
                <label class="form-label">Anniversary</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" readOnly name="anniversary" value="{{isset($user->account_name)? $user->anniversary : ''}}">
              </div>
            </div>
          </div>
          <div class="form-group ">
            <div class="row">
              <div class="col-md-2">
                <label class="form-label">Account No</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" readOnly name="account_no" value="{{isset($user->account_name)? $user->account_no : ''}}">
              </div>

              <div class="col-md-2">
                <label class="form-label">Bank Name</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" readOnly name="bank_name" value="{{isset($user->account_name)? $user->account_name : ''}}">
              </div>
            </div>
          </div>
          <div class="form-group ">
            <div class="row">
              @if(isset($user->account_name) && !empty($user->account_name))
              <div class="col-md-2">
                <label class="form-label">Account Name</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" readOnly name="account_name" value="{{$user->account_name}}">
              </div>
              @endif
              @if(isset($user->ifsc) && !empty($user->ifsc))
              <div class="col-md-2">
                <label class="form-label">Ifsc</label>
              </div>
              <div class="col-md-4">
                <input type="type" class="form-control" readOnly name="ifsc" value="{{$user->ifsc}}">
              </div>
              @endif
            </div>
          </div>
          <div class="form-group ">
            <div class="row">
              @if(isset($user->profile) && !empty($user->profile))
              <div class="col-md-2">
                <label class="form-label">User profile</label>
              </div>
              <div class="col-md-4">

                <img src="{{URL::asset('profile')}}/{{$user->profile}}">

              </div>
              @endif
              @if(isset($user->photo) && !empty($user->photo))
              <div class="col-md-2">
                <label class="form-label">Photo</label>
              </div>
              <div class="col-md-4">

                <img src="{{URL::asset('profile')}}/{{$user->photo}}">
              </div>
              @endif
            </div>
          </div>
          <div class="form-group ">
            <div class="row">
              @if(isset($user->pan_card) && !empty($user->pan_card))
              <div class="col-md-2">
                <label class="form-label">Pan Card</label>
              </div>
              <div class="col-md-4">

                <img src="{{URL::asset('profile')}}/{{$user->pan_card}}">

              </div>
              @endif
              @if(isset($user->aadhar_card) && !empty($user->aadhar_card))
              <div class="col-md-2">
                <label class="form-label">Aadhar Card</label>
              </div>
              <div class="col-md-4">
                <img src="{{URL::asset('profile')}}/{{$user->aadhar_card}}">


              </div>
              @endif
            </div>
          </div>
          @if(isset($user->gst) && !empty($user->gst))
          <div class="form-group ">
            <div class="row">
              <div class="col-md-2">
                <label class="form-label">Gst</label>
              </div>
              <div class="col-md-4">
                <img src="{{URL::asset('profile')}}/{{$user->gst}}">
              </div>

            </div>
          </div>
          @endif
          @if(isset($user->email) && !empty($user->email))
          <div class="mb-4 main-content-label">Contact Info</div>
          <div class="form-group ">
            <div class="row">
              <div class="col-md-3">
                <label class="form-label">Email</label>
              </div>
              <div class="col-md-9">
                <input type="text" readOnly class="form-control" readonly name="email" value="{{$user->email}}">
              </div>
            </div>
          </div>

        </div>
        @endif
      </div>

    </div>

  </div>
</div>
<!-- /Col -->
</div>
<!-- row closed -->
</div>
<!-- Container closed -->
@endsection


@section('scripts')
<script>
  $('.dropify').dropify();
</script>

@endsection