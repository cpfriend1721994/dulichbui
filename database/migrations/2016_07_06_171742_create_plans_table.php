<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tour_id');
            $table->string('arrival_place');
            $table->dateTimeTz('arrival_time');
            $table->string('stay_place');
            $table->string('stay_period');
            $table->string('activities');
            $table->string('cover_photo');
            $table->string('planto_id');
            $table->string('vehicle');
            $table->string('period');
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
        Schema::drop('plans');
    }
}
