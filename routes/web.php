<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('login',  [LoginController::class, 'login']);
Route::post('login', [LoginController::class, 'store'])->name('login');

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

//Route::group(['middleware' => ['userAdmin', 'role:super-admin|admin']], function () });

Route::group(['middleware' => ['isAdmin']], function () {
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


    //Route::resource('permissions', PermissionController::class);

    Route::get('admin/permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('admin/permissions/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('admin/permissions', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('admin/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('admin/permissions/{permission}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('admin/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permission.destroy');

    //Route::resource('users', UserController::class);

    Route::get('admin/users', [UserController::class, 'index'])->name('user.index');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('admin/users', [UserController::class, 'store'])->name('user.store');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('admin/permissions/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});

  /*Student CRUD*/
Route::get('students', [StudentController::class, 'index'])->name('student.index');
Route::get('add-student', [StudentController::class, 'create'])->name('student.create');
Route::post('add-student', [StudentController::class, 'store'])->name('student.store');




