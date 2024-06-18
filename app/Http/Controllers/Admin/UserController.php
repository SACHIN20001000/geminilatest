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
                                <a  href="' . route("users.show", $row) . '" class="iconBtn"><i class="fa fa-user"></i>
                                </a>
                                <a  href="' . route("leads.index", ['lead_id' => $row]) . '" class="iconBtn"><i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                        <a  href="' . route("users.edit", $row) . '" class="iconBtn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                        </a>

                        <a href="' . route("users.destroy", $row) . '"
                                class="iconBtn remove_us"
                                title="Delete User"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-method="DELETE"
                                data-confirm-title="Please Confirm"
                                data-confirm-text="Are you sure that you want to delete this User?"
                                data-confirm-delete="Yes, delete it!">
                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
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
