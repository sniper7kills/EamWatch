<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Controllers\Controller;
use App\Http\Resources\AutomatedRecordingResource;
use App\Models\Recording;
use Illuminate\Http\Request;

class AutomatedRecordingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Recording::class, 'recording');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $recordings = Recording::where('automated', true)->where('message_id', null)->paginate();

        return AutomatedRecordingResource::collection($recordings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
    }
}
