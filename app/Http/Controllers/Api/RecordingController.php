<?php

namespace App\Http\Controllers\Api;

use App\Concerns\GetCurrentUserOrGuest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecordingStoreRequest;
use App\Http\Resources\RecordingResource;
use App\Models\Message;
use App\Models\Recording;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     */
    public function store(RecordingStoreRequest $request): RecordingResource
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
            '/recordings/'.$message->id.'/'.$recording->id
        );

        Storage::setVisibility('/recordings/'.$message->id.'/'.$recording->id, 'public');

        return RecordingResource::make($recording);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recording $recording): RecordingResource
    {
        return RecordingResource::make($recording);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return void
     */
    public function update(Request $request, Recording $recording)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recording $recording): JsonResponse
    {
        $recording->delete();

        return response()->json()->setStatusCode(204);
    }
}
