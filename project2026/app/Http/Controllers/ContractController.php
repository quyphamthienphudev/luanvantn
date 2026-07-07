<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ContractController extends Controller
{
    public function index()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $contracts = Contract::with('employee')->get();
        return view('hcns.contracts.index', compact('contracts'));
    }

    public function create()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $employees = Employee::all();
        return view('hcns.contracts.create', compact('employees'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $request->validate([
            'employee_id'=>'required',
            'contract_type'=>'required',
            'start_date'=>'required',
            'salary' => 'required|numeric|min:0',
            'contract_file' => 'required|mimes:pdf,doc,docx|max:5120'
        ],[
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu',
            'salary.required' => 'Vui lòng nhập mức lương',
            'salary.numeric' => 'Mức lương chỉ được nhập số',
            'salary.min' => 'Mức lương không hợp lệ',
            'contract_file.required' => 'Vui lòng chọn file để tải lên',
            'contract_file.mimes' => 'Định dạng file không phù hợp, chỉ cho phép file pdf, doc, docx',
            'contract_file.max' => 'Vui lòng tải lên file dưới 5 MB'
        ]);

        $fileName = null;

        if($request->hasFile('contract_file'))
        {
            $fileName = $request->file('contract_file')->store('contracts');
        }

        Contract::create([
            'employee_id'=>$request->employee_id,
            'contract_code'=>'HD'.rand(),
            'contract_type'=>$request->contract_type,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'salary'=>$request->salary,
            'description'=>$request->description,
            'contract_file'=>$fileName,
            'status'=>'active',
            'users_id'=>auth()->id()
        ]);

        return redirect('/hcns/contracts')->with('success','Thêm hợp đồng thành công');
    }

    public function extend($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $old = Contract::findOrFail($id);

        Contract::create([
            'employee_id'=>$old->employee_id,
            'contract_code'=>'HD'.rand(),
            'contract_type'=>'fixed_term',
            'start_date'=>now(),
            'end_date'=>now()->addYear(),
            'salary'=>$old->salary,
            'description'=>$old->description,
            'contract_file'=>$old->contract_file,
            'status'=>'active',
            'users_id'=>auth()->id()
        ]);

        $old->update(['status'=>'expired']);

        return redirect('/hcns/contracts')->with('success','Gia hạn hợp đồng thành công');
    }

    public function terminate($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $contract = Contract::findOrFail($id);
        $contract->update(['status'=>'terminated']);
        return redirect('/hcns/contracts')->with('success','Thanh lý hợp đồng thành công');
    }

    public function viewFile($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        
        $contract = Contract::findOrFail($id);

        if (!$contract->contract_file)
        {
            abort(404, 'Không tìm thấy file');
        }

        $path = storage_path('app/private/' . $contract->contract_file);

        if (!file_exists($path))
        {
            abort(404, 'File không tồn tại');
        }

        return response()->file($path);
    }
}