<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title', 'description', 'image', 'category_id'
    ];


    /**
     * One to Many relationship between Category.
     *
     * @return Model
     */

    public function categories() 
    {
        return $this->belongsTo('App\Category');
    }

      /**
     * One to Many relationship between User.
     *
     * @return Model
     */

    public function user() 
    {
        return $this->belongsToMany('App\User');
    }
    
     /**
     * One to Many relationship between Tutor.
     *
     * @return Model
     */

    public function tutor() 
    {
        return $this->belongsTo('App\Tutor');
    } 

}
