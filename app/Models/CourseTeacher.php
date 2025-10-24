<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourseTeacher extends Pivot
{
    protected $fillable = [
        'course_id',
        'teacher_id',
        'role',
        'semester',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
