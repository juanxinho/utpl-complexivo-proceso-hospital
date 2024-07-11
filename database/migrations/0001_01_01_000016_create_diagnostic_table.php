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
        Schema::create('diagnostic', function (Blueprint $table) {
            $table->bigIncrements('id_diagnostic');
            $table->unsignedBigInteger('id_clinical_history');
            $table->string('description', 255)->nullable();
            $table->unsignedBigInteger('user_register');
            $table->date('date');
            $table->timestamps();

            $table->foreign('id_clinical_history')->references('id_clinical_history')->on('clinical_history')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic');
    }
};
