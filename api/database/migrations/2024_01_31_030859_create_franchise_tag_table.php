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
        Schema::create('franchise_tag', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('franchise_id');
            $table->foreign('franchise_id')
                ->references('franchise_id')
                ->on('franchises')
                ->onDelete('cascade');

            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')
                ->references('tag_id')
                ->on('tags')
                ->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('franchise_tag');
    }
};
