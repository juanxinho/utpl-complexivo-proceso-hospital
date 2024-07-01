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
            $table->unsignedBigInteger('specialty_id_specialty');
            $table->unsignedBigInteger('schedule_id_schedule');
            $table->timestamps();

            $table->foreign('specialty_id_specialty')->references('id_specialty')->on('specialty');
            $table->foreign('schedule_id_schedule')->references('id_schedule')->on('schedule');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medic_schedule');
    }
}

