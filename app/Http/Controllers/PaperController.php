<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Paper;
use App\Lecture;
use Session;
use Excel;

class PaperController extends Controller
{
  private $PAPER_DATA = array();
  private $NAME;
  private $counter;
  private $report = array();
  private $arr;


  protected function regexForm($s){
      $s = str_replace("/", "\/", $s);
      $s = str_replace(".","\.", $s);
      $s = str_replace("(", "\(", $s);
      $s = str_replace(")","\)", $s);
      $s = str_replace("[", "\[", $s);
      $s = str_replace("]","\]", $s);
      return $s;
  }

  public function setPaper($url){
    //GET USER URL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://scholar.google.co.id/citations?user=" . $url);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $data = curl_exec($ch);

    //GET PAPER DETAIL
    $left = $this->regexForm('<table id="gsc_a_t">');
    $right = $this->regexForm('</table>');
    $regex = "/$left(.*?)$right/s";
    $matches = array();
    preg_match_all($regex, $data, $matches);

    $tableData = $matches[0][0];

        //get the row
    $left= $this->regexForm('<tr class="gsc_a_tr">');
    $right = $this->regexForm('</tr>');
    $regex = "/$left(.*?)$right/s";
    $matches = array();
    preg_match_all($regex, $tableData, $matches);
    $tableRows = $matches[0];

    $test = array();
    preg_match("/no articles/", $matches[0][0], $test);

    if(empty($test) ){
      foreach($tableRows as $row){

          //mengambil citedby, tahun
          $left=$this->regexForm('<td ');
          $right= $this->regexForm('</td>');
          $regex = "/$left(.*?)$right/s";
          $matches = array();
          preg_match_all($regex, $row, $matches);

          //memisah paper detail menjadi judul, author & journal
              //judul paper
          $paperDetail= $matches[0][0];
          $left=$this->regexForm('<a ');
          $right= $this->regexForm('</a>');
          $regex = "/$left(.*?)$right/s";
          $paperJudul = array();
          preg_match_all($regex, $paperDetail, $paperJudul);

              //author & journal
          $paperDetail= $matches[0][0];
          $left=$this->regexForm('<div class="gs_gray">');
          $right= $this->regexForm('</div>');
          $regex = "/$left(.*?)$right/s";
          $paperAJ = array();
          preg_match_all($regex, $paperDetail, $paperAJ);

          if(strpos($matches[0][1],"&nbsp") > 0){
            $matches[0][1] = "0";
          }
          $detail = array(
              'judul' => preg_replace('#<a.*?>([^>]*)</a>#i', '$1', $paperJudul[0][0]),
              'author' => $paperAJ[1][0],
              'jurnal' => strip_tags($paperAJ[1][1]),
              'citedby' => strip_tags(str_replace("*","",$matches[0][1])),
              'year' => strip_tags($matches[0][2])
          );
          $this->PAPER_DATA[] = $detail;
          $this->counter = true;
      }
    }else{
      $this->counter = false;
    }

    //GET USER SUMMARY DETAIL
        //get table
    $left= $this->regexForm('<table id="gsc_rsb_st">');
    $right = $this->regexForm('</table>');
    $regex = "/$left(.*?)$right/s";
    $matches = array();
    preg_match_all($regex, $data, $matches);
    $tableSummary = $matches[0][0];
        //get row
    $left= $this->regexForm('<tr>');
    $right = $this->regexForm('</tr>');
    $regex = "/$left(.*?)$right/s";
    $matches = array();
    preg_match_all($regex, $tableSummary, $matches);
    $rowCitation = $matches[0][1];
    $rowHindex = $matches[0][2];

        //get nama
    $left= $this->regexForm('<div id="gsc_prf_in">');
    $right = $this->regexForm('</div>');
    $regex = "/$left(.*?)$right/s";
    $matches = array();
    preg_match_all($regex, $data, $matches);

    $userName = $matches[1][0];

    $this->NAME = $userName;
  }

  public function insertAllPaper(){
    $data = Lecture::select('username', 'url')->get();

    Paper::truncate();

    $i = 0;
    foreach($data as $lecture){
      $url = $lecture->url;
      $cstart = 0;
      while(true){
        $this->setPaper($url . "&hl=en&oi=ao&cstart=" . $cstart ."&pagesize=100");
        if($this->counter){
          foreach($this->PAPER_DATA as $paper){
            $data = Paper::firstOrCreate(
              [
                'judul' => $paper['judul'],
                'author' => $paper['author'],
                'jurnal' => $paper['jurnal'],
                'citedby' => $paper['citedby'],
                'year' => $paper['year'],
                'id_dosen'=> $url
              ]
            );
          }
        }else{
          break;
        }
        $this->PAPER_DATA = null;
        $cstart+=100;
      }
    }

    return redirect('dashboard');

  }

  public function getPaper(){
    $view = Paper::join('lectures', 'papers.id_dosen', '=', 'lectures.url')
              ->where('lectures.username', Session::get('lectureId'))->get();

    return view('dosen.dashboard', compact('view'));
    // if(isset($url)){
    //   $this->setPaper($url);
    //   foreach($PAPER_DATA as $paper){
    //    $table->judul = $paper[judul];
    //    $table->author = $paper[author];
    //    $table->jurnal = $paper[journal];
    //    $table->citedby =  $paper[cited];
    //    $table->year =  $paper[year];
    //    $table->id_dosen = Session::get('lectureId');
    //   }
    // }
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

    $this->report = $data;

    $size = count($data);
    $citation = 0;
    $hindex = 0;
    $i10index = 0;
    $minCitation = $data[0][1];
    $maxCitation = $data[0][1];
    $minHindex = $data[0][2];
    $maxHindex = $data[0][2];
    $minI10index = $data[0][3];
    $maxI10index = $data[0][3];
    $medianCitation = array();
    $medianHindex = array();
    $medianI10index= array();
    $stdevCitation = array();
    $stdevHindex = array();
    $stdevI10index= array();

    for($i=0; $i<$size; $i++){
      $citation += $data[$i][1];
      $hindex += $data[$i][2];
      $i10index += $data[$i][3];
      array_push($medianCitation, $data[$i][1]);
      array_push($medianHindex, $data[$i][2]);
      array_push($medianI10index, $data[$i][3]);

      array_push($stdevCitation, $data[$i][1]);
      array_push($stdevHindex, $data[$i][2]);
      array_push($stdevI10index, $data[$i][3]);

      if($minCitation > $data[$i][1]){
        $minCitation = $data[$i][1];
      }
      if($maxCitation < $data[$i][1]){
        $maxCitation = $data[$i][1];
      }

      if($minHindex > $data[$i][2]){
        $minHindex = $data[$i][2];
      }
      if($maxHindex < $data[$i][2]){
        $maxHindex = $data[$i][2];
      }

      if($minI10index > $data[$i][3]){
        $minI10index = $data[$i][3];
      }
      if($maxI10index < $data[$i][3]){
        $maxI10index = $data[$i][3];
      }
    }


    $citation /= $size;
    $hindex /= $size;
    $i10index /= $size;

    sort($medianCitation);


    $summary = array(
      'meanCitation' => $citation,
      'meanHindex' => $hindex,
      'meani10Index' => $i10index,
      'minCitation' => $minCitation,
      'minHindex' => $minHindex,
      'minI10index' => $minI10index,
      'maxCitation' => $maxCitation,
      'maxHindex' => $maxHindex,
      'maxI10index' => $maxI10index,
      'medianCitation' => $this->median($medianCitation),
      'medianHindex' => $this->median($medianHindex),
      'medianI10index' => $this->median($medianI10index),
      'stdevCitation' => $this->stdev($stdevCitation, $citation),
      'stdevHindex' => $this->stdev($stdevHindex, $hindex),
      'stdevI10index' => $this->stdev($stdevI10index, $i10index)
    );

    return view('paper', compact(['summary','data']));
  }

  public function exportPaper(){
    $data = Paper::join('lectures', 'lectures.url', '=', 'papers.id_dosen')
      ->select(['nama', 'judul', 'author', 'jurnal', 'citedby', 'year'])
      ->get();
    $date = Date('Ymd');

    // echo "halo";
    Excel::create('All_paper_' . $date, function($excel) use($data){
    //     // Our first sheet
      $excel->sheet('First sheet', function($sheet) use($data) {
        $sheet->fromArray($data);
      });
    })->export('xls');

    return redirect()->back();

  }

  public function exportPaperSummary(){

    print_r($this->report);
    // $date = Date('Ymd');
    // // echo "halo";
    // Excel::create('Paper_summary_' . $date , function($excel) use($data){
    // //     // Our first sheet
    //   $excel->sheet('First sheet', function($sheet) use($data) {
    //     $sheet->fromArray($data);
    //   });
    // })->export('xls');
    //
    // return redirect()->back();

  }


  protected function median($arr){
    $count = count($arr);
    $middleval = floor(($count-1)/2); // find the middle value, or the lowest middle value
    if($count % 2) { // odd number, middle is the median
       $median = $arr[$middleval];
    } else { // even number, calculate avg of 2 medians
       $low = $arr[$middleval];
       $high = $arr[$middleval+1];
       $median = (($low+$high)/2);
    }

    return $median;
  }

  protected function stdev($arr, $mean){
    $count = count($arr);
    $stdev = 0;
    for($i=0; $i<$count; $i++){
      $stdev += ($arr[$i] - $mean) * ($arr[$i] - $mean);
    }

    return sqrt($stdev/($count-1));
  }


}
