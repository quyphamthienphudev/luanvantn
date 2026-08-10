<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Position;

class PositionControllerAdmin 
{

    // INDEX
    public function index()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $positions = DB::table('positions')->select('name', 'base_salary', 'max_salary', 'id')->get();
        return view('hcns.positions.index', compact('positions'));
    }

    // SHOW CREATE
    public function create()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        return view('hcns.positions.create');
    }

    // STORE
    public function store(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $request->validate([
            'name' => 'required',
            'base_salary' => 'required|numeric|min:0',
            'max_salary' => 'required|numeric|min:0|gte:base_salary'
        ],[
            'name.required' => 'Tên công việc không được để trống.',
            'base_salary.required' => 'Lương cơ bản không được để trống.',
            'base_salary.numeric' => 'Lương cơ bản không hợp lệ, vui lòng kiểm tra lại.',
            'base_salary.min' => 'Lương cơ bản không hợp lệ, vui lòng kiểm tra lại.',
            'max_salary.required' => 'Lương cao nhất không được để trống.',
            'max_salary.numeric' => 'Lương cao nhất không hợp lệ, vui lòng kiểm tra lại.',
            'max_salary.min' => 'Lương cao nhất không hợp lệ, vui lòng kiểm tra lại.',
            'max_salary.gte' => 'Lương cao nhất không được ít hơn lương cơ bản.'
        ]);

        DB::table('positions')->insert([
            'name' => $request->name,
            'base_salary' => $request->base_salary,
            'max_salary' => $request->max_salary
        ]);

        return redirect('/hcns/positions')->with('success', 'Thêm công việc thành công');
    }

    // SHOW EDIT
    public function edit($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $position = DB::table('positions')->where('id', $id)->first();
        return view('hcns.positions.edit', compact('position'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $request->validate([
            'name' => 'required',
            'base_salary' => 'required|numeric|min:0',
            'max_salary' => 'required|numeric|min:0|gte:base_salary'
        ],[
            'name.required' => 'Tên công việc không được để trống.',
            'base_salary.required' => 'Lương cơ bản không được để trống.',
            'base_salary.numeric' => 'Lương cơ bản không hợp lệ, vui lòng kiểm tra lại.',
            'base_salary.min' => 'Lương cơ bản không hợp lệ, vui lòng kiểm tra lại.',
            'max_salary.required' => 'Lương cao nhất không được để trống.',
            'max_salary.numeric' => 'Lương cao nhất không hợp lệ, vui lòng kiểm tra lại.',
            'max_salary.min' => 'Lương cao nhất không hợp lệ, vui lòng kiểm tra lại.',
            'max_salary.gte' => 'Lương cao nhất không được ít hơn lương cơ bản.'
        ]);

        DB::table('positions')
        ->where('id',$id)
        ->update([
            'name' => $request->name,
            'base_salary' => $request->base_salary,
            'max_salary' => $request->max_salary
        ]);

        return redirect('/hcns/positions')->with('success', 'Cập nhật công việc thành công');
    }

    // DELETE
    public function delete($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $hasEmployee = DB::table('employees')
            ->where('position_id', $id)
            ->exists();

        if($hasEmployee)
        {
            return back()->with('error', 'Công việc này đang có nhân viên, không thể xóa');
        }

        DB::table('positions')->where('id', $id)->delete();

        return redirect('/hcns/positions')->with('success', 'Xóa công việc thành công');
    }

    // SEARCH
    public function search(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $search = $request->search;

        $positions = DB::table('positions')
            ->when($search, function ($query) use ($search) {

            // Tìm theo name hoặc base_salary
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('base_salary', 'like', '%' . $search . '%');
            })
        ->get();

        return view('hcns.positions.index', compact('search', 'positions'));
    }

    // EXPORT FILE
    public function export()
    {   
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        
        $positions = DB::table('positions')->select('name', 'base_salary', 'max_salary')->get();
        
        if ($positions->isEmpty()) 
        {
            return back()->with('error', 'Không có dữ liệu');
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