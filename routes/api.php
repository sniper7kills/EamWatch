<?php

use App\Http\Controllers\Api;
use App\Http\Middleware\BannedMiddleware;
use App\Http\Resources\SupporterMessageResource;
use App\Models\SupporterMessage;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(BannedMiddleware::class)->group(function () {

    Route::post(
        config('vapor.signed_storage.url', '/vapor/signed-storage-url'),
        Laravel\Vapor\Contracts\SignedStorageUrlController::class.'@store'
    )->middleware('auth:api');

    Route::apiResource('messages', Api\MessageController::class);
    Route::apiResource('recordings', Api\RecordingController::class);
    Route::apiResource('comments', Api\CommentController::class);
    Route::apiResource('skykings', Api\SkykingController::class)->only('index');
    Route::apiResource('automatedRecordings', Api\AutomatedRecordingController::class)->except(['delete', 'show']);
    Route::apiResource('users', Api\UserController::class)->only(['show', 'update']);
    Route::apiResource('guests', Api\GuestController::class)->only(['show', 'update']);

    Route::get('/search', [Api\MessageController::class, 'search'])->name('search');

    Route::get('/supporter-messages', function (Request $request) {
        return SupporterMessageResource::collection(SupporterMessage::paginate($request->get('paginate', 15)));
    })->name('supporter-messages');

    Route::prefix('charts')->group(function () {
        Route::get('/character-count', [Api\ChartController::class, 'characterCount'])->name('character-count');
        Route::get('/codeword-count', [Api\ChartController::class, 'codewordCount'])->name('codeword-count');
        Route::get('/daily-count', [Api\ChartController::class, 'dailyCount'])->name('daily-count');
    });
});
