<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'phone'
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
     * One to Many relationship between BookedCourse.
     *
     * @return Model
     */

    public function courses() 
    {
        return $this->hasMany('App\BookedCourse');
    }

    /**
     * One to One relationship between Location.
     *
     * @return Model
     */

    public function location()
    {
        return $this->hasOne('App\Location');
    }
}
