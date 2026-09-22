<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'lastname',
        'firstname',
        'province',
        'country',
        'school',
        'program',
        'year',
        'birthday',
        'profile_image'
    ];
}