<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

use App\Models\Position;

class ManageEmployeeControllerQLCL extends Controller
{

    //INDEX + SEARCH
    public function index(Request $request)
    {
        $search = $request->search;

        $employees = Employee::with('department','user')
            ->where('department_id','2')
            ->when($search, function($q) use ($search){
                $q->where('full_name','like','%'.$search.'%')
                  ->orWhere('employee_code',$search)
                  // tìm theo tên phòng ban
                  ->orWhereHas('department', function($query) use ($search){
                        $query->where('name','like','%'.$search.'%');
                    });
            })
            ->get();

        return view('qlcl.employees.index', compact('employees','search'));
    }

    // SHOW CREATE
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('qlcl.employees.create', compact('departments','positions'));
    }

    //STORE
    public function store(Request $request)
    {
        $request->validate([
        'employee_code' => 'required|unique:employees,employee_code',
        'full_name' => 'required',

        'email' => 'required|email',
        'date_of_birth' => 'required|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
        'phone' => 'required|numeric'
        ],[
            'employee_code.required' => 'Vui lòng nhập mã nhân viên',
            'employee_code.unique' => 'Mã nhân viên đã tồn tại, vui lòng kiểm tra lại',
            'full_name.required' => 'Vui lòng nhập họ tên nhân viên',

            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',

            'date_of_birth.required' => 'Vui lòng chọn ngày sinh',
            'date_of_birth.before_or_equal' => 'Nhân viên phải từ 18 tuổi trở lên',

            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại chỉ được nhập số'
        ]);

        $data = $request->all();
        $data['users_id'] = auth()->user()->id;

        // tự động set ngày vào làm
        $data['hire_date'] = date('Y-m-d');

        // trạng thái mặc định
        $data['status'] = 'working';

        Employee::create($data);
        return redirect('/qlcl/employees')->with('success','Thêm nhân viên thành công');
    }

    // EDIT
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        return view('qlcl.employees.edit', compact('employee','departments','positions'));
    }

    //UPDATE
    public function update(Request $request,$id)
    {
        $request->validate([
        'employee_code' => 'required',
        'full_name' => 'required',
        'hire_date' => 'required|date',
        'email' => 'required|email',
        'date_of_birth' => 'required|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
        'phone' => 'required|numeric'
        ],[
            'employee_code.required' => 'Vui lòng nhập mã nhân viên',
            'full_name.required' => 'Vui lòng nhập họ tên nhân viên',
            'hire_date.required' => 'Vui lòng chọn ngày vào làm',
            'hire_date.date' => 'Ngày vào làm không hợp lệ',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'date_of_birth.required' => 'Vui lòng chọn ngày sinh',
            'date_of_birth.before_or_equal' => 'Nhân viên phải từ 18 tuổi trở lên',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại chỉ được nhập số'
        ]);
        Employee::findOrFail($id)->update($request->all());
        return redirect('/qlcl/employees')->with('success','Cập nhật thông tin thành công');
    }

    // DELETE
    public function delete($id)
    {
        Employee::findOrFail($id)->delete();
        return back()->with('success','Xóa nhân viên thành công');
    }

    // SHOW DETAIL
    public function show($id)
    {
        $employee = Employee::with('department','position')->findOrFail($id);
        return view('qlcl.employees.show', compact('employee'));
    }
}
