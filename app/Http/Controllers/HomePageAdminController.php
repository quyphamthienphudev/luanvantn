<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomePageAdminController 
{
    // HOME PAGE
    public function homePage(Request $request)
    {
        if (auth()->user()->role->name !== 'admin') 
        {
            return back();
        }
        // Employees đang làm việc
        $e_working = DB::table('employees')->where('status','working')->count('employee_code');

        // Employees đã nghỉ việc
        $e_resign = DB::table('employees')->where('status','resigned')->count('employee_code');

        // Employees
        $employees = DB::table('employees')->count('employee_code');

        // ===== THỐNG KÊ NHÂN VIÊN THEO PHÒNG BAN =====
        $employeesByDepartment = DB::table('employees')
            ->join('departments','employees.department_id','=','departments.id')
            ->select(
                'name',
                DB::raw('COUNT(employee_code) as total_employees')
            )
            ->where('status','working')
            ->groupBy('name')
            ->get();

        // Tách dữ liệu cho biểu đồ
        $deptLabels = $employeesByDepartment->pluck('name');
        $deptData = $employeesByDepartment->pluck('total_employees');

        return view('admin.home', compact('e_working','e_resign','employees','deptLabels','deptData'));
    }
}
