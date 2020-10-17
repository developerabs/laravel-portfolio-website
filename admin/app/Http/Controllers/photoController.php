<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\photoModel;

class photoController extends Controller
{
    public function photoIndex(){
        return view('photoGallery');
    }
    public function photoJSON(){
       return photoModel::all();
    }
    public function photoUpload(Request $req){
        $photoPath = $req->file('photo')->store('public');
        $photoName =(explode('/',$photoPath))[1];
        $host = $_SERVER['HTTP_HOST'];
        $location="http://" .$host."/storage/".$photoName;
        $result = photoModel::insert(['location'=>$location]);
        return $result;
    }
}
