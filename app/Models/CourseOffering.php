<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseOffering extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'semester_id',
        'instructor_name',
        'capacity',
        'room',
        'schedule',
        'status',
    ];

    protected $casts = [
        'capacity' => 'integer',
        'status' => 'boolean',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }
}