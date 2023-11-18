<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->ajax()) {
            $id = $request->id;
            $advance = $request->advance;
            $query = User::with('roles');
            if (isset($advance) && !empty($advance)) {
                $query->whereNotNull('advance_payout');
            } else {
                if (isset($id) && $id == 1) {
                    $query->whereHas(
                        'roles',
                        function ($q) {
                            $q->where('name', '=', 'Admin');
                        }
                    );
                }
                if (isset($id) && $id == 2) {
                    $query->whereHas(
                        'roles',
                        function ($q) {
                            $q->where('name', '=', 'Broker');
                        }
                    );
                }
                if (isset($id) && $id == 3) {
                    $query->whereHas(
                        'roles',
                        function ($q) {
                            $q->where('name', '=', 'Staff');
                        }
                    );
                }
                if (isset($id) && $id == 4) {
                    $query->whereHas(
                        'roles',
                        function ($q) {
                            $q->where('name', '=', 'Client');
                        }
                    );
                }
            }

            if (isset($request->date) && !empty($request->date)) {
                $query->whereDate('created_at', today());
            }

            $data = $query->orderby('id', 'DESC');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $action = '<span class="action-buttons">
                                <a  href="' . route("users.show", $row) . '" class="btn btn-sm btn-info btn-b"><i class="fa fa-user"></i>
                                </a>
                                <a  href="' . route("leads.index", ['lead_id' => $row]) . '" class="btn btn-sm btn-info btn-b"><i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                        <a  href="' . route("users.edit", $row) . '" class="btn btn-sm btn-info btn-b"><i class="las la-pen"></i>
                        </a>

                        <a href="' . route("users.destroy", $row) . '"
                                class="btn btn-sm btn-danger remove_us"
                                title="Delete User"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-method="DELETE"
                                data-confirm-title="Please Confirm"
                                data-confirm-text="Are you sure that you want to delete this User?"
                                data-confirm-delete="Yes, delete it!">
                                <i class="las la-trash"></i>
                            </a>
                    ';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $role = Role::where('name', '!=', 'IotAdmin')->get();

        return view('admin.users.addEdit', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        
        $inputs = $request->all();
        $inputs['password'] = bcrypt($request->password);
        if ($request->hasFile('profile')) {
            $image_name = $request->file('profile')->getClientOriginalName();
            $request->profile->move(public_path('/profile'), $image_name);
            $inputs['profile'] = $image_name;
          }
          if ($request->hasFile('photo')) {
            $image_name = $request->file('photo')->getClientOriginalName();
            $request->photo->move(public_path('/profile'), $image_name);
            $inputs['photo'] = $image_name;
        }
          if ($request->hasFile('pan_card')) {
            $image_name = $request->file('pan_card')->getClientOriginalName();
            $request->pan_card->move(public_path('/profile'), $image_name);
            $inputs['pan_card'] = $image_name;
          }
          if ($request->hasFile('aadhar_card')) {
            $image_name = $request->file('aadhar_card')->getClientOriginalName();
            $request->aadhar_card->move(public_path('/profile'), $image_name);
            $inputs['aadhar_card'] = $image_name;
          }
          if ($request->hasFile('gst')) {
            $image_name = $request->file('gst')->getClientOriginalName();
            $request->gst->move(public_path('/profile'), $image_name);
            $inputs['gst'] = $image_name;
          }

        $user = User::create($inputs);
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $role = Role::updateOrCreate(['name' => $request->role]);
        $user->assignRole($role);
        return back()->with('success', 'User addded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {


        return view('admin.profile.viewProfile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $users = User::where('id', '!=', $user->id)->get();
        $role = Role::where('name', '!=', 'IotAdmin')->get();
        return view('admin.users.addEdit', compact('user', 'users', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {

        $inputs = $request->all();
    
        if ($request->hasFile('profile')) {
            $image_name = $request->file('profile')->getClientOriginalName();
            $request->profile->move(public_path('/profile'), $image_name);
            $inputs['profile'] = $image_name;
          }
          if ($request->hasFile('photo')) {
            $image_name = $request->file('photo')->getClientOriginalName();
            $request->photo->move(public_path('/profile'), $image_name);
            $inputs['photo'] = $image_name;
        }
          if ($request->hasFile('pan_card')) {
            $image_name = $request->file('pan_card')->getClientOriginalName();
            $request->pan_card->move(public_path('/profile'), $image_name);
            $inputs['pan_card'] = $image_name;
          }
          if ($request->hasFile('aadhar_card')) {
            $image_name = $request->file('aadhar_card')->getClientOriginalName();
            $request->aadhar_card->move(public_path('/profile'), $image_name);
            $inputs['aadhar_card'] = $image_name;
          }
          if ($request->hasFile('gst')) {
            $image_name = $request->file('gst')->getClientOriginalName();
            $request->gst->move(public_path('/profile'), $image_name);
            $inputs['gst'] = $image_name;
          }

          
        $inputs['password'] = bcrypt($request->password);
        $user->update($inputs);
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $role = Role::updateOrCreate(['name' => $request->role]);
        $user->syncRoles([$role]);

        return back()->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted successfully!');
    }
}
