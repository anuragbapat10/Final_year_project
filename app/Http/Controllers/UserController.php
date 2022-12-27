<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Organization;

class UserController extends Controller
{
    //
    public function getUser($id): UserResource {

        return UserResource::make(User::find($id));
    }

    public function updateUser(UpdateUserRequest $request) {
        if ($request->id !== null) {
            if ($request->password !== null) {
                User::find($request->id)->update(
                    ['email' => $request->email,
                    'hashed_password' => hash('sha256', $request->password),
                    'name' => $request->name],
                );
            }
            else {
                User::find($request->id)->update(
                    ['email' => $request->email,
                    'name' => $request->name],
                );
            }

        } else {
            User::create(
                ['email' => $request->email,
                'hashed_password' => hash('sha256', $request->password),
                'name' => $request->name],
            );
        }
        $user = User::where('id', $request->id)->first();
        $user->organizations()->attach($request->organization_id);

        $user = User::where('email', $request->email)->first();

        return UserResource::make($user);
    }

    public function deleteUser($id) {
        $deletedUser = User::find($id);
        $deletedUser->delete();

        return UserResource::make($deletedUser);
    }
}
