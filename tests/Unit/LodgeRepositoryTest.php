<?php

namespace Tests\Unit;

use App\Models\Lodge;
use App\Repositories\LodgeRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LodgeRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $lodgeRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->lodgeRepository = new LodgeRepository(new Lodge());
    }

    public function test_find_by_number()
    {
        $lodge = Lodge::factory()->create(['number' => 123]);
        Lodge::factory()->create(['number' => 456]);

        $foundLodge = $this->lodgeRepository->findByNumber(123);

        $this->assertEquals($lodge->id, $foundLodge->id);
    }

    public function test_get_by_orient()
    {
        $lodge1 = Lodge::factory()->create(['orient' => 'East']);
        $lodge2 = Lodge::factory()->create(['orient' => 'East']);
        Lodge::factory()->create(['orient' => 'West']);

        $lodges = $this->lodgeRepository->getByOrient('East');

        $this->assertCount(2, $lodges);
        $this->assertTrue($lodges->contains($lodge1));
        $this->assertTrue($lodges->contains($lodge2));
    }
}
