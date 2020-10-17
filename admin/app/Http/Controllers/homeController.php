<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visitorModel;
use App\Models\ServiceModel;
use App\Models\CourseModel;
use App\Models\ContactModel;

class homeController extends Controller
{
    public function homeIndex()
    {
        $totalVisitor = visitorModel::count();
        $totalService = ServiceModel::count();
        $totalCourse = CourseModel::count();
        $totalContact = ContactModel::count();

        return view('home',[
            'totalVisitor'=>$totalVisitor,
            'totalService'=>$totalService,
            'totalCourse'=>$totalCourse,
            'totalContact'=>$totalContact,
        ]);
    }
}
