<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Channel;
use DataTables;
use App\Http\Requests\Admin\Channel\StoreChannelRequest;
class ChannelController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
       
        if ($request->ajax())
        {
            $data = Channel::orderby('id','DESC')->get();

            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function ($row)
                            {
                                $action = '<span class="action-buttons">
                                
                        <a  href="' . route("channel.edit", $row) . '" class="btn btn-sm btn-info btn-b"><i class="las la-pen"></i>
                        </a>

                        <a href="' . route("channel.destroy", $row) . '"
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
        return view('admin.channel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      
        return view('admin.channel.addEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChannelRequest $request)
    {

      
        $inputs = $request->only(
            'name',
            );
           $make= Channel::create($inputs);
         
        
        return back()->with('success', 'Channel addded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('admin.channel.index',compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
       
        return view('admin.channel.addEdit', compact('channel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreChannelRequest $request, Channel $channel)
    {
       
        $inputs = $request->only(
            'name',
            );
        $channel->update($inputs);
   
        
        return back()->with('success', 'Channel updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        $channel->delete();
        return back()->with('success', 'Channel deleted successfully!');
    }

}
