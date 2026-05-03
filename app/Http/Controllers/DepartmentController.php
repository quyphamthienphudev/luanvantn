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
        return view('departments.index', compact('departments'));
    }

    public function adminIndex()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        if(auth()->user()->role->name !== 'admin'){
            return back();
        }
        return view('departments.create');
    }

    public function adminCreate()
    {
        if(auth()->user()->role->name !== 'admin'){
            return back();
        }
        return view('departments.create');
    }

    public function store(Request $request)
    {
        Department::create($request->all());
        return redirect('/departments')->with('success','Thêm thành công');
    }

    public function adminStore(Request $request)
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
        return view('departments.edit', compact('department'));
    }

    public function adminEdit($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request,$id)
    {
        Department::findOrFail($id)->update($request->all());
        return redirect('/departments')->with('success','Cập nhật thành công');
    }

    public function adminUpdate(Request $request,$id)
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
        if(auth()->user()->role->name !== 'admin'){
            return back();
        }

        Department::findOrFail($id)->delete();
        return back()->with('success','Xóa thành công');
    }

    public function adminDelete($id)
    {
        if(auth()->user()->role->name !== 'admin'){
            return back();
        }
        
        // ===== KIỂM TRA NHÂN VIÊN =====
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
