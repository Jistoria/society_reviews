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
        Schema::create('civil_reviews', function (Blueprint $table) {
            $table->id('civil_review_id'); // Puedes usar `id` o `bigIncrements` según tus necesidades
            $table->unsignedBigInteger('franchise_id')->nullable();
            $table->unsignedBigInteger('civil_franchise_id')->nullable();
            $table->enum('franchise_type', ['existing', 'civil_suggestion']);
            $table->string('slug')->unique();
            $table->unsignedBigInteger('content_type_id');
            $table->unsignedBigInteger('user_id');
            $table->string('title_alternative')->nullable();
            $table->text('description_alternative')->nullable();
            $table->text('data');
            $table->decimal('rating_main', 5, 2); // Ajusta la precisión y escala según tus necesidades
            $table->text('spoiler_content')->nullable();
            $table->date('release_year');
            $table->date('release_year');
            $table->integer('quantity_episode')->nullable();
            $table->time('duration_time')->nullable();
            $table->boolean('seend')->default(false); // Agregado el campo 'seend'
            $table->enum('state_type', ['accept', 'not_accept'])->nullable();
            $table->timestamps();

            // Claves foráneas
            $table->foreign('franchise_id')
            ->references('id')
            ->on('franchises')
            ->onDelete('cascade');

            $table->foreign('civil_franchise_id')
                ->references('id')
                ->on('civil_franchises')
                ->onDelete('cascade');

            $table->foreign('content_type_id')
                ->references('content_type_id')
                ->on('content_types')
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
        //
        Schema::dropIfExists('civil_reviews');
    }
};
