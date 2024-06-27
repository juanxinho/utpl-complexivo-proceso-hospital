<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    public function up()
    {
        Schema::create('horario', function (Blueprint $table) {
            $table->id('idhorario');
            $table->enum('dias', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']);
            $table->string('rango_horario', 45);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('horario');
    }
}

