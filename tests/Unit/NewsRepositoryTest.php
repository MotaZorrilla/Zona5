<?php

namespace Tests\Unit;

use App\Repositories\NewsRepository;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class NewsRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $newsRepository;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->newsRepository = new NewsRepository(new News());
    }

    public function test_get_published_news()
    {
        // Create some test news items
        News::factory()->create([
            'title' => 'Published News',
            'status' => 'published',
            'published_at' => now()->subDay(),
            'user_id' => 1
        ]);

        News::factory()->create([
            'title' => 'Draft News',
            'status' => 'draft',
            'user_id' => 1
        ]);

        $publishedNews = $this->newsRepository->getPublished();

        $this->assertCount(1, $publishedNews);
        $this->assertEquals('Published News', $publishedNews->first()->title);
    }

    public function test_get_drafts()
    {
        // Mock the Auth service to return a user ID
        Auth::shouldReceive('id')
            ->andReturn(1);

        // Create some test news items
        News::factory()->create([
            'title' => 'User Draft',
            'status' => 'draft',
            'user_id' => 1
        ]);

        News::factory()->create([
            'title' => 'Other User Draft',
            'status' => 'draft',
            'user_id' => 2
        ]);

        $userDrafts = $this->newsRepository->getDrafts();

        $this->assertCount(1, $userDrafts);
        $this->assertEquals('User Draft', $userDrafts->first()->title);
    }

    public function test_get_scheduled_news()
    {
        // Create some test news items
        News::factory()->create([
            'title' => 'Scheduled News',
            'status' => 'scheduled',
            'published_at' => now()->addDay(),
            'user_id' => 1
        ]);

        News::factory()->create([
            'title' => 'Past Scheduled News',
            'status' => 'published',
            'published_at' => now()->subDay(),
            'user_id' => 1
        ]);

        $scheduledNews = $this->newsRepository->getScheduled();

        $this->assertCount(1, $scheduledNews);
        $this->assertEquals('Scheduled News', $scheduledNews->first()->title);
    }

    public function test_publish_now()
    {
        $news = News::factory()->create([
            'title' => 'Draft News',
            'status' => 'draft',
            'published_at' => null,
            'user_id' => 1
        ]);

        $result = $this->newsRepository->publishNow($news->id);

        $this->assertTrue($result);

        $news->refresh();
        $this->assertEquals('published', $news->status);
        $this->assertNotNull($news->published_at);
    }

    public function test_publish_now_news_not_found()
    {
        $result = $this->newsRepository->publishNow(999);

        $this->assertFalse($result);
    }

    public function test_repository_inheritance()
    {
        $this->assertInstanceOf(\App\Repositories\AbstractRepository::class, $this->newsRepository);
    }

    public function test_find_method_from_parent()
    {
        $news = News::factory()->create([
            'title' => 'Test News',
            'user_id' => 1
        ]);

        $foundNews = $this->newsRepository->find($news->id);

        $this->assertNotNull($foundNews);
        $this->assertEquals('Test News', $foundNews->title);
    }
}