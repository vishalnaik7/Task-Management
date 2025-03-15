<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust as needed for authorization
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:2',
            'description' => 'required|string',
            'instructor' => 'required|string|max:255',
        ];
    }
}
