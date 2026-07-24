<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomePageQLCLController extends Controller
{
    // HOME PAGE
    public function homePage()
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        // Số lượng đơn nghỉ phép đã duyệt
        $countLeaveRequestApproved = DB::table('leave_requests')->where('status','approved')->count('users_id');
        // Số lượng đơn nghỉ phép đang chờ
        $countLeaveRequestPending = DB::table('leave_requests')->where('status','pending')->count('users_id');
        // Số lượng đơn nghỉ phép từ chối
        $countLeaveRequestRejected = DB::table('leave_requests')->where('status','rejected')->count('users_id');
        // Số lượng nhân viên chấm công hôm nay
        $countAttendanceToday = DB::table('attendances')->where('work_date','2026-06-30')->count('users_id');
        // Số lượng nhân viên chấm công tháng này
        $countAttendanceForMonth = DB::table('attendances')->distinct('users_id')->whereMonth('work_date','06')->count();
        
        return view('qlcl.home',compact('countLeaveRequestApproved','countLeaveRequestPending','countLeaveRequestRejected','countAttendanceToday','countAttendanceForMonth'));
    }
}
