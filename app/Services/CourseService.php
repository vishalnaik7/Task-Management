<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Validation\ValidationException;

class CourseService
{
    public function createCourse(array $data)
    {
        // Validate course data
        $validator = validator()->make($data, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructor' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Create the course
        return Course::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'instructor' => $data['instructor'],
        ]);
    }
}
