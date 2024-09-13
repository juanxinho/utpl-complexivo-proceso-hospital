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
        Schema::create('triajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users');
            $table->integer('heart_rate'); // Frecuencia cardíaca
            $table->integer('respiratory_rate'); // Frecuencia respiratoria
            $table->integer('systolic_blood_pressure'); // Presión arterial sistólica
            $table->integer('diastolic_blood_pressure'); // Presión arterial diastólica
            $table->decimal('temperature', 4, 1); // Temperatura corporal
            $table->integer('spo2'); // Nivel de saturación de oxígeno
            $table->enum('priority', ['Alto', 'Medio', 'Bajo']); // Prioridad del paciente
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triages');
    }
};
