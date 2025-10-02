<?php

namespace Tests\Feature\Public;

use App\Models\News;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_news_index_loads_correctly()
    {
        News::factory()->count(10)->create(['status' => 'published']);
        Event::factory()->count(5)->create(['is_public' => true]);

        $response = $this->get(route('public.news.index'));

        $response->assertStatus(200);
        $response->assertViewIs('public.news');
        $response->assertViewHas('news');
        $response->assertViewHas('events');
    }
}
