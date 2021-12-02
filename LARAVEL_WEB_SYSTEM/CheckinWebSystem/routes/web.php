<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\ClassAnalysisController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LecturersController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UnitLecturersController;
use App\Http\Controllers\UnitsAnalysisController;
use App\Http\Controllers\UnitsController;
use App\Http\Controllers\VerifyAdminController;

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

Route::get('/', function () {
    return view('auth/login/index');
});


// Route::get('/', function () {
//     return view('admin-users/index');
// });

Auth::routes(['verify' => true]);
Route::resource('admin-users', AdminUsersController::class);
Route::resource('dashboard', DashboardController::class);
Route::resource('lecturers', LecturersController::class);
Route::resource('units', UnitsController::class);
Route::resource('units-assign', UnitLecturersController::class);
Route::resource('units-analysis', UnitsAnalysisController::class);
Route::resource('class-analysis', ClassAnalysisController::class);
Route::resource('classroom-analysis', ClassRoomController::class);
Route::resource('students', StudentsController::class);
Route::get('/verify/{token}', [VerifyAdminController::class, 'VerifyEmail'])->name('verify');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
