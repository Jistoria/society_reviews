<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('color')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('session_at')->nullable(); // Añadir session_at
            $table->unsignedBigInteger('rol_id'); // Añadir rol_id
            $table->timestamps();

            // Clave foránea
            $table->foreign('rol_id')
                ->references('rol_id')
                ->on('roles')
                ->onDelete('RESTRICT'); // Restricción para evitar eliminar roles con usuarios asociados
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
