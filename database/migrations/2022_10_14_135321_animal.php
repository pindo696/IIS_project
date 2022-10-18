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
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id('animal_id');
            $table->string('name')->nullable();
            $table->string('species');
            $table->string('color');
            $table->integer('age')->nullable();
            $table->string('gender');
            $table->string('description')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('discovery_place')->nullable();
            $table->date('discovery_date')->default(DB::raw('CURRENT_DATE'));
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
