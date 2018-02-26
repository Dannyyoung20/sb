<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'locations';
    
    protected $fillable = [
        'lat',
        'long',
        'state_id'
    ];

    /**
     * One to One relationship between User.
     *
     * @return Model
     */

    public function user()
    {
        return $this->hasOne('App\User');
    }
    
}
