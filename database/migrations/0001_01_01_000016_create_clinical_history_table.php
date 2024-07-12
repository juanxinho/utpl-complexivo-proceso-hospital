<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicalHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('clinical_history', function (Blueprint $table) {
            $table->id('id_clinical_history');
            $table->unsignedBigInteger('patient_id');
            $table->timestamp('record_date')->useCurrent();
            $table->unsignedBigInteger('user_register');
            $table->timestamps();

            // Add foreign key constraint for user_id
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('clinical_history');
    }
}
