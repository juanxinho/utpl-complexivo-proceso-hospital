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
        // database/migrations/2024_06_23_163845_create_usuarios_table.php
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('idusuario');
            $table->string('correo', 45);
            $table->string('clave', 45);
            $table->tinyInteger('estado');
            $table->timestamps();
            $table->unsignedBigInteger('usuario_registro');
            $table->unsignedBigInteger('usuario_modificacion')->nullable();
            $table->unsignedBigInteger('idpersona');
            $table->foreign('idpersona')->references('idpersona')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
