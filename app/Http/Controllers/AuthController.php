<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    public function create(Request $request)
    {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(),[
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $array['error'] = $validator->messages();
        }

        $user = new User;
        $user->email    = $request->input('email');
        $user->password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $user->save();

        return $array;
    }

    function login(Request $request)
    {
        $array = ['error' => ''];

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::where('email', $request->email)->first();

            $array['token'] = $user->createToken(time().rand(0, 999))->plainTextToken;
        } else {
            $array['error'] = 'Email e/ou senha incorretos';

        }

        return $array;
    }

    function logout(Request $request) {
        $array = ['error' => ''];

        $request->user()->tokens()->delete();

        return $array;
    }
}
