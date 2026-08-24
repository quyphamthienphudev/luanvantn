<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePageAdminController 
{
    public function homePage()
    {
        if (auth()->user()->role->name !== 'admin') 
        {
            return back();
        }
        $e_working = DB::table('employees')->where('status', 'working')->count('employee_code');
        $e_resign = DB::table('employees')->where('status', 'resigned')->count('employee_code');
        $employees = DB::table('employees')->count('employee_code');
        $employeesByDepartment = DB::table('employees')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select(
                'name',
                DB::raw('COUNT(employee_code) as total_employees')
            )
            ->where('status', 'working')
            ->groupBy('name')
            ->get();
        $deptLabels = $employeesByDepartment->pluck('name');
        $deptData = $employeesByDepartment->pluck('total_employees');
        return view('admin.home', compact('e_working', 'e_resign', 'employees', 'deptLabels', 'deptData'));
    }
}
