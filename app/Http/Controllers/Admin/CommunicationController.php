<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Communication;
use App\Models\CommunicationGroup;
use App\Models\User;
use DataTables;
use Mail;
use App\Traits\WhatsappApi;
use Illuminate\Support\Facades\File;

set_time_limit(600);



class CommunicationController extends Controller
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
            $data = Communication::with('users', 'group')->orderby('id', 'DESC')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.communication.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = CommunicationGroup::all();

        return view('admin.communication.addEdit', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $communication = $request->except('_token');

        $communication['created_by'] = auth()->user()->id;
        $communicate =  Communication::create($communication);
        if ($request->hasfile('attachment')) {
            $publicPdfDirectory = public_path('communication');

            if (!File::exists($publicPdfDirectory)) {
                File::makeDirectory($publicPdfDirectory, 0755, true);
            }
            foreach ($request->file('attachment') as $file) {
                $attachment_filename = preg_replace('/\s+/', '', $file->getClientOriginalName());
                $file->move(public_path('/communication'), $attachment_filename);

                $communicate->attachments()->create([
                    'file_name' => $attachment_filename,
                    'file_path' => '/communication/' . $attachment_filename,
                ]);
            }
        }


        $query = User::with('roles');
        if (isset($request->type)) {
            if ($request->type == 'Admin Only') {
                $query->whereHas(
                    'roles',
                    function ($q) {
                        $q->where('name', '=', 'Admin');
                    }
                );
            }
            if ($request->type == 'Broker Only') {
                $query->whereHas(
                    'roles',
                    function ($q) {
                        $q->where('name', '=', 'Broker');
                    }
                );
            }
            if ($request->type == 'Staff Only') {
                $query->whereHas(
                    'roles',
                    function ($q) {
                        $q->where('name', '=', 'Staff');
                    }
                );
            }
            if ($request->type == 'Client Only') {
                $query->whereHas(
                    'roles',
                    function ($q) {
                        $q->where('name', '=', 'Client');
                    }
                );
            }
            if ($request->type == 'Group') {
                $group = CommunicationGroup::find($request->group_id);
                if ($group && $group->users_id) {
                    $query->whereIn('id', explode(',', $group->users_id));
                } else {
                    $query->where('id', 0);
                }
            }
        }

        $data = $query->orderby('id', 'DESC')->get(['email', 'phone']);
        if ($data->count()) {
            foreach ($data as $key => $value) {
                try {

                    if (($request->sentWhere == 'whatsapp'  || $request->sentWhere == 'both') && $value->phone) {


                        $data = rawurlencode(strip_tags($request->text));
                        $media = '';
                        $type = '&type=text';
                        if (!empty($communicate->attachments)) {

                            foreach ($communicate->attachments as $attach) {
                                $media = '&media_url=' . url($attach->file_path) . '&filename=' . $attach->file_name;
                                $type = '&type=media';
                                $messagefile = rawurlencode(strip_tags($attach->file_name));
                                $url = env("WHATSAPP_URL", "https://bulkchatbot.co.in/api/send.php") . '?number=' . $value->phone . $type . $media . '&message=' . $messagefile . '&instance_id=' . env("WHATSAPP_INSTANCE", "63B293D6D4019") . '&access_token=' . env("WHATSAPP_TOKEN", "d947472c111c73ec8b4187b3dad025a2");
                                $this->sendFileMessage($url);
                            }
                        }

                        $texturl = env("WHATSAPP_URL", "https://bulkchatbot.co.in/api/send.php") . '?number=' . $value->phone . '&type=text&message=' . $data . '&instance_id=' . env("WHATSAPP_INSTANCE", "63B293D6D4019") . '&access_token=' . env("WHATSAPP_TOKEN", "d947472c111c73ec8b4187b3dad025a2");

                        $this->sendMessage($texturl);

                      
                    }
                    if (($request->sentWhere == 'email'  || $request->sentWhere == 'both')  && $value->email) {
                        Mail::send('admin.email.communication', ['content' => $request->text], function ($messages) use ($request, $value, $communicate) {
                            $messages->to($value->email);
                            $messages->bcc(globalSetting()['bcc_email'] ?? 'geminiservices@outlook.com');
                            $subject = $request->subject ?? 'Gemini consultancy Service';
                            if (!empty($communicate->attachments)) {
                                foreach ($communicate->attachments as $attach) {
                                    $messages->attach(url($attach->file_path));
                                }
                            }
                            $messages->subject($subject);
                        });
                    }
                } catch (Exception $e) {
                    // return redirect()->back()->with('error', 'Something went wrong!');
                }
            }
        }

        return redirect()->route('communications.index')->with('success', 'Mail Send successfully!');
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
        $expences = $request->except('_token', '_method');
        Expences::find($id)->update($expences);
        return redirect()->back()->with('success', 'Expences Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expences::find($id)->delete();
        return redirect()->back()->with('success', 'Expences Delete successfully!');
    }
}
