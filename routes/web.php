<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resources([
    'dashboard' => 'DashboardController',
    'student'   => 'StudentController',
    'teacher'   => 'TeacherController',
    'exam'      => 'ExamController',
    'question'      => 'QuestionController',
    
]);

Route::get('/exam/question/{id}', 'ExamController@showQuestion')->name('exam.question');
Route::get('/exam/question/{id}/edit', 'ExamController@showQuestionEdit')->name('exam.question.edit');
Route::put('/exam/question/{id}/edit', 'ExamController@questionUpdate')->name('exam.question.update');
Route::get('/exam/question/option/{id}', 'ExamController@showOption')->name('exam.question.option');
