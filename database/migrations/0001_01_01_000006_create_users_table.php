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
        // Crear la tabla de usuarios con campos adicionales
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Campo ID principal
            //$table->string('name'); // Nombre del usuario
            $table->string('email')->unique(); // Correo electrónico
            $table->timestamp('email_verified_at')->nullable(); // Verificación de correo electrónico
            $table->string('password'); // Contraseña
            $table->rememberToken(); // Token de recordatorio
            //$table->foreignId('current_team_id')->nullable(); // ID del equipo actual (nullable)
            $table->string('profile_photo_path', 2048)->nullable(); // Ruta de la foto de perfil (nullable)
            $table->timestamps(); // Timestamps de creación y actualización

            // Campos adicionales
            $table->tinyInteger('status'); // Estado del usuario
            $table->unsignedBigInteger('user_register')->nullable(); // ID del usuario que registró
            $table->unsignedBigInteger('user_modification')->nullable(); // ID del usuario que modificó
            $table->unsignedBigInteger('id_profile')->nullable(); // ID de la profile asociada
            $table->foreign('id_profile')->references('id_profile')->on('profile'); // Llave foránea a la tabla profile
        });

        // Crear la tabla de tokens de reseteo de contraseña
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Correo electrónico (primary)
            $table->string('token'); // Token de reseteo de contraseña
            $table->timestamp('created_at')->nullable(); // Timestamp de creación (nullable)
        });

        // Crear la tabla de sesiones
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID de la sesión (primary)
            $table->foreignId('user_id')->nullable()->index(); // ID del usuario (nullable, indexed)
            $table->string('ip_address', 45)->nullable(); // Dirección IP (nullable)
            $table->text('user_agent')->nullable(); // Agente de usuario (nullable)
            $table->longText('payload'); // Payload de la sesión
            $table->integer('last_activity')->index(); // Última actividad (indexed)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Eliminar la tabla de usuarios
        Schema::dropIfExists('password_reset_tokens'); // Eliminar la tabla de tokens de reseteo de contraseña
        Schema::dropIfExists('sessions'); // Eliminar la tabla de sesiones
    }
};
