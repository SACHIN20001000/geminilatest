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

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $products = SubProduct::all();
        $users = User::with('roles')->whereHas(
            'roles',
            function ($q) {
                $q->where('name', '=', 'Broker');
            }
        )->get();
        $query = Policy::with('users', 'lead', 'insurances', 'products', 'subProduct', 'lead.assigns')->where(['is_policy' => 1]);
        if (isset($request->search_anything)   && !empty($request->search_anything)) {
            $query->orwhereHas('lead', function ($q) use ($request) {

                $searchParam = ['holder_name', 'phone', 'email'];
                foreach ($searchParam as $key => $value) {
                    $q->orwhere($value, 'like', '%' . $request->search_anything . '%');
                }
            })
                ->orwhereHas('insurances', function ($q) use ($request) {

                    $q->where('name',  $request->search_anything);
                })
                ->orwhereHas('products', function ($q) use ($request) {

                    $q->where('name',  $request->search_anything);
                })
                ->orwhereHas('subProduct', function ($q) use ($request) {

                    $q->where('name',  $request->search_anything);
                });
        }
        if (isset($request->id) && !empty($request->id)) {
            $date = strtotime(date('Y-m-d'));
            $today = date('Y-m-d', strtotime('-1 days', $date));
            $daysabove = date('Y-m-d', strtotime('+15 days', $date));

            if (isset($request->expiry_from) && !empty($request->expiry_from) && !empty($request->expiry_to) && isset($request->expiry_to)) {
                $query->whereBetween('expiry_date', [$request->expiry_from, $request->expiry_to]);
            } else {
                if ($request->id == 2) {
                    $query->whereBetween('expiry_date', [$today, $daysabove]);
                }
            }
        }

        if (isset($request->product)   && !empty($request->product)) {

            $query->where('subproduct_id', $request->product);
        }
        if (isset($request->follow_ups)   && !empty($request->follow_ups)) {

            $query->where('follow_ups', $request->follow_ups);
        }
        if (isset($request->search_anything)   && !empty($request->search_anything)) {
            $searchParam = ['user_id', 'insurance_id', 'product_id', 'net_premium', 'case_type', 'policy_no', 'channel_name', 'lead_id', 'company_id', 'attachment_id', 'subproduct_id', 'gross_premium', 'others', 'pa', 'tp_premium', 'add_on_premium', 'od_premium', 'gwp', 'gst', 'basic_premium', 'terrorism_premium', 'requirement', 'client_name', 'address', 'remarks', 'type', 'commodity_type', 'mode_of_transport', 'cover_type', 'per_sending_limit', 'per_location_limit', 'estimate_annual_sum', 'basic_of_valuation', 'policy_period', 'start_date', 'expiry_date', 'commodity_details', 'packing_description', 'libality', 'policy_type', 'liability_industrial', 'liability_nonindustrial', 'liability_act', 'professional_indeminity', 'comprehensive_general_liability', 'wc_policy', 'pincode', 'industry_type', 'worker_number', 'job_profile', 'salary_per_month', 'add_on_cover', 'medical_extension', 'occupation_disease', 'compressed_air_disease', 'terrorism_cover', 'terrorism_cover', 'multiple_location', 'occupancy', 'occupancy_tarriff', 'particular', 'building', 'plant_machine', 'furniture_fixure', 'stock_in_process', 'finished_stock', 'other_contents', 'clain_in_last_three_year', 'loss_details', 'loss_in_amount', 'loss_date', 'measures_taken_after_loss', 'address_risk_location', 'cover_opted', 'policy_inception_date', 'tenure', 'construction_type', 'age_of_building', 'basement_for_building', 'basement_for_content', 'claims', 'building_carpet_area', 'building_cost_of_construction', 'building_sum_insured', 'content_sum_insured', 'rent_alternative_accommodation', 'health_type', 'fresh', 'portability', 'dob', 'pre_existing_disease', 'hospitalization_history', 'upload_discharge_summary', 'dob_sr_most_member', 'dob_self', 'dob_spouse', 'dob_child', 'dob_father', 'dob_mother', 'sum_insured', 'visiting_country', 'date_of_departure', 'date_of_arrival', 'no_of_days', 'no_person', 'passport_datails', 'make', 'model', 'cubic_capacity', 'bussiness_type', 'rto', 'reg_no', 'mfr_year', 'reg_date', 'claims_in_existing_policy', 'ncb_in_existing_policy', 'gcv_type', 'gvw', 'fuel_type', 'passenger_carrying_capacity', 'category', 'varriant'];
            foreach ($searchParam as $key => $value) {
                $query->orwhere($value, 'like', '%' . $request->search_anything . '%');
            }
            if (isset($request->users)   && !empty($request->users)) {
                $query->where('assigned', $request->users);
            }
        }

        if (isset($request->users)   && !empty($request->users)) {
            $query->where('user_id', $request->users);
        }
        if (isset($request->status)   && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        if ($request->id == 1) {
            $query->orderby('id', 'desc');
        } else {
            $query->orderby('expiry_date', 'ASC');
        }
        if (isset($request->sort)   && !empty($request->sort)) {
            if ($request->sort == 'all') {
                $leads =  $query->paginate(100000);
            } else {
                $leads =  $query->paginate($request->sort);
            }
        } else {
            $leads =  $query->paginate(10);
        }

        return view('admin.policy.index', compact('leads', 'products', 'users'));
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
        Policy::create($policyInputs);
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
                        'type' => $request->type[$key] ??  ''
                    ]);
                }
            }
        }
        return redirect()->route('policy.index', ['id' => 1])->with('success', 'Policy Added successfully!');
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
        $company = Company::all();
        return view('admin.policy.one', compact('policy', 'company'));
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
                        'type' => $request->type[$key] ??  ''
                    ]);
                }
            }
        }
        return redirect()->route('policy.index', ['id' => 1])->with('success', 'Policy Update successfully!');
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

        if ($request->type == 'email') {
            $policy = Policy::where('id', $request->policy_id)->with(['users', 'commonAttachment', 'subProduct', 'lead'])->first();


            try {
                Mail::send('admin.email.endrosment', ['policy' => $policy, 'content' => $request->content], function ($messages) use ($request, $policy) {
                    $messages->to($request->to);
                    if (!empty($request->cc)) {
                        $messages->cc($request->cc);
                    }
                    $subject = 'Gemini consultancy Service';
                    $messages->subject($subject);
                    if (!empty($policy->commonAttachment)) {
                        foreach ($policy->commonAttachment as $attach) {
                            $fileurls = url('attachments', $attach->file_name);
                            $messages->attach($fileurls);
                        }
                    }
                });
            } catch (Exception $e) {
            }
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
                    $subject = 'Renewals Mis';
                    $messages->subject($subject);
                });
            } catch (Exception $e) {
            }
        }
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
