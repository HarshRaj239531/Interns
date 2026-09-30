<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'degree',
        'college',
        'institution_name',
        'coordinator_name',
        'designation',
        'city',
        'student_count',
        'message',
        'status',
    ];
}
