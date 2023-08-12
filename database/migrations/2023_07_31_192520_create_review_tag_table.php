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
        Schema::create('review_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('review_id'); // FK desde la tabla reviews
            $table->unsignedBigInteger('tag_id'); // FK desde la tabla tags

            // Constraints de clave foránea hacia las tablas reviews y tags
            $table->foreign('review_id')->references('id_review')->on('reviews')->onDelete('cascade');
            $table->foreign('tag_id')->references('id_tag')->on('tags')->onDelete('cascade');

            // Establecer la clave primaria compuesta por las claves foráneas
            $table->primary(['review_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_tag');
    }
};
