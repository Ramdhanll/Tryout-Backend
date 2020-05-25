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

Route::POST('/register-admin', 'API\AuthController@register_admin');
Route::POST('/register-teacher', 'API\AuthController@register_teacher');
Route::POST('/register-student', 'API\AuthController@register_student');
