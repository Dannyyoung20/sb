<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['role'];

    /**
     * One to One Relationship between Role
     * 
     * @return App\Role
     */

    public function user()
    {
       return $this->hasMany('App\User');
    }
}
