<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Position;

class PositionControllerAdmin extends Controller
{

    //INDEX
    public function index()
    {
        $positions = DB::table('positions')->get();
        return view('hcns.positions.index',compact('positions'));
    }

    //SHOW CREATE
    public function create()
    {
        return view('hcns.positions.create');
    }

    //STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'base_salary' => 'required|numeric|min:0',
            'max_salary' => 'required|numeric|min:0'
        ],[
            'name.required' => 'Tên công việc không được để trống',
            'base_salary.required' => 'Lương cơ bản không được để trống',
            'base_salary.numeric' => 'Lương cơ bản chỉ được nhập số',
            'base_salary.min' => 'Lương cơ bản không hợp lệ',
            'max_salary.required' => 'Lương cao nhất không được để trống',
            'max_salary.numeric' => 'Lương cao nhất chỉ được nhập số',
            'max_salary.min' => 'Lương cao nhất không hợp lệ'
        ]);

        DB::table('positions')->insert([
            'name'=>$request->name,
            'base_salary'=>$request->base_salary,
            'max_salary'=>$request->max_salary
        ]);

        return redirect('/hcns/positions')->with('success','Thêm công việc thành công');
    }

    //SHOW EDIT
    public function edit($id)
    {
        $position = DB::table('positions')->where('id',$id)->first();
        return view('hcns.positions.edit',compact('position'));
    }

    //UPDATE
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'base_salary' => 'required|numeric|min:0',
            'max_salary' => 'required|numeric|min:0'
        ],[
            'name.required' => 'Tên công việc không được để trống',
            'base_salary.required' => 'Lương cơ bản không được để trống',
            'base_salary.numeric' => 'Lương cơ bản chỉ được nhập số',
            'base_salary.min' => 'Lương cơ bản không hợp lệ',
            'max_salary.required' => 'Lương cao nhất không được để trống',
            'max_salary.numeric' => 'Lương cao nhất chỉ được nhập số',
            'max_salary.min' => 'Lương cao nhất không hợp lệ'
        ]);

        DB::table('positions')
        ->where('id',$id)
        ->update([
            'name'=>$request->name,
            'base_salary'=>$request->base_salary,
            'max_salary'=>$request->max_salary
        ]);

        return redirect('/hcns/positions')->with('success','Cập nhật công việc thành công');
    }

    //DELETE
    public function delete($id)
    {
        $hasEmployee = DB::table('employees')
            ->where('position_id', $id)
            ->exists();

        if($hasEmployee)
        {
            return back()->with('error','Công việc này đang có nhân viên, không thể xóa');
        }

        DB::table('positions')->where('id',$id)->delete();

        return redirect('/hcns/positions')->with('success','Xóa công việc thành công');
    }

    //SEARCH
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

        return view('hcns.positions.index', compact('positions', 'search'));
    }

    //EXPORT FILE
    public function export()
    {   
        $positions = DB::table('positions')->select('name', 'base_salary', 'max_salary')->get();
        
        if ($positions->isEmpty()) 
        {
            return redirect()->back()->with('error', 'Không có dữ liệu.');
        }
        
        $filename = 'ds_cong_viec' . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF");
        
        fputcsv($output, ['STT', 'Công việc', 'Lương cơ bản', 'Lương cao nhất']);
        
        $stt = 1;
        foreach ($positions as $position) 
        {
            fputcsv($output, [
                $stt,
                $position->name ?? '',
                $position->base_salary ?? '',
                $position->max_salary ?? ''
            ]);
            $stt++;
        }
        
        fclose($output);
        exit;
    }
}
