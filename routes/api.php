<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'App\Http\Controllers\UserController@register');
Route::get('users', 'App\Http\Controllers\UserController@index');
Route::post('/users/{user}/add-to-pupil', 'App\Http\Controllers\UserController@setRoleAsPupil');
Route::post('/users/{user}/add-to-worker', 'App\Http\Controllers\UserController@setRoleAsWorker');
Route::get('/users/{user}', 'App\Http\Controllers\UserController@show');

Route::post('/subjects', 'App\Http\Controllers\SubjectController@store');
Route::post('/schedules', 'App\Http\Controllers\ScheduleController@addSubjectToSchedule');
