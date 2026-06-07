<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardControllerAdmin extends Controller
{
    public function adminDashboard(Request $request)
    {
        // employees tạo bởi admin
        $e_admin = DB::table('employees')
        ->join('users','employees.users_id','=','users.id')
        ->join('roles','users.role_id','=','roles.id')
        ->where('roles.id','1')->count();

        // employees tạo bởi user
        $e_user = DB::table('employees')
        ->join('users','employees.users_id','=','users.id')
        ->join('roles','users.role_id','=','roles.id')
        ->where('roles.id','2')->count();

        //employees
        $employees = DB::table('employees')->count();

        //department
        $departments = DB::table('departments')->count();

        //department tạo bởi admin
        $d_admin = DB::table('departments')
        ->join('users','departments.users_id','=','users.id')
        ->join('roles','users.role_id','=','roles.id')
        ->where('roles.id','1')->count();

        //department tạo bởi user
        $d_user = DB::table('departments')
        ->join('users','departments.users_id','=','users.id')
        ->join('roles','users.role_id','=','roles.id')
        ->where('roles.id','2')->count();

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

        return view('admin.dashboard',['e_admin'=>$e_admin,
            'e_user'=>$e_user, 'employees'=>$employees,
            'd_admin'=>$d_admin, 'd_user'=>$d_user,
            'deptLabels'=>$deptLabels,'deptData'=>$deptData,
            'departments'=>$departments
        ]);
    }
}
