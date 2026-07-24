<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardControllerAdmin extends Controller
{
    public function dashboard(Request $request)
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
                'departments.name as department_name',
                DB::raw('COUNT(employees.id) as total_employees')
            )
            ->where('status','working')
            ->groupBy('departments.name')
            ->orderBy('departments.name','asc')
            ->get();

        // Tách dữ liệu cho biểu đồ
        $deptLabels = $employeesByDepartment->pluck('department_name');
        $deptData = $employeesByDepartment->pluck('total_employees');

        // ===== THỐNG KÊ LƯƠNG =====
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));

        $totalYearSalary = 0;
        $totalMonthSalary = 0;

        // Tổng lương theo năm
        if($request->has('filter_year'))
        {
            $totalYearSalary = DB::table('payrolls')->where('year', $year)->sum('total_salary');
        }

        // Tổng lương theo tháng và năm
        if($request->has('filter_month'))
        {
            $totalMonthSalary = DB::table('payrolls')->where('month', $month)->where('year', $year)->sum('total_salary');
        }

        return view('admin.dashboard', compact('e_working','e_resign','employees','deptLabels','deptData','totalYearSalary','totalMonthSalary','year','month'));
    }
}