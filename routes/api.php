<?php

use App\Http\Resources\User\UserResoruce;
use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return new UserResoruce($request->user());
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::resource('/categories', 'CategoryController');
    Route::resource('categories.courses', 'CategoryCourseController');
    Route::resource('/courses', 'CourseController');
    Route::post('/course/booked', 'CourseController@bookCourse');
});

// User Auth Route
Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'AuthController@register');

// Tutor Auth Route
Route::post('/login/tutor', 'TutorAuthController@login');
Route::post('/register/tutor', 'TutorAuthController@register');

