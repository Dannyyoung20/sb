<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'phone','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


     /**
     * One to Many relationship between Wishlist.
     *
     * @return Model
     */
    public function wishlists() 
    {
        return $this->hasMany('App\Wishlist');
    }


     /**
     * One to Many relationship between BookedCourses.
     *
     * @return Model
     */
    public function bookedcourses() 
    {
        return $this->hasMany('App\BookedCourse');
    }
    

    /**
     * One to Many relationship between Courses.
     *
     * @return Model
     */
    public function courses() 
    {
        return $this->belongsToMany('App\Course');
    }

}
