<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id('id_schedule');
            $table->enum('days', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']);
            $table->string('time_range', 45);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedule');
    }
}

