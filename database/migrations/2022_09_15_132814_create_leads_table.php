<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('holder_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('insurance_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('subproduct_id')->nullable();
            $table->integer('attachment_id')->nullable();
            $table->string('remark')->nullable();
            $table->string('assigned')->nullable();
            $table->string('status')->nullable();
            $table->integer('quote_id')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
