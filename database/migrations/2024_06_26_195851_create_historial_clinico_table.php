<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialClinicoTable extends Migration
{
    public function up()
    {
        Schema::create('historial_clinico', function (Blueprint $table) {
            $table->id('idhistorial_clinico');
            $table->string('recomendaciones', 45);
            $table->timestamp('fecha_registro')->useCurrent();
            $table->unsignedBigInteger('usuario_registro');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial_clinico');
    }
}
