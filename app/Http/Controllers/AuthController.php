<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function signin(Request $request)
    {

        $request->validate([
            'email' => 'required|email|min:8|max:50',
            'password' => 'required|min:8|max:50'
        ]);

        $remember_me = $request->has('remember_me') ? true : false;

        if (Auth::attempt($request->only('email', 'password'), $remember_me)) {
            return redirect()->route('home');
        } else {
            return redirect()->back();
        }
    }

    public function signout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
