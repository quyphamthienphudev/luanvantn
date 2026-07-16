<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\User;

class AttendanceControllerNV extends Controller
{
    // SHOW ATTENDANCE
    public function index()
    {
        if (auth()->user()->role->name !== 'user') 
        {
            return back();
        }
        $today = Carbon::today()->toDateString();
        $attendance = Attendance::where('users_id', Auth::id())->where('work_date', $today)->first();
        return view('user.attendances.index', compact('attendance'));
    }

    //CHECK IN
    public function checkIn()
    {
        if (auth()->user()->role->name !== 'user') 
        {
            return back();
        }
        $today = Carbon::today()->toDateString();
        $attendance = Attendance::where('users_id', Auth::id())->where('work_date', $today)->first();
        if ($attendance && $attendance->check_in) 
        {
            return back()->with('success', 'Bạn đã chấm công vào làm');
        }
        $currentTime = Carbon::now();
        $status = $currentTime->format('H:i:s') > '08:00:00' ? 'late' : 'present';
        if (!$attendance) 
        {
            Attendance::create([
                'users_id'  => Auth::id(),
                'work_date' => $today,
                'check_in'  => $currentTime->format('H:i:s'),
                'status'    => $status,
                'confirm'   => 'no'
            ]);
        } 
        else 
        {
            $attendance->update([
                'check_in' => $currentTime->format('H:i:s'),
                'status'   => $status,
                'confirm'  => 'no'
            ]);
        }
        return back()->with('success', 'Chấm công vào làm thành công');
    }

    //CHECK OUT
    public function checkOut()
    {
        if (auth()->user()->role->name !== 'user') 
        {
            return back();
        }
        $today = Carbon::today()->toDateString();
        $attendance = Attendance::where('users_id', Auth::id())->where('work_date', $today)->first();
        if ($attendance->check_out) 
        {
            return back()->with('success', 'Bạn đã chấm công tan ca');
        }
        $attendance->update(['check_out' => Carbon::now()->format('H:i:s')]);
        return back()->with('success', 'Chấm công tan ca thành công');
    }
}
