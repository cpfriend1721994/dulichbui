<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tour_name');
            $table->dateTimeTz('start_time');
            $table->string('start_place');
            $table->integer('user_max')->default(1);
            $table->string('cover_photo')->default("default_cover.jpg");
            $table->string('status')->default("planning");
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
        Schema::drop('tours');
    }
}
