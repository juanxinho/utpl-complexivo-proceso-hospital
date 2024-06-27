<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id('idcita');
            $table->unsignedBigInteger('usuario_registro');
            $table->unsignedBigInteger('usuario_modificacion')->nullable();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->timestamp('fecha_modificacion')->nullable();
            $table->string('estado', 45);
            $table->unsignedBigInteger('medico_horario_idmedico_horario');
            $table->unsignedBigInteger('factura_idfactura')->nullable();
            $table->unsignedBigInteger('historial_clinico_idhistorial_clinico')->nullable();
            $table->dateTime('fecha_atencion');
            $table->timestamps();

            $table->foreign('medico_horario_idmedico_horario')->references('idmedico_horario')->on('medico_horario');
            $table->foreign('factura_idfactura')->references('idfactura')->on('factura');
            $table->foreign('historial_clinico_idhistorial_clinico')->references('idhistorial_clinico')->on('historial_clinico');
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
}

