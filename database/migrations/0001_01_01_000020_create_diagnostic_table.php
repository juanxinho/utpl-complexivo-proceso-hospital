<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('description', 255); // This will store translations in JSON format
            $table->timestamps();
        });

        Schema::create('medical_diagnostic', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedBigInteger('id_clinical_history');
            $table->string('recommendations', 255)->nullable();
            $table->unsignedBigInteger('user_register');
            $table->date('date');
            $table->timestamps();

            $table->foreign('appointment_id')->references('id_appointment')->on('appointment')->onDelete('cascade');
            $table->foreign('id_clinical_history')->references('id_clinical_history')->on('clinical_history')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostics');
        Schema::dropIfExists('medical_diagnostic');
    }
};
