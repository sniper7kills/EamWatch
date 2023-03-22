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
     *
     * @param  \App\Models\Guest  $guest
     * @return UserResource
     */
    public function show(Guest $guest)
    {
        return new UserResource($guest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guest  $guest
     * @return UserResource
     */
    public function update(GuestUpdateRequest $request, Guest $guest)
    {
        $data = $request->validated();

        /**
         * Ban & Unban.
         */
        if (Auth::user()->hasAnyPermission(['ban guests', 'unban guests']) && array_key_exists('banned', $data)) {
            if (Auth::user()->hasPermissionTo('ban users') && $data['banned'] == true) {
                $guest->banned = true;
                $guest->save();
            }
            if (Auth::user()->hasPermissionTo('unban users') && $data['banned'] == false) {
                $guest->banned = false;
                $guest->save();
            }
        }

        return new UserResource($guest);
    }
}
