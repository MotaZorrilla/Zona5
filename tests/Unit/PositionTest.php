<?php

namespace Tests\Unit;

use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PositionTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_position()
    {
        $position = Position::create([
            'name' => 'Test Position',
            'description' => 'Test Position Description',
        ]);

        $this->assertDatabaseHas('positions', [
            'name' => 'Test Position',
            'description' => 'Test Position Description',
        ]);
    }

    public function test_position_attributes()
    {
        $position = Position::create([
            'name' => 'Test Position',
            'description' => 'Test Position Description',
        ]);

        $this->assertEquals('Test Position', $position->name);
        $this->assertEquals('Test Position Description', $position->description);
    }
}