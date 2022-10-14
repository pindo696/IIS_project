<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('schedule_id');
            $table->unsignedBigInteger('fk_volunteer_id');
            $table->foreign('fk_volunteer_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('fk_animal_id');
            $table->foreign('fk_animal_id')->references('animal_id')->on('animals')->onDelete('cascade');
            $table->dateTime('from');
            $table->dateTime('to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
