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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->unsignedBigInteger('fk_animal_id');
            $table->foreign('fk_animal_id')->references('animal_id')->on('animals')->onDelete('cascade');
            // after volunteer requests for reservation, his, id will be filled
            $table->foreignId('fk_taken_by_volunteer_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->dateTime('reservation_from');
            $table->dateTime('reservation_to');
            $table->string('reservation_status')->default("listed");
            // after careman accepts request, fk_approved_by will be filled
            $table->foreignId('fk_approved_by_id')->nullable()->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('reservations');
    }
};
