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
        Schema::create('roles', function (Blueprint $table) {
            $table->id('rol_id'); // Puedes usar `id` o `bigIncrements` según tus necesidades
            $table->string('rol')->unique();
            $table->timestamps(); // Opcional, agrega automáticamente las columnas `created_at` y `updated_at`
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
