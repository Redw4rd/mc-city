<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 20);
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('wallet')->default(0);
            $table->string('avatar')->nullable();
            $table->integer('rank_id')->default('0');
            $table->boolean('is_admin')->default('0');
            $table->boolean('subscribe_newsletter')->default('1');
            $table->string('displayed_name')->default('username');
            $table->string('avatar_image')->default('gravatar');
            $table->string('verify_token')->nullable();
            $table->string('reset_password_token')->nullable();
            $table->rememberToken();
            $table->timestamp('got_rank');
            $table->timestamp('rank_expire');
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
        Schema::drop('users');
    }
}
