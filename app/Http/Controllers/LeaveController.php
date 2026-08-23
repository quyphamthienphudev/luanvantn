<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\LeaveRequest;

class LeaveController 
{
    public function index() 
    {
        if (auth()->user()->role->name !== 'user') 
        {
            return back();
        }

        $leaves = LeaveRequest::where('users_id', Auth::id())
                ->orderBy('id', 'desc')
                ->get();
        $countLeave = LeaveRequest::where('users_id', Auth::id())->where('status', 'approved')->sum('number_days');
        $resumeLeave = 12 - $countLeave;
        return view('user.leave.index', compact('resumeLeave', 'leaves'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role->name !== 'user') 
        {
            return back();
        }

        $validate = $request->validate([
        'start_date' => 'required|date|after_or_equal:today',
        'end_date'   => 'required|date|after_or_equal:start_date',
        'reason'     => 'required'
        ],[
        'start_date.required' => 'Vui lòng chọn ngày bắt đầu.',
        'start_date.after_or_equal' => 'Ngày bắt đầu không được nhỏ hơn ngày hiện tại.',
        'end_date.required' => 'Vui lòng chọn ngày kết thúc.',
        'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
        'reason.required' => 'Vui lòng nhập lý do nghỉ phép.'
        ]);

        // Đếm số lượng ngày nghỉ phép
        $countLeave = LeaveRequest::where('users_id', Auth::id())->where('status', 'approved')->sum('number_days');
        if ($countLeave >= 12) 
        {
            return back()->with('error', 'Bạn đã sử dụng hết 12 ngày nghỉ phép, không thể gửi thêm đơn nghỉ phép mới');
        }

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

        LeaveRequest::create([
            'users_id'   => Auth::id(),
            'start_date' => $validate['start_date'],
            'end_date'   => $validate['end_date'],
            'number_days' => $numberDays,
            'reason'     => $validate['reason'],
            'status'     => 'pending'
        ]);

        return redirect('/leave')->with('success', 'Gửi đơn xin nghỉ phép thành công');
    }

    public function edit($id) 
    {
        if (auth()->user()->role->name !== 'user') 
        {
            return back();
        }
        $exists = LeaveRequest::where('id', $id)
                ->where('users_id', Auth::id())
                ->where('status', 'pending')
                ->exists();
        if($exists)
        {
            $leave = LeaveRequest::where('id', $id)
                ->where('users_id', Auth::id())
                ->where('status', 'pending')
                ->first();

            return view('user.leave.edit', compact('leave'));
        }
        return back();
    }

    public function update(Request $request, $id) 
    {
        if (auth()->user()->role->name !== 'user') 
        {
            return back();
        }
        
        $leave = LeaveRequest::where('id', $id)
                ->where('users_id', Auth::id())
                ->where('status', 'pending')
                ->first();

        $validate = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'reason'     => 'required'
        ],[
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

        return redirect('/leave')->with('success', 'Cập nhật đơn nghỉ phép thành công');
    }
} 