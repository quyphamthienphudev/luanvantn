<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\LeaveRequest;

class LeaveControllerQLCL 
{
    public function index(Request $request) 
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        $date = $request->date;
        if($date)
        {
            $allLeaves = DB::table('leave_requests')
                ->join('users', 'leave_requests.users_id', '=', 'users.id')
                ->join('employees', 'users.name', '=', 'employees.full_name')
                ->select('name', 'employee_code', 'reason', 'start_date', 'end_date', 'number_days', 'leave_requests.status', 'leave_requests.id')
                ->where('start_date', $date)
                ->orderBy('end_date', 'desc')
                ->get();
        }
        else
        {
            $allLeaves = DB::table('leave_requests')
                ->join('users', 'leave_requests.users_id', '=', 'users.id')
                ->join('employees', 'users.name', '=', 'employees.full_name')
                ->select('name', 'employee_code', 'reason', 'start_date', 'end_date', 'number_days', 'leave_requests.status', 'leave_requests.id')
                ->orderBy('start_date', 'desc')
                ->get();
        }
        return view('qlcl.leave.index', compact('allLeaves'));
    }

    public function edit($id) 
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        $exists = DB::table('leave_requests')
                ->join('users', 'leave_requests.users_id', '=', 'users.id')
                ->join('employees', 'users.name', '=', 'employees.full_name')
                ->select('employee_code', 'name', 'start_date', 'end_date', 'reason', 'leave_requests.id')
                ->where('leave_requests.id', $id)
                ->exists();
        if($exists)
        {
            $leave = DB::table('leave_requests')
                ->join('users', 'leave_requests.users_id', '=', 'users.id')
                ->join('employees', 'users.name', '=', 'employees.full_name')
                ->select('employee_code', 'name', 'start_date', 'end_date', 'reason', 'leave_requests.id')
                ->where('leave_requests.id', $id)
                ->first();
            return view('qlcl.leave.edit', compact('leave'));
        }
        return back();
    }

    public function update(Request $request, $id) 
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        $leave = LeaveRequest::findOrFail($id);
        $validate = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'reason'     => 'required'
        ], [
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu.',
            'start_date.after_or_equal' => 'Ngày bắt đầu không được nhỏ hơn ngày hiện tại.',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
            'reason.required' => 'Vui lòng nhập lý do nghỉ phép.'
        ]);

        // Đếm số lượng ngày nghỉ phép
        $countLeave = LeaveRequest::where('users_id', Auth::id())->where('status', 'approved')->sum('number_days');
        
        $resumeLeave = 12 - $countLeave;

        // Tính số ngày nghỉ (bao gồm cả ngày bắt đầu và ngày kết thúc)
        $startDate = Carbon::parse($validate['start_date']);
        $endDate   = Carbon::parse($validate['end_date']);
        $numberDays = $startDate->diffInDays($endDate) + 1;
        // Kiểm tra số ngày nghỉ phép
        if($numberDays > $resumeLeave)
        {
            return back()->with('error', 'Số ngày nghỉ phép còn lại không đủ, vui lòng kiểm tra lại');
        }

        $validate['number_days'] = $startDate->diffInDays($endDate) + 1;
        $leave->update($validate);

        return redirect('/qlcl/leave')->with('success', 'Cập nhật đơn nghỉ phép thành công');
    }

    public function delete($id) 
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        LeaveRequest::findOrFail($id)->delete();
        return back()->with('success', 'Đã xóa đơn nghỉ phép');
    }

    public function approve(Request $request, $id)
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        LeaveRequest::findOrFail($id)->update(['status' => 'approved']);
        return back()->with('success', 'Đã duyệt đơn nghỉ phép thành công');
    }

    public function reject(Request $request, $id)
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        LeaveRequest::findOrFail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Đã từ chối đơn nghỉ phép');
    }

    public function countResumeLeave()
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }

        $countResumeLeave = DB::table('leave_requests')
            ->join('users', 'leave_requests.users_id', '=', 'users.id')
            ->join('employees', 'users.name', '=', 'employees.full_name')
            ->select(
                'name',
                'employee_code',
                DB::raw('SUM(number_days) as number_days_used'),
                DB::raw('12 - SUM(number_days) as number_days_resume')
            )
            ->where('leave_requests.status', 'approved')
            ->groupBy('name', 'employee_code')
            ->orderBy('employee_code', 'asc')
            ->get();
        
        return view('qlcl.resume-leave', compact('countResumeLeave'));
    }
} 