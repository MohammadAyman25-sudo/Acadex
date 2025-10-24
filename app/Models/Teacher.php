<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'department_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_teacher')
                    ->using(CourseTeacher::class)
                    ->withPivot(['role', 'semester'])
                    ->withTimestamps();
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function getNameAttribute() {
        return $this->user->name ?? "Teacher ({$this->id})";
    }
}
