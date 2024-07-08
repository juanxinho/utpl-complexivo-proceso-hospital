<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->id('id_invoice');
            $table->timestamp('record_date')->useCurrent();
            $table->string('status', 45);
            $table->string('detail', 45);
            $table->integer('total');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}

