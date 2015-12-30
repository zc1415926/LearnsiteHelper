<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index/index');
});

Route::get('principle', [
    'uses' => 'PrincipleController@index'
]);

Route::get('students_gradeclass/{grade}/{class}', [
    'uses' => 'StudentsController@students_gradeclass'
]);

Route::put('sync_students', [
    'uses' => 'StudentsController@sync_students'
]);

Route::get('students_sync', function () {
    return view('admin/students_sync');
});