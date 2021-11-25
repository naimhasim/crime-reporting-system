<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
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

//Resources
//Route::resource('report', ReportController::class);

// Route::get('/', [ReportController::class, 'index']);
Route::get('showall-report',[ReportController::class, 'showallreport']);
Route::get('show-chart',[ReportController::class, 'showchart']);

Route::post('/', [ReportController::class, 'store']);
Route::get('all-post', [ReportController::class, 'getAllPost'])->name('post.all');
Route::get('single-post/{lat}/{long}', [ReportController::class, 'getSinglePost'])->name('post.single');

Route::get('cluster',function(){
    return view('cluster');
});
Route::get('/', function () {
    return view('index');
});

