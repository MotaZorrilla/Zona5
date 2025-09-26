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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->string('grade_level')->nullable(); // Primer Grado, Segundo Grado, etc.
            $table->string('image_url')->nullable();
            $table->string('instructor_name')->nullable();
            $table->string('instructor_role')->nullable();
            $table->string('instructor_image')->nullable();
            $table->integer('duration')->nullable(); // duración en horas
            $table->string('status')->default('active'); // active, inactive, upcoming
            $table->string('type'); // synchronous, asynchronous
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
