<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->text('mis_received_bank_detail')->nullable();
            $table->text('mis_deposit_payment_method')->nullable();
            $table->text('mis_short_premium')->nullable();
            $table->text('mis_premium_deposit')->nullable();
            $table->text('mis_deposit_bank_detail')->nullable();
            $table->text('premium_payment_source')->nullable();
            $table->text('commission_base')->nullable();
            $table->text('payout_settled')->nullable();
            $table->text('mis_invoice')->nullable();
            $table->text('month_settled')->nullable();
            $table->text('payout_recovery')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->dropColumn('mis_received_bank_detail');
            $table->dropColumn('mis_deposit_payment_method');
            $table->dropColumn('mis_short_premium');
            $table->dropColumn('mis_premium_deposit');
            $table->dropColumn('mis_deposit_bank_detail');
            $table->dropColumn('premium_payment_source');
            $table->dropColumn('commission_base');
            $table->dropColumn('payout_settled');
            $table->dropColumn('mis_invoice');
            $table->dropColumn('month_settled');
            $table->dropColumn('payout_recovery');
        });
    }
}
