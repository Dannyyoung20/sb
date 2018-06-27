<?php

namespace App\Models;

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
       return $this->hasMany(User::class);
    }
}
