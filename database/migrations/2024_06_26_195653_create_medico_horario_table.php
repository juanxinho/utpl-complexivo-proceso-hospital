<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicoHorarioTable extends Migration
{
    public function up()
    {
        Schema::create('medico_horario', function (Blueprint $table) {
            $table->id('idmedico_horario');
            $table->unsignedBigInteger('usuario_rol_idusuario_rol');
            $table->unsignedBigInteger('especialidad_idespecialidad');
            $table->unsignedBigInteger('horario_idhorario');
            $table->timestamps();

            $table->foreign('usuario_rol_idusuario_rol')->references('idusuario_rol')->on('usuario_rol');
            $table->foreign('especialidad_idespecialidad')->references('idespecialidad')->on('especialidad');
            $table->foreign('horario_idhorario')->references('idhorario')->on('horario');
        });
    }

    public function down()
    {
        Schema::dropIfExists('medico_horario');
    }
}

