<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id('animal_id');
            $table->string('animal_name')->nullable();
            $table->string('species');
            $table->string('color');
            $table->integer('animal_age')->nullable();
            $table->string('gender');
            $table->string('animal_description')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('discovery_place')->nullable();
            $table->date('discovery_date');
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
        Schema::dropIfExists('animals');
    }
};
