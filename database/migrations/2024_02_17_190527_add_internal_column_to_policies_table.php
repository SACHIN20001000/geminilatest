<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInternalColumnToPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('policies', function (Blueprint $table) {
            $table->string('internal_payout_expected')->nullable();
            $table->string('internal_payout_received')->nullable();
            $table->string('internal_payout_percentage')->nullable();
            $table->string('internal_percentage')->nullable();

            $table->string('internal_commission')->nullable();
            $table->string('internal_payout_saved')->nullable();
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
            $table->dropColumn('internal_payout_expected');
            $table->dropColumn('internal_payout_received');
            $table->dropColumn('internal_commission');
            $table->dropColumn('internal_payout_saved');
            $table->dropColumn('internal_payout_percentage');
            $table->dropColumn('internal_percentage');
        });
    }
}
