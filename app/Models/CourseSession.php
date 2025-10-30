<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $course_id
 * @property string $teacher_id
 * @property string $date
 * @property string $start_time
 * @property string $end_time
 * @property string|null $topic
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\Teacher $teacher
 * @method static \Database\Factories\CourseSessionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseSession query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseSession whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseSession whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseSession whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseSession whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseSession whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseSession whereTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CourseSession whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
