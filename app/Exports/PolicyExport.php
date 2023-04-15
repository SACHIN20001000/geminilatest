<?php

namespace App\Exports;

use App\Models\Policy;
use Maatwebsite\Excel\Concerns\FromCollection;

class PolicyExport implements FromCollection
{
    private $date_range, $type, $user;

    public function __construct(String  $type, String $date_range, String $user)
    {

        $this->date_range = $date_range;
        $this->type =  $type;
        $this->user =  $user;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $date_range =  $this->date_range;
        $type =         $this->type;
        $user =         $this->user;
        $finalData = [];
        $header['Id'] = "Id" ?? null;
        $header['Client'] = 'Client' ?? null;
        $header['Broker'] = 'Broker' ?? null;
        $header['Phone'] = 'Phone' ?? null;
        $header['Email'] = 'Email' ?? null;
        $header['Insurance'] = 'Insurance' ?? null;
        $header['Product'] = 'Product' ?? null;
        $header['Sub Product'] = 'Sub Product' ?? null;
        $header['Status'] = 'Status' ?? null;
        $header['channel_name'] = 'Channel Name';
        $header['policy_no'] = 'Policy No';
        $header['case_type'] = 'Case Type';
        $header['net_premium'] = 'Net Premium';
        $header['gst'] = 'GST';
        $header['gwp'] = 'GWP';
        $header['od_premium'] = 'OD Premium';
        $header['add_on_premium'] = 'Add On Premium';
        $header['tp_premium'] = 'TP Premium';
        $header['pa'] = 'PA';
        $header['others'] = 'Others';
        $header['gross_premium'] = 'Gross Premium';
        $header['basic_premium'] = 'Basic Premium';
        $header['terrorism_premium'] = 'Terrorism Premium';
        $header['requirement'] = 'Requirement';
        $header['client_name'] = 'Client Name';
        $header['address'] = 'Address';
        $header['remarks'] = 'Remarks';
        $header['type'] = 'Type';
        $header['commodity_type'] = 'Commodity Type';
        $header['mode_of_transport'] = 'Mode Of Transport';
        $header['cover_type'] = 'Cover Type';
        $header['per_sending_limit'] = 'Per Sending Limit';
        $header['per_location_limit'] = 'Per Location Limit';
        $header['estimate_annual_sum'] = 'Estimate Annual Sum';
        $header['basic_of_valuation'] = 'Basic Of Valuation';
        $header['policy_period'] = 'Policy Period';
        $header['start_date'] = 'Start Date';
        $header['expiry_date'] = 'Expiry Date';
        $header['commodity_details'] = 'Commodity Details';
        $header['packing_description'] = 'Packing Description';
        $header['libality'] = 'Libality';
        $header['policy_type'] = 'Policy Type';
        $header['liability_industrial'] = 'liability Inducstrial';
        $header['liability_nonindustrial'] = 'Liability Non Industrial';
        $header['liability_act'] = 'Liability Act';
        $header['professional_indeminity'] = 'Professional Indeminity';
        $header['comprehensive_general_liability'] = 'Comprehensive General Liability';
        $header['wc_policy'] = 'Wc Policy';
        $header['pincode'] = 'Pincode';
        $header['industry_type'] = 'Industry Type';
        $header['worker_number'] = 'Worker Number';
        $header['job_profile'] = 'Job Profile';
        $header['salary_per_month'] = 'Salary Per Month';
        $header['add_on_cover'] = 'Add On Cover';
        $header['medical_extension'] = 'Medical Extension';
        $header['occupation_disease'] = 'Occupation Disease';
        $header['compressed_air_disease'] = 'Compressed Air Disease';
        $header['terrorism_cover'] = 'Terrorism Cover';
        $header['sub_contractor_cover'] = 'Sub Contractor Cover';
        $header['multiple_location'] = 'Multiple Location';
        $header['occupancy'] = 'Occupancy';
        $header['occupancy_tarriff'] = 'Occupancy Tarriff';
        $header['particular'] = 'Particular';
        $header['building'] = 'Building';
        $header['plant_machine'] = 'Plant Machine';
        $header['furniture_fixure'] = 'Furniture Fixure';
        $header['stock_in_process'] = 'Stock In Process';
        $header['finished_stock'] = 'Finished Stock';
        $header['other_contents'] = 'Other Contents';
        $header['clain_in_last_three_year'] = 'Clain In Last Three Year';
        $header['loss_details'] = 'Loss Details';
        $header['loss_in_amount'] = 'Loss In Amount';
        $header['loss_date'] = 'Loss Date';
        $header['measures_taken_after_loss'] = 'Measures Taken After Loss';
        $header['address_risk_location'] = 'Address Risk Location';
        $header['cover_opted'] = ' Cover Opted';
        $header['policy_inception_date'] = 'Policy Inception Date';
        $header['tenure'] = 'Tenure';
        $header['construction_type'] = 'Construction Type';
        $header['age_of_building'] = 'Age Of Building';
        $header['basement_for_building'] = 'Basement For Building';
        $header['basement_for_content'] = 'Basement For Content';
        $header['claims'] = 'Claims';
        $header['building_carpet_area'] = 'Building Carpet Area';
        $header['building_cost_of_construction'] = 'Building Cost Of Construction';
        $header['building_sum_insured'] = 'Building Sum Insured';
        $header['content_sum_insured'] = 'Content Sum Insured';
        $header['rent_alternative_accommodation'] = 'Rent Alternative Accommodation';
        $header['health_type'] = 'Health Type';
        $header['fresh'] = 'Fresh';
        $header['portability'] = 'Portability';
        $header['dob'] = 'Dob';
        $header['pre_existing_disease'] = 'Pre Existing Disease';
        $header['hospitalization_history'] = 'Hospitalization History';
        $header['upload_discharge_summary'] = 'Upload Discharge Summary';
        $header['dob_sr_most_member'] = 'Dob Sr Most Member';
        $header['dob_self'] = 'Dob Self';
        $header['dob_spouse'] = 'Dob Spouse';
        $header['dob_child'] = 'Dob Child';
        $header['dob_father'] = 'Dob Father';
        $header['dob_mother'] = 'Dob Mother';
        $header['sum_insured'] = 'Sum Insured';
        $header['visiting_country'] = 'Visiting Country';
        $header['date_of_departure'] = 'Date Of Departure';
        $header['date_of_arrival'] = 'Date Of Arrival';
        $header['no_of_days'] = 'No Of Days';
        $header['no_person'] = 'No Person';
        $header['passport_headerils'] = 'Passport Headerils';
        $header['make'] = 'Make';
        $header['model'] = 'Model';
        $header['cubic_capacity'] = 'Cubic Capacity';
        $header['bussiness_type'] = 'Bussiness Type';
        $header['rto'] = 'RTO';
        $header['reg_no'] = 'Reg No';
        $header['mfr_year'] = 'MFR Year';
        $header['reg_date'] = 'Reg Date';
        $header['claims_in_existing_policy'] = 'Claims In Existing Policy';
        $header['ncb_in_existing_policy'] = 'Ncb In Existing Policy';
        $header['gcv_type'] = 'GCV Type';
        $header['gvw'] = 'GVW';
        $header['fuel_type'] = 'Fuel Type';
        $header['passenger_carrying_capacity'] = 'Passenger Carrying Capacity';
        $header['category'] = 'Category';
        $header['varriant'] = 'Varriant';
        $header['Created At'] = 'Created At';


        $query = Policy::with('users', 'lead', 'insurances', 'products', 'subProduct');



        if (isset($type) && !empty($type)) {
            if ($date_range) {

                $date_range = explode('-', $date_range);
                $start_date = $date_range[0];
                $end_date = $date_range[1];

                $start_date = date("Y-m-d", strtotime($start_date));
                $end_date = date("Y-m-d", strtotime($end_date));
                $StartDate = $start_date . ' 00:00:00';
                $endDate = $end_date . ' 23:59:59';
            }
            if ($type == 'policy') {
                $query->whereBetween('start_date', [$StartDate, $endDate]);
            } else {
                $query->whereBetween('expiry_date', [$StartDate, $endDate]);
            }
        }
        if (isset($user) && !empty($user)) {
            $query->where('user_id', $request->user);
        }

        $policies =  $query->get();

        if ($policies->count()) {
            foreach ($policies as $key => $policy) {

                $data['Id'] = $policy->id ?? null;
                $data['Client'] = $policy->lead->holder_name ?? null;
                $data['Broker'] = $policy->users->name ?? null;
                $data['Phone'] = $policy->phone ?? null;
                $data['Email'] = $policy->email ?? null;
                $data['Insurance'] = $policy->insurances->name ?? null;
                $data['Product'] = $policy->products->name ?? null;
                $data['Sub Product'] = $policy->subProduct->name ?? null;
                $data['Status'] = $policy->renew_status ?? null;
                $data['channel_name'] = $policy->channel_name ?? null;
                $data['policy_no'] = $policy->policy_no ?? null;
                $data['case_type'] = $policy->case_type ?? null;
                $data['net_premium'] = $policy->net_premium ?? null;
                $data['gst'] = $policy->gst     ?? null;
                $data['gwp'] = $policy->gwp ?? null;
                $data['od_premium'] = $policy->od_premium ?? null;
                $data['add_on_premium'] = $policy->add_on_premium ?? null;
                $data['tp_premium'] = $policy->tp_premium ?? null;
                $data['pa'] = $policy->pa ?? null;
                $data['others'] = $policy->others ?? null;
                $data['gross_premium'] = $policy->gross_premium ?? null;
                $data['basic_premium'] = $policy->basic_premium ?? null;
                $data['terrorism_premium	'] = $policy->terrorism_premium     ?? null;
                $data['requirement'] = $policy->requirement ?? null;
                $data['client_name'] = $policy->client_name ?? null;
                $data['address'] = $policy->address ?? null;
                $data['remarks'] = $policy->remarks ?? null;
                $data['type'] = $policy->type ?? null;
                $data['commodity_type'] = $policy->commodity_type ?? null;
                $data['mode_of_transport'] = $policy->mode_of_transport ?? null;
                $data['cover_type'] = $policy->cover_type ?? null;
                $data['per_sending_limit'] = $policy->per_sending_limit ?? null;
                $data['per_location_limit'] = $policy->per_location_limit ?? null;
                $data['estimate_annual_sum'] = $policy->estimate_annual_sum ?? null;
                $data['basic_of_valuation'] = $policy->basic_of_valuation ?? null;
                $data['policy_period'] = $policy->policy_period ?? null;
                $data['start_date'] = $policy->start_date ?? null;
                $data['expiry_date'] = $policy->expiry_date ?? null;
                $data['commodity_details'] = $policy->commodity_details ?? null;
                $data['packing_description'] = $policy->packing_description ?? null;
                $data['libality'] = $policy->libality ?? null;
                $data['policy_type'] = $policy->policy_type ?? null;
                $data['liability_industrial'] = $policy->liability_industrial ?? null;
                $data['liability_nonindustrial'] = $policy->liability_nonindustrial ?? null;
                $data['liability_act'] = $policy->liability_act ?? null;
                $data['professional_indeminity'] = $policy->professional_indeminity ?? null;
                $data['comprehensive_general_liability'] = $policy->comprehensive_general_liability ?? null;
                $data['wc_policy'] = $policy->wc_policy ?? null;
                $data['pincode'] = $policy->pincode ?? null;
                $data['industry_type'] = $policy->industry_type ?? null;
                $data['worker_number'] = $policy->worker_number ?? null;
                $data['job_profile'] = $policy->job_profile ?? null;
                $data['salary_per_month'] = $policy->salary_per_month ?? null;
                $data['add_on_cover'] = $policy->add_on_cover ?? null;
                $data['medical_extension'] = $policy->medical_extension ?? null;
                $data['occupation_disease'] = $policy->occupation_disease ?? null;
                $data['compressed_air_disease'] = $policy->compressed_air_disease ?? null;
                $data['terrorism_cover'] = $policy->terrorism_cover ?? null;
                $data['sub_contractor_cover'] = $policy->sub_contractor_cover ?? null;
                $data['multiple_location'] = $policy->multiple_location ?? null;
                $data['occupancy'] = $policy->occupancy ?? null;
                $data['occupancy_tarriff'] = $policy->occupancy_tarriff ?? null;
                $data['particular'] = $policy->particular ?? null;
                $data['building'] = $policy->building ?? null;
                $data['plant_machine'] = $policy->plant_machine ?? null;
                $data['furniture_fixure'] = $policy->furniture_fixure ?? null;
                $data['stock_in_process'] = $policy->stock_in_process ?? null;
                $data['finished_stock'] = $policy->finished_stock ?? null;
                $data['other_contents'] = $policy->other_contents ?? null;
                $data['clain_in_last_three_year'] = $policy->clain_in_last_three_year ?? null;
                $data['loss_details'] = $policy->loss_details ?? null;
                $data['loss_in_amount'] = $policy->loss_in_amount ?? null;
                $data['loss_date'] = $policy->loss_date ?? null;
                $data['measures_taken_after_loss'] = $policy->measures_taken_after_loss ?? null;
                $data['address_risk_location'] = $policy->address_risk_location ?? null;
                $data['cover_opted'] = $policy->cover_opted ?? null;
                $data['policy_inception_date'] = $policy->policy_inception_date ?? null;
                $data['tenure'] = $policy->tenure ?? null;
                $data['construction_type'] = $policy->construction_type ?? null;
                $data['age_of_building'] = $policy->age_of_building ?? null;
                $data['basement_for_building'] = $policy->basement_for_building ?? null;
                $data['basement_for_content'] = $policy->basement_for_content ?? null;
                $data['claims'] = $policy->claims ?? null;
                $data['building_carpet_area'] = $policy->building_carpet_area ?? null;
                $data['building_cost_of_construction'] = $policy->building_cost_of_construction ?? null;
                $data['building_sum_insured'] = $policy->building_sum_insured ?? null;
                $data['content_sum_insured'] = $policy->content_sum_insured ?? null;
                $data['rent_alternative_accommodation'] = $policy->rent_alternative_accommodation ?? null;
                $data['health_type'] = $policy->health_type ?? null;
                $data['fresh'] = $policy->fresh ?? null;
                $data['portability'] = $policy->portability ?? null;
                $data['dob'] = $policy->dob ?? null;
                $data['pre_existing_disease'] = $policy->pre_existing_disease ?? null;
                $data['hospitalization_history'] = $policy->hospitalization_history ?? null;
                $data['upload_discharge_summary'] = $policy->upload_discharge_summary ?? null;
                $data['dob_sr_most_member'] = $policy->dob_sr_most_member ?? null;
                $data['dob_self'] = $policy->dob_self ?? null;
                $data['dob_spouse'] = $policy->dob_spouse ?? null;
                $data['dob_child'] = $policy->dob_child ?? null;
                $data['dob_father'] = $policy->dob_father ?? null;
                $data['dob_mother'] = $policy->dob_mother ?? null;
                $data['sum_insured'] = $policy->sum_insured ?? null;
                $data['visiting_country'] = $policy->visiting_country ?? null;
                $data['date_of_departure'] = $policy->date_of_departure ?? null;
                $data['date_of_arrival'] = $policy->date_of_arrival ?? null;
                $data['no_of_days'] = $policy->no_of_days ?? null;
                $data['no_person'] = $policy->no_person ?? null;
                $data['passport_datails'] = $policy->passport_datails ?? null;
                $data['make'] = $policy->makes->name ?? null;
                $data['model'] = $policy->models->name ?? null;
                $data['cubic_capacity'] = $policy->cubic_capacity ?? null;
                $data['bussiness_type'] = $policy->bussiness_type ?? null;
                $data['rto'] = $policy->rto ?? null;
                $data['reg_no'] = $policy->reg_no ?? null;
                $data['mfr_year'] = $policy->mfr_year ?? null;
                $data['reg_date'] = $policy->reg_date ?? null;
                $data['claims_in_existing_policy'] = $policy->claims_in_existing_policy ?? null;
                $data['ncb_in_existing_policy'] = $policy->ncb_in_existing_policy ?? null;
                $data['gcv_type'] = $policy->gcv_type ?? null;
                $data['gvw'] = $policy->gvw ?? null;
                $data['fuel_type'] = isset($policy->models->makeModels) ? $policy->models->getMakes($policy->models->id, 'fuel') : '';
                $data['passenger_carrying_capacity'] = isset($policy->models->makeModels) ? $policy->models->getMakes($policy->models->id, 'seating') : '';
                $data['category'] = isset($policy->models->makeModels) ? $policy->models->getMakes($policy->models->id, 'od') : '';
                $data['varriant'] = isset($policy->models->makeModels) ? $policy->models->getMakes($policy->models->id, 'varriant') : '';

                $data['Created At'] = $policy->created_at ?? null;
                array_push($finalData, $data);
                while (count($data) > 0) {
                    array_pop($data);
                }
            }
        }
        array_unshift($finalData, $header);
        return collect($finalData);
    }
}
