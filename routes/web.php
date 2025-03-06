<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('login',  [LoginController::class, 'login']);
Route::post('login', [LoginController::class, 'store'])->name('login');

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'useradmin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //Route::resource('roles', RoleController::class);

    Route::get('admin/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('admin/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('admin/role', [RoleController::class, 'store'])->name('role.store');
    Route::get('admin/role/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('admin/role/{role}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('admin/role/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
});


