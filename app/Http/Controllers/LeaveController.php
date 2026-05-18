<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index() {
        $allEmployees = \App\Models\Employee::all();
        $leaves = LeaveRequest::latest()->get(); 
        return view('user.leave.index', compact('allEmployees', 'leaves'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'start_date'  => 'required|date|after_or_equal:today', 
            'end_date'    => 'required|date|after_or_equal:start_date', 
            'reason'      => 'required', 
        ], [
            'employee_id.required' => 'Vui lòng chọn nhân viên.',
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu.',
            'start_date.after_or_equal' => 'Ngày bắt đầu không được chọn ngày trong quá khứ.',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải ngay ngày hiện tại hoặc sau ngày bắt đầu.',
            'reason.required' => 'Vui lòng nhập lý do nghỉ phép.'
        ]);
        LeaveRequest::create([
            'employee_id' => $request->employee_id, // kết nối sql
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'reason'      => $request->reason,
            'status'      => 'pending',
        ]);

        return back()->with('success', 'Gửi đơn nghỉ phép thành công');
    }

    public function edit($id) {
        $leave = LeaveRequest::findOrFail($id);
        $allEmployees = \App\Models\Employee::all();
    
        // Chỉ cho phép sửa nếu đơn đang chờ duyệt
        if($leave->status !== 'pending') {
            return redirect()->route('leave.index')->with('error', 'Đơn đã duyệt không thể sửa!');
        }
    
        return view('user.leave.edit', compact('leave', 'allEmployees'));
    }

    public function update(Request $request, $id) {
        $leave = LeaveRequest::findOrFail($id);
        $leave->update($request->all());
    
        return redirect()->route('leave.index')->with('success', 'Cập nhật đơn nghỉ phép thành công');
    }

    public function adminIndex() 
    {
        $allLeaves = LeaveRequest::with('employee')->latest()->paginate(10); 
        return view('admin.leave.index', compact('allLeaves'));
    }

    public function adminEdit($id) 
    {
        $leave = LeaveRequest::findOrFail($id);
        return view('admin.leave.edit', compact('leave'));
    }

    public function adminUpdate(Request $request, $id) 
    {
        $leave = LeaveRequest::findOrFail($id);
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'reason'     => 'required|string'
        ], [
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu.',
            'start_date.after_or_equal' => 'Ngày bắt đầu không được chọn ngày trong quá khứ.',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải ngay ngày hiện tại hoặc sau ngày bắt đầu.',
            'reason.required' => 'Vui lòng nhập lý do nghỉ phép.'
        ]);
        $leave->update($validated);
        return redirect()->route('admin.leave.adminIndex')->with('success', 'Cập nhật đơn nghỉ phép thành công');
    }

    public function destroy($id) 
    {
        $leave = LeaveRequest::findOrFail($id);
        $leave->delete();
        return back()->with('success', 'Đã xóa đơn nghỉ phép');
    }

    public function approve(Request $request, $id)
    {
        $leave = LeaveRequest::findOrFail($id);
        $leave->update([
            'status' => 'approved'
        ]);
        return back()->with('success', 'Đã duyệt đơn nghỉ phép thành công');
    }

    public function reject(Request $request, $id)
    {
        $leave = LeaveRequest::findOrFail($id);
        $leave->update([
            'status' => 'rejected'
        ]);
        return back()->with('success', 'Đã từ chối đơn nghỉ phép');
    }
} 