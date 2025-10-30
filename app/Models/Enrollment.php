<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property-read \App\Models\Course|null $course
 * @property-read \App\Models\Student|null $student
 * @method static \Database\Factories\EnrollmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Enrollment query()
 * @mixin \Eloquent
 */
class Enrollment extends Pivot
{

    use HasFactory;

    protected $table = 'enrollments';
    
    protected $fillable = [
        'student_id',
        'course_id',
        'grade',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
