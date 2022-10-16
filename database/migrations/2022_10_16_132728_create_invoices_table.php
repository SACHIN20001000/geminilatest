<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('policy_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('transfer_date')->nullable();
            $table->string('bank_detail')->nullable();
            $table->string('name')->nullable();
            $table->string('invoice_amount')->nullable();
            $table->string('tds')->nullable();
            $table->string('amount_transfer')->nullable();
            $table->string('adjusted')->nullable();
            $table->string('advance_payout')->nullable();
            $table->string('recovery_cases')->nullable();
            $table->string('short_premium')->nullable();
            $table->string('total_Payout')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
