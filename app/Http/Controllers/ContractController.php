<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\Models\Contract;
use App\Models\Employee;

class ContractController 
{
    // INDEX
    public function index()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $contracts = Contract::with('employee')->get();
        return view('hcns.contracts.index', compact('contracts'));
    }

    // CREATE
    public function create()
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $employees = Employee::all();
        return view('hcns.contracts.create', compact('employees'));
    }

    // STORE
    public function store(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        
        $countContract = DB::table('contracts')
                        ->where('contract_type', 'fixed_term')
                        ->where('status', 'expired')
                        ->where('employee_id', $request->employee_id)
                        ->count();
        
        if($countContract >= 2)
        {
            return back()->with('error', 'Không thể tạo thêm hợp đồng lao động xác định thời hạn, vui lòng kiểm tra lại');
        }

        $request->validate([
            'employee_id' => 'required',
            'contract_code' => 'required',
            'contract_type' => 'required',
            'start_date' => 'required',
            'salary' => 'required|numeric|min:0',
            'contract_file' => 'required|mimes:pdf,doc,docx|max:2048'
        ],[
            'contract_code.required' => 'Vui lòng nhập mã hợp đồng.',
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu.',
            'salary.required' => 'Vui lòng nhập mức lương.',
            'salary.numeric' => 'Mức lương không hợp lệ, vui lòng kiểm tra lại.',
            'salary.min' => 'Mức lương không hợp lệ, vui lòng kiểm tra lại.',
            'contract_file.required' => 'Vui lòng chọn file để tải lên.',
            'contract_file.mimes' => 'Định dạng file không phù hợp, chỉ cho phép file pdf, doc, docx.',
            'contract_file.uploaded' => 'Vui lòng tải lên file dưới 2 MB.',
            'contract_file.max' => 'Vui lòng tải lên file dưới 2 MB.'
        ]);

        $fileName = null;

        if($request->hasFile('contract_file'))
        {
             $fileName = $request->file('contract_file')->store('contracts');
        }

        Contract::create([
            'employee_id' => $request->employee_id,
            'contract_code' => $request->contract_code,
            'contract_type' => $request->contract_type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'salary' => $request->salary,
            'description' => $request->description,
            'contract_file' => $fileName,
            'status' => 'active'
        ]);

        return redirect('/hcns/contracts')->with('success', 'Thêm hợp đồng thành công');
    }

    // EDIT
    public function edit($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $contract = Contract::findOrFail($id);
        $employees = Employee::all();
        return view('hcns.contracts.edit', compact('contract', 'employees'));
    }

    // EXTEND
    public function extend(Request $request, $id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $old = Contract::findOrFail($id);

        if($request->end_date == '')
        {
            Contract::create([
                'employee_id' => $old->employee_id,
                'contract_code' => $old->contract_code,
                'contract_type' => 'indefinite',
                'start_date' => $old->end_date,
                'end_date' => $request->end_date,
                'salary' => $old->salary,
                'description' => $request->description,
                'contract_file' => $old->contract_file,
                'status' => 'active'
            ]);

            $old->update(['status'=>'expired']);
        }

        else
        {
            $request->validate([
                'end_date' => 'date|after:today',
            ],[
                'end_date.after' => 'Ngày kết thúc không hợp lệ, vui lòng kiểm tra lại.',
            ]);

            Contract::create([
                'employee_id' => $old->employee_id,
                'contract_code' => $old->contract_code,
                'contract_type' => $old->contract_type,
                'start_date' => $old->end_date,
                'end_date' => $request->end_date,
                'salary' => $old->salary,
                'description' => $request->description,
                'contract_file' => $old->contract_file,
                'status' => 'active'
            ]);

            $old->update(['status'=>'expired']);
        }
        
        return redirect('/hcns/contracts')->with('success', 'Gia hạn hợp đồng thành công');
    }

    // TERMINATE
    public function terminate($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        Contract::findOrFail($id)->update(['status' => 'terminated']);
        DB::table('users')
            ->join('employees', 'users.name', '=', 'employees.full_name')
            ->join('contracts', 'employees.id', '=', 'contracts.employee_id')
            ->where('users.id', $id)
            ->update(['users.status' => 'suspend']);
        return redirect('/hcns/contracts')->with('success', 'Thanh lý hợp đồng thành công');
    }

    // VIEW FILE
    public function viewFile($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        
        $contract = Contract::findOrFail($id);

        if (!$contract->contract_file)
        {
            // abort(404, 'Không tìm thấy file');
            return back();
        }

        $path = storage_path('app/private/' . $contract->contract_file);

        if (!file_exists($path))
        {
            // abort(404, 'File không tồn tại');
            return back();
        }

        return response()->file($path);
    }

    // SEARCH
    public function search(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $search = $request->search;

        $contracts = Contract::with('employee')
            ->when($search, function ($query) use ($search) {

            $query->where('contract_code', 'like', '%' . $search . '%')
                  ->orWhereHas('employee', function($query) use ($search){
                        $query->where('full_name', 'like', '%'. $search .'%');
                    });
        })
        ->get();

        return view('hcns.contracts.index', compact('search', 'contracts'));
    }
}