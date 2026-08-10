<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\LeaveRequest;

class LeaveControllerHCNS 
{
    public function index(Request $request) 
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $date = $request->date;
        if($date)
        {
            $allLeaves = DB::table('leave_requests')
                ->join('users', 'users.id', '=', 'leave_requests.users_id')
                ->join('employees', 'users.name', '=', 'employees.full_name')
                ->select('name', 'employee_code', 'reason', 'start_date', 'end_date', 'leave_requests.status', 'leave_requests.id')
                ->where('start_date', $date)
                ->where('leave_requests.status', 'approved')
                ->orderBy('start_date', 'desc')
                ->get();
        }
        else
        {
            $allLeaves = DB::table('leave_requests')
                ->join('users', 'users.id', '=', 'leave_requests.users_id')
                ->join('employees', 'users.name', '=', 'employees.full_name')
                ->select('name', 'employee_code', 'reason', 'start_date', 'end_date', 'leave_requests.status', 'leave_requests.id')
                ->where('leave_requests.status', 'approved')
                ->orderBy('start_date', 'desc')
                ->get();
        }
        return view('hcns.leave.index', compact('allLeaves'));
    }

    public function edit($id) 
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $leave = DB::table('leave_requests')
                ->join('users', 'users.id', '=', 'leave_requests.users_id')
                ->join('employees', 'users.name', '=', 'employees.full_name')
                ->select('employee_code', 'name', 'start_date', 'end_date', 'reason', 'leave_requests.id')
                ->where('leave_requests.id', $id)
                ->first();
        return view('hcns.leave.edit', compact('leave'));
    }

    public function update(Request $request, $id) 
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $leave = LeaveRequest::findOrFail($id);
        $validate = $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'reason'     => 'required'
        ], [
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu.',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
            'reason.required' => 'Vui lòng nhập lý do nghỉ phép.'
        ]);
        $leave->update($validate);
        return redirect('/hcns/leave')->with('success', 'Cập nhật đơn nghỉ phép thành công');
    }

    public function delete($id) 
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        LeaveRequest::findOrFail($id)->delete();
        return back()->with('success', 'Đã xóa đơn nghỉ phép');
    }
} 