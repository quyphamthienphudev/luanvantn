<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

use App\Models\Position;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $employees = Employee::with('department')
            ->when($search, function($q) use ($search){
                $q->where('full_name','like','%'.$search.'%')
                  ->orWhere('employee_code',$search);
            })
            ->get();

        return view('user.employees.index', compact('employees','search'));
    }

    public function adminIndex(Request $request)
    {
        $search = $request->search;

        $employees = Employee::with('department')
            ->when($search, function($q) use ($search){
                $q->where('full_name','like','%'.$search.'%')
                  ->orWhere('employee_code',$search);
            })
            ->get();

        return view('admin.employees.index', compact('employees','search'));
    }

    // CREATE
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('user.employees.create', compact('departments','positions'));
    }

    public function adminCreate()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('admin.employees.create', compact('departments','positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'employee_code' => 'required',
        'full_name' => 'required',

        'email' => 'required|email',
        'date_of_birth' => 'required|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
        'phone' => 'required|numeric'
        ],[
            'employee_code.required' => 'Vui lòng nhập mã nhân viên',
            'full_name.required' => 'Vui lòng nhập họ tên nhân viên',

            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',

            'date_of_birth.required' => 'Vui lòng chọn ngày sinh',
            'date_of_birth.before_or_equal' => 'Nhân viên phải từ 18 tuổi trở lên',

            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại chỉ được nhập số'
        ]);

        $data = $request->all();

        // tự động set ngày vào làm
        $data['hire_date'] = date('Y-m-d');

        // trạng thái mặc định
        $data['status'] = 'working';

        Employee::create($data);
        return redirect('/employees')->with('success','Thêm nhân viên thành công');
    }

    public function adminStore(Request $request)
    {
        $request->validate([
        'employee_code' => 'required',
        'full_name' => 'required',

        'email' => 'required|email',
        'date_of_birth' => 'required|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
        'phone' => 'required|numeric'
        ],[
            'employee_code.required' => 'Vui lòng nhập mã nhân viên',
            'full_name.required' => 'Vui lòng nhập họ tên nhân viên',

            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',

            'date_of_birth.required' => 'Vui lòng chọn ngày sinh',
            'date_of_birth.before_or_equal' => 'Nhân viên phải từ 18 tuổi trở lên',

            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại chỉ được nhập số'
        ]);

        $data = $request->all();

        // tự động set ngày vào làm
        $data['hire_date'] = date('Y-m-d');

        // trạng thái mặc định
        $data['status'] = 'working';

        Employee::create($data);
        return redirect('/admin/employees')->with('success','Thêm nhân viên thành công');
    }

    // EDIT
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        return view('user.employees.edit', compact('employee','departments','positions'));
    }

    public function adminEdit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        return view('admin.employees.edit', compact('employee','departments','positions'));
    }

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
        return redirect('/employees')->with('success','Cập nhật thông tin thành công');
    }

    public function adminUpdate(Request $request,$id)
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
        return redirect('/admin/employees')->with('success','Cập nhật thông tin thành công');
    }

    // DELETE (chỉ admin)
    public function delete($id)
    {
        if(auth()->user()->role->name !== 'admin'){
            return back()->with('error','Không có quyền');
        }

        Employee::findOrFail($id)->delete();
        return back()->with('success','Xóa nhân viên thành công');
    }

    // SHOW
    public function show($id)
    {
        $employee = Employee::with('department','position')->findOrFail($id);
        return view('user.employees.show', compact('employee'));
    }

    public function adminShow($id)
    {
        $employee = Employee::with('department','position')->findOrFail($id);
        return view('admin.employees.show', compact('employee'));
    }
}
