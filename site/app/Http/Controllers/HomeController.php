<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visitorModel;
use App\Models\ServicesModel;
use App\Models\CourseModel;
use App\Models\ContactModel;

class HomeController extends Controller
{
    public function homeIndex()
    {
        $userIp=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate=date("Y-m-d h:i:sa");
        visitorModel::insert(['ip_address'=>$userIp,'visite_time'=>$timeDate]);

        $servicesData=json_decode(ServicesModel::all());
        $courseDAta = json_decode(CourseModel::orderBy('id','desc')->limit(6)->get());

        return view('home',[
            'servicesData'=>$servicesData,
            'courseDAta' =>$courseDAta
        ]);
    }
    public function contactSend(Request $req)
    {
        $contactName = $req->input('contact_name');
        $contactMobile = $req->input('contact_mobile');
        $contactEmail = $req->input('contact_email');
        $contactMsg = $req->input('contact_msg');

       $result = ContactModel::insert([
            'contact_name'=>$contactName,
            'contact_mobile'=>$contactMobile,
            'contact_email'=>$contactEmail,
            'contact_msg'=>$contactMsg,
        ]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
