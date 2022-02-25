<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SpaController;
use App\Http\Middleware\BannedMiddleware;
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

use Illuminate\Support\Facades\Route;

Route::get('/banned', function () {
    return view('banned');
});

Route::get('/unauthorized', function () {
    return view('unauthorized');
});

Route::middleware(BannedMiddleware::class)->group(function () {
    Auth::routes();

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/{any}', [SpaController::class, 'index'])->where('any', '.*');
});
