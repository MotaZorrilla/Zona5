<?php

namespace Tests\Unit;

use App\Repositories\RepositoryRepository;
use App\Models\Repository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepositoryRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private $repositoryRepository;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->repositoryRepository = new RepositoryRepository(new Repository());
    }

    public function test_get_by_category()
    {
        Repository::factory()->create([
            'title' => 'Document 1',
            'category' => 'Category A'
        ]);

        Repository::factory()->create([
            'title' => 'Document 2',
            'category' => 'Category B'
        ]);

        $categoryARepo = $this->repositoryRepository->getByCategory('Category A');

        $this->assertCount(1, $categoryARepo);
        $this->assertEquals('Document 1', $categoryARepo->first()->title);
    }

    public function test_get_by_grade_level()
    {
        Repository::factory()->create([
            'title' => 'Document 1',
            'grade_level' => 'TODOS'
        ]);

        Repository::factory()->create([
            'title' => 'Document 2',
            'grade_level' => 'Aprendiz'
        ]);

        $todosRepo = $this->repositoryRepository->getByGradeLevel('TODOS');

        $this->assertCount(1, $todosRepo);
        $this->assertEquals('Document 1', $todosRepo->first()->title);
    }

    public function test_repository_inheritance()
    {
        $this->assertInstanceOf(\App\Repositories\AbstractRepository::class, $this->repositoryRepository);
    }

    public function test_find_method_from_parent()
    {
        $repository = Repository::factory()->create([
            'title' => 'Test Repository'
        ]);

        $foundRepo = $this->repositoryRepository->find($repository->id);

        $this->assertNotNull($foundRepo);
        $this->assertEquals('Test Repository', $foundRepo->title);
    }

    public function test_all_method_from_parent()
    {
        Repository::factory()->count(3)->create();

        $allRepos = $this->repositoryRepository->all();

        $this->assertCount(3, $allRepos);
    }
}