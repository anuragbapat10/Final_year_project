<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\SignUpRequest;
use App\Http\Resources\UserResource;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    //
    public function getUser($id): UserResource {
        
        return UserResource::make(User::find($id));
    }

    public function updateUser(UpdateUserRequest $request) {
        if ($request->id !== null) {

            User::find($request->id)->update(
                ['email' => $request->email,
                'hashed_password' => hash('sha256', $request->password),
                'name' => $request->name],
            );

        } else {
            User::create(
                ['email' => $request->email,
                'hashed_password' => hash('sha256', $request->password),
                'name' => $request->name],
            );
        }

        $user = User::where('email', $request->email)->first();

        return UserResource::make($user);
    }
}
