<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return inertia('Auth/Login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'password' => 'The provided credentials do not match our records.',
        ])->onlyInput('password');
    }

    public function logout(Request $request) {

        Auth::logout();

        $request->session()->invalidate();
        $request->user()->currentAccessToken()->delete();
        $token = $request->user()->token();
        $token->revoke();

        return redirect('/');

    }
}
