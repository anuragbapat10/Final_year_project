<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * @param \App\Http\Requests\LoginRequest $request
     *
     * @return \App\Http\Resources\UserResource
     */
    public function login(LoginRequest $request): UserResource
    {
        $email = $request->email;
        $password = $request->password;
        $hashed_password = hash('sha256', $password);

        abort_if(
            User::where('email', $email)->first()===null,
            422,
            'Invalid Email!'
        );
        $user = User::where('email', $email)->first();

        abort_if(
            $user->hashed_password!==$hashed_password,
            422,
            'Invalid Password!'
        );

        return UserResource::make($user);
    }
}
