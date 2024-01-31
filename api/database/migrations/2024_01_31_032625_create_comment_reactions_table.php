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
        Schema::create('comment_reactions', function (Blueprint $table) {
            $table->id('reaction_id'); // Puedes usar `id` o `bigIncrements` según tus necesidades
            $table->unsignedBigInteger('comment_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('reaction_type', ['like', 'dislike']);
            $table->timestamps();

            // Claves foráneas
            $table->foreign('comment_id')
                ->references('comment_id')
                ->on('comments')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_reactions');
    }
};
