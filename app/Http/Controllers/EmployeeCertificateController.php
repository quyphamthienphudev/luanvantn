<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeCertificate;
use Illuminate\Support\Facades\Storage;

class EmployeeCertificateController extends Controller
{
    public function store(Request $request,$employee_id)
    {
        $request->validate([
            'certificate_name' => 'required',
            'issue_date' => 'required',
            'expiry_date' => 'required',
            'certificate_file' => 'required|mimes:pdf,jpg,jpeg,png|max:5120'
        ],[
            'certificate_name.required' => 'Vui lòng nhập tên chứng chỉ',
            'issue_date.required' => 'Vui lòng chọn ngày cấp',
            'expiry_date.required' => 'Vui lòng chọn ngày hết hạn',
            'certificate_file.required' => 'Vui lòng tải file chứng chỉ lên',
            'certificate_file.mimes' => 'Định dạng file không phù hợp, chỉ cho phép file pdf, jpg, jpeg, png',
            'certificate_file.max' => 'Vui lòng tải lên file dưới 5 MB'
        ]);

        $file = $request->file('certificate_file');

        $fileName = time().'_'.$file->getClientOriginalName();

        $file->storeAs('certificates', $fileName);

        EmployeeCertificate::create([
            'employee_id' => $employee_id,
            'certificate_name' => $request->certificate_name,
            'certificate_file' => $fileName,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date
        ]);

        return back()->with('success', 'Tải chứng chỉ thành công');
    }

    public function view($id)
    {
        $certificate = EmployeeCertificate::findOrFail($id);
        $path = storage_path('app/private/certificates/' . $certificate->certificate_file);
        return response()->file($path);
    }
}
