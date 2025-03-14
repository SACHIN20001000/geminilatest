<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\User;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\Channel;
use App\Models\MakeModel;
use App\Models\ModelMake;
use App\Models\Make;
use App\Models\Policy;
use App\Models\Insurance;
use App\Models\Company;
use App\Models\Attachment;
use App\Models\Endrosment;
use App\Models\SubEndrosment;
use App\Models\Quote;
use DataTables;
use Mail;
use Auth;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Admin\Lead\StoreLeadRequest;
use App\Models\TicketSystem;
use App\Traits\WhatsappApi;
use Illuminate\Support\Facades\DB;

class PolicyController extends Controller
{
    use WhatsappApi;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        // echo '<pre>'; print_r($request->all()); die;
        $products = SubProduct::all();
        $users = User::all();

        
        $query = Policy::with('users', 'lead', 'insurances', 'products', 'subProduct', 'lead.assigns')->where(['is_policy' => 1]);

        
        if (isset($request->search_anything)   && !empty($request->search_anything)) {

            $searchParam = ['holder_name', 'phone', 'email', 'reg_no', 'policy_no'];
            foreach ($searchParam as $key => $value) {

                if ($key == 0) {
                    $query->where($value, 'like', '%' . $request->search_anything . '%');
                } else {
                    $query->orwhere($value, 'like', '%' . $request->search_anything . '%');
                }
            }
        }
        if (isset($request->id) && !empty($request->id)) {
            $date = strtotime(date('Y-m-d'));
            $today = date('Y-m-d', strtotime('-1 days', $date));
            $daysabove = date('Y-m-d', strtotime('+15 days', $date));

            if (isset($request->expiry_from) && !empty($request->expiry_from) && !empty($request->expiry_to) && isset($request->expiry_to)) {
                if ($request->id == 1) {
                    $query->whereBetween('start_date', [$request->expiry_from, $request->expiry_to]);
                } else {
                    $query->whereBetween('expiry_date', [$request->expiry_from, $request->expiry_to]);
                }
            } else {
                if ($request->id == 2) {
                    $query->whereBetween('expiry_date', [$today, $daysabove]);
                }
            }
        }

        if (isset($request->type) && !empty($request->type)) {
            if ($request->type == 'premium_short') {
                $query->where('mis_short_premium', '>', 0);
            } elseif ($request->type == 'premium_deposit') {
                $query->whereNull('mis_premium_deposit');
            }
        }
        if (Auth::user()->hasRole('Broker') ||  Auth::user()->hasRole('Client')) {
            $query->where('user_id', Auth::user()->id);
        }

        if (isset($request->product)   && !empty($request->product)) {

            $query->whereIn('subproduct_id', $request->product);
        }
        if (isset($request->renew_status_search)   && !empty($request->renew_status_search)) {
            $query->where('renew_status', 'like', '%' . $request->renew_status_search . '%');
        }
        if (isset($request->mis_transaction_type)   && !empty($request->mis_transaction_type)) {
            $query->whereIn('mis_transaction_type', $request->mis_transaction_type);
        }
        if (isset($request->follow_ups)   && !empty($request->follow_ups)) {

            $query->where('follow_up', $request->follow_ups);
        }
        if (isset($request->is_paid)   && !empty($request->is_paid)) {

            if ($request->is_paid == 1) {
                $query->whereColumn('mis_amount_paid', '=', 'gross_premium');
            } else {
                $query->whereColumn('mis_amount_paid', '!=', 'gross_premium');
            }
        }


        if (isset($request->users)   && !empty($request->users)) {
            $query->whereIn('user_id', $request->users);
        }
        if (isset($request->company_id)   && !empty($request->company_id)) {
            $query->whereIn('company_id', $request->company_id);
        }
        if (isset($request->status)   && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        if (isset($request->duplicate) && !empty($request->duplicate) && $request->duplicate == true) {
            $duplicatePolicyNos = Policy::select('policy_no')
                ->groupBy('policy_no')
                ->havingRaw('COUNT(policy_no) > 1')
                ->pluck('policy_no');

            $query->whereIn('policy_no', $duplicatePolicyNos);
        }
        if ($request->id == 1) {
            if (isset($request->duplicate) && !empty($request->duplicate) && $request->duplicate == true) {
                $query->orderby('policy_no', 'desc');
            } else {
                $query->orderby('start_date', 'desc');
            }
        } else {
            $query->orderby('expiry_date', 'ASC');
        }

        $count =  $query->count();
        $leads = ($request->sort == 'all') ? $query->paginate(100000000) : $query->paginate($request->sort ?? 10);

        $companies = Company::all();
        return view('admin.policy.new-index', compact('leads', 'products', 'users', 'count', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insurances = Insurance::all();
        $companies = Company::all();
        $make = Make::all();
        $channels = Channel::all();
        $roles = Role::all();
        $users = User::all();
        return view('admin.policy.addEdit', compact('insurances', 'companies', 'make', 'channels', 'users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $policyInputs = $request->except('_token', 'attachment', 'type');
        $policyInputs['user_id'] = $request->user_id ?? auth()->user()->id;
        $policyInputs['is_policy'] = 1;
        $policyInputs['cc'] = $request->cc ?? $request->vehicle_cc ?? null;
        $policyInputs['gross_premium'] = $request->product_id != 2 ? $request->gross_premium : $request->gross_premium_normal;
        $policyInputs['gst'] = $request->product_id != 2 ? $request->gst : $request->gst_normal;
        $policyInputs['net_premium'] = $request->product_id != 2 ? $request->net_premium : $request->net_premium_normal;
        $policyInputs['expiry_date'] = $request->product_id != 2 ? $request->expiry_date : $request->expiry_date_normal;
        $policyInputs['start_date'] = $request->product_id != 2 ? $request->start_date : $request->start_date_normal;
        if ($request->mis_commission && !empty($request->mis_commission)) {
            $policyInputs['is_mis'] = 1;
        }
        if ($request->health_name && !empty($request->health_name)) {
            $health_hospitalization_upload = [];
            if (isset($request->health_hospitalization_upload) && !empty($request->health_hospitalization_upload)) {

                foreach ($request->health_hospitalization_upload as $key => $value) {
                    if (!empty($value)) {
                        $attachment_filename = preg_replace('/\s+/', '', $value->getClientOriginalName());
                        $value->move(public_path('/attachments'), $attachment_filename);
                        array_push($health_hospitalization_upload, $attachment_filename);
                    }
                }
            }

            $Healthdata = [
                'health_name' => $request->health_name,
                'health_dob' => $request->health_dob,
                'health_age' => $request->health_age,
                'health_relation' => $request->health_relation,
                'health_sum_insured' => $request->health_sum_insured,
                'health_pre_existing_disease' => $request->health_pre_existing_disease,
                'health_hospitalization_upload' => $health_hospitalization_upload,
            ];

            $policyInputs['health_type'] = json_encode($Healthdata);
        }
        if ($request->travel_name && !empty($request->travel_name)) {


            $traveldata = [
                'travel_name' => $request->travel_name,
                'travel_dob' => $request->travel_dob,
                'travel_age' => $request->travel_age,
                'travel_sum_insured' => $request->travel_sum_insured,
            ];

            $policyInputs['travel_type'] = json_encode($traveldata);
        }
        $policy = Policy::create($policyInputs);
        if (isset($request->attachment) && (!empty($request->attachment))) {
            foreach ($request->attachment as $key => $value) {
                if (!empty($value)) {
                    $attachment_filename = preg_replace('/\s+/', '', $value->getClientOriginalName());
                    $value->move(public_path('/attachments'), $attachment_filename);
                    Attachment::create([
                        'lead_id' => $policy->lead_id ?? 0,
                        'policy_id' => $policy->id ?? 0,
                        'user_id' => Auth::user()->id ?? '',
                        'file_name' => $attachment_filename ?? '',
                        'type' => 'Policy'
                    ]);
                }
            }
        }

        if (isset($request['button-type'])) {
            try {
                Mail::send('admin.email.newPolicy', ['lead' => $policy], function ($messages) use ($policy) {
                    $messages->to($policy->users->email);
                    $messages->bcc(globalSetting()['bcc_email'] ?? 'geminiservices@outlook.com');
                    $subject = 'Policy Issued,' . ($policy->holder_name ?? '') . ' ' . ($policy->subProduct->name ?? '');
                    $messages->subject($subject);
                    if (!empty($policy->policyAttachment)) {
                        foreach ($policy->policyAttachment as $attach) {
                            $fileurls = url('attachments', $attach->file_name);
                            $messages->attach($fileurls);
                        }
                    }
                });
            } catch (\Exception $th) {
                //throw $th;
            }
        }
        return redirect()->route('new-policy.index', ['id' => 1])->with('success', 'Policy Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        $policy->update(['mark_read' => 1]);
        $insurances = Insurance::all();
        $products = Product::all();
        $subProducts = SubProduct::where('product_id', $policy->product_id)->get();
        $companies = Company::all();
        $make = Make::where('subproduct_id', $policy->subproduct_id)->get();
        $model = ModelMake::all();
        $varients = MakeModel::where('make_id', $policy->model)->get();
        $channels = Channel::all();
        $roles = Role::all();
        $users =  User::with('roles')->whereHas(
            'roles',
            function ($q) use ($policy) {
                $q->where('id', '=', $policy->user_type);
            }
        )->get();
        $ticket = TicketSystem::where('policy_id', $policy->id)->with('attachments')->first();
        return view('admin.policy.one', compact('roles', 'model', 'users', 'channels', 'insurances', 'companies', 'policy', 'make', 'products', 'subProducts', 'varients', 'ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Policy $policy)
    {
        $insurances = Insurance::all();
        $products = Product::all();
        $subProducts = SubProduct::where('product_id', $policy->product_id)->get();
        $companies = Company::all();
        $make = Make::where('subproduct_id', $policy->subproduct_id)->get();
        $model = ModelMake::all();
        $varients = MakeModel::where('make_id', $policy->model)->get();
        $channels = Channel::all();
        $roles = Role::all();
        $users =  User::with('roles')->whereHas(
            'roles',
            function ($q) use ($policy) {
                $q->where('id', '=', $policy->user_type);
            }
        )->get();
        return view('admin.policy.addEdit', compact('roles', 'model', 'users', 'channels', 'insurances', 'companies', 'policy', 'make', 'products', 'subProducts', 'varients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policy $policy)
    {
        $policyInputs = $request->except('_token', '_method', 'attachment', 'type');
        if ($request->mis_commission && !empty($request->mis_commission)) {
            $policyInputs['is_mis'] = 1;
        }
        $policyInputs['cc'] = $request->cc ?? $request->vehicle_cc ?? null;
        $policyInputs['gross_premium'] = $request->product_id != 2 ? $request->gross_premium : $request->gross_premium_normal;
        $policyInputs['gst'] = $request->product_id != 2 ? $request->gst : $request->gst_normal;
        $policyInputs['net_premium'] = $request->product_id != 2 ? $request->net_premium : $request->net_premium_normal;
        $policyInputs['expiry_date'] = $request->product_id != 2 ? $request->expiry_date : $request->expiry_date_normal;
        $policyInputs['start_date'] = $request->product_id != 2 ? $request->start_date : $request->start_date_normal;

        if ($request->health_name && !empty($request->health_name)) {
            $health_hospitalization_upload = [];
            if (isset($request->health_hospitalization_upload) && !empty($request->health_hospitalization_upload)) {

                foreach ($request->health_hospitalization_upload as $key => $value) {
                    if (!empty($value)) {
                        $attachment_filename = preg_replace('/\s+/', '', $value->getClientOriginalName());
                        $value->move(public_path('/attachments'), $attachment_filename);
                        array_push($health_hospitalization_upload, $attachment_filename);
                    }
                }
            }

            $Healthdata = [
                'health_name' => $request->health_name,
                'health_dob' => $request->health_dob,
                'health_age' => $request->health_age,
                'health_relation' => $request->health_relation,
                'health_sum_insured' => $request->health_sum_insured,
                'health_pre_existing_disease' => $request->health_pre_existing_disease,
                'health_hospitalization_upload' => $health_hospitalization_upload,
            ];

            $policyInputs['health_type'] = json_encode($Healthdata);
        }
        if ($request->travel_name && !empty($request->travel_name)) {


            $traveldata = [
                'travel_name' => $request->travel_name,
                'travel_dob' => $request->travel_dob,
                'travel_age' => $request->travel_age,
                'travel_sum_insured' => $request->travel_sum_insured,
            ];

            $policyInputs['travel_type'] = json_encode($traveldata);
        }
        $policy->update($policyInputs);
        if (isset($request->attachment) && (!empty($request->attachment))) {
            foreach ($request->attachment as $key => $value) {
                if (!empty($value)) {
                    $attachment_filename = preg_replace('/\s+/', '', $value->getClientOriginalName());
                    $value->move(public_path('/attachments'), $attachment_filename);
                    Attachment::create([
                        'lead_id' => $policy->lead_id ?? 0,
                        'policy_id' => $policy->id ?? 0,
                        'user_id' => Auth::user()->id ?? '',
                        'file_name' => $attachment_filename ?? '',
                        'type' => 'Policy'
                    ]);
                }
            }
        }
        if (isset($request['button-type'])) {
            try {
                Mail::send('admin.email.newPolicy', ['lead' => $policy], function ($messages) use ($policy) {
                    $messages->to($policy->users->email);
                    $messages->bcc(globalSetting()['bcc_email'] ?? 'geminiservices@outlook.com');

                    $subject = 'Policy Issued,' . ($policy->holder_name ?? '') . ' ' . ($policy->subProduct->name ?? '');
                    $messages->subject($subject);
                    if (!empty($policy->policyAttachment)) {
                        foreach ($policy->policyAttachment as $attach) {
                            $fileurls = url('attachments', $attach->file_name);
                            $messages->attach($fileurls);
                        }
                    }
                });
            } catch (\Exception $th) {
                // throw $th;
            }
        }


        return redirect()->route('new-policy.index', ['id' => 1])->with('success', 'Policy Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Policy $policy)
    {

        $policy->delete();
        if ($request->ajax()) {
            return response()->json(['message' => 'Policy Deleted successfully', 'data' => $request->all]);
        } else {
            return back()->with('success', 'Policy Deleted successfully!');
        }
    }
    public function renew_status(Request $request)
    {
        Policy::find($request->policy_id)->update(['renew_status' => $request->status]);
        if ($request->status == 'VEHICLE SOLD' || $request->status == 'NOT INTERESTED') {
            $policy = Policy::find($request->policy_id);
            
            if ($policy->lead_id == 0) {
             
                $lead =  Lead::create([
                    'user_id' => $policy->user_id ?? auth()->user()->id,
                    'holder_name' => $policy->holder_name ?? '',
                    'phone' => $policy->phone ?? '',
                    'email' => $policy->email ?? '',
                    'insurance_id' => $policy->insurance_id ?? null,
                    'product_id' => $policy->product_id ?? null,
                    'subproduct_id' => $policy->subproduct_id ?? null,
                    'status' => 'REJECTED' ?? null,
                ]);
                
                $policy->update(['lead_id' => $lead->id]);
            } else {
                Lead::find($policy->lead_id)->update(['status' => 'REJECTED', 'mark_read' => 0]);
            }
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Status Updated successfully', 'data' => $request->all]);
        } else {
            return back()->with('success', 'Status Updated successfully!');
        }
    }

    public function endrosment(Request $request)
    {
        $policy = Policy::where('id', $request->policy_id)->with(['users', 'commonAttachment', 'subProduct', 'lead'])->first();

        try {
            Mail::send('admin.email.endrosment', ['policy' => $policy, 'content' => $request->content], function ($messages) use ($request, $policy) {
                $messages->to($request->to);
                $messages->bcc(globalSetting()['bcc_email'] ?? 'geminiservices@outlook.com');

                if (!empty($request->cc)) {
                    $messages->cc($request->cc);
                }
                $subject = $policy->holder_name . ' insurance due on ' . $policy->expiry_date ?? 'Gemini consultancy Service';
                $messages->subject($subject);
                if (!empty($policy->commonAttachment)) {
                    foreach ($policy->commonAttachment as $attach) {
                        $fileurls = url('attachments', $attach->file_name);
                        $messages->attach($fileurls);
                    }
                }
            });

            if (!empty($policy->users->phone)) {
                $data = rawurlencode(strip_tags($request->content));
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
            if ($request->ajax()) {
                return response()->json(['message' => $e->getMessage(), 'data' => $request->all()]);
            }
        }
        if ($request->ajax()) {
            return response()->json(['message' => 'Mail sent successfully', 'data' => $request->all()]);
        } else {
            return back()->with('success', 'Mail Sent successfully!');
        }
    }
    public function commonEndrosment(Request $request)
    {

        $lead =   Lead::find($request->lead_id);

        $endresoment = Endrosment::create([
            'created_to' => $lead->user_id,
            'created_by' => auth()->user()->id,
            'parent' => 1,
            'lead_id' => $request->lead_id,
            'previous_message' => $request->previous_message,
            'new_message' => $request->new_message,
            'type' => $request->type,
        ]);
        if (!empty($request->image)) {
            $allImage = [];
            foreach ($request->image as $key => $image) {
                $attachment_filename = preg_replace('/\s+/', '', $image->getClientOriginalName());
                $image->move(public_path('/endrosment'), $attachment_filename);
                array_push($allImage, $attachment_filename);
            }

            $endresoment->update(['image' => json_encode($allImage)]);
        }
        return back()->with('success', 'Endrosment Sent successfully!');
    }
    public function subEndrosment(Request $request)
    {

        $endrosment = Endrosment::find($request->lead_id);
        $endresoment = SubEndrosment::create([
            'created_to' => $endrosment->created_by,
            'created_by' => auth()->user()->id,
            'endrosment_id' => $request->lead_id,
            'message' => $request->message,
        ]);
        if (!empty($request->image)) {
            $allImage = [];
            foreach ($request->image as $key => $image) {
                $attachment_filename = preg_replace('/\s+/', '', $image->getClientOriginalName());
                $image->move(public_path('/endrosment'), $attachment_filename);
                array_push($allImage, $attachment_filename);
            }

            $endresoment->update(['image' => json_encode($allImage)]);
        }
        return back()->with('success', 'Reply Sent successfully!');
    }
    public function bulkEmail(Request $request)
    {


        $user = User::with(['policies' => function ($query) use ($request) {
            $query->whereIn('id', $request->id);
        }])
            ->whereHas('policies', function ($q) use ($request) {
                $q->whereIn('id', $request->id);
            })
            ->get();
        foreach ($user as $key => $value) {
            try {
                Mail::send('admin.email.bulkemail', ['user' => $value], function ($messages) use ($value) {
                    $messages->to($value->email);
                    $messages->bcc(globalSetting()['bcc_email'] ?? 'geminiservices@outlook.com');

                    $subject = 'Renewals Mis';
                    $messages->subject($subject);
                });
                if (!empty($value->phone)) {
                    $texturl = env("WHATSAPP_URL", "https://bulkchatbot.co.in/api/send.php") . '?number=' . $value->phone . '&type=text&message=' . view('admin.email.bulkemail', ['user' => $value]) . '&instance_id=' . env("WHATSAPP_INSTANCE", "63B293D6D4019") . '&access_token' . env("WHATSAPP_TOKEN", "d947472c111c73ec8b4187b3dad025a2");

                    $this->sendMessage($texturl);
                }
            } catch (Exception $e) {
            }
        }
    }

    public function bulkDelete(Request $request)
    {
        Policy::whereIn('id', $request->id)->delete();
        return back()->with('success', 'Deleted successfully!');
    }
    public function renewFolloup(Request $request)
    {
        Policy::where('id', $request->id)->update(['follow_up' => $request->date]);
    }
    public function renewAttachment(Request $request)
    {

        if (!empty($request->image)) {
            $attachment_filename = preg_replace('/\s+/', '', $request->image->getClientOriginalName());
            $request->image->move(public_path('/attachments'), $attachment_filename);
            Attachment::create([
                'policy_id' => $request->policy_id ?? 0,
                'user_id' => Auth::user()->id ?? '',
                'file_name' => $attachment_filename ?? '',
                'type' => 'Renewal' ??  ''
            ]);
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Renewal Created successfully!', 'data' => $request->all()]);
        } else {
            return back()->with('success', 'Renewal Created successfully!');
        }
    }
    public function acceptPolicyLead(Request $request)
    {
        $policy = Policy::find($request->quote);

        if ($policy->lead_id == 0) {
            $lead =  Lead::create([
                'user_id' => $policy->user_id ?? auth()->user()->id,
                'holder_name' => $policy->holder_name ?? '',
                'phone' => $policy->phone ?? '',
                'email' => $policy->email ?? '',
                'insurance_id' => $policy->insurance_id ?? null,
                'product_id' => $policy->product_id ?? null,
                'subproduct_id' => $policy->subproduct_id ?? null,
                'status' => 'POLICY TO BE ISSUED' ?? null,
            ]);
            $policy->update(['lead_id' => $lead->id]);
        } else {
            Lead::find($policy->lead_id)->update(['status' => 'POLICY TO BE ISSUED', 'mark_read' => 0]);
        }
        $policy->update(['is_policy' => 0]);
        return redirect()->route('leads.index', ['id' => 3])->with('success', ' Accepted successfully!');
    }
    public function rejectpolicyLead(Request $request)
    {
        $policy = Policy::find($request->quote);
        $policy->update(['is_policy' => 0]);
        if ($policy->lead_id == 0) {
            $lead =  Lead::create([
                'user_id' => $policy->user_id ?? auth()->user()->id,
                'holder_name' => $policy->holder_name ?? '',
                'phone' => $policy->phone ?? '',
                'email' => $policy->email ?? '',
                'insurance_id' => $policy->insurance_id ?? null,
                'product_id' => $policy->product_id ?? null,
                'subproduct_id' => $policy->subproduct_id ?? null,
                'status' => 'POLICY TO BE ISSUED' ?? null,
            ]);

            $policy->update(['lead_id' => $lead->id]);
        } else {
            Lead::find($policy->lead_id)->update(['status' => 'REJECTED', 'mark_read' => 0]);
        }

        return redirect()->route('leads.index', ['id' => 4])->with('success', ' Rejected successfully!');
    }
    public function delAttachment(Request $request, $id)
    {
        Attachment::find($id)->delete();
        if ($request->ajax()) {
            return response()->json(['message' => 'Deleted successfully!', 'data' => $request->all()]);
        } else {
            return back()->with('success', 'Deleted successfully!');
        }
    }
}
