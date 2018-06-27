<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Routeable;

class Tutor extends Model
{
    use Routeable;

    protected $fillable = [
        'firstname', 
        'lastname',
        'email', 
        'password', 
        'bio',
        'image', 
        'phone', 
        'location_id', 
        'course_id', 
        'remember_token'
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
        return $this->hasMany(Wishlist::class);
    }

    /**
     * One to Many relationship between BookedCourse.
     *
     * @return Model
     */

    public function courses() 
    {
        return $this->hasMany(BookedCourse::class);
    }

    /**
     * One to One relationship between Location.
     *
     * @return Model
     */

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
