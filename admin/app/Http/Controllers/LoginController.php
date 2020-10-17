<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginModel;

class LoginController extends Controller
{
    public function loginIndex(){
        return view('login');
    }
    public function onLogin(Request $req){
        $username = $req->input('user');
        $password = $req->input('pass');

       $countresult = LoginModel::where('username','=',$username)->where('password','=',$password)->count();
       if($countresult==1){
           $req->session()->put('user',$username);
           return 1;
       }else{
           return 0;
       }
    }
    public function onLogout(Request $req){
        $req->session()->flush();
        return redirect('/adminlogin');
    }
}
