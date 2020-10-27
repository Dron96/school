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
Route::prefix('/users/{user}')->group(function () {
    Route::post('/add-to-pupil', 'App\Http\Controllers\UserController@setRoleAsPupil');
    Route::post('/add-to-worker', 'App\Http\Controllers\UserController@setRoleAsWorker');
    Route::get('/', 'App\Http\Controllers\UserController@show');
    Route::delete('/', 'App\Http\Controllers\UserController@destroy');
    Route::put('/', 'App\Http\Controllers\UserController@update');
});

Route::prefix('/subjects')->group(function () {
    Route::post('/', 'App\Http\Controllers\SubjectController@store');
    Route::get('/', 'App\Http\Controllers\SubjectController@index');
    Route::get('/{subject}', 'App\Http\Controllers\SubjectController@show');
    Route::put('/{subject}', 'App\Http\Controllers\SubjectController@update');
    Route::delete('/{subject}', 'App\Http\Controllers\SubjectController@destroy');
});

Route::prefix('/schedules')->group(function () {
    Route::post('/', 'App\Http\Controllers\ScheduleController@addSubjectToSchedule');
    Route::get('/', 'App\Http\Controllers\ScheduleController@index');
    Route::get('/{schedule}', 'App\Http\Controllers\ScheduleController@show');
    Route::delete('/{schedule}', 'App\Http\Controllers\ScheduleController@destroy');
    Route::put('/{schedule}', 'App\Http\Controllers\ScheduleController@update');
});
