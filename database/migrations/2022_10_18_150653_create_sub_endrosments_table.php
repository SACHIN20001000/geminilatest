<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubEndrosmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  
        Schema::create('sub_endrosments', function (Blueprint $table) {
            $table->id();
            $table->integer('endrosment_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('created_to')->nullable();
            $table->string('image')->nullable();
            $table->text('message')->nullable();
        
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
        Schema::dropIfExists('sub_endrosments');
    }
}
