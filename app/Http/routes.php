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
Route::group(['middleware' => 'tamu'], function(){
  Route::get('/', [
    'uses' => 'UserController@getLogin',
    'as' => 'login'
  ]);

  Route::post('login', [
    'uses' => 'UserController@postLogin',
    'as' => 'login'
  ]);
});

  //Lecture
Route::group(['middleware' => 'lecture'], function(){
  Route::get('dashboard', ['uses'=>'PaperController@getPaper', 'as'=>'dashboard']);
  Route::get('get-paper', ['uses'=>'PaperController@insertAllPaper', 'as'=>'get-paper']);
  Route::get('activity', ['uses'=>'LectureController@getActivity', 'as'=>'activity']);
  Route::get('activity-details', function () {return view('dosen.activity-details');});
  Route::get('activity-add', function () {return view('dosen.activity-add');});
  Route::get('activity-details/{id}', 'LectureController@getDetail');
  Route::get('activity-details/delete/{id}', 'LectureController@deleteDetail');

  //Admin
  Route::get('admin-dashboard', function () {return view('admin.dashboard');});
  Route::get('admin-activity-lecture', function () {return view('admin.activity-lecture');});
  Route::get('admin-activity-student', function () {return view('admin.activity-student');});
  Route::post('insertData', [
    'uses' => 'LectureController@insertActivity',
    'as' => 'insertData'
  ]);
  Route::get('signout', [
    'uses' => 'UserController@logout',
    'as' => 'signout'
  ]);
});

//Student
Route::group(['middleware' => 'student'], function(){
  Route::get('student-dashboard', 'StudentController@getData');
  Route::get('student-activity-details/{id}', 'StudentController@getDetail');
  Route::get('student-activity-details/delete/{id}', 'StudentController@deleteDetail');
  Route::get('student-activity-add', function () {return view('student.activity-add');});
  Route::get('logout', [
    'uses' => 'UserController@logout',
    'as' => 'logout'
  ]);
  Route::post('insertActivity', [
    'uses' => 'StudentController@insertData',
    'as' => 'insertActivity'
  ]);

});
