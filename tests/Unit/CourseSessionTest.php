<?php

namespace Tests\Unit;

use App\Models\CourseSession;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_course_session()
    {
        $course = Course::factory()->create();

        $courseSession = CourseSession::create([
            'course_id' => $course->id,
            'title' => 'Test Session',
            'description' => 'Test session description',
            'start_time' => now()->addHour(),
            'end_time' => now()->addHours(2),
            'location' => 'Test Location',
            'type' => 'synchronous',
            'instructor_name' => 'Test Instructor',
            'instructor_role' => 'Lead Instructor',
            'status' => 'upcoming',
            'link' => 'https://example.com/session',
        ]);

        $this->assertDatabaseHas('course_sessions', [
            'course_id' => $course->id,
            'title' => 'Test Session',
            'status' => 'upcoming',
        ]);
    }

    public function test_course_session_belongs_to_course()
    {
        $course = Course::factory()->create();
        $courseSession = CourseSession::factory()->create(['course_id' => $course->id]);

        $this->assertInstanceOf(Course::class, $courseSession->course);
        $this->assertEquals($course->id, $courseSession->course->id);
    }

    public function test_course_session_attributes_casting()
    {
        $course = Course::factory()->create();

        $courseSession = CourseSession::create([
            'course_id' => $course->id,
            'title' => 'Test Session',
            'start_time' => '2023-01-01 10:00:00',
            'end_time' => '2023-01-01 11:00:00',
            'type' => 'asynchronous',
            'status' => 'live',
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $courseSession->start_time);
        $this->assertInstanceOf(\Carbon\Carbon::class, $courseSession->end_time);
        $this->assertEquals('asynchronous', $courseSession->type);
        $this->assertEquals('live', $courseSession->status);
    }
}