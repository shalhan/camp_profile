<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Category;
use App\Cakupan;
use App\Paper;
use App\File;
use DB;

use App\Http\Requests;

class AdminController extends Controller
{
    public function getAdmin(){
      $view = Paper::join(
        'lectures',
        'lectures.url', '=',
        'papers.id_dosen'
      )->get();

      return view('admin.dashboard', compact('view'));
    }

    public function getPaperSummary(){
      $query = Paper::select('nama', 'citedby', 'url')
        ->join('lectures', 'papers.id_dosen', '=', 'lectures.url');

      $view = $query->get();

      $counter = $query->first()->url;
      $citation = 0;
      $hIndex = 0;
      $i10Index = 0;
      $i = 0;

      $data=array();

      foreach($view as $row){
        if($counter == $row->url){
          $nama = $row->nama;
          if($row->citedby > $hIndex){
            $hIndex++;
          }
          if($row->citedby > 10){
            $i10Index++;
          }
          $citation= $citation + $row->citedby;
        }else{
          $data[$i][0] = $nama;
          $data[$i][1] = $citation;
          $data[$i][2] = $hIndex;
          $data[$i][3] = $i10Index;
          $data[$i][4] = $counter;

          $i++;
          $citation = 0;
          $hIndex = 0;
          $i10Index = 0;
          $counter = $row->url;
          $nama = $row->nama;
          $citation= $citation + $row->citedby;
          if($row->citedby > $hIndex){
            $hIndex++;
          }
          if($row->citedby >= 10){
            $i10Index++;
          }
        }
      }

      $summary = array(
        'meanCitation' => $view->avg('citation'),
        'maxCitation' => $view->max('citation'),
        'minCitation' => $view->min('citation')
      );



      echo $data[0][0];
      return view('paper', compact(['summary', 'data']));
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
}
