<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('client_sessions');

        Schema::create('client_sessions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('sessionID');
            $table->string('serverHash');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('client_sessions');
    }
}
