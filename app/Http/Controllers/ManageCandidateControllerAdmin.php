<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\DB;

use App\Models\Position;

class ManageCandidateControllerAdmin extends Controller
{
    public function index()
    {
        $candidates = DB::table('candidates')->get();
        return view('admin.candidates.index',compact('candidates'));
    }

    // CREATE
    public function create()
    {
        return view('admin.candidates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'employee_code' => 'required',
        'full_name' => 'required',

        'email' => 'required|email',
        'date_of_birth' => 'required|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
        'phone' => 'required|numeric'
        ],[
            'employee_code.required' => 'Vui lòng nhập mã nhân viên',
            'full_name.required' => 'Vui lòng nhập họ tên nhân viên',

            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',

            'date_of_birth.required' => 'Vui lòng chọn ngày sinh',
            'date_of_birth.before_or_equal' => 'Nhân viên phải từ 18 tuổi trở lên',

            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại chỉ được nhập số'
        ]);

        DB::table('candidates')->insert([
            'full_name'=>$request->full_name,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'gender'=>$request->gender,
            'date_of_birth'=>$request->date_of_birth,
            'phone'=>$request->phone,
            'education'=>$request->education,
            'email'=>$request->email,
            'address'=>$request->address,
            'street'=>$request->street,
            'ward'=>$request->ward,
            'province'=>$request->province
        ]);

        // $data = $request->all();
        // $data['users_id'] = auth()->user()->id;

        // // tự động set ngày vào làm
        // $data['hire_date'] = date('Y-m-d');

        // // trạng thái mặc định
        // $data['status'] = 'working';

        // Employee::create($data);
        // return redirect('/admin/employees')->with('success','Thêm nhân viên thành công');
        return redirect('/admin/candidates')
            ->with('success','Thêm hồ sơ thành công');
    }

    // EDIT
    public function edit($id)
    {
        // $employee = Employee::findOrFail($id);
        // $departments = Department::all();
        // $positions = Position::all();
        // return view('admin.employees.edit', compact('employee','departments','positions'));
        $candidates = DB::table('candidates')->where('id',$id)->first();

        return view('admin.candidates.edit',compact('candidates'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
        'employee_code' => 'required',
        'full_name' => 'required',
        'hire_date' => 'required|date',
        'email' => 'required|email',
        'date_of_birth' => 'required|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
        'phone' => 'required|numeric'
        ],[
            'employee_code.required' => 'Vui lòng nhập mã nhân viên',
            'full_name.required' => 'Vui lòng nhập họ tên nhân viên',
            'hire_date.required' => 'Vui lòng chọn ngày vào làm',
            'hire_date.date' => 'Ngày vào làm không hợp lệ',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'date_of_birth.required' => 'Vui lòng chọn ngày sinh',
            'date_of_birth.before_or_equal' => 'Nhân viên phải từ 18 tuổi trở lên',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại chỉ được nhập số'
        ]);

        DB::table('candidates')
        ->where('id',$id)
        ->update([
            'full_name'=>$request->full_name,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'gender'=>$request->gender,
            'date_of_birth'=>$request->date_of_birth,
            'phone'=>$request->phone,
            'education'=>$request->education,
            'email'=>$request->email,
            'address'=>$request->address,
            'street'=>$request->street,
            'ward'=>$request->ward,
            'province'=>$request->province
        ]);
        // Employee::findOrFail($id)->update($request->all());
        // return redirect('/admin/employees')->with('success','Cập nhật thông tin thành công');
        return redirect('/admin/candidates')
            ->with('success','Cập nhật hồ sơ thành công');
    }

    // DELETE
    public function delete($id)
    {
        // if(auth()->user()->role->name !== 'admin'){
        //     return back()->with('error','Không có quyền');
        // }

        // Employee::findOrFail($id)->delete();
        // return back()->with('success','Xóa nhân viên thành công');
        DB::table('candidates')->where('id',$id)->delete();

        return redirect('/admin/candidates')
            ->with('success','Xóa hồ sơ thành công');
    }

    // SHOW
    public function show($id)
    {
        // $employee = Employee::with('department','position')->findOrFail($id);
        // return view('admin.employees.show', compact('employee'));
    }
}
