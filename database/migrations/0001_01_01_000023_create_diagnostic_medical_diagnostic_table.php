<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticMedicalDiagnosticTable extends Migration
{
    public function up()
    {
        Schema::create('diagnostic_medical_diagnostic', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_diagnostic_id');
            $table->unsignedBigInteger('diagnostic_id');
            $table->timestamps();

            $table->foreign('medical_diagnostic_id')->references('id_diagnostic')->on('medical_diagnostic')->onDelete('cascade');
            $table->foreign('diagnostic_id')->references('id')->on('diagnostics')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('diagnostic_medical_diagnostic');
    }
}

