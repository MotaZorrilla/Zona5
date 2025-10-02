<?php

namespace Tests\Unit;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_course_has_fillable_attributes()
    {
        $course = new Course();
        $fillable = [
            'title',
            'subtitle',
            'description',
            'grade_level',
            'image_url',
            'instructor_name',
            'instructor_role',
            'instructor_image',
            'duration',
            'status',
            'type',
            'link',
        ];

        $this->assertEquals($fillable, $course->getFillable());
    }
}
