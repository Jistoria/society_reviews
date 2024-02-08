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
        Schema::create('franchises', function (Blueprint $table) {
            $table->id('franchise_id'); // Puedes usar `id` o `bigIncrements` según tus necesidades
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('description');
            $table->string('animation_studio_latest')->nullable();
            $table->string('image_url')->nullable();
            $table->string('author')->nullable();
            $table->string('original_work')->nullable();
            $table->date('first_release')->nullable();
            $table->date('end_release')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('franchises');
    }
};
