<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title', 'image'
    ];


    /**
     * One to Many relationship between Course.
     *
     * @return Model
     */

    public function courses() 
    {
        return $this->hasMany(Course::class);
    }


}
