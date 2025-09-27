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
        Schema::table('forums', function (Blueprint $table) {
            $table->integer('posts_count')->default(0)->after('order');
            $table->timestamp('last_activity_at')->nullable()->after('posts_count');
            $table->string('color', 7)->default('#2C3E50')->after('last_activity_at'); // Hex color for category
            $table->string('icon', 50)->default('ri-discuss-line')->after('color'); // Remix icon class
            $table->integer('views_count')->default(0)->after('icon');
            $table->boolean('is_featured')->default(false)->after('views_count');
            $table->text('excerpt')->nullable()->after('is_featured'); // Short description for cards
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('forums', function (Blueprint $table) {
            $table->dropColumn([
                'posts_count',
                'last_activity_at',
                'color',
                'icon',
                'views_count',
                'is_featured',
                'excerpt'
            ]);
        });
    }
};
