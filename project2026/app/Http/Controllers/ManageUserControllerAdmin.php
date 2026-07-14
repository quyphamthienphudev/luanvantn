<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class ManageUserControllerAdmin extends Controller
{
    //INDEX
    public function index()
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }
        $users = DB::table('users')->get();
        return view('httt.accounts.index',compact('users'));
    }

    //SHOW CREATE
    public function create()
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }
        $roles = DB::table('roles')->get();
        return view('httt.accounts.create',compact('roles'));
    }

    //STORE
    public function store(Request $request)
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }

        $request->validate([
            'name' => 'required|regex:/^[\p{L}\p{N}\s]+$/u',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ],[
            'name.required' => 'Họ tên không được để trống',
            'name.regex' => 'Họ tên không hợp lệ, vui lòng kiểm tra lại',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ, vui lòng kiểm tra lại',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự'
        ]);

        DB::table('users')->insert([
            'role_id'=>$request->role,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        return redirect('/httt/accounts')->with('success','Thêm tài khoản thành công');
    }

    //SHOW EDIT
    public function edit($id)
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }
        $user = DB::table('users')->where('id',$id)->first();
        $roles = Role::all();
        return view('httt.accounts.edit',compact('user','roles'));
    }

    //UPDATE
    public function update(Request $request,$id)
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }

        $request->validate([
            'name' => 'required|regex:/^[\p{L}\p{N}\s]+$/u',
            // 'email'=>'required|email|unique:users,email'
            'email' => 'required|email'
        ],[
            'name.required' => 'Họ tên không được để trống',
            'name.regex' => 'Họ tên không hợp lệ, vui lòng kiểm tra lại',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ, vui lòng kiểm tra lại',
            // 'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự'
        ]);

        // Kiểm tra ràng buộc dữ liệu
        $current_user = DB::table('users')->where('id', Auth::id())->exists();
        if ($current_user) 
        {
            return back()->with('error', 'Không thể cập nhật thông tin tại đây, vui lòng truy cập vào mục Cập nhật thông tin');
        }
        
        DB::table('users')
        ->where('id',$id)
        ->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'status'=>$request->status,
            'role_id'=>$request->role
        ]);

        return redirect('/httt/accounts')->with('success','Cập nhật tài khoản thành công');
    }

    //DELETE
    public function delete($id)
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }
        // Kiểm tra ràng buộc dữ liệu
        $attendance = DB::table('attendances')->where('users_id', $id)->exists();
        if ($attendance) 
        {
            return back()->with('error', 'Tài khoản này đang được sử dụng, không thể xoá tài khoản này');
        }
        $candidate = DB::table('candidates')->where('users_id', $id)->exists();
        if ($candidate) 
        {
            return back()->with('error', 'Tài khoản này đang được sử dụng, không thể xoá tài khoản này');
        }
        $contract = DB::table('contracts')->where('users_id', $id)->exists();
        if ($contract) 
        {
            return back()->with('error', 'Tài khoản này đang được sử dụng, không thể xoá tài khoản này');
        }
        $department = DB::table('departments')->where('users_id', $id)->exists();
        if ($department) 
        {
            return back()->with('error', 'Tài khoản này đang được sử dụng, không thể xoá tài khoản này');
        }
        $employee = DB::table('employees')->where('users_id', $id)->exists();
        if ($employee) 
        {
            return back()->with('error', 'Tài khoản này đang được sử dụng, không thể xoá tài khoản này');
        }
        $leave = DB::table('leave_requests')->where('users_id', $id)->exists();
        if ($leave) 
        {
            return back()->with('error', 'Tài khoản này đang được sử dụng, không thể xoá tài khoản này');
        }
        $payroll = DB::table('payrolls')->where('users_id', $id)->exists();
        if ($payroll) 
        {
            return back()->with('error', 'Tài khoản này đang được sử dụng, không thể xoá tài khoản này');
        }
        $position = DB::table('positions')->where('users_id', $id)->exists();
        if ($position) 
        {
            return back()->with('error', 'Tài khoản này đang được sử dụng, không thể xoá tài khoản này');
        }
        $current_user = DB::table('users')->where('id', Auth::id())->exists();
        if ($current_user) 
        {
            return back()->with('error', 'Tài khoản này đang được sử dụng, không thể xoá tài khoản này');
        }

        DB::table('users')->where('id',$id)->delete();
        return redirect('/httt/accounts')->with('success','Xóa tài khoản thành công');
    }

    //SEARCH
    public function search(Request $request)
    {
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }

        $search = $request->search;

        $users = DB::table('users')
            ->when($search, function ($query) use ($search) {

            // Tìm theo name hoặc email
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');

            // Tìm theo quyền
            if (strtolower($search) == 'admin') 
            {
                $query->orWhere('role_id', 1);
            }

            if (strtolower($search) == 'hcns') 
            {
                $query->orWhere('role_id', 2);
            }

            if (strtolower($search) == 'qlcl') 
            {
                $query->orWhere('role_id', 3);
            }

            if (strtolower($search) == 'httt') 
            {
                $query->orWhere('role_id', 4);
            }

            if (strtolower($search) == 'user') 
            {
                $query->orWhere('role_id', 5);
            }
        })
        ->get();

        return view('httt.accounts.index', compact('users', 'search'));
    }

    //EXPORT FILE
    public function export()
    {   
        if (auth()->user()->role->name !== 'httt') 
        {
            return back();
        }
        
        $users = DB::table('users')->select('id', 'name', 'email')->get();
        
        if ($users->isEmpty()) 
        {
            return back()->with('error', 'Không có dữ liệu');
        }
        
        $filename = 'ds_tai_khoan' . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF");
        
        fputcsv($output, ['STT', 'Họ tên', 'Email']);
        
        foreach ($users as $user) 
        {
            fputcsv($output, [
                $user->id ?? '',
                $user->name ?? '',
                $user->email ?? ''
            ]);
        }
        
        fclose($output);
        exit;
    }
}