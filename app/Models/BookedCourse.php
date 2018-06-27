<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Routeable;

class BookedCourse extends Model
{
    use Routeable;
    
    protected $fillable = [
        'course_id', 'tutor_id', 'student_id', 'start_date', 'end_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

}
