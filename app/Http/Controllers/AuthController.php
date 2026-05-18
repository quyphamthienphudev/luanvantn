<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->check()) {

            if (auth()->user()->role->name === 'admin') {
                return redirect('/admin/home');
            }

            return redirect('/home');
        }

    return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            if (Auth::user()->role->name === 'admin') {
                return redirect('/admin/home');
            }

            return redirect('/home');
        }

        return back()->with('error', 'Email hoặc mật khẩu không đúng');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
