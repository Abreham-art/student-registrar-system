<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'head_name',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
public function programs()
{
    return $this->hasMany(Program::class);
}
public function courses()
{
    return $this->hasMany(Course::class);
}
public function students()
{
    return $this->hasMany(Student::class);
}
}