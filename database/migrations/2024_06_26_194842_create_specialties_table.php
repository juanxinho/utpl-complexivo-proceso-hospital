<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtiesTable extends Migration
{
    public function up()
    {
        Schema::create('specialty', function (Blueprint $table) {
            $table->id('id_specialty');
            $table->string('name', 45);
            $table->string('abbreviation', 45)->nullable();
            $table->string('description', 255)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('specialty');
    }
}

