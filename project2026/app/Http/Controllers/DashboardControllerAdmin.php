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
        //employees đang làm việc
        $e_working = DB::table('employees')->where('status','working')->count();

        //employees đã nghỉ việc
        $e_resign = DB::table('employees')->where('status','resigned')->count();

        //employees
        $employees = DB::table('employees')->count();

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

        // ===== THỐNG KÊ LƯƠNG =====
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));

        $totalYearSalary = 0;
        $totalMonthSalary = 0;

        // Tổng lương theo năm
        if($request->has('filter_year'))
        {
            if(!$year)
            {
                return back()->with('error_year','Vui lòng nhập năm để thống kê');
            }
            else 
            {
                $totalYearSalary = DB::table('payrolls')->whereRaw("year = ?", [$year])->sum('total_salary');
            }
        }

        // Tổng lương theo tháng và năm
        if($request->has('filter_month'))
        {
            if(!$month || !$year)
            {
                return back()->with('error_month','Vui lòng điền đầy đủ tháng và năm để thống kê');
            }
            else 
            {
                $totalMonthSalary = DB::table('payrolls')->whereRaw("year = ?", [$year])->whereRaw("month = ?", [$month])->sum('total_salary');
            }
        }

        return view('admin.dashboard',[
            'e_working'=>$e_working,
            'e_resign'=>$e_resign,
            'employees'=>$employees,
            'deptLabels'=>$deptLabels,'deptData'=>$deptData,
            'totalYearSalary'=>$totalYearSalary,
            'totalMonthSalary'=>$totalMonthSalary,'year'=>$year,'month'=>$month
        ]);
    }
}
