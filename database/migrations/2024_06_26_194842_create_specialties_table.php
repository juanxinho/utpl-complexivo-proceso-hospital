<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtiesTable extends Migration
{
    public function up()
    {
        Schema::create('especialidad', function (Blueprint $table) {
            $table->id('idespecialidad');
            $table->string('nombre', 45);
            $table->string('abreviatura', 45)->nullable();
            $table->string('descripcion', 255)->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('especialidad');
    }
}

