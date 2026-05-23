<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;

class LeaveControllerAdmin extends Controller
{
    public function index() 
    {
        $allLeaves = LeaveRequest::with('employee')->orderBy('id', 'desc')->get(); 
        return view('admin.leave.index', compact('allLeaves'));
    }

    public function edit($id) 
    {
        $leave = LeaveRequest::findOrFail($id);
        return view('admin.leave.edit', compact('leave'));
    }

    public function update(Request $request, $id) 
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
        return redirect()->route('admin.leave.index')->with('success', 'Cập nhật đơn nghỉ phép thành công');
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