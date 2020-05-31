<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use SoftDeletes;

    public $perPage = 15;
    public $with = ['course', 'student'];
    public $table = 'registrations';

    protected $casts = [
        'student_id' => 'int',
        'course_id' => 'int'
    ];

    protected $dates = [
        'registration_date'
    ];

    protected $fillable = [
        'registration_date',
        'status',
        'student_id',
        'course_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
