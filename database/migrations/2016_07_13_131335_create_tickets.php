<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tickets');

        Schema::create('tickets', function(Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->text('message');
            $table->integer('user_id');
            $table->boolean('is_locked')->default('0');
            $table->boolean('answered')->default('0');
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
        Schmea::drop('tickets');
    }
}
