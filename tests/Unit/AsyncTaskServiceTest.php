<?php

namespace Tests\Unit;

use App\Services\AsyncTaskService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\TestCase;
use Carbon\Carbon;

class AsyncTaskServiceTest extends TestCase
{
    private $asyncTaskService;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Mock Auth service to return a user
        Auth::shouldReceive('id')
            ->andReturn(1);
            
        Auth::shouldReceive('check')
            ->andReturn(true);
            
        Auth::shouldReceive('user->name')
            ->andReturn('Test User');

        $this->asyncTaskService = new AsyncTaskService();
    }

    public function test_create_task()
    {
        $taskId = $this->asyncTaskService->createTask('pdf_report', [
            'dateRange' => ['start' => '2023-01-01', 'end' => '2023-01-31'],
            'options' => ['format' => 'pdf']
        ]);

        $this->assertIsString($taskId);
        $this->assertNotEmpty($taskId);

        $task = $this->asyncTaskService->getTaskStatus($taskId);
        $this->assertNotNull($task);
        $this->assertEquals('pending', $task['status']);
        $this->assertEquals('pdf_report', $task['type']);
        $this->assertEquals(0, $task['progress']);
    }

    public function test_get_task_status()
    {
        $taskId = $this->asyncTaskService->createTask('test_type');
        
        $task = $this->asyncTaskService->getTaskStatus($taskId);
        $this->assertNotNull($task);
        $this->assertEquals('pending', $task['status']);
        $this->assertEquals('test_type', $task['type']);
    }

    public function test_get_nonexistent_task_status()
    {
        $task = $this->asyncTaskService->getTaskStatus('nonexistent_task_id');
        $this->assertNull($task);
    }

    public function test_update_progress()
    {
        $taskId = $this->asyncTaskService->createTask('test_type');
        
        $result = $this->asyncTaskService->updateProgress($taskId, 50, 'Processing data...');
        $this->assertTrue($result);

        $task = $this->asyncTaskService->getTaskStatus($taskId);
        $this->assertEquals(50, $task['progress']);
        $this->assertEquals('Processing data...', $task['message']);
        $this->assertEquals('processing', $task['status']);
    }

    public function test_complete_task()
    {
        $taskId = $this->asyncTaskService->createTask('test_type');
        
        $result = $this->asyncTaskService->completeTask($taskId, ['result' => 'success']);
        $this->assertTrue($result);

        $task = $this->asyncTaskService->getTaskStatus($taskId);
        $this->assertEquals('completed', $task['status']);
        $this->assertEquals(100, $task['progress']);
        $this->assertEquals(['result' => 'success'], $task['result']);
    }

    public function test_fail_task()
    {
        $taskId = $this->asyncTaskService->createTask('test_type');
        
        $result = $this->asyncTaskService->failTask($taskId, 'Test error message');
        $this->assertTrue($result);

        $task = $this->asyncTaskService->getTaskStatus($taskId);
        $this->assertEquals('failed', $task['status']);
        $this->assertEquals('Test error message', $task['error']);
    }

    public function test_uuid_generation()
    {
        $taskId = $this->asyncTaskService->createTask('test_type');
        
        // Check if the task ID is a valid UUID
        $this->assertTrue(Str::isUuid($taskId));
    }

    public function test_task_timeout()
    {
        // Create a mock task with expired timeout
        $taskId = $this->asyncTaskService->createTask('test_type');
        $task = $this->asyncTaskService->getTaskStatus($taskId);
        
        // Manually update task to simulate timeout
        $reflection = new \ReflectionClass($this->asyncTaskService);
        $tasksPath = $reflection->getProperty('tasksPath');
        $tasksPath->setAccessible(true);
        $path = $tasksPath->getValue($this->asyncTaskService);
        
        $taskPath = $path . '/' . $taskId . '.json';
        $task = json_decode(file_get_contents($taskPath), true);
        $task['status'] = 'processing';
        $task['timeout_at'] = Carbon::now()->subMinute()->toISOString();
        file_put_contents($taskPath, json_encode($task, JSON_PRETTY_PRINT));
        
        // Get the updated task status (should be marked as failed due to timeout)
        $updatedTask = $this->asyncTaskService->getTaskStatus($taskId);
        $this->assertEquals('failed', $updatedTask['status']);
        $this->assertStringContainsString('timeout', $updatedTask['error']);
    }
}