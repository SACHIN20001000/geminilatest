<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRemaindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('remainders', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('type');
            $table->dropColumn('message');

            $table->string('date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
