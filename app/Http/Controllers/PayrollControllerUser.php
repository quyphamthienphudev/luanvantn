<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollControllerUser extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));
        
        $payrolls = DB::table('payrolls')
            ->leftJoin('employees', 'payrolls.employee_id', '=', 'employees.id')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->where('payrolls.month', $month)
            ->where('payrolls.year', $year)
            ->select(
                'payrolls.*',
                'employees.employee_code',
                'employees.full_name',
                'positions.name as position_name',
                'departments.name as department_name'
            )
            ->get();
        
        $employees = DB::table('employees')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*', 'positions.name as position_name', 'positions.base_salary')
            ->get();
        
        return view('user.payrolls.index', compact('payrolls', 'employees', 'month', 'year'));
    }

    public function create()
    {
        $employees = DB::table('employees')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*', 'positions.name as position_name', 'positions.base_salary')
            ->get();
            
        return view('user.payrolls.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2020|max:2030',
            'bonus' => 'nullable|integer|min:0',
            'deduction' => 'nullable|integer|min:0'
        ]);

        $exists = DB::table('payrolls')
            ->where('employee_id', $request->employee_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->exists();
            
        if ($exists) {
            return redirect()->back()->with('error', 'Bảng lương đã tồn tại.')->withInput();
        }

        $employee = DB::table('employees')->where('id', $request->employee_id)->first();
        $position = DB::table('positions')->where('id', $employee->position_id)->first();
        
        $base_salary = $position->base_salary ?? 0;
        $bonus = $request->bonus ?? 0;
        $deduction = $request->deduction ?? 0;
        $total_salary = $base_salary + $bonus - $deduction;
        
        DB::table('payrolls')->insert([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'base_salary' => $base_salary,
            'bonus' => $bonus,
            'deduction' => $deduction,
            'total_salary' => $total_salary
        ]);

        return redirect('/payrolls')
            ->with('success', 'Tạo bảng lương thành công.');
    }

    public function show($id)
    {
        $payroll = DB::table('payrolls')
            ->where('payrolls.id', $id)
            ->leftJoin('employees', 'payrolls.employee_id', '=', 'employees.id')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
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

    public function edit($id)
    {
        $payroll = DB::table('payrolls')->where('id', $id)->first();
        $employees = DB::table('employees')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*', 'positions.name as position_name', 'positions.base_salary')
            ->get();
            
        return view('user.payrolls.edit', compact('payroll', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2020|max:2030',
            'bonus' => 'nullable|integer|min:0',
            'deduction' => 'nullable|integer|min:0'
        ]);

        $exists = DB::table('payrolls')
            ->where('employee_id', $request->employee_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->where('id', '!=', $id)
            ->exists();
            
        if ($exists) {
            return redirect()->back()->with('error', 'Bảng lương đã tồn tại.')->withInput();
        }

        $employee = DB::table('employees')->where('id', $request->employee_id)->first();
        $position = DB::table('positions')->where('id', $employee->position_id)->first();
        
        $base_salary = $position->base_salary ?? 0;
        $bonus = $request->bonus ?? 0;
        $deduction = $request->deduction ?? 0;
        $total_salary = $base_salary + $bonus - $deduction;
        
        DB::table('payrolls')->where('id', $id)->update([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'base_salary' => $base_salary,
            'bonus' => $bonus,
            'deduction' => $deduction,
            'total_salary' => $total_salary
        ]);

        return redirect('/payrolls')
            ->with('success', 'Cập nhật bảng lương thành công.');
    }
}
