<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;
use App\Models\Remainder;
use Carbon\Carbon;
use DataTables;
use App\Traits\WhatsappApi;
use Illuminate\Support\Facades\Mail;

ini_set('max_execution_time', 300000000000000000000000);


class RemainderController extends Controller
{
    use WhatsappApi;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Remainder::orderby('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '<span class="action-buttons">
                                
                        <a  href="' . route("remainder.edit", $row) . '" class="btn btn-sm btn-info btn-b"><i class="las la-pen"></i>
                        </a>

                        <a href="' . route("remainder.destroy", $row) . '"
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

        return view('admin.remainder.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('admin.remainder.addEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        Remainder::create($request->all());
        return redirect()->route('remainder.index')->with('success', 'Remainder Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $remainder = Remainder::find($id);
        return view('admin.remainder.addEdit', compact('remainder'));
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


        $remainder = Remainder::find($id);
        $remainder->update($request->all());
        return redirect()->route('remainder.index')->with('success', 'Remainder Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        Remainder::find($id)->delete();
        return redirect()->route('remainder.index')->with('success', 'Remainder Deleted Successfully');
    }

    public function cronRemainder()
    {

        set_time_limit(0);
        $remainders = Remainder::where('status', 'active')->get();
        foreach ($remainders as $remainder) {

            $policies = Policy::where('expiry_date', '=', Carbon::now()->addDays($remainder->date)->toDateString())
                ->where('renew_status', '!=', 'CLOSED')->where(['is_policy' => 1])
                ->get();

            foreach ($policies as $policy) {

                $result = view('admin.email.renewal', compact('policy'))->render();

                try {
                    if (!empty($policy->users->email)) {

                        Mail::send('admin.email.renewal', ['policy' => $policy], function ($messages) use ($policy) {
                            $messages->to($policy->users->email);
                            $messages->bcc(globalSetting()['bcc_email'] ?? 'geminiservices@outlook.com');
                            $subject = $policy->holder_name . ' insurance due on ' . $policy->expiry_date ?? 'Gemini consultancy Service';
                            $messages->subject($subject);
                            if (!empty($policy->commonAttachment)) {
                                foreach ($policy->commonAttachment as $attach) {
                                    $fileurls = url('attachments', $attach->file_name);
                                    $messages->attach($fileurls);
                                }
                            }
                        });
                    }

                    if (!empty($policy->users->phone)) {
                        $data = rawurlencode(strip_tags($result));
                        $media = '';
                        $type = '&type=text';
                        if (!empty($policy->commonAttachment)) {

                            foreach ($policy->commonAttachment as $attach) {
                                $fileurls = url('attachments', $attach->file_name);
                                $media = '&media_url=' . $fileurls . '&filename=' . $fileurls;
                                $type = '&type=media';
                                $messagefile = rawurlencode(strip_tags($attach->file_name));
                                $url = env("WHATSAPP_URL", "https://bulkchatbot.co.in/api/send.php") . '?number=' . $policy->users->phone . $type . $media . '&message=' . $messagefile . '&instance_id=' . env("WHATSAPP_INSTANCE", "63B293D6D4019") . '&access_token=' . env("WHATSAPP_TOKEN", "d947472c111c73ec8b4187b3dad025a2");
                                $this->sendFileMessage($url);
                            }
                        }

                        $texturl = env("WHATSAPP_URL", "https://bulkchatbot.co.in/api/send.php") . '?number=' . $policy->users->phone . '&type=text&message=' . $data . '&instance_id=' . env("WHATSAPP_INSTANCE", "63B293D6D4019") . '&access_token=' . env("WHATSAPP_TOKEN", "d947472c111c73ec8b4187b3dad025a2");

                        $this->sendMessage($texturl);
                    }
                } catch (Exception $e) {
                }
            }
        }
    }
}
