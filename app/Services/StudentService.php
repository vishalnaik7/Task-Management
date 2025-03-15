<?php 

namespace App\Services;

use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Import Str for random string generation
use Illuminate\Support\Facades\Hash; // Import Hash for password hashing

class StudentService
{
    public function registerStudent($data)
    {
        // Handle image upload
        $imagePath = $data['image']->store('images', 'public');

        // Generate a random password
        $randomPassword = Str::random(10); // Generate a random 10-character string

        // Create the student record
        $student = Student::create([
            'name' => $data['name'],
            'education' => $randomPassword,  // Store plain password for reference (optional)
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'address' => $data['address'],
            'dob' => $data['dob'],
            'image' => $imagePath,
            'password' => Hash::make($randomPassword), // Hash the random password
        ]);

        // Optional: Send plain password to student (e.g., via email)

        return $student;
    }
}
