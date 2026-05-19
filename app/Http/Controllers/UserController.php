<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class UserController extends Controller
{
    // ===== CẬP NHẬT THÔNG TIN =====

    public function editProfile()
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id
        ],[
            'name.required' => 'Họ tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email này đã được sử dụng'
        ]);

         $user->name = $request->name;
         $user->email = $request->email;
         $user->save();

        return back()->with('success', 'Cập nhật thành công');

    }

    // ===== ĐỔI MẬT KHẨU =====

    public function showChangePassword()
    {
        return view('user.change-password');
    }

    public function changePassword(Request $request)
    {
         $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8'
    ], [
        'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
        'current_password.min' => 'Mật khẩu hiện tại không đúng',
        'new_password.required' => 'Mật khẩu mới không được để trống',
        'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự'
    ]);

    $user = auth()->user();

    // Kiểm tra mật khẩu hiện tại
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Mật khẩu hiện tại không đúng');
    }

    // Không cho trùng mật khẩu cũ
    if (Hash::check($request->new_password, $user->password)) {
        return back()->with('error', 'Mật khẩu mới không được trùng mật khẩu cũ');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Đổi mật khẩu thành công');
    }

    public function index()
    {
        $users = DB::table('users')->get();

        return view('admin.accounts.index',compact('users'));
    }

    public function create()
    {
        return view('admin.accounts.create');
    }

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

        return redirect('/admin/accounts')
            ->with('success','Thêm tài khoản thành công');
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id',$id)->first();

        return view('admin.accounts.edit',compact('user'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>"required|email|unique:users,email,$id"
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
            'role_id'=>$request->role
        ]);

        return redirect('/admin/accounts')
            ->with('success','Cập nhật tài khoản thành công');
    }

    public function delete($id)
    {
        DB::table('users')->where('id',$id)->delete();

        return redirect('/admin/accounts')
            ->with('success','Xóa tài khoản thành công');
    }
    
    public function resetPassword(Request $request, $id)
    {
        // validation
        $request->validate([
            'new_password' => 'required|min:8'
        ],[
            'new_password.required' => 'Mật khẩu mới không được để trống',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự'
        ]);

        // tìm user
        $user = User::findorFail($id);

        // chỉ reset cho role user
        if($user->role_id != '2'){
            return redirect()->back()->with('error','Chỉ có thể reset mật khẩu cho tài khoản user');
        }

        else {
        // cập nhật mật khẩu
        $user->password = Hash::make($request->new_password);
        $user->save();
        }

        return redirect()->back()->with('success','Reset mật khẩu thành công');
    }

    public function search(Request $request)
    {
    $search = $request->search;

    $users = DB::table('users')
        ->when($search, function ($query) use ($search) {

            // tìm theo name hoặc email
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');

            // tìm theo quyền
            if (strtolower($search) == 'admin') {
                $query->orWhere('role_id', 1);
            }

            if (strtolower($search) == 'user') {
                $query->orWhere('role_id', 2);
            }
        })
        ->get();

    return view('admin.accounts.index', compact('users', 'search'));
    }

    public function export()
    {   
        $users = DB::table('users')
            ->select(
                'id',
                'name',
                'email'
            )
            ->get();
        
        if ($users->isEmpty()) {
            return redirect()->back()->with('error', 'Không có dữ liệu.');
        }
        
        $filename = 'ds_tai_khoan' . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF");
        
        fputcsv($output, ['STT', 'Họ tên nhân viên', 'Email']);
        
        foreach ($users as $user) {
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