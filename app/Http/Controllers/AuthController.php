<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
}
