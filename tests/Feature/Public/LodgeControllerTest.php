<?php

namespace Tests\Feature\Public;

use App\Models\Lodge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LodgeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_lodge_show_page_loads_correctly()
    {
        $lodge = Lodge::factory()->create();

        $response = $this->get(route('public.lodges.show', $lodge));

        $response->assertStatus(200);
        $response->assertViewIs('public.lodge-show');
        $response->assertViewHas('lodge', $lodge);
    }
}
