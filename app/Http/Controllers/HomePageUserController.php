<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveRequest;

class HomePageUserController 
{
    // HOME PAGE
    public function homePage()
    {
        if (auth()->user()->role->name !== 'user') 
        {
            return back();
        }
        // Số ngày nghỉ phép đã sử dụng
        $l_used = LeaveRequest::where('users_id', Auth::id())->where('status', 'approved')->sum('number_days');
        // Số ngày nghỉ phép còn lại
        $l_resume = 12 - $l_used;
        // Số ngày nghỉ phép cả năm
        $l_year = $l_used + $l_resume;

        return view('user.home', compact('l_used', 'l_resume', 'l_year'));
    }
}
