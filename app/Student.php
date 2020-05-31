<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    public $perPage = 15;
    public $with = [];
    public $table = 'students';

    protected $dates = [
        'born_date'
    ];

    protected $fillable = [
        'name',
        'cpf',
        'born_date',
        'email',
        'telephone'
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
