<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
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

    Route::get('admin/role/{role}/give-permission', [RoleController::class, 'givePermission'])->name('role.give-permission');
    Route::put('admin/role/{role}/give-permission', [RoleController::class, 'givePermissionToRole'])->name('role.update-permission');

    //Route::resource('users', UserController::class);

    Route::get('admin/user', [UserController::class, 'index'])->name('user.index');
    Route::get('admin/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('admin/user', [UserController::class, 'store'])->name('user.store');
    Route::get('admin/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('admin/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('admin/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');


    //Route::resource('permissions', PermissionController::class);

    Route::get('admin/permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('admin/permissions/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('admin/permissions', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('admin/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('admin/permissions/{permission}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('admin/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permission.destroy');
});




