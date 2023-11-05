<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Group\StoreCommunicationGroupRequest;
use Illuminate\Http\Request;
use App\Models\CommunicationGroup;
use App\Models\User;
use DataTables;

class CommunicationGroupController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->ajax()) {
            $data = CommunicationGroup::orderby('id', 'DESC')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '<span class="action-buttons">
                                
                        <a  href="' . route("group.edit", $row) . '" class="btn btn-sm btn-info btn-b"><i class="las la-pen"></i>
                        </a>

                        <a href="' . route("group.destroy", $row) . '"
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
        return view('admin.group.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();

        return view('admin.group.addEdit', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommunicationGroupRequest $request)
    {

        $inputs = $request->all();
        $inputs['users_id'] = implode(',', $inputs['users_id']);
        CommunicationGroup::create($inputs);
        return back()->with('success', 'Group added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('admin.group.index', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunicationGroup $group)
    {
        $users = User::all();
    
        return view('admin.group.addEdit', compact('group', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCommunicationGroupRequest $request, CommunicationGroup $group)
    {

        $inputs = $request->all();
        if (isset($inputs['users_id']) && is_array($inputs['users_id'])) {
            $inputs['users_id'] = implode(',', $inputs['users_id']);
        }
        $group->update($inputs);
        return back()->with('success', 'Group updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunicationGroup $group)
    {
        $group->delete();
        return back()->with('success', 'Group deleted successfully!');
    }
}
