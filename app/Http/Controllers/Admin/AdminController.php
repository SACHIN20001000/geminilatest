<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Admin\Profile\UpdateUserProfile;
use Storage;

class AdminController extends Controller
{
  /**
   * View Profile
   * @return type
   */
  public function viewProfile()
  {
    return view('admin.profile.viewProfile');
  }

  /**
   * Update Profile view
   * @return type
   */
  public function updateProfile()
  {
    return view('admin.profile.editprofile');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function updateUserProfile(UpdateUserProfile $request, $id)
  {

    $user = User::find($id);
    if (!empty($request->password)) {
      $user->password =  bcrypt($request->password);
    }
    if ($request->hasFile('profile')) {
      $image_name = $request->file('profile')->getClientOriginalName();
      $request->profile->move(public_path('/profile'), $image_name);
      $user->profile = $image_name;
    }
    if ($request->hasFile('photo')) {
      $image_name = $request->file('photo')->getClientOriginalName();
      $request->photo->move(public_path('/profile'), $image_name);
      $user->photo = $image_name;
    }
    if ($request->hasFile('pan_card')) {
      $image_name = $request->file('pan_card')->getClientOriginalName();
      $request->pan_card->move(public_path('/profile'), $image_name);
      $user->pan_card = $image_name;
    }
    if ($request->hasFile('aadhar_card')) {
      $image_name = $request->file('aadhar_card')->getClientOriginalName();
      $request->aadhar_card->move(public_path('/profile'), $image_name);
      $user->aadhar_card = $image_name;
    }
    $user->name = $request->name;
    $user->birthday = $request->birthday;
    $user->anniversary = $request->anniversary;
    $user->account_no = $request->account_no;
    $user->bank_name = $request->bank_name;
    $user->account_name = $request->account_name;
    $user->ifsc = $request->ifsc;
    $user->upi = $request->upi;
    $user->gst = $request->gst;
    $user->phone = $request->phone;
    $user->email = $request->email;
    $user->save();
    return back()->with('success', 'User updated successfully!');
  }
}
