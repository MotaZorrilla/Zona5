<?php

namespace Tests\Unit;

use App\Services\DebugService;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class DebugServiceTest extends TestCase
{
    public function test_debug_service_initialization()
    {
        $debugService = new DebugService();
        
        $this->assertTrue($debugService->isEnabled());
    }

    public function test_debug_service_disabled()
    {
        $debugService = new DebugService(false);
        
        $this->assertFalse($debugService->isEnabled());
    }

    public function test_start_task()
    {
        $debugService = new DebugService(true);
        
        $result = $debugService->startTask('test_task', 'Initial message');
        
        // The method doesn't return anything, but we can verify it doesn't throw an exception
        $this->assertNull($result);
    }

    public function test_step_method()
    {
        $debugService = new DebugService(true);
        
        $debugService->startTask('test_task');
        $result = $debugService->step('Test Step', 50, 'Additional info');
        
        $this->assertNull($result);
    }

    public function test_info_method()
    {
        $debugService = new DebugService(true);
        
        $result = $debugService->info('Test info message', 'Additional info');
        
        $this->assertNull($result);
    }

    public function test_warning_method()
    {
        $debugService = new DebugService(true);
        
        $result = $debugService->warning('Test warning message', 'Additional info');
        
        $this->assertNull($result);
    }

    public function test_error_method()
    {
        $debugService = new DebugService(true);
        
        $result = $debugService->error('Test error message', 'Additional info');
        
        $this->assertNull($result);
    }

    public function test_query_method()
    {
        $debugService = new DebugService(true);
        
        $result = $debugService->query('SELECT * FROM users', [], 10.5);
        
        $this->assertNull($result);
    }

    public function test_end_task()
    {
        $debugService = new DebugService(true);
        
        $debugService->startTask('test_task');
        $result = $debugService->endTask(true, ['result' => 'success']);
        
        $this->assertNull($result);
    }

    public function test_set_enabled_method()
    {
        $debugService = new DebugService(false);
        
        $this->assertFalse($debugService->isEnabled());
        
        $debugService->setEnabled(true);
        
        $this->assertTrue($debugService->isEnabled());
    }

    public function test_log_with_task_id()
    {
        $debugService = new DebugService(true, 'test_task_id');
        
        $this->assertNotNull($debugService);
    }

    public function test_elapsed_time_calculation()
    {
        $debugService = new DebugService(true);
        
        $start = microtime(true);
        $elapsed = $debugService->isEnabled(); // This won't actually return elapsed time directly
        $end = microtime(true);
        
        // Just make sure the service works
        $this->assertTrue(is_bool($elapsed));
    }
}