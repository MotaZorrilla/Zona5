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
        Schema::table('forum_posts', function (Blueprint $table) {
            $table->integer('likes_count')->default(0)->after('is_approved');
            $table->integer('dislikes_count')->default(0)->after('likes_count');
            $table->integer('views_count')->default(0)->after('dislikes_count');
            $table->string('slug')->nullable()->after('views_count');
            $table->text('excerpt')->nullable()->after('slug');
            $table->boolean('is_featured')->default(false)->after('excerpt');
            $table->json('attachments')->nullable()->after('is_featured'); // Para archivos adjuntos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forum_posts', function (Blueprint $table) {
            $table->dropColumn([
                'likes_count',
                'dislikes_count',
                'views_count',
                'slug',
                'excerpt',
                'is_featured',
                'attachments'
            ]);
        });
    }
};
