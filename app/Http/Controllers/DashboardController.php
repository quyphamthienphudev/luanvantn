<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // employees
        $working = DB::table('employees')->where('status','working')->count();

        // ===== THỐNG KÊ LƯƠNG =====
        $year = $request->year;
        $month = $request->month;

        $totalYearSalary = 0;
        $totalMonthSalary = 0;

        // Tổng lương theo năm
        if($request->has('filter_year')){
            if(!$year){
                return back()->with('error_year','Vui lòng nhập năm để thống kê');
            }
            else if(!is_numeric($year))
            {
                return back()->with('error_year','Vui lòng nhập năm thống kê là số');
            }
            else {
                $totalYearSalary = DB::table('payrolls')
                    ->whereRaw("year = ?", [$year])
                    ->sum('total_salary');
            }
        }

        // Tổng lương theo tháng + năm
        if($request->has('filter_month')){
            if(!$month || !$year){
                return back()->with('error_month','Vui lòng điền đầy đủ tháng và năm để thống kê');
            }
            else if(!is_numeric($year))
            {
                return back()->with('error_year','Vui lòng nhập năm thống kê là số');
            }
            else {
                $totalMonthSalary = DB::table('payrolls')
                    ->whereRaw("year = ?", [$year])
                    ->whereRaw("month = ?", [$month])
                    ->sum('total_salary');
            }
        }

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

        return view('admin.dashboard',['working'=>$working,
            'totalYearSalary'=>$totalYearSalary,'totalMonthSalary'=>$totalMonthSalary,
            'year'=>$year,'month'=>$month,'deptLabels'=>$deptLabels,'deptData'=>$deptData,
            'leaveLabels'=>$leaveLabels,'leaveData'=>$leaveData
        ]);
    }

    public function userdashboard()
    {
        // employees
        $working = DB::table('employees')->where('status','working')->count();

        return view('user.dashboard',compact('working'));
    }
}
