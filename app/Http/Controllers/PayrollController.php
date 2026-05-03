<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
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
        
        return view('payrolls.index', compact('payrolls', 'employees', 'month', 'year'));
    }

    public function create()
    {
        $employees = DB::table('employees')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*', 'positions.name as position_name', 'positions.base_salary')
            ->get();
            
        return view('payrolls.create', compact('employees'));
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
            'total_salary' => $total_salary,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $routeName = auth()->user()->role->name === 'admin' ? 'admin.payrolls.index' : 'user.payrolls.index';
        return redirect()->route($routeName, ['month' => $request->month, 'year' => $request->year])
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
            
        return view('payrolls.show', compact('payroll'));
    }

    public function edit($id)
    {
        $payroll = DB::table('payrolls')->where('id', $id)->first();
        $employees = DB::table('employees')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*', 'positions.name as position_name', 'positions.base_salary')
            ->get();
            
        return view('payrolls.edit', compact('payroll', 'employees'));
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
            'total_salary' => $total_salary,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.payrolls.index', ['month' => $request->month, 'year' => $request->year])
            ->with('success', 'Cập nhật bảng lương thành công.');
    }

    public function destroy($id)
    {
        $payroll = DB::table('payrolls')->where('id', $id)->first();
        DB::table('payrolls')->where('id', $id)->delete();

        return redirect()->route('admin.payrolls.index', ['month' => $payroll->month, 'year' => $payroll->year])
            ->with('success', 'Xóa bảng lương thành công.');
    }

    public function export(Request $request)
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
        
        if ($payrolls->isEmpty()) {
            return redirect()->back()->with('error', 'Không có dữ liệu.');
        }
        
        $filename = 'bang_luong_' . $month . '_' . $year . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF");
        
        fputcsv($output, ['STT', 'Mã nhân viên', 'Họ tên', 'Phòng ban', 'Chức vụ', 'Lương cơ bản', 'Thưởng', 'Khấu trừ', 'Tổng lương']);
        
        $stt = 1;
        foreach ($payrolls as $payroll) {
            fputcsv($output, [
                $stt,
                $payroll->employee_code ?? '',
                $payroll->full_name ?? '',
                $payroll->department_name ?? '',
                $payroll->position_name ?? '',
                $payroll->base_salary ?? 0,
                $payroll->bonus ?? 0,
                $payroll->deduction ?? 0,
                $payroll->total_salary ?? 0
            ]);
            $stt++;
        }
        
        fclose($output);
        exit;
    }
}
