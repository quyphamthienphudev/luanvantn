<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ManageUserControllerAdmin extends Controller
{
    //INDEX
    public function index()
    {
        $users = DB::table('users')->get();
        return view('httt.accounts.index',compact('users'));
    }

    //SHOW CREATE
    public function create()
    {
        return view('httt.accounts.create');
    }

    //STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ],[
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
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
        $user = DB::table('users')->where('id',$id)->first();
        return view('httt.accounts.edit',compact('user'));
    }

    //UPDATE
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>"required|email|unique:users,email"
        ],[
            'name.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự'
        ]);

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
        DB::table('users')->where('id',$id)->delete();
        return redirect('/httt/accounts')->with('success','Xóa tài khoản thành công');
    }

    //SEARCH
    public function search(Request $request)
    {
        $search = $request->search;

        $users = DB::table('users')
            ->when($search, function ($query) use ($search) {

            // tìm theo name hoặc email
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');

            // tìm theo quyền
            if (strtolower($search) == 'admin') 
            {
                $query->orWhere('role_id', 1);
            }

            if (strtolower($search) == 'user') 
            {
                $query->orWhere('role_id', 2);
            }
        })
        ->get();

        return view('httt.accounts.index', compact('users', 'search'));
    }

    //EXPORT FILE
    public function export()
    {   
        $users = DB::table('users')->select('id', 'name', 'email')->get();
        
        if ($users->isEmpty()) 
        {
            return redirect()->back()->with('error', 'Không có dữ liệu.');
        }
        
        $filename = 'ds_tai_khoan' . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF");
        
        fputcsv($output, ['STT', 'Họ tên nhân viên', 'Email']);
        
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