<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LeaveControllerQLCL extends Controller
{
    public function index() 
    {
        $allLeaves = LeaveRequest::with('user')->orderBy('start_date','desc')->get(); 
        return view('qlcl.leave.index', compact('allLeaves'));
    }

    public function edit($id) 
    {
        $leave = LeaveRequest::findOrFail($id);
        return view('qlcl.leave.edit', compact('leave'));
    }

    public function update(Request $request, $id) 
    {
        $leave = LeaveRequest::findOrFail($id);
        $validate = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'reason'     => 'required|string'
        ], [
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu',
            'start_date.after_or_equal' => 'Ngày bắt đầu không được nhỏ hơn ngày hiện tại',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu',
            'reason.required' => 'Vui lòng nhập lý do nghỉ phép'
        ]);

        // Tính số ngày nghỉ (bao gồm cả ngày bắt đầu và ngày kết thúc)
        $startDate = Carbon::parse($validate['start_date']);
        $endDate   = Carbon::parse($validate['end_date']);

        $validate['number_days'] = $startDate->diffInDays($endDate) + 1;
        $leave->update($validate);

        return redirect('/qlcl/leave')->with('success', 'Cập nhật đơn nghỉ phép thành công');
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