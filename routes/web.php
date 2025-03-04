<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('login',  [LoginController::class, 'login']);
Route::post('login', [LoginController::class, 'store'])->name('login');

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


