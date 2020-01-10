<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recording;
use Illuminate\Http\Request;

class RecordingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Recording::class, 'recording');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Recording $recording
     * @return void
     */
    public function show(Recording $recording)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Recording $recording
     * @return void
     */
    public function update(Request $request, Recording $recording)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Recording $recording
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Recording $recording)
    {
        $recording->delete();

        return response()->json()->setStatusCode(204);
    }
}
