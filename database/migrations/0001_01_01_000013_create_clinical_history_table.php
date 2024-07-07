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
            $table->string('recommendations', 45);
            $table->timestamp('record_date')->useCurrent();
            $table->unsignedBigInteger('user_register');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clinical_history');
    }
}
