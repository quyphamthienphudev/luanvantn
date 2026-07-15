<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PayrollControllerAdmin extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

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
        
        return view('hcns.payrolls.index', compact('payrolls', 'employees', 'month', 'year'));
    }

    public function create(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $employees = DB::table('employees')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*', 'positions.name as position_name', 'positions.base_salary')
            ->get();
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));
        return view('hcns.payrolls.create', compact('employees','month','year'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2001|max:2099',
            'allowance' => 'required|numeric'
        ],[
            'allowance.required' => 'Phụ cấp không được để trống',
            'allowance.numeric' => 'Phụ cấp chỉ được nhập số'
        ]);
        $exists = DB::table('payrolls')
            ->where('employee_id', $request->employee_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->exists();
        if ($exists) 
        {
            return back()->with('error', 'Bảng lương đã tồn tại');
        }
        $employee = DB::table('employees')->where('id', $request->employee_id)->first();
        $position = DB::table('positions')->where('id', $employee->position_id)->first();
        $base_salary = $position->base_salary ?? 0;
        $bonus = DB::table('reward_discipline')
                ->where('employee_id', $request->employee_id)
                ->where('type', 'reward')
                ->whereMonth('decision_date', $request->month)
                ->whereYear('decision_date', $request->year)
                ->sum('amount');
        $deduction = DB::table('reward_discipline')
                    ->where('employee_id', $request->employee_id)
                    ->where('type', 'discipline')
                    ->whereMonth('decision_date', $request->month)
                    ->whereYear('decision_date', $request->year)
                    ->sum('amount');
        $countLeave = DB::table('attendances')
                      ->leftJoin('users', 'users.id', '=', 'attendances.users_id')
                      ->where('users.name', $employee->full_name)->count();
        if($request->allowance > $base_salary)
        {
            return back()->with('error', 'Phụ cấp không được lớn hơn lương cơ bản');
        }
        $total_salary = ($base_salary + $request->allowance + $bonus - $deduction) / 26 * $countLeave;
        DB::table('payrolls')->insert([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'base_salary' => $base_salary,
            'allowance' => $request->allowance,
            'bonus' => $bonus,
            'deduction' => $deduction,
            'work_numbers' => $countLeave,
            'total_salary' => $total_salary
        ]);
        return redirect('/hcns/payrolls')->with('success', 'Tạo bảng lương thành công');
    }

    public function show($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

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
            
        return view('hcns.payrolls.show', compact('payroll'));
    }

    public function edit($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $payroll = DB::table('payrolls')->where('id', $id)->first();
        $employees = DB::table('employees')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*', 'positions.name as position_name', 'positions.base_salary')
            ->get();
        $request = DB::table('payrolls')->select('allowance')->where('id', $id)->first();
        return view('hcns.payrolls.edit', compact('payroll', 'employees','request'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2001|max:2099',
            'allowance' => 'required|numeric'
        ],[
            'allowance.required' => 'Phụ cấp không được để trống',
            'allowance.numeric' => 'Phụ cấp chỉ được nhập số'
        ]);
        $exists = DB::table('payrolls')
            ->where('employee_id', $request->employee_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->where('id', '!=', $id)
            ->exists();
        if ($exists) 
        {
            return back()->with('error', 'Bảng lương đã tồn tại');
        }
        $employee = DB::table('employees')->where('id', $request->employee_id)->first();
        $position = DB::table('positions')->where('id', $employee->position_id)->first();
        $base_salary = $position->base_salary ?? 0;
        $bonus = DB::table('reward_discipline')
                ->where('employee_id', $request->employee_id)
                ->where('type', 'reward')
                ->whereMonth('decision_date', $request->month)
                ->whereYear('decision_date', $request->year)
                ->sum('amount');
        $deduction = DB::table('reward_discipline')
                    ->where('employee_id', $request->employee_id)
                    ->where('type', 'discipline')
                    ->whereMonth('decision_date', $request->month)
                    ->whereYear('decision_date', $request->year)
                    ->sum('amount');
        $countLeave = DB::table('attendances')
                      ->leftJoin('users', 'users.id', '=', 'attendances.users_id')
                      ->where('users.name', $employee->full_name)->count();
        if($request->allowance > $base_salary)
        {
            return back()->with('error', 'Phụ cấp không được lớn hơn lương cơ bản');
        }
        $total_salary = ($base_salary + $request->allowance + $bonus - $deduction) / 26 * $countLeave;
        DB::table('payrolls')->where('id', $id)->update([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'base_salary' => $base_salary,
            'allowance' => $request->allowance,
            'bonus' => $bonus,
            'deduction' => $deduction,
            'work_numbers' => $countLeave,
            'total_salary' => $total_salary
        ]);
        return redirect('/hcns/payrolls')->with('success', 'Cập nhật bảng lương thành công');
    }

    public function delete($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $payroll = DB::table('payrolls')->where('id', $id)->first();
        DB::table('payrolls')->where('id', $id)->delete();
        return back()->with('success', 'Xóa bảng lương thành công');
    }

    public function export(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        
        $payrolls = DB::table('payrolls')
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
            ->orderBy('month','asc')
            ->orderBy('year','asc')
            ->get();

        if ($payrolls->isEmpty()) 
        {
            return back()->with('error', 'Không có dữ liệu');
        }
        
        $filename = 'bang_luong' . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF");
        
        fputcsv($output, ['STT', 'Mã nhân viên', 'Họ tên', 'Phòng ban', 'Chức vụ', 'Tháng', 'Năm', 'Lương cơ bản', 'Phụ cấp', 'Thưởng', 'Khấu trừ', 'Số ngày làm việc', 'Lương thực lãnh']);
        
        $stt = 1;
        foreach ($payrolls as $payroll) 
        {
            fputcsv($output, [
                $stt,
                $payroll->employee_code ?? '',
                $payroll->full_name ?? '',
                $payroll->department_name ?? '',
                $payroll->position_name ?? '',
                $payroll->month ?? '',
                $payroll->year ?? '',
                $payroll->base_salary ?? 0,
                $payroll->allowance ?? 0,
                $payroll->bonus ?? 0,
                $payroll->deduction ?? 0,
                $payroll->work_numbers ?? 0,
                $payroll->total_salary ?? 0
            ]);
            $stt++;
        }
        
        fclose($output);
        exit;
    }
}