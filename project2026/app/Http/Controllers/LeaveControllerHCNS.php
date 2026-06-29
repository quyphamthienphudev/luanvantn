<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;

class LeaveControllerHCNS extends Controller
{
    public function index() 
    {
        $allLeaves = LeaveRequest::with('user')->where('status','approved')->orderBy('start_date','desc')->get(); 
        return view('hcns.leave.index', compact('allLeaves'));
    }

    public function edit($id) 
    {
        $leave = LeaveRequest::findOrFail($id);
        return view('hcns.leave.edit', compact('leave'));
    }

    public function update(Request $request, $id) 
    {
        $leave = LeaveRequest::findOrFail($id);
        $validate = $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'reason'     => 'required|string'
        ], [
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu',
            'reason.required' => 'Vui lòng nhập lý do nghỉ phép'
        ]);
        $leave->update($validate);
        return redirect('/hcns/leave')->with('success', 'Cập nhật đơn nghỉ phép thành công');
    }

    public function delete($id) 
    {
        $leave = LeaveRequest::findOrFail($id);
        $leave->delete();
        return back()->with('success', 'Đã xóa đơn nghỉ phép');
    }

    public function approve(Request $request, $id)
    {
        $leave = LeaveRequest::findOrFail($id);
        $leave->update(['status' => 'approved']);
        return back()->with('success', 'Đã duyệt đơn nghỉ phép thành công');
    }

    public function reject(Request $request, $id)
    {
        $leave = LeaveRequest::findOrFail($id);
        $leave->update(['status' => 'rejected']);
        return back()->with('success', 'Đã từ chối đơn nghỉ phép');
    }
} 