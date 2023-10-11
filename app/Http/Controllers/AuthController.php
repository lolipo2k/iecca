<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'email' => ['required', 'email']
        ]);

        $credentials = array(
            'username' => $request->username,
            'password' => $request->password
        );

        User::create([
            'username' => $request->username,
            'password_hash' => $request->password,
            'email' => $request->email,
        ]);

        Auth::attempt($credentials, true);
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        Auth::attempt($credentials, true);
    }

    public function comments(Request $request)
    {
        $user = new User();
        $user = $user::where('id', $request->id)->first();

        return view("user", compact('user'));
    }
}
