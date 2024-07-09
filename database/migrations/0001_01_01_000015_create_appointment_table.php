<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentTable extends Migration
{
    public function up()
    {
        Schema::create('appointment', function (Blueprint $table) {
            $table->id('id_appointment');
            $table->unsignedBigInteger('id_patient');
            $table->unsignedBigInteger('user_register');
            $table->unsignedBigInteger('user_modification')->nullable();
            $table->timestamp('record_date')->useCurrent();
            $table->timestamp('modification_date')->nullable();
            $table->string('status', 45);
            $table->unsignedBigInteger('medic_schedule_id_medic_schedule');
            $table->unsignedBigInteger('invoice_id_invoice')->nullable();
            $table->unsignedBigInteger('clinical_history_id_clinical_history')->nullable();
            $table->date('service_date');
            $table->timestamps();

            $table->foreign('medic_schedule_id_medic_schedule')->references('id_medic_schedule')->on('medic_schedule');
            $table->foreign('invoice_id_invoice')->references('id_invoice')->on('invoice');
            $table->foreign('clinical_history_id_clinical_history')->references('id_clinical_history')->on('clinical_history');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointment');
    }
}

