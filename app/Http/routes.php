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
  Route::post('insertData', [
    'uses' => 'LectureController@insertActivity',
    'as' => 'insertData'
  ]);
  Route::get('endsession', [
    'uses' => 'UserController@logout',
    'as' => 'endsession'
  ]);
});

Route::group(['middleware' => 'admin'], function(){
  //Admin
  Route::get('admin-dashboard', ['uses'=>'AdminController@getAdmin', 'as'=>'admin-dashboard']);
  Route::get('activity-lecture', ['uses'=>'AdminController@getLecture', 'as'=>'activity-lecture']);
  Route::get('activity-details', ['uses'=>'AdminController@getDetail', 'as'=>'activity-details']);
  Route::get('activity-student', ['uses'=>'AdminController@getStudent', 'as'=>'activity-student']);
  Route::get('get-paper', ['uses'=>'PaperController@insertAllPaper', 'as'=>'get-paper']);
  Route::get('signout', [
    'uses' => 'UserController@logout',
    'as' => 'signout'
  ]);
});

//Student
Route::group(['middleware' => 'student'], function(){
  Route::get('student-dashboard', 'StudentController@getData');
  Route::get('student-activity-details/{id}', 'StudentController@getDetail');
  Route::post('student-activity-details/upload/{id}', 'StudentController@insertImg');
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
