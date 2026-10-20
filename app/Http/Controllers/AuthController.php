<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('student.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember', false);

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->isAdmin()) {
                $intended = $request->session()->pull('url.intended', route('admin.dashboard'));
                $target = str_contains($intended, '/admin') ? $intended : route('admin.dashboard');

                return redirect($target)->with('success', 'Welcome back, Administrator');
            }

            // Student login: clear any stored admin url.intended to prevent 403 unauthorized error
            $intended = $request->session()->pull('url.intended', route('student.dashboard'));
            $target = (str_contains($intended, '/student') && ! str_contains($intended, '/admin'))
                ? $intended
                : route('student.dashboard');

            return redirect($target)->with('success', 'Welcome to your Student Portal');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out safely.');
    }
}
