<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\visitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\photoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',[HomeController::class, 'homeIndex'])->middleware('LoginCheck');
Route::get('/visitor',[visitorController::class, 'visitorIndex'])->middleware('LoginCheck');

//services all routing
Route::get('/service',[ServiceController::class, 'serviceIndex'])->middleware('LoginCheck');
Route::get('/getServiceData',[ServiceController::class, 'getServiceData'])->middleware('LoginCheck');
Route::post('/serviceDelete',[ServiceController::class, 'serviceDelete'])->middleware('LoginCheck');
Route::post('/serviceDetails',[ServiceController::class, 'getServiceDetails'])->middleware('LoginCheck');
Route::post('/serviceUpdate',[ServiceController::class, 'serviceUpdate'])->middleware('LoginCheck');
Route::post('/serviceAddNew',[ServiceController::class, 'ServiceAddNew'])->middleware('LoginCheck');

//coursex all routing
Route::get('/course',[CourseController::class, 'courseIndex'])->middleware('LoginCheck');
Route::get('/getcourseData',[CourseController::class, 'getcourseData'])->middleware('LoginCheck');
Route::post('/courseDelete',[CourseController::class, 'courseDelete'])->middleware('LoginCheck');
Route::post('/courseDetails',[CourseController::class, 'getcourseDetails'])->middleware('LoginCheck');
Route::post('/courseUpdate',[CourseController::class, 'courseUpdate'])->middleware('LoginCheck');
Route::post('/courseAddNew',[CourseController::class, 'CourseAddNew'])->middleware('LoginCheck');


Route::get('/adminlogin',[LoginController::class, 'loginIndex']);
Route::post('/onLogin',[LoginController::class, 'onLogin']);
Route::get('/logout',[LoginController::class, 'onLogout']);

//phpto gallery 
Route::get('/photo',[photoController::class, 'photoIndex']);
Route::post('/photoUpload',[photoController::class, 'photoUpload']);
Route::get('/photoJSON',[photoController::class, 'photoJSON']);