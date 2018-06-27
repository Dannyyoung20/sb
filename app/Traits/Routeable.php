<?php

namespace App\Traits;

trait Routeable
{

    public function getRouteKeyName()
    {
        return 'slug';
    }
}