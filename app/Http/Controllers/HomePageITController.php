<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomePageITController 
{
    // HOME PAGE
    public function homePage()
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }
        // Accounts đang hoạt động
        $a_active = DB::table('users')->where('status', 'active')->count('email');

        // Accounts đã tạm dừng
        $a_suspended = DB::table('users')->where('status', 'suspended')->count('email');

        // Accounts
        $accounts = DB::table('users')->count('email');

        return view('httt.home', compact('a_active', 'a_suspended', 'accounts'));
    }
}
