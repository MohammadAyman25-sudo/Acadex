<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseSession extends Model
{
    use HasFactory;
    
    protected $table = 'course_sessions';

    protected $fillable = [
        'course_id',
        'teacher_id',
        'date',
        'start_time',
        'end_time',
        'topic',
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
