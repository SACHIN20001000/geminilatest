<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('user_type')->nullable();
            $table->integer('insurance_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('subproduct_id')->nullable();
            $table->integer('attachment_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('lead_id')->default(0);
            $table->integer('is_paid')->default(0);
            $table->integer('is_policy')->default(0);
            $table->integer('is_mail')->default(0);
            $table->integer('is_mis')->default(0);
            $table->integer('is_recovery')->default(0);
            $table->integer('mark_read')->default(0);
            $table->string('holder_name')->nullable();
            $table->string('follow_up')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('renew_status')->default('POLICY ISSUED');
            $table->string('channel_name')->nullable();
            $table->string('policy_no')->nullable();
            $table->string('case_type')->nullable();
            $table->string('net_premium')->nullable();
            $table->string('gst')->nullable();
            $table->string('od_factor')->nullable();
            $table->string('ex_showroom')->nullable();
            $table->string('seating_capacity')->nullable();
            $table->string('fuel')->nullable();
            $table->string('cc')->nullable();
            $table->text('gwp')->nullable();
            $table->text('voyage')->nullable();
            $table->text('od_premium')->nullable();
            $table->text('add_on_premium')->nullable();
            $table->text('tp_premium')->nullable();
            $table->text('pa')->nullable();
            $table->text('others')->nullable();
            $table->text('gross_premium')->nullable();
            $table->text('basic_premium')->nullable();
            $table->text('terrorism_premium')->nullable();
            $table->text('requirement')->nullable();
            $table->text('client_name')->nullable();
            $table->text('address')->nullable();
            $table->text('remarks')->nullable();
            $table->text('type')->nullable();
            $table->text('commodity_type')->nullable();
            $table->text('mode_of_transport')->nullable();
            $table->text('cover_type')->nullable();
            $table->text('per_sending_limit')->nullable();
            $table->text('per_location_limit')->nullable();
            $table->text('estimate_annual_sum')->nullable();
            $table->text('basic_of_valuation')->nullable();
            $table->text('policy_period')->nullable();
            $table->text('start_date')->nullable();
            $table->text('expiry_date')->nullable();
            $table->text('commodity_details')->nullable();
            $table->text('packing_description')->nullable();
            $table->text('libality')->nullable();
            $table->text('policy_type')->nullable();
            $table->text('liability_industrial')->nullable();
            $table->text('liability_nonindustrial')->nullable();
            $table->text('liability_act')->nullable();
            $table->text('professional_indeminity')->nullable();
            $table->text('comprehensive_general_liability')->nullable();
            $table->text('wc_policy')->nullable();
            $table->text('pincode')->nullable();
            $table->text('industry_type')->nullable();
            $table->text('worker_number')->nullable();
            $table->text('job_profile')->nullable();
            $table->text('salary_per_month')->nullable();
            $table->text('add_on_cover')->nullable();
            $table->text('medical_extension')->nullable();
            $table->text('occupation_disease')->nullable();
            $table->text('compressed_air_disease')->nullable();
            $table->text('terrorism_cover')->nullable();
            $table->text('sub_contractor_cover')->nullable();
            $table->text('multiple_location')->nullable();
            $table->text('occupancy')->nullable();
            $table->text('occupancy_tarriff')->nullable();
            $table->text('particular')->nullable();
            $table->text('building')->nullable();
            $table->text('plant_machine')->nullable();
            $table->text('furniture_fixure')->nullable();
            $table->text('stock_in_process')->nullable();
            $table->text('finished_stock')->nullable();
            $table->text('other_contents')->nullable();
            $table->text('clain_in_last_three_year')->nullable();
            $table->text('loss_details')->nullable();
            $table->text('loss_in_amount')->nullable();
            $table->text('loss_date')->nullable();
            $table->text('measures_taken_after_loss')->nullable();
            $table->text('address_risk_location')->nullable();
            $table->text('cover_opted')->nullable();
            $table->text('policy_inception_date')->nullable();
            $table->text('tenure')->nullable();
            $table->text('construction_type')->nullable();
            $table->text('age_of_building')->nullable();
            $table->text('basement_for_building')->nullable();
            $table->text('basement_for_content')->nullable();
            $table->text('claims')->nullable();
            $table->text('building_carpet_area')->nullable();
            $table->text('building_cost_of_construction')->nullable();
            $table->text('building_sum_insured')->nullable();
            $table->text('content_sum_insured')->nullable();
            $table->text('rent_alternative_accommodation')->nullable();
            $table->text('health_type')->nullable();
            $table->text('travel_type')->nullable();
            $table->text('fresh')->nullable();
            $table->text('portability')->nullable();
            $table->text('dob')->nullable();
            $table->text('invoice_id')->nullable();
            $table->text('pre_existing_disease')->nullable();
            $table->string('hospitalization_history')->nullable();
            $table->string('upload_discharge_summary')->nullable();
            $table->string('dob_sr_most_member')->nullable();
            $table->string('dob_self')->nullable();
            $table->string('dob_spouse')->nullable();
            $table->string('dob_child')->nullable();
            $table->string('dob_father')->nullable();
            $table->string('dob_mother')->nullable();
            $table->string('sum_insured')->nullable();
            $table->string('visiting_country')->nullable();
            $table->string('date_of_departure')->nullable();
            $table->string('date_of_arrival')->nullable();
            $table->string('no_of_days')->nullable();
            $table->string('no_person')->nullable();
            $table->string('passport_datails')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('cubic_capacity')->nullable();
            $table->string('bussiness_type')->nullable();
            $table->string('rto')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('mfr_year')->nullable();
            $table->string('reg_date')->nullable();
            $table->string('claims_in_existing_policy')->nullable();
            $table->string('ncb_in_existing_policy')->nullable();
            $table->string('gcv_type')->nullable();
            $table->string('gvw')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('passenger_carrying_capacity')->nullable();
            $table->string('category')->nullable();
            $table->string('varriant')->nullable();
            $table->text('mis_premium')->nullable();
            $table->text('mis_amount_paid')->nullable();
            $table->text('mis_payment_date')->nullable();
            $table->text('mis_payment_method')->nullable();
            $table->text('mis_commissionable_amount')->nullable();
            $table->text('mis_percentage')->nullable();
            $table->text('mis_commission')->nullable();
            $table->text('mis_transaction_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('policies');
    }
}
