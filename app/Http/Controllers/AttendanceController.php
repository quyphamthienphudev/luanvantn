<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    public function adminIndex()
    {
        $attendances = Attendance::with('employee')->orderBy('work_date', 'desc')->get();
        return view('admin.attendances.index', compact('attendances'));
    }

    public function adminEdit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees = Employee::all();
        return view('admin.attendances.edit', compact('attendance', 'employees'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'work_date' => 'required|date',
            'status' => 'required'
        ],[
            'work_date.required' => 'Vui lòng chọn ngày chấm công',
            'status.required' => 'Vui lòng chọn trạng thái'
        ]);

        Attendance::findOrFail($id)->update($request->all());
        return redirect('/admin/attendances')->with('success','Cập nhật chấm công thành công');
    }

    public function adminDelete($id)
    {
        if(auth()->user()->role->name !== 'admin'){
            return back();
        }
        Attendance::findOrFail($id)->delete();
        return back()->with('success','Xóa dữ liệu chấm công thành công');
    }

    public function index()
    {
        $attendances = Attendance::with('employee')->orderBy('work_date', 'desc')->get();
        return view('user.attendances.index', compact('attendances'));
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees = Employee::all();
        return view('user.attendances.edit', compact('attendance', 'employees'));
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
        return redirect('/attendances')->with('success','Cập nhật chấm công thành công');
    }
}
