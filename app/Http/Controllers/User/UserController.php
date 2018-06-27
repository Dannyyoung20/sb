<?php

namespace App\Http\Controllers\User;

use App\Http\Resources\User\UserResoruce;
use Illuminate\Http\Request;
use App\Category;

class UserController extends Controller
{
    public function getUser(Request $request) 
    {
        return new UserResource($request->user());
    }

}
