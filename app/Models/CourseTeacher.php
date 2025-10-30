<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $course_id
 * @property string $teacher_id
 * @property string $role
 * @property string|null $semester
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\Teacher $teacher
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher whereSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseTeacher whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CourseTeacher extends Pivot
{

    protected $table = 'course_teacher';

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
