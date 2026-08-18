<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomePageQLCLController 
{
    // HOME PAGE
    public function homePage(Request $request)
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        $today = Carbon::now()->today();
        $month = $request->get('month', date('m'));
        // Số lượng đơn nghỉ phép đã duyệt
        $countLeaveRequestApproved = DB::table('leave_requests')->where('status', 'approved')->count('users_id');
        // Số lượng đơn nghỉ phép đang chờ
        $countLeaveRequestPending = DB::table('leave_requests')->where('status', 'pending')->count('users_id');
        // Số lượng đơn nghỉ phép từ chối
        $countLeaveRequestRejected = DB::table('leave_requests')->where('status', 'rejected')->count('users_id');
        // Số lượng nhân viên chấm công hôm nay
        $countAttendanceToday = DB::table('attendances')->where('work_date', $today)->count('users_id');
        // Số lượng nhân viên chấm công tháng này
        $countAttendanceForMonth = DB::table('attendances')->distinct('users_id')->whereMonth('work_date', $month)->count('users_id');
        
        return view('qlcl.home',compact('countLeaveRequestApproved', 'countLeaveRequestPending', 'countLeaveRequestRejected', 'countAttendanceToday', 'countAttendanceForMonth'));
    }
}
