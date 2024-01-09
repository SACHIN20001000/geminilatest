@extends('admin.layouts.app')

@section('content')
<!-- container opened -->
<div class="container">

  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">View-Profile</h4>
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
                @if(!empty($user->profile))
                <img alt="" src="{{URL::asset('profile')}}/{{$user->profile}}">
                @else
                <img src="../../assets/img/faces/6.jpg" alt="img">
                @endif
              </div>
              <div class="d-flex justify-content-between mg-b-20">
                <div>
                  <h5 class="main-profile-name">{{$user->name}}</h5>
                  <p class="main-profile-name-text">{{$user->email}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Col -->
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <div class="mb-4 main-content-label">Personal Information</div>
          <form class="form-horizontal" id="profile-add-edit" action="{{route('updateUserProfile' , $user->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 main-content-label">Name</div>

            <div class="form-group ">
              <div class="row">
                <div class="col-md-2">
                  <label class="form-label">User Name</label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="name" placeholder="User Name" value="{{$user->name}}">
                </div>
                <div class="col-md-2">
                  <label class="form-label">Upi</label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="upi" value="{{$user->upi}}">
                </div>

              </div>
            </div>
            <div class="form-group ">
              <div class="row">
                <div class="col-md-2">
                  <label class="form-label">Birthday</label>
                </div>
                <div class="col-md-4">
                  <input type="date" class="form-control" name="birthday" value="{{$user->birthday}}">
                </div>
                <div class="col-md-2">
                  <label class="form-label">Anniversary</label>
                </div>
                <div class="col-md-4">
                  <input type="date" class="form-control" name="anniversary" value="{{$user->anniversary}}">
                </div>
              </div>
            </div>
            <div class="form-group ">
              <div class="row">
                <div class="col-md-2">
                  <label class="form-label">Account No</label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="account_no" value="{{$user->account_no}}">
                </div>
                <div class="col-md-2">
                  <label class="form-label">Bank Name</label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="bank_name" value="{{$user->bank_name}}">
                </div>
              </div>
            </div>
            <div class="form-group ">
              <div class="row">
                <div class="col-md-2">
                  <label class="form-label">Account Name</label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="account_name" value="{{$user->account_name}}">
                </div>
                <div class="col-md-2">
                  <label class="form-label">Ifsc</label>
                </div>
                <div class="col-md-4">
                  <input type="type" class="form-control" name="ifsc" value="{{$user->ifsc}}">
                </div>
              </div>
            </div>
            <div class="form-group ">
              <div class="row">
                <div class="col-md-2">
                  <label class="form-label">User profile</label>
                </div>
                <div class="col-md-4">
                  @if(!empty($user->profile))
                  <a href="{{URL::asset('profile')}}/{{$user->profile}}" target="_blank">View File</a>
                  @endif
                </div>
                <div class="col-md-2">
                  <label class="form-label">Photo</label>
                </div>
                <div class="col-md-4">
                  @if(!empty($user->photo))
                  <a href="{{URL::asset('profile')}}/{{$user->photo}}" target="_blank">
                    View File
                  </a>
                  @endif

                </div>
              </div>
            </div>
            <div class="form-group ">
              <div class="row">
                <div class="col-md-2">
                  <label class="form-label">Pan Card</label>
                </div>
                <div class="col-md-4">
                  @if(!empty($user->pan_card))
                  <a href="{{URL::asset('profile')}}/{{$user->pan_card}}" target="_blank">
                    View File
                  </a>
                  @endif

                </div>
                <div class="col-md-2">
                  <label class="form-label">Aadhar Card</label>
                </div>
                <div class="col-md-4">

                  @if(!empty($user->aadhar_card))
                  <a href="{{URL::asset('profile')}}/{{$user->aadhar_card}}" target="_blank">
                    View File
                  </a>

                  @endif

                </div>
              </div>
            </div>
            <div class="form-group ">
              <div class="row">
                <div class="col-md-2">
                  <label class="form-label">Gst</label>
                </div>
                <div class="col-md-4">
                  @if(!empty($user->gst))
                  <a href="{{URL::asset('profile')}}/{{$user->gst}}" target="_blank">
                    View File
                  </a>
                  @endif

                </div>
                <div class="col-md-2">
                  <label class="form-label">Phone</label>
                </div>
                <div class="col-md-4">
                  <input type="number" class="form-control" placeholder="Please use 91 before the number" name="phone" value="{{$user->phone}}">
                </div>

              </div>
            </div>


            <div class="mb-4 main-content-label">Contact Info</div>
            <div class="form-group ">
              <div class="row">
                <div class="col-md-3">
                  <label class="form-label">Email</label>
                </div>
                <div class="col-md-9">
                  <input type="text" class="form-control" readonly name="email" value="{{$user->email}}">
                </div>
              </div>
            </div>
        </div>
      </div>

      </form>
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
  $(document).ready(function() {
    $('#profile-add-edit :input').prop('disabled', true);
    $('.dropify').attr('disabled', false);
    $('.dropify').dropify();
  });
</script>


@endsection