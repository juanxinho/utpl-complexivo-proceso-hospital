<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicScheduleTable extends Migration
{
    public function up()
    {
        Schema::create('medic_schedule', function (Blueprint $table) {
            $table->id('id_medic_schedule');
            $table->unsignedBigInteger('id_specialty');
            $table->unsignedBigInteger('id_schedule');
            $table->unsignedBigInteger('id_medic');
            $table->timestamps();

            $table->foreign('id_specialty')->references('id_specialty')->on('specialty');
            $table->foreign('id_schedule')->references('id_schedule')->on('schedule');
            $table->foreign('id_medic')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medic_schedule');
    }
}

