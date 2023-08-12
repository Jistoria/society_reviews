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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id('id_comentario'); // PK con autoincremento
            $table->unsignedBigInteger('id_user'); // FK desde la tabla users
            $table->unsignedBigInteger('comen_id')->nullable(); // FK desde la propia tabla
            $table->unsignedBigInteger('id_review'); // FK desde una tabla reviews
            $table->string('contenido');
            $table->timestamp('created_at')->nullable();

            // Constraints de clave primaria y claves foráneas con eliminación en cascada
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('comen_id')->references('id_comentario')->on('comentarios')->onDelete('cascade');
            $table->foreign('id_review')->references('id_review')->on('reviews')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
