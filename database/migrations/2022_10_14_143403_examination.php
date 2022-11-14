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
            $table->unsignedBigInteger('fk_requested_by_careman_id');
            $table->foreign('fk_requested_by_careman_id')->references('id')->on('users')->onDelete('cascade');

            // after examination request creation, will be vet_id null. After vet accepts request, the fk_will be filled
            $table->foreignId('fk_vet_id')->nullable()->constrained('users')->onDelete('cascade');

            $table->string('examination_status')->default('requested');
            $table->string('examination_type');
            $table->string('examination_description')->nullable();
            $table->dateTime('examination_from')->nullable();
            $table->dateTime('examination_to')->nullable();
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
        Schema::dropIfExists('examinations');
    }
};
