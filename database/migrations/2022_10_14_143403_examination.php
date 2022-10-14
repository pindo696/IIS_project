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
        Schema::create('examinations', function (Blueprint $table) {
            $table->id('examination_id');
            $table->unsignedBigInteger('fk_animal_id');
            $table->foreign('fk_animal_id')->references('animal_id')->on('animals')->onDelete('cascade');
            $table->unsignedBigInteger('fk_vet_id');
            $table->foreign('fk_vet_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->string('type');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('examinations');
    }
};
