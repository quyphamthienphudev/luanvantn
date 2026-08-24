<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePageITController 
{
    public function homePage()
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }
        $a_active = DB::table('users')->where('status', 'active')->count('email');
        $a_suspended = DB::table('users')->where('status', 'suspended')->count('email');
        $accounts = DB::table('users')->count('email');
        return view('httt.home', compact('a_active', 'a_suspended', 'accounts'));
    }
}
