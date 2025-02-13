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
use App\Traits\WhatsappApi;
use Illuminate\Support\Facades\DB;

class NewPolicyController extends Controller
{
    use WhatsappApi;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $products = SubProduct::all();
        $users = User::all();
        $query = Policy::with('users', 'lead', 'insurances', 'products', 'subProduct', 'lead.assigns', 'company', 'attachments', 'makes', 'models', 'varriants')->where('is_policy', 1);
        if (Auth::user()->hasRole('Broker') ||  Auth::user()->hasRole('Client')) {

            $query->where('user_id', Auth::user()->id);
        }
        if (isset($request->id) && !empty($request->id)) {
            $date = strtotime(date('Y-m-d'));
            $today = date('Y-m-d', strtotime('-1 days', $date));
            $daysabove = date('Y-m-d', strtotime('+15 days', $date));

            if (isset($request->expiry_from) && !empty($request->expiry_from) && !empty($request->expiry_to) && isset($request->expiry_to)) {
                if ($request->id == 1) {
                    // Grouping renew_status conditions using closure
                    $query->whereBetween('start_date', [$request->expiry_from, $request->expiry_to])
                        ->where(function ($q) {
                            $q->where('renew_status', 'FOLLOW UP')
                                ->orWhere('renew_status', 'POLICY ISSUED')
                                ->orWhere('renew_status', 'CLOSED');
                        });
                } else {
                    $query->whereBetween('expiry_date', [$request->expiry_from, $request->expiry_to])
                        ->where(function ($q) {
                            $q->where('renew_status', 'FOLLOW UP')
                                ->orWhere('renew_status', 'POLICY ISSUED');
                        });
                }
            } else {
                if ($request->id == 2) {
                    // Grouping renew_status conditions using closure
                    $query->where(function ($q) {
                        $q->where('renew_status', 'FOLLOW UP')
                            ->orWhere('renew_status', 'POLICY ISSUED');
                    })
                        ->whereBetween('expiry_date', [$today, $daysabove]);
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

        if ($request->ajax()) {
            if (isset($request->product)   && !empty($request->product)) {

                $query->whereIn('subproduct_id', $request->product);
            }
        }

        if (isset($request->renew_status_search)   && !empty($request->renew_status_search)) {
            $query->where('renew_status', 'like', '%' . $request->renew_status_search . '%');
        }
        if ($request->ajax()) {
            if (isset($request->mis_transaction_type)   && !empty($request->mis_transaction_type)) {
                $query->whereIn('mis_transaction_type', $request->mis_transaction_type);
            }
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


        if ($request->ajax()) {
            if (isset($request->users)   && !empty($request->users)) {
                $query->whereIn('user_id', $request->users);
            }
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
        $leads = $query->get();


        $companies = Company::all();
        if ($request->ajax()) {
            return Datatables::of($leads)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '<div class="d-flex align-items-center gap-2">';
                    // Check if request id is 2, then show the select box
                    if (request()->id == 2) {
                        $action .= '<select name="renew_status" id="renew_status" data-id="' . $row->id . '" class="form-control renew_status">';
                        $action .= '<option value="FOLLOW UP" ' . (isset($row->renew_status) && $row->renew_status == 'FOLLOW UP' ? 'selected' : '') . '>FOLLOW UP</option>';
                        $action .= '<option value="VEHICLE SOLD" ' . (isset($row->renew_status) && $row->renew_status == 'VEHICLE SOLD' ? 'selected' : '') . '>VEHICLE SOLD</option>';
                        $action .= '<option value="NOT INTERESTED" ' . (isset($row->renew_status) && $row->renew_status == 'NOT INTERESTED' ? 'selected' : '') . '>NOT INTERESTED</option>';
                        $action .= '<option value="CLOSED" ' . (isset($row->renew_status) && $row->renew_status == 'CLOSED' ? 'selected' : '') . '>CLOSED</option>';
                        $action .= '</select>';
                    }
                    // Common "Send Mail" button
                    $action .= '<a 
                                    type="button" 
                                    data-id="' . $row->phone . ' "
                                    data-toggle="tooltip"
                                    title="' . $row->phone . ' "
                                    class="endrosment-btn iconBtn"><i class="fa fa-phone text-info"></i></a>';
                    $action .= '<a 
                                    type="button" 
                                    data-id="' . $row->id . ' "
                                    data-email="' . (optional($row->users)->email ?? '') . '"
                                    data-expiry="' . date("d-m-Y", strtotime($row->expiry_date)) . '"
                                    data-customer="' . ($row->holder_name ?? '') . '"
                                    data-product="' . ($row->products->name ?? '') . '"
                                    data-subproduct="' . (optional($row->products)->name ?? '') . '"
                                    data-policy="' . ($row->reg_no ?? '') . '"
                                    data-name="' . (optional($row->users)->name ?? '') . '"
                                    data-toggle="tooltip"
                                    title="Send Mail!"
                                    class="common-btn iconBtn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                                </a>';
                    // Common "Send Mail" button
                    $action .= '<a 
                                    type="button" 
                                    data-id="' . $row->id . ' "
                                    data-toggle="tooltip"
                                    title="Endrosment"
                                    class="endrosment-btn iconBtn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM625 177L497 305c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L591 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                                </a>';



                    // Check if request id is not 2, then show the action buttons
                    if (request()->id != 2) {
                        $action .= '<span class="action-buttons ml-3 d-flex align-items-center gap-2">';
                        $action .= '<a href="' . route("policy.edit", $row) . '" class="iconBtn" data-toggle="tooltip" data-placement="top" title="Edit Policy" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg></a>';
                        if (Auth::user()->hasRole('Staff') || Auth::user()->hasRole('Admin')) {
                            $action .= '<a href="' . route("policy.destroy", $row) . '"
                            class="iconBtn remove_us"
                            
                            data-confirm-delete="Yes, delete it!">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                        </a>
                    </span>';
                        }
                    }

                    $action .= '</div>';

                    return $action;
                })


                ->addColumn('checkbox', function ($row) {
                    $checkbox = '<input type="checkbox" name="checked" data-id="' . $row->id . '" class="checkSingle checkLead">';
                    return $checkbox;
                })
                ->addColumn('attachment', function ($row) {
                    $attachmentdata = '<div><svg class="open-attachment" height="24" viewBox="0 0 1792 1792" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M1344 1472q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm256 0q0-26-19-45t-45-19-45 19-19 45 19 45 45 19 45-19 19-45zm128-224v320q0 40-28 68t-68 28h-1472q-40 0-68-28t-28-68v-320q0-40 28-68t68-28h427q21 56 70.5 92t110.5 36h256q61 0 110.5-36t70.5-92h427q40 0 68 28t28 68zm-325-648q-17 40-59 40h-256v448q0 26-19 45t-45 19h-256q-26 0-45-19t-19-45v-448h-256q-42 0-59-40-17-39 14-69l448-448q18-19 45-19t45 19l448 448q31 30 14 69z"/></svg>
                <input type="file" data-id="' . $row->id . '" class="form-control renew-att" style="display: none;"></div>';
                    if (!empty($row->attachments)) {
                        foreach ($row->attachments as $attachment) {
                            if ($attachment->type == 'Renewal') {
                                $attachmentdata .= '<a class="view_files" href="' . asset("attachments/{$attachment->file_name}") . '" target="_blank">
                                    <svg class="feather feather-file-text" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <polyline points="14 2 14 8 20 8" />
                                        <line x1="16" x2="8" y1="13" y2="13" />
                                        <line x1="16" x2="8" y1="17" y2="17" />
                                        <polyline points="10 9 9 9 8 9" />
                                    </svg>
                                </a>
                                <a href="' . route('delAttachment', $attachment->id) . '" data-attachment-id="{{ $attachment->id }}" class="remove_us remove_attachment" title="Delete Lead" data-toggle="tooltip" data-placement="top" data-method="DELETE">
                                    <svg height="512px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g>
                                            <path d="M256,33C132.3,33,32,133.3,32,257c0,123.7,100.3,224,224,224c123.7,0,224-100.3,224-224C480,133.3,379.7,33,256,33z M364.3,332.5c1.5,1.5,2.3,3.5,2.3,5.6c0,2.1-0.8,4.2-2.3,5.6l-21.6,21.7c-1.6,1.6-3.6,2.3-5.6,2.3c-2,0-4.1-0.8-5.6-2.3L256,289.8 l-75.4,75.7c-1.5,1.6-3.6,2.3-5.6,2.3c-2,0-4.1-0.8-5.6-2.3l-21.6-21.7c-1.5-1.5-2.3-3.5-2.3-5.6c0-2.1,0.8-4.2,2.3-5.6l75.7-76 l-75.9-75c-3.1-3.1-3.1-8.2,0-11.3l21.6-21.7c1.5-1.5,3.5-2.3,5.6-2.3c2.1,0,4.1,0.8,5.6,2.3l75.7,74.7l75.7-74.7 c1.5-1.5,3.5-2.3,5.6-2.3c2.1,0,4.1,0.8,5.6,2.3l21.6,21.7c3.1,3.1,3.1,8.2,0,11.3l-75.9,75L364.3,332.5z" />
                                        </g>
                                    </svg>
                                </a>';
                            }
                        }
                    }
                    return $attachmentdata;
                })
                ->addColumn('is_paid', function ($row) {
                    return   $row->mis_amount_paid !== $row->gross_premium ? 'Short' : 'Paid';
                })
                ->addColumn('followDate', function ($row) {
                    $followUp = '<input type="date" name="follow_up" value="' . ($row->follow_up ?? $row->expiry_date) . '" data-id="' . $row->id . '" class="form-control follow_up">';
                    return $followUp;
                })
                ->rawColumns(['action', 'checkbox', 'attachment', 'followDate'])
                ->make(true);
        }
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
        return view('admin.policy.one', compact('roles', 'model', 'users', 'channels', 'insurances', 'companies', 'policy', 'make', 'products', 'subProducts', 'varients'));
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
    public function destroy(Policy $policy)
    {

        $policy->delete();
        return back()->with('success', 'Policy Deleted successfully!');
    }
    public function renew_status(Request $request)
    {
        Policy::find($request->policy_id)->update(['renew_status' => $request->status]);
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
        }
        return back()->with('success', 'Mail Sent successfully!');
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


        return back()->with('success', 'Renewal Created successfully!');
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
    public function delAttachment($id)
    {
        Attachment::find($id)->delete();
        return back()->with('success', 'Deleted successfully!');
    }
}
