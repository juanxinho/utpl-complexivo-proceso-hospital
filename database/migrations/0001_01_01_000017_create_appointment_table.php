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
            $table->text('reason'); // Adding long text field for reason
            $table->unsignedBigInteger('medic_schedule_id_medic_schedule');
            $table->unsignedBigInteger('invoice_id_invoice')->nullable();
            $table->unsignedBigInteger('clinical_history_id_clinical_history')->nullable();
            $table->date('service_date');
            $table->timestamps();

            $table->foreign('id_patient')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('medic_schedule_id_medic_schedule')->references('id_medic_schedule')->on('medic_schedule')->onDelete('cascade');
            $table->foreign('invoice_id_invoice')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('clinical_history_id_clinical_history')->references('id_clinical_history')->on('clinical_history')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointment');
    }
}

