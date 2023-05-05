<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $hashed_password = hash('sha256', $password);
        session(['key' => 'value']);
        //session(['error' => 'Invalid']);
        //$request->session()->put('error', 'invalid');
        //Session::put('error','nahi ho raha bhai');

//        if(User::where('email', $email)->first()===null){
//
//            //Cookie::make('name', 'value', 120);
//            return redirect('login');
//        }
//
//        $user = User::where('email', $email)->first();
//
//        if($user->hashed_password!==$hashed_password)
//            return redirect('login')->with([ 'error' => 'Invalid Password!' ]);
//        abort_if(
//            User::where('email', $email)->first()===null,
//            422,
//            'Invalid Email!'
//        );
//
//
//        abort_if(
//            $user->hashed_password!==$hashed_password,
//            422,
//            'Invalid Password!'
//        );
//

        if($request->role ==0) {
            if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password])) {
                // Authentication passed...
                return redirect('user/dashboard');
            }
        }
        else
        {if (Auth::guard('organization')->attempt(['email'=>$email,'password'=>$password])) {
            // Authentication passed...
            return redirect('organization/dashboard');
        }}
        return redirect('login');

        //return UserResource::make($user);
    }

    public function logout(Request $request)
    {
        Session::flush();

        Auth::logout();

        return redirect('login');
    }
}
