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
        Schema::create('review_grade', function (Blueprint $table) {

            $table->bigIncrements('id_rg');
            $table->unsignedBigInteger('id_grade'); // FK desde la tabla grades
            $table->unsignedBigInteger('id_review'); // FK desde la tabla reviews
            $table->unsignedBigInteger('id_admin')->nullable(); // FK desde la tabla users_admins
            $table->unsignedBigInteger('id_user')->nullable(); // FK desde la tabla users

            // Constraints de clave foránea hacia las tablas grades, reviews, users_admins y users con eliminación en cascada
            $table->foreign('id_grade')->references('id_grade')->on('grades')->onDelete('cascade');
            $table->foreign('id_review')->references('id_review')->on('reviews')->onDelete('cascade');
            $table->foreign('id_admin')->references('id_admin')->on('users_admins')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_grade');
    }
};
