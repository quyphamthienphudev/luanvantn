<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\Employee;
use App\Models\EmployeeCertificate;

class EmployeeCertificateController extends Controller
{
    public function store(Request $request,$employee_id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $request->validate([
            'certificate_name' => 'required',
            'issue_date' => 'required',
            'expiry_date' => 'required|after:issue_date',
            'certificate_file' => 'required|mimes:pdf,jpg,jpeg,png|max:2048'
        ],[
            'certificate_name.required' => 'Vui lòng nhập tên chứng chỉ.',
            'issue_date.required' => 'Vui lòng chọn ngày cấp.',
            'expiry_date.required' => 'Vui lòng chọn ngày hết hạn.',
            'expiry_date.after' => 'Ngày hết hạn không hợp lệ, vui lòng kiểm tra lại.',
            'certificate_file.required' => 'Vui lòng tải file chứng chỉ lên.',
            'certificate_file.mimes' => 'Định dạng file không phù hợp, chỉ cho phép file pdf, jpg, jpeg, png.',
            'certificate_file.max' => 'Vui lòng tải lên file dưới 2 MB.'
        ]);

        $fileName = null;

        if($request->hasFile('certificate_file'))
        {
            $fileName = $request->file('certificate_file')->store('certificates');
        }

        EmployeeCertificate::create([
            'employee_id' => $employee_id,
            'certificate_name' => $request->certificate_name,
            'certificate_file' => $fileName,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date
        ]);

        return back()->with('success', 'Thêm chứng chỉ thành công');
    }

    public function viewFile($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        
        $certificate = EmployeeCertificate::findOrFail($id);

        if (!$certificate->certificate_file)
        {
            // abort(404, 'Không tìm thấy file');
            return back();
        }

        $path = storage_path('app/private/' . $certificate->certificate_file);

        if (!file_exists($path))
        {
            // abort(404, 'File không tồn tại');
            return back();
        }
        
        return response()->file($path);
    }
}
