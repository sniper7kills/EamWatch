<?php

namespace App\Http\Controllers\Api;

use App\Concerns\GetCurrentUserOrGuest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecordingStoreRequest;
use App\Http\Resources\RecordingResource;
use App\Models\Guest;
use App\Models\Message;
use App\Models\Recording;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecordingController extends Controller
{
    use GetCurrentUserOrGuest;

    public function __construct()
    {
        $this->authorizeResource(Recording::class, 'recording');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RecordingStoreRequest $request
     * @return RecordingResource
     */
    public function store(RecordingStoreRequest $request)
    {
        $request = $request->validated();

        $message = Message::find($request['message_id']);

        $recording = new Recording($request);
        $recording->time = $message->time;
        $recording->message = $message;
        $recording->user = $this->currentUserOrGuest();
        $recording->save();

        Storage::copy(
            $request['key'],
            '/recordings/'.$message->id."/".$recording->id
        );

        Storage::setVisibility('/recordings/'.$message->id."/".$recording->id, 'public');

        return RecordingResource::make($recording);
    }

    /**
     * Display the specified resource.
     *
     * @param Recording $recording
     * @return RecordingResource
     */
    public function show(Recording $recording)
    {
        return RecordingResource::make($recording);
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
