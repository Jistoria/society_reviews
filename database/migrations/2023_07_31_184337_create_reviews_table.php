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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('id_review'); // PK con autoincremento
            $table->unsignedBigInteger('id_admin'); // FK desde la tabla admins
            $table->string('titulo')->unique();
            $table->string('titulo2')->unique();
            $table->string('imagen');
            $table->string('sinopsis');
            $table->string('contenido');
            $table->string('slug')->unique();
            $table->timestamps();

            // Constraints de clave primaria y clave foránea
            $table->foreign('id_admin')->references('id_admin')->on('users_admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
