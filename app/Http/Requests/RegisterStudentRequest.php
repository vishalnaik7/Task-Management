<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStudentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'mobile' => 'required|string|size:10|unique:students',
            'email' => 'required|string|email|max:255|unique:students',
            'address' => 'required|string',
            'dob' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function authorize()
    {
        return true; // Change this based on your authorization logic
    }
}
