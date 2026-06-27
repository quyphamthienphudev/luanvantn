<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use App\Models\Position;

class ManageEmployeeControllerAdmin extends Controller
{

    //INDEX + SEARCH
    public function index(Request $request)
    {
        $search = $request->search;

        $employees = Employee::with('department','user')
            ->when($search, function($q) use ($search){
                $q->where('full_name','like','%'.$search.'%')
                  ->orWhere('employee_code',$search)
                  // Tìm theo tên phòng ban
                  ->orWhereHas('department', function($query) use ($search){
                        $query->where('name','like','%'.$search.'%');
                    });
            })
            ->get();

        return view('hcns.employees.index', compact('employees','search'));
    }

    // SHOW CREATE
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('hcns.employees.create', compact('departments','positions'));
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
            'date_of_birth.before_or_equal' => 'Nhân viên phải từ 18 tuổi trở lên, vui lòng kiểm tra lại',
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
        return redirect('/hcns/employees')->with('success','Thêm nhân viên thành công');
    }

    // EDIT
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        return view('hcns.employees.edit', compact('employee','departments','positions'));
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
            'date_of_birth.before_or_equal' => 'Nhân viên phải từ 18 tuổi trở lên, vui lòng kiểm tra lại',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại chỉ được nhập số'
        ]);
        Employee::findOrFail($id)->update($request->all());
        return redirect('/hcns/employees')->with('success','Cập nhật thông tin thành công');
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
        $employee = Employee::with('department', 'position', 'certificates')->findOrFail($id);
        return view('hcns.employees.show', compact('employee'));
    }

    //EXPORT FILE
    public function export()
    {   
        $employees = DB::table('employees')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->leftJoin('positions', 'employees.position_id', '=', 'positions.id')
            ->where('status','working')
            ->select(
                'employee_code',
                'full_name',
                'departments.name as department_name',
                'positions.name as position_name',
                'gender',
                'date_of_birth',
                'phone',
                'email',
                'address',
                'street',
                'ward',
                'province'
            )
            ->get();
        
        if ($employees->isEmpty()) 
        {
            return redirect()->back()->with('error', 'Không có dữ liệu');
        }
        
        $filename = 'ds_nhan_vien' . '.csv';
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fwrite($output, "\xEF\xBB\xBF");
        
        fputcsv($output, ['STT', 'Mã nhân viên', 'Họ tên nhân viên', 'Phòng ban', 'Công việc', 'Giới tính', 'Ngày sinh', 'Số điện thoại', 'Email', 'Địa chỉ']);
        
        $stt = 1;
        foreach ($employees as $employee) 
        {
            // Hiển thị giới tính Nam hoặc Nữ khi xuất file
            $gender = '';

            if ($employee->gender == 'male') {
                $gender = 'Nam';
            } elseif ($employee->gender == 'female') {
                $gender = 'Nữ';
            }

            fputcsv($output, [
                $stt,
                $employee->employee_code ?? '',
                $employee->full_name ?? '',
                $employee->department_name ?? '',
                $employee->position_name ?? '',
                $gender,
                $employee->date_of_birth ? date('d/m/Y', strtotime($employee->date_of_birth)) : '',
                // Hiển thị đầy đủ số điện thoại có số 0 ở đầu
                "\t" . ($employee->phone ?? ''),
                $employee->email ?? '',
                ($employee->address ?? '') . ", " . ($employee->street ?? '') . ", " . ($employee->ward ?? '') . ", " . ($employee->province ?? '')
            ]);
            $stt++;
        }
        
        fclose($output);
        exit;
    }
}
