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
        Schema::create('examination_requests', function (Blueprint $table) {
            $table->id('examination_request_id');
            $table->unsignedBigInteger('fk_careman_id');
            $table->foreign('fk_careman_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('fk_animal_id');
            $table->foreign('fk_animal_id')->references('animal_id')->on('animals')->onDelete('cascade');
            $table->string('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

        public function down(){
        Schema::dropIfExists('examination_requests');
    }
};
