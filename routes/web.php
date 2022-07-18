<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\DashboardController;

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


Route::middleware(['ifauth'])->group(function () {
    Route::view('/','auth.login');
    Route::post('/login',[LoginController::class,'authenticate']);
});

Route::get('logout', [LoginController::class,'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::get('grafik',[DashboardController::class,'grafik']);
    Route::resource('department', DepartmentController::class);
    Route::resource('management-user', UserController::class);
    Route::post('archive-update',[ArchiveController::class,'update']);
    Route::resource('archive',ArchiveController::class)->except('update');
    Route::post('changePass',[LoginController::class,'changePass']);
    Route::get('reset-pass/{id}',[LoginController::class,'resetPass']);
});
