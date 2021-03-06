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
  Route::get('activity', ['uses'=>'ActivityController@getActivity', 'as'=>'activity']);
  Route::get('activity-add', 'ActivityController@getAddActivity');
  Route::get('lec-activity-details/{id}', 'ActivityController@getDetail');
  Route::post('activity-details/upload/{id}', 'ActivityController@insertFile');
  Route::post('activity-export', ['uses'=>'ActivityController@exportActivity', 'as'=>'activity-export']);
  Route::get('activity-details/delete/{id}', 'ActivityController@deleteDetail');
  Route::get('activity-details/delete-file/{id}', 'ActivityController@deleteFile');
  Route::get('activity-details/download/{id}', 'ActivityController@downloadFile');
  Route::post('insertData', [
    'uses' => 'ActivityController@insertActivity',
    'as' => 'insertData'
  ]);
  Route::get('endsession', [
    'uses' => 'UserController@logout',
    'as' => 'endsession'
  ]);

  Route::get('lecture-download-all-file/{id}', 'ActivityController@downloadAllFile');
  Route::get('lecture-compress-all-file/{id}', 'ActivityController@compressFile');

});

Route::group(['middleware' => 'admin'], function(){
  //Admin
  Route::get('admin-dashboard', ['uses'=>'AdminController@getAdmin', 'as'=>'admin-dashboard']);
  Route::get('paper', ['uses'=>'PaperController@getPaperSummary', 'as'=>'paper']);
  Route::get('activity-lecture', ['uses'=>'AdminController@getLecture', 'as'=>'activity-lecture']);
  Route::get('activity-details/{id}', ['uses'=>'AdminController@getDetail', 'as'=>'activity-details']);
  Route::get('activity-student', ['uses'=>'AdminController@getStudent', 'as'=>'activity-student']);
  Route::get('get-paper', ['uses'=>'PaperController@insertAllPaper', 'as'=>'get-paper']);
  Route::get('setting', ['uses'=>'AdminController@getSetting', 'as'=>'setting']);
  Route::post('setting/update-category/{id}', ['uses'=>'AdminController@updateCategory', 'as'=>'update-category']);
  Route::get('setting/delete-category/{id}', ['uses'=>'AdminController@deleteCategory', 'as'=>'delete-category']);
  Route::get('setting/delete-cakupan/{id}', ['uses'=>'AdminController@deleteCakupan', 'as'=>'delete-cakupan']);
  Route::post('add-category', ['uses'=>'AdminController@addCategory', 'as'=>'add-category']);
  Route::post('add-cakupan', ['uses'=>'AdminController@addCakupan', 'as'=>'add-cakupan']);
  Route::get('signout', [
    'uses' => 'UserController@logout',
    'as' => 'signout'
  ]);
  Route::get('export-paper', ['uses'=>'PaperController@exportPaper', 'as'=>'export-paper']);
  Route::get('export-paper-summary', ['uses'=>'PaperController@exportPaperSummary', 'as'=>'export-paper-summary']);
  Route::post('export-all-student-activity', ['uses'=>'AdminController@exportStudentActivity', 'as'=>'export-all-student-activity']);
  Route::post('export-all-lecture-activity', ['uses'=>'AdminController@exportLectureActivity', 'as'=>'export-all-lecture-activity']);

});

//Student
Route::group(['middleware' => 'student'], function(){
  Route::get('student-dashboard', ['uses'=>'ActivityController@getActivity', 'as'=>'student-dashboard']);
  Route::get('student-activity-details/{id}', 'ActivityController@getDetail');
  Route::post('student-activity-details/upload/{id}', 'ActivityController@insertFile');
  Route::get('student-activity-details/delete/{id}', 'ActivityController@deleteDetail');
  Route::get('student-activity-details/delete-file/{id}', 'ActivityController@deleteFile');
  Route::get('student-activity-details/download/{id}', 'ActivityController@downloadFile');
  Route::get('student-activity-add', 'ActivityController@getAddActivity');
  Route::post('student-activity-export', ['uses'=>'ActivityController@exportActivity', 'as'=>'student-activity-export']);
  Route::get('student-download-all-file/{id}', 'ActivityController@downloadAllFile');
  Route::get('student-compress-all-file/{id}', 'ActivityController@compressFile');
  Route::get('logout', [
    'uses' => 'UserController@logout',
    'as' => 'logout'
  ]);
  Route::post('insertActivity', [
    'uses' => 'ActivityController@insertActivity',
    'as' => 'insertActivity'
  ]);

});
