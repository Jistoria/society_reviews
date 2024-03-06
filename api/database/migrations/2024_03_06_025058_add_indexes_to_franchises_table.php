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
        Schema::table('franchises', function (Blueprint $table) {
            // Índice para la columna 'title'
            $table->index('title');

            // Índice para la columna 'slug'
            $table->index('slug');

            // Índice para la columna 'title_alternative'
            // $table->index('title_alternative');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('franchises', function (Blueprint $table) {
            //
        });
    }
};
