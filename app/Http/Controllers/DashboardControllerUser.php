<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardControllerUser extends Controller
{
    public function userDashboard()
    {
        // departments
        $department = DB::table('departments')->count();

        // ===== THỐNG KÊ NHÂN VIÊN THEO PHÒNG BAN =====
        $employeesByDepartment = DB::table('employees')
            ->join('departments','employees.department_id','=','departments.id')
            ->select(
                'departments.name as department_name',
                DB::raw('COUNT(employees.id) as total_employees')
            )
            ->groupBy('departments.name')
            ->orderBy('departments.name','asc')
            ->get();

        // Tách dữ liệu cho biểu đồ
        $deptLabels = $employeesByDepartment->pluck('department_name');
        $deptData = $employeesByDepartment->pluck('total_employees');

        // ===== THỐNG KÊ TỶ LỆ NGHỈ PHÉP (leave_requests) =====
        $pendingCount = DB::table('leave_requests')
            ->where('status','pending')
            ->count();

        $approvedCount = DB::table('leave_requests')
            ->where('status','approved')
            ->count();

        $rejectedCount = DB::table('leave_requests')
            ->where('status','rejected')
            ->count();

        // Dữ liệu cho biểu đồ
        $leaveLabels = ['Chờ duyệt', 'Đã duyệt', 'Từ chối'];
        $leaveData = [$pendingCount, $approvedCount, $rejectedCount];

        return view('user.dashboard',['deptLabels'=>$deptLabels,'deptData'=>$deptData,
            'department'=>$department,'leaveLabels'=>$leaveLabels,'leaveData'=>$leaveData
        ]);
    }
}
