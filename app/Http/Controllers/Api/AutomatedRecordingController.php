<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AutomatedRecordingResource;
use App\Http\Requests\AutomatedRecordingStoreRequest;
use App\Models\Recording;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class AutomatedRecordingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['only' => 'store']);
        $this->authorizeResource(Recording::class, 'recording');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $recordings = Recording::where('automated', true)->where('message_id', null)->orderBy('broadcasted_at', 'desc')->paginate();

        return AutomatedRecordingResource::collection($recordings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AutomatedRecordingStoreRequest $request)
    {
        $request = $request->validated();

        $recording = new Recording($request);
        $recording->time = $request['time'];
        $recording->user = Auth::user();
        $recording->automated = true;
        $recording->save();

        Storage::copy(
            $request['key'],
            '/automated/' . $recording->id
        );

        Storage::setVisibility('/automated/' . $recording->id, 'public');

        return AutomatedRecordingResource::make($recording);
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
