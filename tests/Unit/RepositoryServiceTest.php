<?php

namespace Tests\Unit;

use App\Services\RepositoryService;
use App\Repositories\RepositoryRepository;
use App\Models\Repository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Illuminate\Http\UploadedFile;

class RepositoryServiceTest extends TestCase
{
    use RefreshDatabase;

    private $repositoryRepository;
    private $repositoryService;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->repositoryRepository = Mockery::mock(RepositoryRepository::class);
        $this->repositoryService = new RepositoryService($this->repositoryRepository);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_all_with_uploader()
    {
        $repositories = collect([Repository::factory()->make()]);
        
        $this->repositoryRepository->shouldReceive('all')
            ->once()
            ->with(['uploader'])
            ->andReturn($repositories);

        $result = $this->repositoryService->allWithUploader();

        $this->assertCount(1, $result);
    }

    public function test_create_repository()
    {
        $data = [
            'title' => 'Test Document',
            'description' => 'Test Description',
            'category' => 'Test Category',
            'grade_level' => 'TODOS'
        ];

        $file = UploadedFile::fake()->create('test.pdf', 100, 'application/pdf');

        $repository = Repository::factory()->make();
        $repository->id = 1;
        $repository->title = 'Test Document';
        
        $this->repositoryRepository->shouldReceive('create')
            ->once()
            ->andReturn($repository);

        Auth::shouldReceive('id')
            ->andReturn(1);

        $result = $this->repositoryService->create($data, ['document' => $file]);

        $this->assertInstanceOf(Repository::class, $result);
        $this->assertEquals('Test Document', $result->title);
    }

    public function test_update_repository()
    {
        $repositoryId = 1;
        $data = [
            'title' => 'Updated Document',
            'description' => 'Updated Description'
        ];

        $repository = Repository::factory()->create([
            'id' => $repositoryId,
            'title' => 'Original Document'
        ]);

        $this->repositoryRepository->shouldReceive('find')
            ->once()
            ->with($repositoryId, [])
            ->andReturn($repository);

        $result = $this->repositoryService->update($repositoryId, $data);

        $this->assertInstanceOf(Repository::class, $result);
        $this->assertEquals('Updated Document', $result->title);
    }

    public function test_update_repository_not_found()
    {
        $this->repositoryRepository->shouldReceive('find')
            ->once()
            ->with(999, [])
            ->andReturn(null);

        $result = $this->repositoryService->update(999, ['title' => 'Updated Document']);

        $this->assertNull($result);
    }

    public function test_delete_repository()
    {
        $repository = Repository::factory()->create(['id' => 1]);

        $this->repositoryRepository->shouldReceive('find')
            ->once()
            ->with(1)
            ->andReturn($repository);

        $result = $this->repositoryService->delete(1);

        $this->assertTrue($result);
    }

    public function test_delete_repository_not_found()
    {
        $this->repositoryRepository->shouldReceive('find')
            ->once()
            ->with(999)
            ->andReturn(null);

        $result = $this->repositoryService->delete(999);

        $this->assertFalse($result);
    }

    public function test_get_by_category()
    {
        $repositories = collect([Repository::factory()->make()]);
        
        $this->repositoryRepository->shouldReceive('getByCategory')
            ->once()
            ->with('Test Category', ['uploader'])
            ->andReturn($repositories);

        $result = $this->repositoryService->getByCategory('Test Category');

        $this->assertCount(1, $result);
    }

    public function test_get_by_grade_level()
    {
        $repositories = collect([Repository::factory()->make()]);
        
        $this->repositoryRepository->shouldReceive('getByGradeLevel')
            ->once()
            ->with('TODOS', ['uploader'])
            ->andReturn($repositories);

        $result = $this->repositoryService->getByGradeLevel('TODOS');

        $this->assertCount(1, $result);
    }

    public function test_find_repository()
    {
        $repository = Repository::factory()->create(['id' => 1]);
        
        $this->repositoryRepository->shouldReceive('find')
            ->once()
            ->with(1, [])
            ->andReturn($repository);

        $result = $this->repositoryService->find(1);

        $this->assertInstanceOf(Repository::class, $result);
        $this->assertEquals(1, $result->id);
    }
}