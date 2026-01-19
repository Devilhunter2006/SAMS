<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];

    // Many-to-Many with Student
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subject');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
}
