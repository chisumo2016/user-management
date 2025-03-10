<?php

use App\Http\Controllers\Admin\TransactionController;
use Illuminate\Support\Facades\Route;



    /*Group by Controller**/
    Route::controller(TransactionController::class)->group(function () {
        Route::get('/',                 'index')->name('index');
        Route::get('/create',           'create')->name('create');
        Route::get('/{transactionId}',  'show')->name('show');
        Route::post('/transactions',    'store')->name('store');
    });



