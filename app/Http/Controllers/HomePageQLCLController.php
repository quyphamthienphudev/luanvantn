<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomePageQLCLController 
{
    public function homePage(Request $request)
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        $today = Carbon::now()->today();
        $month = $request->get('month', date('m'));
        $countLeaveRequestApproved = DB::table('leave_requests')->where('status', 'approved')->count('users_id');
        $countLeaveRequestPending = DB::table('leave_requests')->where('status', 'pending')->count('users_id');
        $countLeaveRequestRejected = DB::table('leave_requests')->where('status', 'rejected')->count('users_id');
        $countAttendanceToday = DB::table('attendances')->where('work_date', $today)->count('users_id');
        $countAttendanceForMonth = DB::table('attendances')->distinct('users_id')->whereMonth('work_date', $month)->count('users_id');
        return view('qlcl.home',compact('countLeaveRequestApproved', 'countLeaveRequestPending', 'countLeaveRequestRejected', 'countAttendanceToday', 'countAttendanceForMonth'));
    }
}
