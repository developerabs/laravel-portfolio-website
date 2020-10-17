<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visitorModel;

class visitorController extends Controller
{
    public function visitorIndex()
    {
        $visitorData= json_decode(visitorModel::orderBy('id','desc')->take(100)->get());
        return view('visitor',['visitorData'=>$visitorData]);
    }
}





































































