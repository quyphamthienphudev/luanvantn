<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

use App\Models\Position;

class ManageEmployeeControllerQLCL extends Controller
{

    //INDEX
    public function index()
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        $employees = Employee::with('department','user')
            ->where('department_id','24')->orWhere('department_id','25')
            ->get();

        return view('qlcl.employees.index', compact('employees'));
    }

    // SHOW DETAIL
    public function show($id)
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        $employee = Employee::with('department','position')->findOrFail($id);
        return view('qlcl.employees.show', compact('employee'));
    }

    //SEARCH
    public function search(Request $request)
    {
        if (auth()->user()->role->name !== 'qlcl') 
        {
            return back();
        }
        
        $search = $request->search;

        $employees = Employee::with('department','user')
            ->where('department_id','24')->orWhere('department_id','25')
            ->when($search, function ($query) use ($search) {
            
            $query->where('employee_code', 'like', '%' . $search . '%')
                  ->orWhere('full_name', 'like', '%' . $search . '%');

        })
        ->get();

        return view('qlcl.employees.index', compact('employees', 'search'));
    }
}
