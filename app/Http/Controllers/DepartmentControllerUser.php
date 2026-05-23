<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DepartmentControllerUser extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('user.department', compact('departments'));
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
}