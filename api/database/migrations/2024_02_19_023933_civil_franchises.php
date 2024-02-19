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
        Schema::create('civil_franchises', function (Blueprint $table) {
            $table->id('civil_franchise_id'); // Puedes usar `id` o `bigIncrements` según tus necesidades
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('animation_studio_latest')->nullable();
            $table->string('image_url')->nullable();
            $table->string('author')->nullable();
            $table->string('original_work')->nullable();
            $table->date('first_release')->nullable();
            $table->date('end_release')->nullable();
            $table->boolean('seend')->default(false);
            $table->enum('state_type', ['accept', 'not_accept'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('civil_franchises');
    }
};
