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

Route::prefix('/users')->group(function () {
    Route::get('/', 'App\Http\Controllers\UserController@index');
    Route::get('/workers', 'App\Http\Controllers\UserController@getAllWorker');
    Route::get('/pupils', 'App\Http\Controllers\UserController@getAllPupils');
    Route::get('/class', 'App\Http\Controllers\UserController@getPupilsFromClass');
    Route::post('/add-to-pupil', 'App\Http\Controllers\UserController@setRoleAsPupil');
    Route::post('/add-to-worker', 'App\Http\Controllers\UserController@setRoleAsWorker');
    Route::prefix('/{user}')->group(function () {
        Route::get('/', 'App\Http\Controllers\UserController@show');
        Route::delete('/', 'App\Http\Controllers\UserController@destroy');
        Route::put('/', 'App\Http\Controllers\UserController@update');
    });
});

Route::put('workers/{worker}', 'App\Http\Controllers\UserController@dismissWorker');
Route::get('workers/{worker}/schedule', 'App\Http\Controllers\UserController@getWorkerSchedule');
Route::get('workers/{worker}/marks', 'App\Http\Controllers\MarkController@getTeacherMarks');
Route::put('pupils/{pupil}', 'App\Http\Controllers\UserController@changeClassForPupil');
Route::get('pupils/{pupil}/marks', 'App\Http\Controllers\MarkController@getPupilMarks');
Route::get('class/schedule', 'App\Http\Controllers\ScheduleController@getClassSchedule');

Route::prefix('/subjects')->group(function () {
    Route::post('/', 'App\Http\Controllers\SubjectController@store');
    Route::get('/', 'App\Http\Controllers\SubjectController@index');
    Route::get('/{subject}', 'App\Http\Controllers\SubjectController@show');
    Route::put('/{subject}', 'App\Http\Controllers\SubjectController@update');
    Route::delete('/{subject}', 'App\Http\Controllers\SubjectController@destroy');
    Route::get('/{subject}/marks', 'App\Http\Controllers\MarkController@getSubjectMarks');
});

Route::prefix('/schedules')->group(function () {
    Route::post('/', 'App\Http\Controllers\ScheduleController@addSubjectToSchedule');
    Route::get('/', 'App\Http\Controllers\ScheduleController@index');
    Route::get('/{schedule}', 'App\Http\Controllers\ScheduleController@show');
    Route::delete('/{schedule}', 'App\Http\Controllers\ScheduleController@destroy');
    Route::put('/{schedule}', 'App\Http\Controllers\ScheduleController@update');
});

Route::prefix('/marks')->group(function () {
    Route::post('/', 'App\Http\Controllers\MarkController@store');
    Route::get('/', 'App\Http\Controllers\MarkController@index');
    Route::get('/class', 'App\Http\Controllers\MarkController@getClassMarks');
    Route::get('/{mark}', 'App\Http\Controllers\MarkController@show');
    Route::delete('/{mark}', 'App\Http\Controllers\MarkController@destroy');
    Route::put('/{mark}', 'App\Http\Controllers\MarkController@update');
});
