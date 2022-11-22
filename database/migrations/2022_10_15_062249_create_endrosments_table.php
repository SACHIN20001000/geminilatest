<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndrosmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endrosments', function (Blueprint $table) {
            $table->id();
            $table->integer('created_by')->nullable();
            $table->integer('created_to')->nullable();
            $table->integer('parent')->default(0);
            $table->integer('lead_id')->nullable();
            $table->string('image')->nullable();
            $table->string('type')->nullable();
            $table->text('previous_message')->nullable();
            $table->text('new_message')->nullable();
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
        Schema::dropIfExists('endrosments');
    }
}
