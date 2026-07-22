<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PayrollControllerUser extends Controller
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
            ->leftJoin('employees', 'payrolls.employee_id', '=', 'employees.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select(
                'employees.employee_code',
                'employees.full_name',
                'departments.name as department_name',
                'positions.name as position_name',
                'payrolls.base_salary',
                'allowance',
                'bonus',
                'deduction',
                'work_numbers',
                'month',
                'year',
                'total_salary',
            )
            ->where('employees.full_name', $fullName)
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        return view('user.payrolls.show', compact('payroll'));
    }
}