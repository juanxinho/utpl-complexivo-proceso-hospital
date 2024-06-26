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
        // database/migrations/2024_06_23_163845_create_personas_table.php
        Schema::create('personas', function (Blueprint $table) {
            $table->id('idpersona');
            $table->string('cedula', 13);
            $table->string('nombres', 45);
            $table->string('apellidos', 45);
            $table->date('fecha_nacimiento');
            $table->string('telefono', 10);
            $table->enum('sexo', ['M', 'F']);
            $table->tinyInteger('estado');
            $table->timestamps();
            $table->unsignedBigInteger('usuario_registro')->nullable();
            $table->unsignedBigInteger('usuario_modificacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
