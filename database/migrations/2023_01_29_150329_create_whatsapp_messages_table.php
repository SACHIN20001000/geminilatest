<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhatsappMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('whatsapp_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_user');
            $table->integer('user_id')->unsigned();
            $table->text('message');
            $table->boolean('is_attachment')->default(0);
            $table->string('is_image')->default(0);
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
        Schema::dropIfExists('whatsapp_messages');
    }
}
