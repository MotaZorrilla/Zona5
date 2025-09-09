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
        // Create users table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('national_id')->unique()->nullable();
            $table->date('birth_date')->nullable();
            $table->date('initiation_date')->nullable();
            $table->string('degree')->nullable(); // Ej: Aprendiz, Compañero, Maestro Masón
            $table->string('profession')->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamps();
        });

        // Create cache table
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        // Create jobs table
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        // Create lodges table
        Schema::create('lodges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('number')->unique();
            $table->string('oriente'); // Original name
            $table->text('history')->nullable();
            $table->string('image_url')->nullable();
            $table->string('address')->nullable(); // Added address
            $table->timestamps();
        });

        // Create roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Create role_user pivot table
        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->primary(['role_id', 'user_id']);
        });

        // Create positions table
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create lodge_user pivot table
        Schema::create('lodge_user', function (Blueprint $table) {
            $table->foreignId('lodge_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('position_id')->nullable()->constrained()->onDelete('set null');
            $table->primary(['lodge_id', 'user_id']);
            $table->timestamps();
        });

        // Create news table
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('image_path')->nullable();
            $table->string('status')->default('draft'); // draft, pending, published, archived
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // Create sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('news');
        Schema::dropIfExists('lodge_user');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('lodges');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('users');
    }
};