<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceController 
{

    public function index()
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        $attendances = DB::table('attendances')
                ->join('users', 'users.id', '=', 'attendances.users_id')
                ->join('employees', 'users.name', '=', 'employees.full_name')
                ->select('users.name','employee_code','work_date','check_in','check_out','attendances.status','confirm','attendances.id')
                ->orderBy('work_date', 'desc')
                ->paginate(357);
        return view('qlcl.attendances.index', compact('attendances'));
    }

    public function edit($id)
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        $attendance = DB::table('attendances')
                ->join('users', 'users.id', '=', 'attendances.users_id')
                ->join('employees', 'users.name', '=', 'employees.full_name')
                ->select('employee_code','users.name','work_date','check_in','check_out','attendances.id')
                ->where('attendances.id', $id)
                ->first();
        return view('qlcl.attendances.edit', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }

        $attendance = Attendance::findOrFail($id);
        
        // Xác định trạng thái theo giờ vào
        $status = 'absent';

        if(!empty($request->check_in))
        {
            if($request->check_in > '08:00')
            {
                $status = 'late';
            }
            else
            {
                $status = 'present';
            }
        }

        $attendance->update([
            'check_in'  => $request->check_in,
            'check_out' => $request->check_out,
            'status'    => $status
        ]);
        return redirect('/qlcl/attendances')->with('success','Cập nhật chấm công thành công');
    }

    public function delete($id)
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }

        Attendance::findOrFail($id)->delete();
        return back()->with('success','Xóa dữ liệu chấm công thành công');
    }

    public function confirm($id)
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        
        DB::table('attendances')->where('id',$id)->update(['confirm' => 'yes']);
        return redirect('/qlcl/attendances')->with('success','Xác nhận chấm công thành công');
    }
}
