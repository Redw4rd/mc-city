<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRanks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('ranks');

        Schema::create('ranks', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('group')->unique();
            $table->string('color')->nullable();
            $table->text('description');
            $table->integer('price')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ranks');
    }
}
