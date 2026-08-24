<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ManageUserControllerUser 
{
    public function editProfile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id
        ],[
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ, vui lòng kiểm tra lại.',
            'email.unique' => 'Email này đã được sử dụng.'
        ]);
        $user->email = $request->email;
        $user->save();
        return back()->with('success', 'Cập nhật thành công');

    }

    public function showChangePassword()
    {
        return view('change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8'
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'current_password.min' => 'Mật khẩu hiện tại không đúng.',
            'new_password.required' => 'Mật khẩu mới không được để trống.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.'
        ]);
        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) 
        {
            return back()->with('error', 'Mật khẩu hiện tại không đúng');
        }
        if (Hash::check($request->new_password, $user->password)) 
        {
            return back()->with('error', 'Mật khẩu mới không được trùng mật khẩu cũ');
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('success', 'Đổi mật khẩu thành công');
    }
}