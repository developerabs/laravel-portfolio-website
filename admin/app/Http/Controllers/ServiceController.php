<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceModel;

class ServiceController extends Controller
{
    public function serviceIndex()
    {
        return view('services');
    }

    public function getServiceData()
    {
        $result = json_decode(ServiceModel::orderBy('id','desc')->get());
        return $result;
    }
    public function getServiceDetails(Request $req)
    {
        $id = $req->input('id');
        $result = ServiceModel::where('id', '=', $id)->get();
        return $result;
    }

    public function serviceDelete(Request $req)
    {
        $id = $req->input('id');
        $result = ServiceModel::where('id', '=', $id)->delete();
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
    public function serviceUpdate(Request $req)
    {
        $id = $req->input('id');
        $name = $req->input('name');
        $des = $req->input('des');
        $img = $req->input('img');
        $result = ServiceModel::where('id', '=', $id)->update(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
    public function ServiceAddNew(Request $req)
    {
        $name = $req->input('name');
        $des = $req->input('des');
        $img = $req->input('img');
        $result = ServiceModel::insert(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
