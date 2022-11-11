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
            $table->foreign('fk_vet_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('examination_status')->default('requested');
            $table->string('examination_type');
            $table->string('examination_description')->nullable();
            $table->dateTime('examination_from')->nullable();
            $table->dateTime('examination_to')->nullable();
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
