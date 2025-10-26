<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'description',
        'credits',
        'is_active',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'course_teacher')
                    ->using(CourseTeacher::class)
                    ->withPivot(['role', 'semester'])
                    ->withTimestamps();
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments')
                    ->using(Enrollment::class)
                    ->withPivot(['grade', 'status'])
                    ->withTimestamps();
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
