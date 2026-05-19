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

    public function search(Request $request)
    {
    $search = $request->search;

    $departments = DB::table('departments')
        ->when($search, function ($query) use ($search) {

            // tìm theo name hoặc description
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        })
        ->get();

    return view('user.department', compact('departments', 'search'));
    }

    public function adminSearch(Request $request)
    {
    $search = $request->search;

    $departments = DB::table('departments')
        ->when($search, function ($query) use ($search) {

            // tìm theo name hoặc description
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        })
        ->get();

    return view('admin.departments.index', compact('departments', 'search'));
    }

    public function export()
    {   
        $departments = DB::table('departments')
            ->select(
                'name',
                'description'
            )
            ->get();
        
        if ($departments->isEmpty()) {
            return redirect()->back()->with('error', 'Không có dữ liệu.');
        }
        
        $filename = 'ds_phong_ban' . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF");
        
        fputcsv($output, ['STT', 'Tên phòng ban', 'Mô tả thông tin']);
        
        $stt = 1;
        foreach ($departments as $department) {
            fputcsv($output, [
                $stt,
                $department->name ?? '',
                $department->description ?? ''
            ]);
            $stt++;
        }
        
        fclose($output);
        exit;
    }

    public function adminExport()
    {   
        $departments = DB::table('departments')
            ->select(
                'name',
                'description'
            )
            ->get();
        
        if ($departments->isEmpty()) {
            return redirect()->back()->with('error', 'Không có dữ liệu.');
        }
        
        $filename = 'ds_phong_ban' . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF");
        
        fputcsv($output, ['STT', 'Tên phòng ban', 'Mô tả thông tin']);
        
        $stt = 1;
        foreach ($departments as $department) {
            fputcsv($output, [
                $stt,
                $department->name ?? '',
                $department->description ?? ''
            ]);
            $stt++;
        }
        
        fclose($output);
        exit;
    }
}
