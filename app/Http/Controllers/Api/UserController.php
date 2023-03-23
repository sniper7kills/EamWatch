<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('show');
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user): UserResource
    {
        $data = $request->validated();

        /**
         * Ban & Unban.
         */
        if (array_key_exists('banned', $data)) {
            if (Auth::user()->hasPermissionTo('ban users', 'web') && $data['banned'] == true) {
                $user->banned = true;
                $user->save();
            }
            if (Auth::user()->hasPermissionTo('unban users', 'web') && $data['banned'] == false) {
                $user->banned = false;
                $user->save();
            }
            unset($data['banned']);
        }

        /**
         * Change Roles.
         */
        if (Auth::user()->hasPermissionTo('edit users', 'web') && array_key_exists('role', $data)) {
            $user->syncRoles([]);
            $role = strtolower($data['role']);
            if ($role != 'member') {
                $user->syncRoles(Role::findByName($role, "web"));
            }
        }
        if (array_key_exists('role', $data)) {
            unset($data['role']);
        }

        /**
         * Change Password.
         */
        if (array_key_exists('password', $data)) {
            if (!is_null($data['password'])) {
                $user->password = Hash::make($data['password']);
                $user->save();
            }
            unset($data['password'], $data['password_confirm']);
        }

        /**
         * Ensure Null Inputs are not updated.
         */
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                unset($data[$key]);
            }
        }

        /**
         * Update User.
         */
        $user->update($data);

        return new UserResource($user);
    }
}
