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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user'); // PK con autoincremento
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('color')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->timestamps(); // Campos created_at y updated_at
    });}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
