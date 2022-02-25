<?php

use App\Http\Controllers\Api;
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

Route::apiResource('messages', Api\MessageController::class);
Route::apiResource('recordings', Api\RecordingController::class);
Route::apiResource('comments', Api\CommentController::class);
Route::apiResource('skykings', Api\SkykingController::class)->only('index');
Route::apiResource('automatedRecordings', Api\AutomatedRecordingController::class)->except(['delete', 'show']);
Route::apiResource('users', Api\UserController::class)->only(['show', 'update']);
Route::apiResource('guests', Api\GuestController::class)->only(['show', 'update']);
