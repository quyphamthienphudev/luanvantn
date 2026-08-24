<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController 
{
    public function showLogin()
    {
        if (auth()->check()) 
        {
            if (auth()->user()->role->name === 'admin') 
            {
                return redirect('/admin/home');
            }
            if (auth()->user()->role->name === 'hcns') 
            {
                return redirect('/hcns/home');
            }
            if (auth()->user()->role->name === 'qlcl') 
            {
                return redirect('/qlcl/home');
            }
            if (auth()->user()->role->name === 'httt') 
            {
                return redirect('/httt/home');
            }
            return redirect('/home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();
        if ($user)
        {
            if ($user->status === 'suspend') 
            {
                return back()->with('error', 'Tài khoản này đang bị tạm dừng');
            }
            if (Auth::attempt($credentials)) 
            {
                if (auth()->user()->role->name === 'admin') 
                {
                    return redirect('/admin/home');
                }
                if (auth()->user()->role->name === 'hcns') 
                {
                    return redirect('/hcns/home');
                }
                if (auth()->user()->role->name === 'qlcl') 
                {
                    return redirect('/qlcl/home');
                }
                if (auth()->user()->role->name === 'httt') 
                {
                    return redirect('/httt/home');
                }
                return redirect('/home');
            }
        }
        return back()->with('error', 'Email hoặc mật khẩu không đúng');
    }

    public function logout()
    {
        if(!auth()->check())
        {
            return back();
        }
        Auth::logout();
        return redirect('/login');
    }
}