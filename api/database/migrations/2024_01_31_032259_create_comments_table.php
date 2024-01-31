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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id'); // Puedes usar `id` o `bigIncrements` según tus necesidades
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('review_id');
            $table->unsignedBigInteger('com_comment_id')->nullable(); // Clave foránea para comentarios anidados
            $table->text('content');
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

            $table->foreign('com_comment_id')
                ->references('comment_id')
                ->on('comments')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
