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
        $attendances = Attendance::with('user')->orderBy('work_date', 'desc')->where('confirm','yes')->get();
        return view('hcns.attendances.index', compact('attendances'));
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees = Employee::all();
        return view('hcns.attendances.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'work_date' => 'required|date',
            'status' => 'required'
        ],[
            'work_date.required' => 'Vui lòng chọn ngày chấm công',
            'status.required' => 'Vui lòng chọn trạng thái'
        ]);

        Attendance::findOrFail($id)->update($request->all());
        return redirect('/hcns/attendances')->with('success','Cập nhật chấm công thành công');
    }

    public function delete($id)
    {
        Attendance::findOrFail($id)->delete();
        return back()->with('success','Xóa dữ liệu chấm công thành công');
    }
}
