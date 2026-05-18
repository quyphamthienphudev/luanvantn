<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('user.department', compact('departments'));
    }

    public function adminIndex()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ],[
            'name.required' => 'Tên phòng ban không được để trống',
            'description.required' => 'Thông tin phòng ban không được để trống'
        ]);
        Department::create($request->all());
        return redirect('/admin/departments')->with('success','Thêm phòng ban thành công');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ],[
            'name.required' => 'Tên phòng ban không được để trống',
            'description.required' => 'Thông tin phòng ban không được để trống'
        ]);
        Department::findOrFail($id)->update($request->all());
        return redirect('/admin/departments')->with('success','Cập nhật phòng ban thành công');
    }

    public function delete($id)
    {
        $hasEmployee = DB::table('employees')
            ->where('department_id', $id)
            ->exists();

        if($hasEmployee){
            return back()->with('error','Phòng ban này đang có nhân viên, không thể xóa');
        }
        Department::findOrFail($id)->delete();
        return back()->with('success','Xóa phòng ban thành công');
    }
}
