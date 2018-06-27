<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Orderable;
use App\Traits\Routeable;

class Course extends Model
{
    use Orderable, Routeable;

    protected $fillable = [
        'title', 'description', 'image', 'category_id', 'tutor_id'
    ];


    /**
     * One to Many relationship between Category.
     *
     * @return Model
     */

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

      /**
     * One to Many relationship between User.
     *
     * @return Model
     */

    public function user() 
    {
        return $this->belongsToMany(User::class);
    }
    
     /**
     * One to Many relationship between Tutor.
     *
     * @return Model
     */

    public function tutor() 
    {
        return $this->belongsTo(Tutor::class);
    }

}
