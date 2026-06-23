<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceController extends Controller
{

    public function index()
    {
        $attendances = Attendance::with('user')->orderBy('work_date', 'desc')->get();
        return view('qlcl.attendances.index', compact('attendances'));
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees = Employee::all();
        return view('qlcl.attendances.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, $id)
    {
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
        return redirect('/qlcl/attendances')->with('success','Cập nhật chấm công thành công');
    }

    public function delete($id)
    {
        Attendance::findOrFail($id)->delete();
        return back()->with('success','Xóa dữ liệu chấm công thành công');
    }

    public function confirm($id)
    {
        DB::table('attendances')->where('id',$id)->update(['confirm' => 'yes']);
        return redirect('/qlcl/attendances')->with('success','Xác nhận chấm công thành công');
    }
}
