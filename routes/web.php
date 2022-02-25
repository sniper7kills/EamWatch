<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SpaController;
use Illuminate\Support\Facades\Route;

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

use App\Http\Middleware\BannedMiddleware;

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
