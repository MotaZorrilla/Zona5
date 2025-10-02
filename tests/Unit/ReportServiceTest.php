<?php

namespace Tests\Unit;

use App\Services\ReportService;
use App\Services\DebugService;
use App\Services\RealTimeProgressTracker;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportServiceTest extends TestCase
{
    private $reportService;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Mock Auth service to return a user
        Auth::shouldReceive('check')
            ->andReturn(true);
            
        Auth::shouldReceive('user->name')
            ->andReturn('Test User');

        $debugService = new DebugService(false);
        $progressTracker = new RealTimeProgressTracker();

        $this->reportService = new ReportService($debugService, $progressTracker);
    }

    public function test_generate_report_data()
    {
        $dateRange = [
            'start' => Carbon::now()->subMonth()->toISOString(),
            'end' => Carbon::now()->toISOString()
        ];
        
        $options = ['include_charts' => true];
        
        $data = $this->reportService->generateReportData($dateRange, $options);
        
        $this->assertArrayHasKey('report_info', $data);
        $this->assertArrayHasKey('executive_summary', $data);
        $this->assertArrayHasKey('membership_stats', $data);
        $this->assertArrayHasKey('financial_status', $data);
        $this->assertArrayHasKey('events_data', $data);
        $this->assertArrayHasKey('news_data', $data);
        $this->assertArrayHasKey('repository_data', $data);
        $this->assertArrayHasKey('messages_data', $data);
        $this->assertArrayHasKey('lodges_data', $data);
        $this->assertArrayHasKey('dignitaries_data', $data);
        $this->assertArrayHasKey('courses_data', $data);
        $this->assertArrayHasKey('activity_data', $data);
        $this->assertArrayHasKey('charts_data', $data);
    }

    public function test_get_report_info()
    {
        $dateRange = [
            'start' => Carbon::now()->subMonth()->toISOString(),
            'end' => Carbon::now()->toISOString()
        ];

        $method = $this->getPrivateMethod('getReportInfo');
        $result = $method->invoke($this->reportService, $dateRange);

        $this->assertArrayHasKey('title', $result);
        $this->assertArrayHasKey('generated_at', $result);
        $this->assertArrayHasKey('generated_by', $result);
        $this->assertArrayHasKey('period_start', $result);
        $this->assertArrayHasKey('period_end', $result);
        $this->assertArrayHasKey('period_description', $result);
    }

    public function test_get_executive_summary()
    {
        $method = $this->getPrivateMethod('getExecutiveSummary');
        $result = $method->invoke($this->reportService);

        $this->assertArrayHasKey('total_lodges', $result);
        $this->assertArrayHasKey('total_members', $result);
        $this->assertArrayHasKey('treasury_balance', $result);
        $this->assertArrayHasKey('upcoming_events', $result);
        $this->assertArrayHasKey('total_documents', $result);
        $this->assertArrayHasKey('unread_messages', $result);
        $this->assertArrayHasKey('active_courses', $result);
    }

    public function test_get_membership_stats()
    {
        $dateRange = [
            'start' => Carbon::now()->subMonth()->toISOString(),
            'end' => Carbon::now()->toISOString()
        ];

        $method = $this->getPrivateMethod('getMembershipStats');
        $result = $method->invoke($this->reportService, $dateRange);

        $this->assertArrayHasKey('degree_distribution', $result);
        $this->assertArrayHasKey('members_by_lodge', $result);
        $this->assertArrayHasKey('membership_growth', $result);
        $this->assertArrayHasKey('total_apprentices', $result);
        $this->assertArrayHasKey('total_companions', $result);
        $this->assertArrayHasKey('total_masters', $result);
    }

    public function test_get_financial_status()
    {
        $dateRange = [
            'start' => Carbon::now()->subMonth()->toISOString(),
            'end' => Carbon::now()->toISOString()
        ];

        $method = $this->getPrivateMethod('getFinancialStatus');
        $result = $method->invoke($this->reportService, $dateRange);

        $this->assertArrayHasKey('summary', $result);
        $this->assertArrayHasKey('recent_movements', $result);
        $this->assertArrayHasKey('income_by_category', $result);
        $this->assertArrayHasKey('expense_by_category', $result);
        $this->assertArrayHasKey('movements_by_lodge', $result);
    }

    public function test_get_events_data()
    {
        $dateRange = [
            'start' => Carbon::now()->subMonth()->toISOString(),
            'end' => Carbon::now()->toISOString()
        ];

        $method = $this->getPrivateMethod('getEventsData');
        $result = $method->invoke($this->reportService, $dateRange);

        $this->assertArrayHasKey('upcoming_events', $result);
        $this->assertArrayHasKey('recent_events', $result);
        $this->assertArrayHasKey('events_by_type', $result);
        $this->assertArrayHasKey('public_vs_private', $result);
        $this->assertArrayHasKey('total_events', $result);
    }

    public function test_get_repository_data()
    {
        $dateRange = [
            'start' => Carbon::now()->subMonth()->toISOString(),
            'end' => Carbon::now()->toISOString()
        ];

        $method = $this->getPrivateMethod('getRepositoryData');
        $result = $method->invoke($this->reportService, $dateRange);

        $this->assertArrayHasKey('total_documents', $result);
        $this->assertArrayHasKey('documents_by_category', $result);
        $this->assertArrayHasKey('documents_by_grade', $result);
        $this->assertArrayHasKey('recent_documents', $result);
        $this->assertArrayHasKey('total_size_mb', $result);
    }

    public function test_get_messages_data()
    {
        $dateRange = [
            'start' => Carbon::now()->subMonth()->toISOString(),
            'end' => Carbon::now()->toISOString()
        ];

        $method = $this->getPrivateMethod('getMessagesData');
        $result = $method->invoke($this->reportService, $dateRange);

        $this->assertArrayHasKey('total_messages', $result);
        $this->assertArrayHasKey('unread_messages', $result);
        $this->assertArrayHasKey('read_messages', $result);
        $this->assertArrayHasKey('archived_messages', $result);
        $this->assertArrayHasKey('monthly_activity', $result);
    }

    public function test_get_lodges_data()
    {
        $method = $this->getPrivateMethod('getLodgesData');
        $result = $method->invoke($this->reportService);

        $this->assertArrayHasKey('lodges', $result);
        $this->assertArrayHasKey('lodges_by_orient', $result);
        $this->assertArrayHasKey('total_lodges', $result);
    }

    public function test_get_dignitaries_data()
    {
        $method = $this->getPrivateMethod('getDignitariesData');
        $result = $method->invoke($this->reportService);

        $this->assertArrayHasKey('dignitaries', $result);
    }

    public function test_get_courses_data()
    {
        $method = $this->getPrivateMethod('getCoursesData');
        $result = $method->invoke($this->reportService);

        $this->assertArrayHasKey('total_courses', $result);
        $this->assertArrayHasKey('courses_by_grade', $result);
        $this->assertArrayHasKey('courses_by_status', $result);
        $this->assertArrayHasKey('courses_by_type', $result);
        $this->assertArrayHasKey('active_courses', $result);
    }

    public function test_get_activity_data()
    {
        $dateRange = [
            'start' => Carbon::now()->subMonth()->toISOString(),
            'end' => Carbon::now()->toISOString()
        ];

        $method = $this->getPrivateMethod('getActivityData');
        $result = $method->invoke($this->reportService, $dateRange);

        $this->assertArrayHasKey('recent_activities', $result);
        $this->assertArrayHasKey('most_active_users', $result);
    }

    private function getPrivateMethod($methodName)
    {
        $class = new \ReflectionClass(ReportService::class);
        $method = $class->getMethod($methodName);
        $method->setAccessible(true);
        return $method;
    }
}