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


Route::get('/', function () {return view('login');});
//Lecture
Route::get('dashboard', function () {return view('dosen.dashboard');});
Route::get('activity', function () {return view('dosen.activity-table');});
Route::get('activity-details', function () {return view('dosen.activity-details');});
Route::get('activity-add', function () {return view('dosen.activity-add');});
//Admin
Route::get('admin-dashboard', function () {return view('admin.dashboard');});
Route::get('admin-activity-lecture', function () {return view('admin.activity-lecture');});
Route::get('admin-activity-student', function () {return view('admin.activity-student');});
//Student
Route::get('student-dashboard', function () {return view('student.dashboard');});
Route::get('student-activity-details', function () {return view('student.activity-details');});
Route::get('student-activity-add', function () {return view('student.activity-add');});
