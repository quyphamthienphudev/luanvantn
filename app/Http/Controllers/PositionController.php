<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Position;

class PositionController extends Controller
{

    public function index()
    {
        $positions = DB::table('positions')->get();

        return view('admin.positions.index',compact('positions'));
    }

    public function create()
    {
        return view('admin.positions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'base_salary' => 'required|numeric|min:0'
        ],[
            'name.required' => 'Tên chức vụ không được để trống',
            'base_salary.required' => 'Lương cơ bản không được để trống',
            'base_salary.numeric' => 'Lương cơ bản chỉ được nhập số',
            'base_salary.min' => 'Lương cơ bản không hợp lệ'
        ]);

        DB::table('positions')->insert([
            'name'=>$request->name,
            'base_salary'=>$request->base_salary
        ]);

        return redirect('/admin/positions')
            ->with('success','Thêm chức vụ thành công');
    }

    public function edit($id)
    {
        $position = DB::table('positions')->where('id',$id)->first();

        return view('admin.positions.edit',compact('position'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'base_salary' => 'required|numeric|min:0'
        ],[
            'name.required' => 'Tên chức vụ không được để trống',
            'base_salary.required' => 'Lương cơ bản không được để trống',
            'base_salary.numeric' => 'Lương cơ bản chỉ được nhập số',
            'base_salary.min' => 'Lương cơ bản không hợp lệ'
        ]);

        DB::table('positions')
        ->where('id',$id)
        ->update([
            'name'=>$request->name,
            'base_salary'=>$request->base_salary
        ]);

        return redirect('/admin/positions')
            ->with('success','Cập nhật chức vụ thành công');
    }

    public function delete($id)
    {
        $hasEmployee = DB::table('employees')
            ->where('position_id', $id)
            ->exists();

        if($hasEmployee){
            return back()->with('error','Chức vụ này đang có nhân viên, không thể xóa');
        }

        DB::table('positions')->where('id',$id)->delete();

        return redirect('/admin/positions')
            ->with('success','Xóa chức vụ thành công');
    }
    
    public function userIndex()
    {
        $positions = Position::all();
        return view('user.position', compact('positions'));
    }

    public function search(Request $request)
    {
    $search = $request->search;

    $positions = DB::table('positions')
        ->when($search, function ($query) use ($search) {

            // tìm theo name hoặc base_salary
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('base_salary', 'like', '%' . $search . '%');
        })
        ->get();

    return view('user.position', compact('positions', 'search'));
    }

    public function adminSearch(Request $request)
    {
    $search = $request->search;

    $positions = DB::table('positions')
        ->when($search, function ($query) use ($search) {

            // tìm theo name hoặc base_salary
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('base_salary', 'like', '%' . $search . '%');
        })
        ->get();

    return view('admin.positions.index', compact('positions', 'search'));
    }

    public function export()
    {   
        $positions = DB::table('positions')
            ->select(
                'name',
                'base_salary'
            )
            ->get();
        
        if ($positions->isEmpty()) {
            return redirect()->back()->with('error', 'Không có dữ liệu.');
        }
        
        $filename = 'ds_chuc_vu' . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF");
        
        fputcsv($output, ['STT', 'Tên chức vụ', 'Lương cơ bản']);
        
        $stt = 1;
        foreach ($positions as $position) {
            fputcsv($output, [
                $stt,
                $position->name ?? '',
                $position->base_salary ?? ''
            ]);
            $stt++;
        }
        
        fclose($output);
        exit;
    }

    public function adminExport()
    {   
        $positions = DB::table('positions')
            ->select(
                'name',
                'base_salary'
            )
            ->get();
        
        if ($positions->isEmpty()) {
            return redirect()->back()->with('error', 'Không có dữ liệu.');
        }
        
        $filename = 'ds_chuc_vu' . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF");
        
        fputcsv($output, ['STT', 'Tên chức vụ', 'Lương cơ bản']);
        
        $stt = 1;
        foreach ($positions as $position) {
            fputcsv($output, [
                $stt,
                $position->name ?? '',
                $position->base_salary ?? ''
            ]);
            $stt++;
        }
        
        fclose($output);
        exit;
    }
}
