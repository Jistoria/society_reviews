<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * This class represents a migration for creating the 'users_admins' table.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /**
         * Create the 'users_admins' table.
         *
         * Columns:
         * - id_admin: Primary key with autoincrement.
         * - username: Unique username.
         * - password: User password.
         * - color: Nullable color field.
         * - enabled: Boolean field indicating if the user is enabled.
         * - created_at: Timestamp for creation.
         * - updated_at: Timestamp for last update.
         */
        Schema::create('users_admins', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('color')->nullable();
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'users_admins' table.
        Schema::dropIfExists('users_admins');
    }
};
