<?php

namespace Tests\Unit;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_activity_log()
    {
        $user = User::factory()->create();

        $activityLog = ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'test_action',
            'description' => 'Test activity description',
            'subject_type' => User::class,
            'subject_id' => $user->id,
        ]);

        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'action' => 'test_action',
            'description' => 'Test activity description',
        ]);
    }

    public function test_activity_log_belongs_to_user()
    {
        $user = User::factory()->create();

        $activityLog = ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'test_action',
            'description' => 'Test activity description',
            'subject_type' => User::class,
            'subject_id' => $user->id,
        ]);

        $this->assertInstanceOf(User::class, $activityLog->user);
        $this->assertEquals($user->id, $activityLog->user->id);
    }

    public function test_activity_log_has_morph_to_subject()
    {
        $user = User::factory()->create();

        $activityLog = ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'test_action',
            'description' => 'Test activity description',
            'subject_type' => User::class,
            'subject_id' => $user->id,
        ]);

        $this->assertInstanceOf(User::class, $activityLog->subject);
        $this->assertEquals($user->id, $activityLog->subject->id);
    }
}