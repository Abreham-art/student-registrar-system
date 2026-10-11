<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'code',
        'name',
        'credit_hours',
        'course_type',
        'description',
        'status',
    ];

    protected $casts = [
        'credit_hours' => 'integer',
        'status' => 'boolean',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
public function courseOfferings()
{
    return $this->hasMany(CourseOffering::class);
}
}