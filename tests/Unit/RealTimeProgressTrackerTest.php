<?php

namespace Tests\Unit;

use App\Services\RealTimeProgressTracker;
use Tests\TestCase;

class RealTimeProgressTrackerTest extends TestCase
{
    public function test_tracker_initialization()
    {
        $tracker = new RealTimeProgressTracker();
        
        $this->assertNotNull($tracker->getTaskId());
        $this->assertTrue($tracker->isDebugEnabled());
    }

    public function test_tracker_initialization_with_task_id()
    {
        $taskId = 'test-task-id';
        $tracker = new RealTimeProgressTracker($taskId);
        
        $this->assertEquals($taskId, $tracker->getTaskId());
    }

    public function test_start_task()
    {
        $tracker = new RealTimeProgressTracker();
        
        $result = $tracker->startTask('test_task', 'Initial message');
        
        $this->assertNotNull($result);
        $this->assertIsString($result);
    }

    public function test_step_method()
    {
        $tracker = new RealTimeProgressTracker();
        $tracker->startTask('test_task');
        
        $result = $tracker->step('Test Step', 50, 'Additional info');
        
        $this->assertIsArray($result);
        $this->assertEquals('Test Step', $result['step_name']);
        $this->assertEquals(50, $result['progress']);
    }

    public function test_info_method()
    {
        $tracker = new RealTimeProgressTracker();
        
        $result = $tracker->info('Test info message', 'Additional info');
        
        $this->assertIsArray($result);
        $this->assertEquals('Test info message', $result['message']);
    }

    public function test_warning_method()
    {
        $tracker = new RealTimeProgressTracker();
        
        $result = $tracker->warning('Test warning message', 'Additional info');
        
        $this->assertIsArray($result);
        $this->assertEquals('Test warning message', $result['message']);
    }

    public function test_error_method()
    {
        $tracker = new RealTimeProgressTracker();
        
        $result = $tracker->error('Test error message', 'Additional info');
        
        $this->assertIsArray($result);
        $this->assertEquals('Test error message', $result['message']);
    }

    public function test_query_method()
    {
        $tracker = new RealTimeProgressTracker();
        
        $result = $tracker->query('SELECT * FROM users', ['id' => 1], 10.5);
        
        $this->assertIsArray($result);
        $this->assertEquals('SELECT * FROM users', $result['query']);
        $this->assertEquals(10.5, $result['time_ms']);
    }

    public function test_end_task()
    {
        $tracker = new RealTimeProgressTracker();
        $tracker->startTask('test_task');
        
        $result = $tracker->endTask(true, ['result' => 'success']);
        
        $this->assertIsArray($result);
        $this->assertTrue($result['success']);
        $this->assertEquals(['result' => 'success'], $result['result']);
    }

    public function test_get_progress_updates()
    {
        $tracker = new RealTimeProgressTracker();
        $tracker->startTask('test_task');
        $tracker->step('Step 1', 25, 'First step');
        $tracker->step('Step 2', 50, 'Second step');
        
        $progressUpdates = $tracker->getProgressUpdates();
        
        $this->assertCount(2, $progressUpdates);
        $this->assertEquals('Step 1', $progressUpdates[0]['step_name']);
        $this->assertEquals('Step 2', $progressUpdates[1]['step_name']);
    }

    public function test_get_performance_metrics()
    {
        $tracker = new RealTimeProgressTracker();
        $tracker->startTask('test_task');
        $tracker->step('Step 1', 25, 'First step');
        $tracker->endTask(true, ['result' => 'success']);
        
        $metrics = $tracker->getPerformanceMetrics();
        
        $this->assertArrayHasKey('start_time', $metrics);
        $this->assertArrayHasKey('end_time', $metrics);
        $this->assertArrayHasKey('total_duration', $metrics);
        $this->assertArrayHasKey('total_steps', $metrics);
    }

    public function test_get_progress_summary()
    {
        $tracker = new RealTimeProgressTracker();
        $tracker->startTask('test_task');
        $tracker->step('Step 1', 25, 'First step');
        
        $summary = $tracker->getProgressSummary();
        
        $this->assertArrayHasKey('task_id', $summary);
        $this->assertArrayHasKey('total_steps', $summary);
        $this->assertArrayHasKey('current_progress', $summary);
        $this->assertArrayHasKey('progress_updates', $summary);
        $this->assertEquals(25, $summary['current_progress']);
    }

    public function test_export_progress_data()
    {
        $tracker = new RealTimeProgressTracker();
        $tracker->startTask('test_task');
        $tracker->step('Step 1', 25, 'First step');
        
        $exported = $tracker->exportProgressData();
        
        $this->assertArrayHasKey('task_id', $exported);
        $this->assertArrayHasKey('progress_updates', $exported);
        $this->assertArrayHasKey('performance_metrics', $exported);
        $this->assertArrayHasKey('summary', $exported);
    }

    public function test_set_debug_enabled()
    {
        $tracker = new RealTimeProgressTracker();
        
        $tracker->setDebugEnabled(false);
        $this->assertFalse($tracker->isDebugEnabled());
        
        $tracker->setDebugEnabled(true);
        $this->assertTrue($tracker->isDebugEnabled());
    }
}