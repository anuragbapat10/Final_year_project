<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organization;
use App\Http\Resources\UserResource;
use App\Http\Resources\IssueResource;
use SebastianBergmann\Type\FalseType;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\IssuesSummaryResource;

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
                    'hashed_password' => password_hash($request->password, PASSWORD_BCRYPT),
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
                'hashed_password' => password_hash($request->password, PASSWORD_BCRYPT),
                'name' => $request->name],
            );
        }

        $user = User::where('email', $request->email)->first();

        if ($request->organization_add != NULL) {
            if ($request->organization_add == 1) {
                $user->organizations()->attach($request->organization_id);
            } elseif ($request->organization_add == 0) {
                $user->organizations()->detach($request->organization_id);
            }
        }

        return UserResource::make($user);
    }

    public function deleteUser($id) {
        $deletedUser = User::find($id);
        $deletedUser->delete();

        return UserResource::make($deletedUser);
    }

    public function getUserIssues($id) {
        return IssueResource::collection(User::find($id)->issues);
    }
}
