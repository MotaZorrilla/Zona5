<?php

namespace Tests\Feature\Public;

use App\Models\Lodge;
use App\Models\News;
use App\Models\Position;
use App\Models\ZoneDignitary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_correctly()
    {
        News::factory()->count(5)->create(['status' => 'published']);
        Lodge::factory()->count(5)->create();
        Position::factory()->create(['name' => 'Presidente']);
        ZoneDignitary::factory()->create(['role' => 'Presidente']);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewIs('welcome');
        $response->assertViewHas('latestNews');
        $response->assertViewHas('featuredLodges');
        $response->assertViewHas('importantPositions');
        $response->assertViewHas('zoneDignitaries');
    }
}