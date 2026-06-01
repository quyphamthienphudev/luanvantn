<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardControllerAdmin extends Controller
{
    public function adminDashboard(Request $request)
    {
        // employees
        $working = DB::table('employees')->where('status','working')->count();

        //department
        $departments = DB::table('departments')->count();

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

        return view('admin.dashboard',['working'=>$working,
            'deptLabels'=>$deptLabels,'deptData'=>$deptData,
            'departments'=>$departments
        ]);
    }
}
