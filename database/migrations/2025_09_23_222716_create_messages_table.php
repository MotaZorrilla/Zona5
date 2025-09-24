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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name');
            $table->string('sender_email');
            $table->string('subject');
            $table->text('content');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Para mensajes internos
            $table->foreignId('recipient_id')->nullable()->constrained('users')->onDelete('set null'); // Para mensajes internos
            $table->enum('status', ['unread', 'read', 'archived', 'deleted'])->default('unread');
            $table->timestamp('read_at')->nullable();
            $table->timestamp('archived_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
