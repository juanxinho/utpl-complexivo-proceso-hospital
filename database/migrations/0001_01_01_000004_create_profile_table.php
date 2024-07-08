<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id('id_profile');
            $table->string('nid', 13)->unique();
            $table->string('first_name', 45);
            $table->string('last_name', 45);
            $table->date('dob');
            $table->string('phone', 10);
            $table->enum('gender', ['M', 'F']);
            $table->timestamps();
            $table->unsignedBigInteger('user_register')->nullable();
            $table->unsignedBigInteger('user_modification')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
