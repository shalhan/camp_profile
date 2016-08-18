<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Storage;
use App\Lecture;
use App\File;
use App\Student;
use App\Activity;
use App\Category;
use App\Cakupan;
use Validator;
use Image;

use App\Http\Requests;

class ActivityController extends Controller
{
  public function getAddActivity(){
      $viewCat = Category::get();
      $viewCak = Cakupan::get();

      if(Session::has('lectureId')){
        return view('dosen.activity-add', compact(['viewCat', 'viewCak']));
      }else{
        return view('student.activity-add', compact(['viewCat', 'viewCak']));
      }
  }

  public function insertActivity(Request $request){
    $user = array(
      'activity' => $request -> input('activity'),
      'category' => $request -> input('category'),
      'cakupan' => $request -> input('cakupan'),
      'description' => $request -> input('description'),

    );

    $validator = Validator::make($user, [
         'activity' => 'required|max:50',
         'category' => 'required',
         'cakupan' => 'required',
         'description' => 'max:180',
     ]);

     if(Session::has('lectureId')){
       $path = 'activity-add';
       $path2 = 'activity';
       $_id = Session::get('lectureId');
       $group = 1;
     }else{
       $path = 'student-activity-add';
       $path2 = 'student-dashboard';
       $_id = Session::get('studentNim');
       $group = 0;
     }

     if($validator->fails()){
       return redirect($path)
                       ->withErrors($validator)
                       ->withInput();
     }else{
       $activity = $request -> input('activity');
       $category = $request -> input('category');
       $cakupan = $request -> input('cakupan');
       $daterange = $request -> input('daterange');
       $fund = $request -> input('fund');
       $achievement = $request -> input('achievement');
       $description = $request -> input('description');

       $date = explode(" ", $daterange);
       $start = $date[0];
       $end = $date[2];

       $table = new Activity();

       $table->nama_kegiatan = $activity;
       $table->category = $category;
       $table->cakupan = $cakupan;
       $table->tgl_mulai = $start;
       $table->tgl_selesai = $end;
       $table->sumber_dana = $fund;
       $table->pencapaian = $achievement;
       $table->deskripsi = $description;
       $table->id_people = $_id;
       $table->group = $group;


       $table->save();
     }
      return redirect($path2);
  }

  public function getActivity(){
    if(Session::has('studentNim')){
      $view = Activity::where('id_people',Session::get('studentNim'))->orderBy('id_activities', 'desc')->get();
      return view('student.dashboard', compact('view'));
    }else if(Session::has('lectureId')){
      $view = Activity::where('id_people',Session::get('lectureId'))->orderBy('id_activities', 'desc')->get();
      return view('dosen.activity-table', compact('view'));
    }
  }

  public function getDetail($id){
      if(Session::has('lectureId')){
        $view = Activity::join('category',
        'activities.category','=','category.id_category')
        ->join('cakupan', 'activities.cakupan','=','cakupan.id_cakupan')
        ->where([
          'id_activities' => $id,
          ])->first();
        $file = File::where('id_activities', $id)->get();


        return view('dosen.activity-details', compact(['view', 'file']));
      }else{
        $view = Activity::join('category',
        'activities.category','=','category.id_category')
        ->join('cakupan', 'activities.cakupan','=','cakupan.id_cakupan')
        ->where([
          'id_people' => Session::get('studentNim'),
          'id_activities' => $id,
          ])->first();
        $file = File::where('id_activities', $id)->get();
        return view('student.activity-details', compact(['view', 'file']));

      }
  }

  public function deleteDetail($id){
    $view = Activity::join('files', 'activities.id_activities', '=', 'files.id_activities')->get();

    if(Session::has('lectureId')){
      $people = Session::get('lectureId');
      $redirect = 'activity';
    }else{
      $people = Session::get('studentNim');
      $redirect = 'student-dashboard';
    }

    foreach($view as $row){
      unlink(storage_path() . '/app/uploads/' . $people . '/' . $row->path);
    }
    // unlink(storage_path() . '/app/uploads/' . $people . '/' . $file->path);
    $data = Activity::where('id_activities',$id)->delete();
    //
    return redirect($redirect);
  }

  public function insertFile(Request $request, $id){
    if(Session::has('lectureId')){
      $people = Session::get('lectureId');
    }else{
      $people = Session::get('studentNim');
    }

    $file = $request -> file('fileActivities');

    if(!empty($file)){
      $path = '/uploads' . '/' . $people . '/' . date("Ymd");
      if(!file_exists($path)){
          $dir = Storage::makeDirectory($path, 0777, true);
      }
      foreach($file as $files){
        $table2 = new File();
        $filename = date("Ymd") . rand(0,100) . '.' . $files->getClientOriginalExtension();
        $files->move(storage_path() . '/app/uploads' . '/' . $people . '/' .
          date("Ymd"), $filename);
        $table2->path = date("Ymd") . '/' . $filename;
        $table2->file = $filename;
        $table2->ext = $files->getClientOriginalExtension();
        $table2->id_activities = $id;

        $table2->save();
      }
    }

    if(Session::has('lectureId')){
      return redirect('lec-activity-details/' . $id);
    }else{
      return redirect('student-activity-details/' . $id);
    }
  }

  public function deleteFile($id){
    $file = File::where('id_files', $id);

    if(Session::has('lectureId')){
      $people = Session::get('lectureId');
    }else{
      $people = Session::get('studentNim');
    }

    unlink(storage_path() . '/app/uploads/' . $people . '/' . $file->first()->path);
    $file->delete();

    return redirect()->back();
  }

  public function downloadFile($id){
    if(Session::has('lectureId')){
      $people = Session::get('lectureId');
    }else{
      $people = Session::get('studentNim');
    }

    $file = File::where('id_files', $id)->first();

    return response()->download(storage_path() . '/app/uploads/' . $people . '/' . $file->path);
  }
}
