<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Policy extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['holder_name', 'is_recovery', 'phone', 'email', 'user_type', 'user_id', 'insurance_id', 'product_id', 'net_premium', 'case_type', 'policy_no', 'channel_name', 'lead_id', 'company_id', 'attachment_id', 'subproduct_id', 'gross_premium', 'others', 'pa', 'tp_premium', 'add_on_premium', 'od_premium', 'gwp', 'gst', 'basic_premium', 'terrorism_premium', 'requirement', 'client_name', 'address', 'remarks', 'type', 'commodity_type', 'mode_of_transport', 'cover_type', 'per_sending_limit', 'per_location_limit', 'estimate_annual_sum', 'basic_of_valuation', 'policy_period', 'start_date', 'expiry_date', 'commodity_details', 'packing_description', 'libality', 'policy_type', 'liability_industrial', 'liability_nonindustrial', 'liability_act', 'professional_indeminity', 'comprehensive_general_liability', 'wc_policy', 'pincode', 'industry_type', 'worker_number', 'job_profile', 'salary_per_month', 'add_on_cover', 'medical_extension', 'occupation_disease', 'compressed_air_disease', 'terrorism_cover', 'terrorism_cover', 'multiple_location', 'occupancy', 'occupancy_tarriff', 'particular', 'building', 'plant_machine', 'furniture_fixure', 'stock_in_process', 'finished_stock', 'other_contents', 'clain_in_last_three_year', 'loss_details', 'loss_in_amount', 'loss_date', 'measures_taken_after_loss', 'address_risk_location', 'cover_opted', 'policy_inception_date', 'tenure', 'construction_type', 'age_of_building', 'basement_for_building', 'basement_for_content', 'claims', 'building_carpet_area', 'building_cost_of_construction', 'building_sum_insured', 'content_sum_insured', 'rent_alternative_accommodation', 'health_type', 'fresh', 'portability', 'dob', 'pre_existing_disease', 'hospitalization_history', 'upload_discharge_summary', 'dob_sr_most_member', 'dob_self', 'dob_spouse', 'dob_child', 'dob_father', 'dob_mother', 'sum_insured', 'visiting_country', 'date_of_departure', 'date_of_arrival', 'no_of_days', 'no_person', 'passport_datails', 'make', 'model', 'cubic_capacity', 'bussiness_type', 'rto', 'reg_no', 'mfr_year', 'reg_date', 'claims_in_existing_policy', 'ncb_in_existing_policy', 'gcv_type', 'gvw', 'fuel_type', 'passenger_carrying_capacity', 'category', 'varriant', 'renew_status', 'is_policy', 'od_factor', 'ex_showroom', 'seating_capacity', 'fuel', 'cc', 'mis_transaction_type', 'mis_commission', 'mis_percentage', 'mis_commissionable_amount', 'mis_payment_method', 'mis_payment_date', 'mis_amount_paid', 'mis_premium', 'is_mis', 'mark_read', 'follow_up', 'voyage', 'travel_type', 'mis_received_bank_detail', 'mis_deposit_payment_method', 'mis_short_premium', 'mis_premium_deposit', 'mis_deposit_bank_detail', 'premium_payment_source', 'commission_base', 'payout_settled', 'mis_invoice', 'month_settled', 'payout_recovery', 'invoice_id'];
    protected $casts = [
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function clients()
    {
        return $this->belongsTo(User::class, 'attachment_id');
    }
    public function insurances()
    {
        return $this->belongsTo(Insurance::class, 'insurance_id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class, 'subproduct_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function lead()
    {
        return $this->belongsTo(Lead::class, 'lead_id');
    }
    public function makes()
    {
        return $this->belongsTo(Make::class, 'make');
    }
    public function models()
    {
        return $this->belongsTo(ModelMake::class, 'model');
    }
    public function varriants()
    {
        return $this->belongsTo(MakeModel::class, 'varriant');
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'policy_id', 'id');
    }

    public function commonAttachment()
    {
        return $this->hasMany(Attachment::class, 'policy_id', 'id')->whereIn('type', ['Policy', 'Renewal']);
    }
    public function policyAttachment()
    {
        return $this->hasMany(Attachment::class, 'policy_id', 'id')->where('type', 'Policy');
    }
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'id', 'invoice_id');
    }
}
