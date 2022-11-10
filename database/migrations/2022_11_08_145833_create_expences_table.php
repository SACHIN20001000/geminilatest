<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expences', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('rent')->nullable();
            $table->string('electricity')->nullable();
            $table->string('water_bill')->nullable();
            $table->string('tea')->nullable();
            $table->string('stationery')->nullable();
            $table->string('salery')->nullable();
            $table->string('internet')->nullable();
            $table->string('repair')->nullable();
            $table->string('commision')->nullable();
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
        Schema::dropIfExists('expences');
    }
}
