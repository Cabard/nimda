<?php

use Illuminate\Support\Facades\Route;


//Route::get('/nimda/test', [Cabard\Nimda\Http\Controllers\Test::class, 'index']);
//Route::get('/nimda/login', [Cabard\Nimda\Http\Controllers\Test::class, 'login']);


//Route::group([
//    'as' => 'nimda.',//config('cnb.routing.as'),
//    'prefix' => 'admin', //config('cnb.routing.prefix'),
//    'namespace' => 'Nimda',
//], function () {
//    Route::get('/login', [\Cabard\Nimda\Http\Controllers\AdminAuthController::class, 'getLogin'])->name('adminLogin');
//    Route::get('/login/auth', [\Cabard\Nimda\Http\Controllers\AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
//    Route::group([
//        'middleware' => [
//            'web',
//            \Cabard\Nimda\Http\Middleware\AdminAuthenticated::class,
//        ],
//    ], function () {
//        Route::get('/adminDashboard', function () {
//            return view('welcome');
//        })->name('adminDashboard');
//    });
//});
