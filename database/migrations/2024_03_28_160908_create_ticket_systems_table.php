<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_systems', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('policy_id');
            $table->string('type')->nullable();
            $table->string('document')->nullable();
            $table->string('current_value')->nullable();
            $table->string('new_value')->nullable();
            $table->string('remarks')->nullable();
            $table->enum('status', ['assigned', 'in progress', 'more info', 'done'])->default('assigned');
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
        Schema::dropIfExists('ticket_systems');
    }
}
