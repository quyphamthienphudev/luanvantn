<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PayrollControllerUser extends Controller
{

    public function show()
    {
        $userId = auth()->id();

        $payroll = DB::table('payrolls')
            ->join('employees', 'payrolls.employee_id', '=', 'employees.id')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->where('employees.users_id', $userId)
            ->select(
                'payrolls.*',
                'employees.employee_code',
                'employees.full_name',
                'positions.name as position_name',
                'departments.name as department_name'
            )
            ->first();

        return view('user.payrolls.show', compact('payroll'));
    }
}
