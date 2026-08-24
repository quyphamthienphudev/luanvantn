<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveRequest;

class HomePageUserController 
{
    public function homePage()
    {
        if (auth()->user()->role->name !== 'user') 
        {
            return back();
        }
        $l_used = LeaveRequest::where('users_id', Auth::id())->where('status', 'approved')->sum('number_days');
        $l_resume = 12 - $l_used;
        $l_year = $l_used + $l_resume;
        return view('user.home', compact('l_used', 'l_resume', 'l_year'));
    }
}
