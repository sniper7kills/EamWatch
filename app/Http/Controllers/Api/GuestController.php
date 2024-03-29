<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuestUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Guest;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('show');
        $this->authorizeResource(Guest::class, 'guest');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest): UserResource
    {
        return new UserResource($guest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GuestUpdateRequest $request, Guest $guest): UserResource
    {
        $data = $request->validated();

        /**
         * Ban & Unban.
         */
        if (array_key_exists('banned', $data)) {
            if (Auth::user()->hasPermissionTo('ban users', 'web') && $data['banned'] == true) {
                $guest->banned = true;
                $guest->save();
            }
            if (Auth::user()->hasPermissionTo('unban users', 'web') && $data['banned'] == false) {
                $guest->banned = false;
                $guest->save();
            }
        }

        return new UserResource($guest);
    }
}
