<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardAdvancedControllerAdmin 
{
    public function dashboardAdvanced(Request $request)
    {
        if (auth()->user()->role->name !== 'admin') 
        {
            return back();
        }

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

        return view('admin.dashboard', compact('totalYearSalary','totalMonthSalary','month','year'));
    }
}