<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\TicketAttachment;
use App\Models\TicketRemark;
use App\Models\TicketSystem;
use Illuminate\Http\Request;
use DataTables;

class TicketSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = TicketSystem::with('user', 'policy');
            

            $data = $query->orderby('id', 'DESC')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $action = '<span class="action-buttons">
                                <a  href="' . route("ticket.show", $row) . '" class="btn btn-sm btn-info btn-b"><i class="fa fa-eye"></i>
                                </a>
                               
                      

                        <a href="' . route("ticket.destroy", $row) . '"
                                class="btn btn-sm btn-danger remove_us"
                                title="Delete User"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-method="DELETE"
                                data-confirm-title="Please Confirm"
                                data-confirm-text="Are you sure that you want to delete this ticket?"
                                data-confirm-delete="Yes, delete it!">
                                <i class="las la-trash"></i>
                            </a>
                    ';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $inputs = $request->all();
        $inputs['user_id'] = auth()->user()->id;
        $ticket =  TicketSystem::create($inputs);
        if ($request->remark && !empty($request->remark)) {
            TicketRemark::create([
                'ticket_id' => $ticket->id,
                'user_id' => auth()->user()->id,
                'remark' => $request->remark
            ]);
        }
        if ($request->file && !empty($request->file)) {


            foreach ($request->file as $value) {
                $attachment_filename = preg_replace('/\s+/', '', $value->getClientOriginalName());
                $value->move(public_path('/attachments'), $attachment_filename);
                TicketAttachment::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => auth()->user()->id,
                    'file' => $attachment_filename
                ]);
            }
        }

        return redirect()->back()->with('success', 'Ticket created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TicketSystem $ticket)
    {
        return view('admin.ticket.show', compact('ticket'));
    }
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        TicketSystem::find($id)->update([
            'status' => $request->status
        ]);
        TicketRemark::create([
            'ticket_id' => $id,
            'user_id' => auth()->user()->id,
            'remark' => $request->remark
        ]);
        return redirect()->back()->with('success', 'Ticket updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TicketRemark::where('ticket_id', $id)->delete();
        TicketAttachment::where('ticket_id', $id)->delete();
        TicketSystem::find($id)->delete();
        return redirect()->back()->with('success', 'Ticket deleted successfully');
    }
}
