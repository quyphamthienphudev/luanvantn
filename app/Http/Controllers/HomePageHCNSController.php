<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomePageHCNSController 
{
    // HOME PAGE
    public function homePage(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        // Employees đang làm việc
        $e_working = DB::table('employees')->where('status', 'working')->count('employee_code');

        // Employees đã nghỉ việc
        $e_resign = DB::table('employees')->where('status', 'resigned')->count('employee_code');

        // Employees
        $employees = DB::table('employees')->count('employee_code');

        // ===== THỐNG KÊ NHÂN VIÊN THEO PHÒNG BAN =====
        $employeesByDepartment = DB::table('employees')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select(
                'name',
                DB::raw('COUNT(employee_code) as total_employees')
            )
            ->where('status', 'working')
            ->groupBy('name')
            ->get();

        // Tách dữ liệu cho biểu đồ
        $deptLabels = $employeesByDepartment->pluck('name');
        $deptData = $employeesByDepartment->pluck('total_employees');

        $today = Carbon::now()->today();
        $month = $request->get('month', date('m'));
        // Số lượng nhân viên chấm công hôm nay
        $countAttendanceToday = DB::table('attendances')->where('work_date', $today)->count('users_id');
        // Số lượng nhân viên chấm công tháng này
        $countAttendanceForMonth = DB::table('attendances')->distinct('users_id')->whereMonth('work_date', $month)->count('users_id');

        return view('hcns.home', compact('e_working', 'e_resign', 'employees', 'deptLabels', 'deptData', 'countAttendanceToday', 'countAttendanceForMonth'));
    }
}
