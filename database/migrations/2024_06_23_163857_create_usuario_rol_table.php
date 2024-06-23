<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // database/migrations/2024_06_23_163845_create_usuario_rol_table.php
        Schema::create('usuario_rol', function (Blueprint $table) {
            $table->id('idusuario_rol');
            $table->unsignedBigInteger('idusuario');
            $table->unsignedBigInteger('idrol');
            $table->timestamps();
            $table->foreign('idusuario')->references('idusuario')->on('usuarios');
            $table->foreign('idrol')->references('idrol')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_rol');
    }
};
