<?php

namespace Tests\Unit;

use App\Enums\NewsStatusEnum;
use App\Models\News;
use App\Models\User;
use App\Repositories\NewsRepository;
use App\Services\NewsService;
use App\Traits\FileUploadTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class NewsServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $newsRepositoryMock;
    protected $newsService;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->newsRepositoryMock = Mockery::mock(NewsRepository::class);
        $this->newsService = new NewsService($this->newsRepositoryMock);
        $this->user = User::factory()->create();
        Auth::login($this->user);
    }

    public function test_create_news()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('news.jpg');
        $data = [
            'title' => 'Test News',
            'excerpt' => 'Test Excerpt',
            'content' => 'Test Content',
            'status' => NewsStatusEnum::PUBLISHED,
        ];
        $files = ['image' => $file];

        $this->newsRepositoryMock->shouldReceive('create')->once()->andReturn(new News($data));

        $news = $this->newsService->create($data, $files);

        $this->assertEquals($data['title'], $news->title);
    }

    public function test_update_news()
    {
        $news = News::factory()->create();
        $data = [
            'title' => 'Updated News',
            'excerpt' => 'Updated Excerpt',
            'content' => 'Updated Content',
            'status' => NewsStatusEnum::DRAFT,
        ];

        $this->newsRepositoryMock->shouldReceive('find')->with($news->id)->andReturn($news);

        $updatedNews = $this->newsService->update($news->id, $data);

        $this->assertEquals($data['title'], $updatedNews->title);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
