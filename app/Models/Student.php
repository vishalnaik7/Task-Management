<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Model implements AuthenticatableContract
{
    use Authenticatable, Notifiable;

    protected $fillable = [
        'name', 'education', 'mobile', 'email', 'address', 'dob', 'image', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student');
    }
}
// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Student extends Model
// {
//     use HasFactory;
//     protected $fillable = [
//         'name',
//         'education',
//         'mobile',
//         'email',
//         'password',
//         'address',
//         'dob',
//         'image',
//     ];
// }
