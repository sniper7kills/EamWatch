<?php

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

Route::namespace('Api')->group(function(){
    Route::apiResource('messages', 'MessageController');
    Route::apiResource('recordings', 'RecordingController')->except('index');
    Route::apiResource('automatedRecordings', 'AutomatedRecordingController')->except(['delete','show']);
});
