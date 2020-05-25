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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
//     Route::post('/logout','AuthController@logout');
// });



Route::group(['middleware' => ['auth:api']], function () {

    Route::get('/user', function (Request $request) { return $request->user(); });
    Route::post('/logout','API\AuthController@logout');

});

Route::post('/login','API\AuthController@login');
Route::post('/register','API\AuthController@register');

// In Middleware
Route::post('/set-student/{id}', 'API\ProfileController@set_student');
Route::post('/set-teacher/{id}', 'API\ProfileController@set_teacher');

Route::get('/get-exam', 'API\ExamController@get_exam');
Route::post('/set-exam', 'API\ExamController@set_exam');
Route::post('/update-exam/{id}', 'API\ExamController@update_exam');
Route::post('/delete-exam/{id}', 'API\ExamController@delete_exam');


