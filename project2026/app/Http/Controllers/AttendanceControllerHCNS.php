<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceControllerHCNS extends Controller
{

    public function index()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $attendances = Attendance::with('user')->orderBy('work_date', 'desc')->where('confirm','yes')->get();
        return view('hcns.attendances.index', compact('attendances'));
    }

    public function edit($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $attendance = Attendance::findOrFail($id);
        $employees = Employee::all();
        return view('hcns.attendances.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $request->validate([
            'work_date' => 'required|date'
        ],[
            'work_date.required' => 'Vui lòng chọn ngày chấm công'
        ]);

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
        return redirect('/hcns/attendances')->with('success','Cập nhật chấm công thành công');
    }

    public function delete($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        Attendance::findOrFail($id)->delete();
        return back()->with('success','Xóa dữ liệu chấm công thành công');
    }
}
