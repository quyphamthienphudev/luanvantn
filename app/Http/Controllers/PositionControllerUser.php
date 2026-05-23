<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Position;

class PositionControllerUser extends Controller
{   
    public function index()
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
}