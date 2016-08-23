<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Category;
use App\Cakupan;
use App\Paper;
use App\File;
use DB;
use Excel;
use Session;
use App\Http\Requests;

class AdminController extends Controller
{
    public function getAdmin(){
      $view = Paper::join(
        'lectures',
        'lectures.url', '=',
        'papers.id_dosen'
      )->distinct()->get();

      return view('admin.dashboard', compact('view'));
    }

    public function getStudent(){
      $view = Activity::where('group', 0)->get();
      $view = Activity::join(
        'students',
        'students.nim', '=',
        'activities.id_people'
      )->get();

      return view('admin.activity-student', compact('view'));
    }

    public function getLecture(){
      $view = Activity::join(
        'lectures',
        'lectures.username', '=',
        'activities.id_people'
      )->get();
      return view('admin.activity-lecture', compact('view'));
    }

    public function getDetail($id){
      $view = Activity::join('category',
      'activities.category','=','category.id_category')
      ->join('cakupan', 'activities.cakupan','=','cakupan.id_cakupan')
      ->where([
        'id_activities' => $id,
        ])->first();

      $file = File::where('id_activities', $id)->get();
      return view('admin.activity-details', compact(['view', 'file']));
    }

    public function getSetting(){
      $view = Category::get();
      $view2 = Cakupan::get();
      $count= Category::get()->count();
      $count2 = Cakupan::get()->count();

      return view('admin.setting', compact(['view', 'view2', 'count', 'count2']));
    }

    public function updateCategory(Request $request, $id){
      $view = Category::where('id_category', $id)->update(['nama_cat' => $request->category]);
      return redirect('setting');
    }

    public function addCategory(Request $request){
      $view = Category::insert(
        ['nama_cat' => $request->input('newcategory')]
      );

      return redirect('setting');
    }

    public function addCakupan(Request $request){
      $view = Cakupan::insert(
        ['nama' => $request->input('newcakupan')]
      );

      return redirect('setting');
    }

    public function deleteCategory($id){
      $view = Category::where('id_category',$id)->delete();

      return redirect('setting');
    }

    public function deleteCakupan($id){
      $view = Cakupan::where('id_cakupan',$id)->delete();

      return redirect('setting');
    }

    public function exportStudentActivity(){
      $data = Activity::join('category',
      'activities.category','=','category.id_category')
      ->join('cakupan', 'activities.cakupan','=','cakupan.id_cakupan')
      ->join('students', 'students.nim', '=', 'activities.id_people')
      ->select(['nama_kegiatan', 'cakupan.nama', 'nama_cat', 'tgl_mulai', 'tgl_selesai', 'sumber_dana', 'pencapaian', 'deskripsi'])
      ->where('group', 0)
      ->get();
      $date = Date('Ymd');

      // echo "halo";
      if($data->count() == 0){
        Session::flash('empty_table', 'Anda tidak memiliki data yang bisa di export');
      }else{
      Excel::create('student_activity_' . $date, function($excel) use($data){
      //     // Our first sheet
        $excel->sheet('First sheet', function($sheet) use($data) {
          $sheet->fromArray($data);
          $sheet->row(1, array(
            'Nama Kegiatan', 'Cakupan', 'Kategori', 'Mulai', 'Berakhir', 'Sumber Dana', 'Pencapaian', 'Deskripsi'
          ));
        });
      })->export('xls');
      }
      return redirect()->back();
    }

    public function exportLectureActivity(){
      $data = Activity::join('category',
      'activities.category','=','category.id_category')
      ->join('cakupan', 'activities.cakupan','=','cakupan.id_cakupan')
      ->join('lectures', 'lectures.username', '=', 'activities.id_people')
      ->select(['nama_kegiatan', 'cakupan.nama', 'nama_cat', 'tgl_mulai', 'tgl_selesai', 'sumber_dana', 'pencapaian', 'deskripsi'])
      ->where('group', 1)
      ->get();
      $date = Date('Ymd');

      // print_r($data);
      if($data->count() == 0){
        Session::flash('empty_table', 'Anda tidak memiliki data yang bisa di export');
      }else{
        Excel::create('lecture_activity_' . $date, function($excel) use($data){
        //     // Our first sheet
          $excel->sheet('First sheet', function($sheet) use($data) {
            $sheet->fromArray($data);
            $sheet->row(1, array(
              'Nama Kegiatan', 'Cakupan', 'Kategori', 'Mulai', 'Berakhir', 'Sumber Dana', 'Pencapaian', 'Deskripsi'
            ));
          });
        })->export('xls');
      }

      return redirect()->back();
    }

    // public function exportPaperSummary(){
    //   $data = Paper:
    //   Excel::create('Paper Summary', function($excel) {
    //     // Our first sheet
    //     $excel->sheet('First sheet', function($sheet) {
    //       $sheet->loadView('admin.');
    //     });
    //   })->export('xls');
    // }
}
