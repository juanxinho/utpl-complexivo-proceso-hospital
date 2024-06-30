<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillTable extends Migration
{
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->id('idfactura');
            $table->timestamp('fecha_registro')->useCurrent();
            $table->string('estado', 45);
            $table->string('detalle', 45);
            $table->integer('total');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('factura');
    }
}

