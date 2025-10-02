<?php

namespace Tests\Unit;

use App\Models\Lodge;
use App\Repositories\LodgeRepository;
use App\Services\LodgeService;
use App\Traits\FileUploadTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class LodgeServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $lodgeRepositoryMock;
    protected $lodgeService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->lodgeRepositoryMock = Mockery::mock(LodgeRepository::class);
        $this->lodgeService = new LodgeService($this->lodgeRepositoryMock);
    }

    public function test_create_lodge()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('lodge.jpg');
        $data = ['name' => 'Test Lodge', 'number' => 1, 'orient' => 'East', 'address' => '123 Main St'];
        $files = ['image_url' => $file];

        $this->lodgeRepositoryMock->shouldReceive('create')->once()->andReturn(new Lodge($data));

        $lodge = $this->lodgeService->create($data, $files);

        $this->assertEquals($data['name'], $lodge->name);
    }

    public function test_update_lodge()
    {
        $lodge = Lodge::factory()->create();
        $data = ['name' => 'Updated Lodge', 'number' => 1, 'orient' => 'East', 'address' => '123 Main St'];

        $this->lodgeRepositoryMock->shouldReceive('find')->with($lodge->id)->andReturn($lodge);

        $updatedLodge = $this->lodgeService->update($lodge->id, $data);

        $this->assertEquals($data['name'], $updatedLodge->name);
    }

    public function test_delete_lodge()
    {
        $lodge = Lodge::factory()->create();

        $this->lodgeRepositoryMock->shouldReceive('find')->with($lodge->id)->andReturn($lodge);

        $result = $this->lodgeService->delete($lodge->id);

        $this->assertTrue($result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
