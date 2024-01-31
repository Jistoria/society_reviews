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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id('rating_id'); // Puedes usar `id` o `bigIncrements` según tus necesidades
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('review_id');
            $table->decimal('score', 5, 2); // Ajusta la precisión y escala según tus necesidades
            $table->timestamps();

            // Claves foráneas
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('review_id')
                ->references('review_id')
                ->on('reviews')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
