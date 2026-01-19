<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'roll_no',
        'name',
    ];

    public $timestamps = false;

    // Many-to-Many with Subject
  public function subjects()
{
    return $this->belongsToMany(Subject::class, 'student_subject');
}

}
