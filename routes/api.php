<?php


use App\Http\Resources\User\UserResoruce;
use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return new UserResoruce($request->user());
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::resource('/categories', 'CategoryController');
    Route::resource('/courses', 'CourseController');
    Route::resource('categories.courses', 'CategoryCourseController');
});

Route::post('/login', 'Auth\LoginController@login');

Route::post('/register', 'RegisterController@register');



