<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sms_transactions');

        Schema::create('sms_transactions', function(Blueprint $table) {
            $table->integer('id')->unique();
            $table->integer('user_id');
            $table->integer('given_pixel');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sms_transactions');
    }
}
