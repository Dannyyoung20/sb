<?php


use App\Http\Resources\User\UserResoruce;
use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return new UserResoruce($request->user());
});
Route::post('/register', 'RegisterController@register');


// Route::group(['middleware' => 'auth:api'], function (){
//     Route::get('/user', 'UserController@getUser');
// });

