<?php

namespace App\Http\Controllers;

use Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Admin;


use App\Http\Requests;



class UserController extends Controller
{

  public function getLogin(){
      return view('login');
  }

  public function postLogin(Request $request){
    $username = $request -> input('username');
    $password = $request -> input('password');
    $data = array(
      "username" => $username,
      "password" => $password
    );
    $data_string = json_encode($data);

    $ch = curl_init('http://agricode.cs.ipb.ac.id/ivan/login.php');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length:' . strlen($data_string)
    ));

    $result = curl_exec($ch);
    $hasil = json_decode($result);

    if(empty($hasil)){
      $login = Admin::where(['username' => $request->username, 'password' => $request->password])->first();
      if($login != null){
        if($login->status == 0){
            Session::put('admin',$request->username);
            return redirect('admin-dashboard');

        }else{
          $user = Admin::join('lectures', 'lectures.username', '=', 'admins.username')->where('lectures.username', $username)->first();
          Session::put(['lectureId' => $username, 'lectureName' => $user->nama]);
          return redirect('dashboard');
        }
      }else{
        Session::flash('error_login', 'Password atau username anda salah');
        return redirect()->back();
      }
    }else{
      if(empty($hasil->nim)){
        Session::put(['lectureId' => $hasil->username, 'lectureName' => $hasil->nama]);
        return redirect('dashboard');
      }else{
        Session::put(['studentNim' => $hasil->nim, 'studentName' => $hasil->nama]);
        return redirect('student-dashboard');
      }
    }
  }

  public function logout(){
    Session::flush();
    return redirect('/');
  }
}
