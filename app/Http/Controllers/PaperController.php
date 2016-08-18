<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Paper;
use App\Lecture;
use Session;

class PaperController extends Controller
{
  private $PAPER_DATA = array();
  private $NAME;
  private $counter;


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
}
