<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    public $perPage = 15;
    public $with = [];
    public $table = 'courses';

    protected $fillable = [
        'name'
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function usersRegistered()
    {
        return $this->hasMany(Registration::class)
            ->count();
    }
}
