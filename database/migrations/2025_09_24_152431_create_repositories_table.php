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
        Schema::create('repositories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type'); // pdf, doc, docx, etc.
            $table->string('category')->nullable(); // Ritual, Administración, Historia, etc.
            $table->string('grade_level')->nullable(); // Aprendiz, Compañero, Maestro
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('set null'); // User who uploaded the file
            $table->timestamp('uploaded_at')->nullable();
            $table->unsignedBigInteger('file_size')->nullable(); // Size in bytes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repositories');
    }
};
