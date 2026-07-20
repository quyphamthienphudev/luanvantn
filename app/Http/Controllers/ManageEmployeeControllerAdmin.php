<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Position;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Department;

class ManageEmployeeControllerAdmin extends Controller
{

    //INDEX + SEARCH
    public function index(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $search = $request->search;

        $employees = Employee::with('department')
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
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $departments = Department::all();
        $positions = Position::all();
        return view('hcns.employees.create', compact('departments','positions'));
    }

    //STORE
    public function store(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $request->validate([
        'employee_code' => 'required|unique:employees,employee_code|regex:/^[A-Za-z0-9_-]+$/',
        'full_name' => 'required',
        'email' => 'required|email',
        'date_of_birth' => 'required|before:' . now()->subYears(18)->format('Y-m-d'),
        'identify' => 'required|regex:/^[A-Za-z0-9_-]+$/|min:12|max:12',
        'national' => 'required',
        'birthplace' => 'required',
        'issue_date' => 'required',
        'ethnic_group' => 'required',
        // Số điện thoại bắt đầu bằng số 0
        'phone' => 'required|regex:/^0[0-9]+$/|min:10|max:11'
        ],[
            'employee_code.required' => 'Vui lòng nhập mã nhân viên.',
            'employee_code.unique' => 'Mã nhân viên đã tồn tại, vui lòng kiểm tra lại.',
            'employee_code.regex' => 'Mã nhân viên không được chứa chữ có dấu, khoảng trắng hoặc ký tự đặc biệt.',
            'full_name.required' => 'Vui lòng nhập họ tên nhân viên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'date_of_birth.required' => 'Vui lòng chọn ngày sinh.',
            'date_of_birth.before' => 'Ngày sinh không hợp lệ, vui lòng kiểm tra lại.',
            'identify.required' => 'Vui lòng nhập CCCD.',
            'identify.regex' => 'CCCD không được chứa chữ có dấu, khoảng trắng hoặc ký tự đặc biệt.',
            'identify.min' => 'CCCD không hợp lệ, vui lòng kiểm tra lại.',
            'identify.max' => 'CCCD không hợp lệ, vui lòng kiểm tra lại.',
            'national.required' => 'Vui lòng nhập quốc tịch.',
            'birthplace.required' => 'Vui lòng nhập nơi sinh.',
            'issue_date.required' => 'Vui lòng nhập ngày cấp.',
            'ethnic_group.required' => 'Vui lòng nhập dân tộc.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không hợp lệ, vui lòng kiểm tra lại.',
            'phone.min' => 'Số điện thoại không hợp lệ, vui lòng kiểm tra lại.',
            'phone.max' => 'Số điện thoại không hợp lệ, vui lòng kiểm tra lại.'
        ]);
        $data = $request->all();
        // Tự động set ngày vào làm
        $data['hire_date'] = date('Y-m-d');
        // Trạng thái mặc định
        $data['status'] = 'working';
        Employee::create($data);
        return redirect('/hcns/employees')->with('success','Thêm nhân viên thành công');
    }

    // EDIT
    public function edit($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $positions = Position::all();
        return view('hcns.employees.edit', compact('employee','departments','positions'));
    }

    //UPDATE
    public function update(Request $request,$id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $request->validate([
        'full_name' => 'required',
        'hire_date' => 'required|date',
        'email' => 'required|email',
        'date_of_birth' => 'required|before:' . now()->subYears(18)->format('Y-m-d'),
        'identify' => 'required|regex:/^[A-Za-z0-9_-]+$/|min:12|max:12',
        'national' => 'required',
        'birthplace' => 'required',
        'issue_date' => 'required',
        'ethnic_group' => 'required',
        // Số điện thoại bắt đầu bằng số 0
        'phone' => 'required|regex:/^0[0-9]+$/|min:10|max:11'
        ],[
            'full_name.required' => 'Vui lòng nhập họ tên nhân viên.',
            'hire_date.required' => 'Vui lòng chọn ngày vào làm.',
            'hire_date.date' => 'Ngày vào làm không hợp lệ.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'date_of_birth.required' => 'Vui lòng chọn ngày sinh.',
            'date_of_birth.before' => 'Ngày sinh không hợp lệ, vui lòng kiểm tra lại.',
            'identify.required' => 'Vui lòng nhập CCCD.',
            'identify.regex' => 'CCCD không được chứa chữ có dấu, khoảng trắng hoặc ký tự đặc biệt.',
            'identify.min' => 'CCCD không hợp lệ, vui lòng kiểm tra lại.',
            'identify.max' => 'CCCD không hợp lệ, vui lòng kiểm tra lại.',
            'national.required' => 'Vui lòng nhập quốc tịch.',
            'birthplace.required' => 'Vui lòng nhập nơi sinh.',
            'issue_date.required' => 'Vui lòng nhập ngày cấp.',
            'ethnic_group.required' => 'Vui lòng nhập dân tộc.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không hợp lệ, vui lòng kiểm tra lại.',
            'phone.min' => 'Số điện thoại không hợp lệ, vui lòng kiểm tra lại.',
            'phone.max' => 'Số điện thoại không hợp lệ, vui lòng kiểm tra lại.'

        ]);
        Employee::findOrFail($id)->update($request->all());
        return redirect('/hcns/employees')->with('success','Cập nhật thông tin thành công');
    }

    // DELETE
    public function delete($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        // Kiểm tra ràng buộc dữ liệu
        $payroll = DB::table('payrolls')->where('employee_id', $id)->exists();
        if ($payroll) 
        {
            return back()->with('error', 'Nhân viên đã có bảng lương, không thể xoá nhân viên này');
        }
        $contract = DB::table('contracts')->where('employee_id', $id)->exists();
        if ($contract) 
        {
            return back()->with('error', 'Nhân viên đã có hợp đồng lao động, không thể xoá nhân viên này');
        }
        $reward_discipline = DB::table('reward_discipline')->where('employee_id', $id)->exists();
        if ($reward_discipline) 
        {
            return back()->with('error', 'Nhân viên đã có khen thưởng hoặc kỷ luật, không thể xoá nhân viên này');
        }
        
        Employee::findOrFail($id)->delete();
        return back()->with('success','Xóa nhân viên thành công');
    }

    // SHOW
    public function show($id)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        $employee = Employee::with('department', 'position', 'certificates')->findOrFail($id);
        return view('hcns.employees.show', compact('employee'));
    }

    //EXPORT FILE
    public function export()
    {   
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }
        
        $employees = DB::table('employees')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
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
            ->where('status','working')
            ->get();
        
        if ($employees->isEmpty()) 
        {
            return back()->with('error', 'Không có dữ liệu');
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

    // DETAIL
    public function detail(Request $request)
    {
        if (auth()->user()->role->name !== 'hcns') 
        {
            return back();
        }

        $employees = DB::table('employees')
                    ->select('full_name','employee_code')
                    ->where('employee_code','!=','EMP001')
                    ->where('employee_code','!=','EMP016')
                    ->where('employee_code','!=','EMP021')
                    ->get();
        $employee = $request->get('employee_full_name');
        $attendances = [];
        $rewards = [];
        $disciplines = [];

        if($request->has('detail'))
        {
            $attendances = DB::table('attendances')
                ->join('users', 'users.id', '=', 'attendances.users_id')
                ->select('users.name','work_date','check_in','check_out','attendances.status')
                ->where('users.name', $employee)
                ->where('confirm', 'yes')
                ->orderBy('work_date','asc')
                ->get();

            $rewards = DB::table('reward_discipline')
                ->join('employees', 'employees.id', '=', 'reward_discipline.employee_id')
                ->select('full_name','title','amount','decision_date')
                ->where('full_name', $employee)
                ->where('type', 'reward')
                ->orderBy('decision_date','asc')
                ->get();

            $disciplines = DB::table('reward_discipline')
                ->join('employees', 'employees.id', '=', 'reward_discipline.employee_id')
                ->select('full_name','title','amount','decision_date')
                ->where('full_name', $employee)
                ->where('type', 'discipline')
                ->orderBy('decision_date','asc')
                ->get();
        }

        return view('hcns.employees.detail', compact('employees','attendances','rewards','disciplines'));
    }
}