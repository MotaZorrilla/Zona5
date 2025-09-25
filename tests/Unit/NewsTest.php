<?php

namespace Tests\Unit;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_news_can_be_created()
    {
        $user = User::factory()->create();
        
        $news = News::create([
            'user_id' => $user->id,
            'title' => 'Test News',
            'slug' => 'test-news',
            'excerpt' => 'Test excerpt',
            'content' => 'Test content',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertDatabaseHas('news', [
            'user_id' => $user->id,
            'title' => 'Test News',
            'slug' => 'test-news',
            'excerpt' => 'Test excerpt',
            'content' => 'Test content',
            'status' => 'published',
        ]);
    }

    public function test_news_belongs_to_author()
    {
        $user = User::factory()->create();
        
        $news = News::create([
            'user_id' => $user->id,
            'title' => 'Test News',
            'slug' => 'test-news',
            'excerpt' => 'Test excerpt',
            'content' => 'Test content',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertEquals($user->id, $news->author->id);
    }

    public function test_news_can_be_published()
    {
        $user = User::factory()->create();
        
        $news = News::create([
            'user_id' => $user->id,
            'title' => 'Test News',
            'slug' => 'test-news',
            'excerpt' => 'Test excerpt',
            'content' => 'Test content',
            'status' => 'draft',
        ]);

        $news->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertEquals('published', $news->fresh()->status);
        $this->assertNotNull($news->fresh()->published_at);
    }

    public function test_published_scope()
    {
        $user = User::factory()->create();
        
        // Create a published news
        News::create([
            'user_id' => $user->id,
            'title' => 'Published News',
            'slug' => 'published-news',
            'excerpt' => 'Published excerpt',
            'content' => 'Published content',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        // Create a draft news
        News::create([
            'user_id' => $user->id,
            'title' => 'Draft News',
            'slug' => 'draft-news',
            'excerpt' => 'Draft excerpt',
            'content' => 'Draft content',
            'status' => 'draft',
        ]);

        $publishedNews = News::published()->get();

        $this->assertCount(1, $publishedNews);
        $this->assertEquals('published', $publishedNews->first()->status);
    }

    public function test_draft_scope()
    {
        $user = User::factory()->create();
        
        // Create a published news
        News::create([
            'user_id' => $user->id,
            'title' => 'Published News',
            'slug' => 'published-news',
            'excerpt' => 'Published excerpt',
            'content' => 'Published content',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        // Create a draft news
        News::create([
            'user_id' => $user->id,
            'title' => 'Draft News',
            'slug' => 'draft-news',
            'excerpt' => 'Draft excerpt',
            'content' => 'Draft content',
            'status' => 'draft',
        ]);

        $draftNews = News::draft()->get();

        $this->assertCount(1, $draftNews);
        $this->assertEquals('draft', $draftNews->first()->status);
    }
}