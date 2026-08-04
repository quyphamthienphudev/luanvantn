<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PayrollControllerUser 
{

    public function show()
    {
        if (auth()->user()->role->name !== 'user') 
        {
            return back();
        }

        $fullName = auth()->user()->name;
        $month = Carbon::today()->month;
        $year = Carbon::today()->year;

        $payroll = DB::table('payrolls')
            ->join('employees', 'payrolls.employee_id', '=', 'employees.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select(
                'employee_code',
                'full_name',
                'departments.name as department_name',
                'positions.name as position_name',
                'payrolls.base_salary',
                'allowance',
                'bonus',
                'deduction',
                'work_numbers',
                'month',
                'year',
                'month_salary',
                'total_salary',
            )
            ->where('full_name', $fullName)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        return view('user.payrolls.show', compact('payroll'));
    }
}