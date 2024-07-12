<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosticMedicalTestTable extends Migration
{
    public function up()
    {
        Schema::create('diagnostic_medical_test', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_diagnostic_id');
            $table->unsignedBigInteger('medical_test_id');
            $table->timestamps();

            $table->foreign('medical_diagnostic_id')->references('id')->on('medical_diagnostic')->onDelete('cascade');
            $table->foreign('medical_test_id')->references('id')->on('medical_tests')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('diagnostic_medical_test');
    }
}

