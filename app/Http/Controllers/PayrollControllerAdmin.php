<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollControllerAdmin 
{
    public function index(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));
        $search = $request->search;

        if($search)
        {
            $payrolls = DB::table('payrolls')
            ->join('employees', 'payrolls.employee_id', '=', 'employees.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select(
                'employee_code',
                'full_name',
                'positions.name as position_name',
                'departments.name as department_name',
                'payrolls.base_salary',
                'allowance',
                'bonus',
                'deduction',
                'month_salary',
                'total_salary',
                'payrolls.id'
            )
            ->where('month', $month)
            ->where('year', $year)
            ->when($search, function ($query) use ($search) {

            // Tìm theo mã nhân viên, họ tên, tên phòng ban hoặc tên công việc
            $query->where('employee_code', 'like', '%' . $search . '%')
                  ->orWhere('full_name', 'like', '%' . $search . '%')
                  ->orWhere('departments.name', 'like', '%' . $search . '%')
                  ->orWhere('positions.name', 'like', '%' . $search . '%');
            })
            ->get();
        }
        else
        {
            $payrolls = DB::table('payrolls')
            ->join('employees', 'payrolls.employee_id', '=', 'employees.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->select(
                'employee_code',
                'full_name',
                'positions.name as position_name',
                'departments.name as department_name',
                'payrolls.base_salary',
                'allowance',
                'bonus',
                'deduction',
                'month_salary',
                'total_salary',
                'payrolls.id'
            )
            ->where('month', $month)
            ->where('year', $year)
            ->where('employee_code', '!=', 'EMP001')
            ->where('employee_code', '!=', 'EMP016')
            ->where('employee_code', '!=', 'EMP021')
            ->orderBy('employee_code', 'asc')
            ->get();
        }
        
        return view('hcns.payrolls.index', compact('month', 'year', 'search', 'payrolls'));
    }

    public function create(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $employees = DB::table('employees')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->select('employees.*', 'positions.name as position_name', 'base_salary')
            ->where('employee_code', '!=', 'EMP001')
            ->where('employee_code', '!=', 'EMP016')
            ->where('employee_code', '!=', 'EMP021')
            ->orderBy('employee_code', 'asc')
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
            'allowance' => 'required|numeric|min:0'
        ],[
            'allowance.required' => 'Phụ cấp không được để trống.',
            'allowance.numeric' => 'Phụ cấp chỉ được nhập số.',
            'allowance.min' => 'Phụ cấp không hợp lệ, vui lòng kiểm tra lại.'
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
        $contract = DB::table('contracts')->where('id', $request->employee_id)->first();
        if($contract->contract_type == 'probation')
        {
            $base_salary = $position->base_salary * 85 / 100 ?? 0;
        }
        else
        {
            $base_salary = $position->base_salary ?? 0;
        }
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
                      ->join('users', 'attendances.users_id', '=', 'users.id')
                      ->where('name', $employee->full_name)
                      ->whereMonth('work_date', $request->month)
                      ->whereYear('work_date', $request->year)
                      ->where('confirm', 'yes')
                      ->count();
        if($countLeave == 0)
        {
            return back()->with('error', 'Nhân viên chưa có dữ liệu chấm công, vui lòng kiểm tra lại');
        }
        if($request->allowance > $base_salary)
        {
            return back()->with('error', 'Phụ cấp không được lớn hơn lương cơ bản');
        }
        $month_salary = ($base_salary + $request->allowance) / 26 * $countLeave;
        $total_salary = $month_salary + $bonus - $deduction;
        DB::table('payrolls')->insert([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'base_salary' => $base_salary,
            'allowance' => $request->allowance,
            'bonus' => $bonus,
            'deduction' => $deduction,
            'work_numbers' => $countLeave,
            'month_salary' => $month_salary,
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
                'month_salary',
                'total_salary',
                'month',
                'year'
            )
            ->where('payrolls.id', $id)
            ->first();
            
        return view('hcns.payrolls.show', compact('payroll'));
    }

    public function edit($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $exists = DB::table('payrolls')->where('id', $id)->exists();
        if($exists)
        {
            $payroll = DB::table('payrolls')->where('id', $id)->first();
            $employees = DB::table('employees')
                ->join('positions', 'employees.position_id', '=', 'positions.id')
                ->select('employees.*', 'positions.name as position_name', 'base_salary')
                ->where('employee_code', '!=', 'EMP001')
                ->where('employee_code', '!=', 'EMP016')
                ->where('employee_code', '!=', 'EMP021')
                ->get();
            $request = DB::table('payrolls')->select('allowance')->where('id', $id)->first();
            return view('hcns.payrolls.edit', compact('payroll', 'employees', 'request'));
        }
        return back();
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
            'allowance' => 'required|numeric|min:0'
        ],[
            'allowance.required' => 'Phụ cấp không được để trống.',
            'allowance.numeric' => 'Phụ cấp chỉ được nhập số.',
            'allowance.min' => 'Phụ cấp không hợp lệ, vui lòng kiểm tra lại.'
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
        $contract = DB::table('contracts')->where('id', $request->employee_id)->first();
        if($contract->contract_type == 'probation')
        {
            $base_salary = $position->base_salary * 85 / 100 ?? 0;
        }
        else
        {
            $base_salary = $position->base_salary ?? 0;
        }
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
                      ->join('users', 'attendances.users_id', '=', 'users.id')
                      ->where('name', $employee->full_name)
                      ->whereMonth('work_date', $request->month)
                      ->whereYear('work_date', $request->year)
                      ->where('confirm', 'yes')
                      ->count();
        if($countLeave == 0)
        {
            return back()->with('error', 'Nhân viên chưa có dữ liệu chấm công, vui lòng kiểm tra lại');
        }
        if($request->allowance > $base_salary)
        {
            return back()->with('error', 'Phụ cấp không được lớn hơn lương cơ bản');
        }
        $month_salary = ($base_salary + $request->allowance) / 26 * $countLeave;
        $total_salary = $month_salary + $bonus - $deduction;
        DB::table('payrolls')->where('id', $id)->update([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'base_salary' => $base_salary,
            'allowance' => $request->allowance,
            'bonus' => $bonus,
            'deduction' => $deduction,
            'work_numbers' => $countLeave,
            'month_salary' => $month_salary,
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

        DB::table('payrolls')->where('id', $id)->delete();
        
        return back()->with('success', 'Xóa bảng lương thành công');
    }

    public function export()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $payrolls = DB::table('payrolls')
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
                'total_salary'
            )
            ->where('employee_code', '!=', 'EMP001')
            ->where('employee_code', '!=', 'EMP016')
            ->where('employee_code', '!=', 'EMP021')
            ->orderBy('month', 'asc')
            ->orderBy('year', 'asc')
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
        
        fputcsv($output, ['STT', 'Mã nhân viên', 'Họ tên', 'Phòng ban', 'Công việc', 'Tháng', 'Năm', 'Lương cơ bản', 'Phụ cấp', 'Thưởng', 'Khấu trừ', 'Số ngày làm việc', 'Lương thực lãnh']);
        
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