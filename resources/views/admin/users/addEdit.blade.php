@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">User</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{isset($user) ? $user->email : 'Add New' }}</span>
            </div>
        </div>
        <a class="btn btn-main-primary ml_auto" style="margin-left: 740px;" href="{{ route('users.index',['id'=> 0]) }}">View User</a>
      

    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        {{isset($user) ? 'Update': 'Add New' }}
                    </div>


                    <!--  start  -->
                    <form  id="user-add-edit" action="{{isset($user) ? route('users.update',$user->id) : route('users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($user) ? method_field('PUT'):'' }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Name</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="name"  placeholder="Enter your name" type="text" value="{{isset($user) ? $user->name : '' }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Email</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="email"  placeholder="Enter your email" type="email" value="{{isset($user) ? $user->email : '' }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Password</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="password"  placeholder="Enter your password" type="password" value="">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Role</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <select name="role"  class="form-control">
                                      <option value="">Choose Below..</option>
                                      @foreach($role as $roles)
                                      <option value="{{$roles->name}}" {{ (isset($user) && $roles->name == @$user->roles[0]->name) ? 'selected' : '' }}>{{$roles->name}}</option>
                                      @endforeach
                              </select>
                                </div>
                            </div>

                            <div class="row row-xs align-items-center mg-b-20 advance_payout">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Advance Payout</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="advance_payout"  placeholder="Enter your Amount" type="number" value="{{isset($user) && !empty($user->advance_payout) ? $user->advance_payout : ''}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Upi</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="upi"  placeholder="Enter your Upi" type="number" value="{{isset($user) && !empty($user->upi) ? $user->upi : ''}}">
                                
              </div>
                                </div>
                         
                            <div class="row row-xs align-items-center mg-b-20 ">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Birthday</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="birthday"  placeholder="Enter your birthday" type="number" value="{{isset($user) && !empty($user->birthday) ? $user->birthday : ''}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 anniversary">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Anniversary</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="anniversary"  placeholder="Enter your anniversary" type="number" value="{{isset($user) && !empty($user->anniversary) ? $user->anniversary : ''}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 account_no">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Account No</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="account_no"  placeholder="Enter your Amount" type="number" value="{{isset($user) && !empty($user->account_no) ? $user->account_no : ''}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 account_name">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Bank Name</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="bank_name"  placeholder="Enter your Bank" type="number" value="{{isset($user) && !empty($user->bank_name) ? $user->bank_name : ''}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 account_name">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Account Name</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="account_name"  placeholder="Enter your Account" type="number" value="{{isset($user) && !empty($user->account_name) ? $user->account_name : ''}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 ifsc">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Ifsc</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="ifsc"  placeholder="Enter your IFSC" type="number" value="{{isset($user) && !empty($user->ifsc) ? $user->ifsc : ''}}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 ">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">User profile</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                @if(!empty($user->profile))
                                <input type="file" class="dropify" name="profile" data-default-file="{{URL::asset('profile')}}/{{$user->profile}}" >
                            @else
                            <input type="file" class="dropify" name="profile">
                            @endif
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 ">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Photo</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                @if(!empty($user->photo))
                <input type="file" class="dropify" name="photo" data-default-file="{{URL::asset('profile')}}/{{$user->photo}}" >
              @else
              <input type="file" class="dropify" name="photo">
              @endif
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 ">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Pan Card</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                @if(!empty($user->pan_card))
                <input type="file" class="dropify" name="pan_card" data-default-file="{{URL::asset('profile')}}/{{$user->pan_card}}" >
              @else
              <input type="file" class="dropify" name="pan_card">
              @endif
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 ">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Aadhar Card</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                @if(!empty($user->aadhar_card))
                <input type="file" class="dropify" name="aadhar_card" data-default-file="{{URL::asset('profile')}}/{{$user->aadhar_card}}" >
              @else
              <input type="file" class="dropify" name="aadhar_card">
              @endif
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20 advance_payout">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Gst</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                @if(!empty($user->gst))
                <input type="file" class="dropify" name="gst" data-default-file="{{URL::asset('profile')}}/{{$user->gst}}" >
              @else
              <input type="file" class="dropify" name="gst">
              @endif
                                </div>
                            </div>
                            </div>
                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($user) ? 'Update' : 'Save' }}</button>
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
@if(isset($user))
{!! JsValidator::formRequest('App\Http\Requests\Admin\User\UpdateUserRequest','#user-add-edit') !!}
@else
{!! JsValidator::formRequest('App\Http\Requests\Admin\User\StoreUserRequest','#user-add-edit') !!}
@endif

@endsection


