<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceControllerHCNS;
use App\Http\Controllers\AttendanceControllerNV;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardControllerAdmin;
use App\Http\Controllers\DepartmentControllerAdmin;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveControllerHCNS;
use App\Http\Controllers\LeaveControllerQLCL;
use App\Http\Controllers\ManageCandidateControllerAdmin;
use App\Http\Controllers\ManageEmployeeControllerAdmin;
use App\Http\Controllers\ManageEmployeeControllerQLCL;
use App\Http\Controllers\ManageUserControllerAdmin;
use App\Http\Controllers\ManageUserControllerUser;
use App\Http\Controllers\PayrollControllerAdmin;
use App\Http\Controllers\PayrollControllerUser;
use App\Http\Controllers\PositionControllerAdmin;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeCertificateController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ManageEmployeeRewardController;
use App\Http\Controllers\ManageEmployeeDisciplinesController;
use App\Http\Controllers\HomePageAdminController;
use App\Http\Controllers\HomePageHCNSController;
use App\Http\Controllers\HomePageQLCLController;
use App\Http\Controllers\HomePageITController;
use App\Http\Controllers\HomePageUserController;

//-----------------------------------------------------------------------------------
Route::get('/', function () {
    if (auth()->check()) 
    {
        if (auth()->user()->role->name === 'admin') 
        {
            return redirect('/admin/home');
        }
        if (auth()->user()->role->name === 'hcns') 
        {
            return redirect('/hcns/home');
        }
        if (auth()->user()->role->name === 'qlcl') 
        {
            return redirect('/qlcl/home');
        }
        if (auth()->user()->role->name === 'httt') 
        {
            return redirect('/httt/home');
        }
        return redirect('/home');
    }
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

//----------------------------------------------------------------------------
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {

    Route::get('/admin/home', [HomePageAdminController::class, 'homePage']);
    Route::get('/hcns/home', [HomePageHCNSController::class, 'homePage']);
    Route::get('/qlcl/home', [HomePageQLCLController::class, 'homePage']);
    Route::get('/httt/home', [HomePageITController::class, 'homePage']);
    Route::get('/home', [HomePageUserController::class, 'homePage']);

    Route::get('/profile', [ManageUserControllerUser::class, 'editProfile']);
    Route::post('/profile', [ManageUserControllerUser::class, 'updateProfile']);

    Route::get('/change-password', [ManageUserControllerUser::class, 'showChangePassword']);
    Route::post('/change-password', [ManageUserControllerUser::class, 'changePassword']);

    Route::get('/httt/accounts', [ManageUserControllerAdmin::class,'index']);
    Route::get('/httt/accounts/create', [ManageUserControllerAdmin::class,'create']);
    Route::post('/httt/accounts/store', [ManageUserControllerAdmin::class,'store']);
    Route::get('/httt/accounts/edit/{id}', [ManageUserControllerAdmin::class,'edit']);
    Route::post('/httt/accounts/update/{id}', [ManageUserControllerAdmin::class,'update']);
    Route::post('/httt/accounts/delete/{id}', [ManageUserControllerAdmin::class,'delete']);
    Route::get('/httt/accounts', [ManageUserControllerAdmin::class,'search']);
    Route::post('/httt/accounts/export', [ManageUserControllerAdmin::class,'export']);
});

// Chức năng báo cáo thống kê
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard',[DashboardControllerAdmin::class,'dashboard']);
});

// Chức năng quản lý nhân viên của phòng hành chính nhân sự
Route::middleware('auth')->group(function () {
    Route::get('/hcns/employees',[ManageEmployeeControllerAdmin::class,'index']);
    Route::get('/hcns/employees/create',[ManageEmployeeControllerAdmin::class,'create']);
    Route::post('/hcns/employees/store',[ManageEmployeeControllerAdmin::class,'store']);
    Route::get('/hcns/employees/edit/{id}',[ManageEmployeeControllerAdmin::class,'edit']);
    Route::post('/hcns/employees/update/{id}',[ManageEmployeeControllerAdmin::class,'update']);
    Route::post('/hcns/employees/delete/{id}',[ManageEmployeeControllerAdmin::class,'delete']);
    Route::get('/hcns/employees/show/{id}',[ManageEmployeeControllerAdmin::class,'show']);
    Route::post('/hcns/employees/export',[ManageEmployeeControllerAdmin::class,'export']);
    Route::post('/hcns/employees/detail',[ManageEmployeeControllerAdmin::class,'detail']);
    Route::get('/hcns/employees',[ManageEmployeeControllerAdmin::class,'search']);
    // Quản lý chứng chỉ
    Route::post('/hcns/employees/{id}/certificate/store', [EmployeeCertificateController::class,'store']);
    Route::get('/hcns/employees/certificate/view/{id}', [EmployeeCertificateController::class,'viewFile']);
});

// Chức năng quản lý phòng ban
Route::middleware('auth')->group(function () {
    Route::get('/hcns/departments',[DepartmentControllerAdmin::class,'index']);
    Route::get('/hcns/departments/create',[DepartmentControllerAdmin::class,'create']);
    Route::post('/hcns/departments/store',[DepartmentControllerAdmin::class,'store']);
    Route::get('/hcns/departments/edit/{id}',[DepartmentControllerAdmin::class,'edit']);
    Route::post('/hcns/departments/update/{id}',[DepartmentControllerAdmin::class,'update']);
    Route::post('/hcns/departments/delete/{id}',[DepartmentControllerAdmin::class,'delete']);
    Route::get('/hcns/departments',[DepartmentControllerAdmin::class,'search']);
    Route::post('/hcns/departments/export',[DepartmentControllerAdmin::class,'export']);
});

// Chức năng quản lý công việc
Route::middleware('auth')->group(function () {
    Route::get('/hcns/positions', [PositionControllerAdmin::class,'index']);
    Route::get('/hcns/positions/create', [PositionControllerAdmin::class,'create']);
    Route::post('/hcns/positions/store', [PositionControllerAdmin::class,'store']);
    Route::get('/hcns/positions/edit/{id}', [PositionControllerAdmin::class,'edit']);
    Route::post('/hcns/positions/update/{id}', [PositionControllerAdmin::class,'update']);
    Route::post('/hcns/positions/delete/{id}', [PositionControllerAdmin::class,'delete']);
    Route::get('/hcns/positions', [PositionControllerAdmin::class,'search']);
    Route::post('/hcns/positions/export', [PositionControllerAdmin::class,'export']);
});

// Chức năng quản lý hồ sơ ứng viên
Route::middleware('auth')->group(function () {
    Route::get('/hcns/candidates',[ManageCandidateControllerAdmin::class,'index']);
    Route::get('/hcns/candidates/create',[ManageCandidateControllerAdmin::class,'create']);
    Route::post('/hcns/candidates/store',[ManageCandidateControllerAdmin::class,'store']);
    Route::get('/hcns/candidates/edit/{id}',[ManageCandidateControllerAdmin::class,'edit']);
    Route::post('/hcns/candidates/update/{id}',[ManageCandidateControllerAdmin::class,'update']);
    Route::post('/hcns/candidates/delete/{id}',[ManageCandidateControllerAdmin::class,'delete']);
    Route::post('/hcns/candidates/show/{id}',[ManageCandidateControllerAdmin::class,'show']);
    Route::get('/hcns/candidates',[ManageCandidateControllerAdmin::class,'search']);
});

// Chức năng quản lý lương phòng hành chính nhân sự
Route::middleware(['auth'])->group(function () {
    Route::get('/hcns/payrolls', [PayrollControllerAdmin::class, 'index']);
    Route::get('/hcns/payrolls/create', [PayrollControllerAdmin::class, 'create']);
    Route::post('/hcns/payrolls', [PayrollControllerAdmin::class, 'store']);
    Route::post('/hcns/payrolls/{id}', [PayrollControllerAdmin::class, 'show']);
    Route::get('/hcns/payrolls/edit/{id}', [PayrollControllerAdmin::class, 'edit']);
    Route::post('/hcns/payrolls/update/{id}', [PayrollControllerAdmin::class, 'update']);
    Route::post('/hcns/payrolls/delete/{id}', [PayrollControllerAdmin::class, 'delete']);
    Route::post('/hcns/payrolls/export', [PayrollControllerAdmin::class, 'export']);
});

// Chức năng xem bảng lương của nhân viên
Route::middleware(['auth'])->group(function () {
    Route::get('/payrolls', [PayrollControllerUser::class, 'show']);
});

// Chức năng quản lý đơn xin nghỉ phép của nhân viên
Route::middleware(['auth'])->group(function () {
    Route::get('/leave', [LeaveController::class, 'index']);
    Route::post('/leave/store', [LeaveController::class, 'store']);
    Route::get('/leave/edit/{id}', [LeaveController::class, 'edit']);
    Route::post('/leave/update/{id}', [LeaveController::class, 'update']);
});

// Chức năng quản lý đơn xin nghỉ phép của từng phòng ban
Route::middleware(['auth'])->group(function () {
    Route::get('/qlcl/leave', [LeaveControllerQLCL::class, 'index']);
    Route::post('/qlcl/leave/approve/{id}', [LeaveControllerQLCL::class, 'approve']);
    Route::post('/qlcl/leave/reject/{id}', [LeaveControllerQLCL::class, 'reject']);
    Route::get('/qlcl/leave/edit/{id}', [LeaveControllerQLCL::class, 'edit']);
    Route::post('/qlcl/leave/update/{id}', [LeaveControllerQLCL::class, 'update']);
    Route::post('/qlcl/leave/delete/{id}', [LeaveControllerQLCL::class, 'delete']);
});

// Chức năng quản lý đơn xin nghỉ phép phòng hành chính nhân sự
Route::middleware(['auth'])->group(function () {
    Route::get('/hcns/leave', [LeaveControllerHCNS::class, 'index']);
    Route::get('/hcns/leave/edit/{id}', [LeaveControllerHCNS::class, 'edit']);
    Route::post('/hcns/leave/update/{id}', [LeaveControllerHCNS::class, 'update']);
    Route::post('/hcns/leave/delete/{id}', [LeaveControllerHCNS::class, 'delete']);
});

// Chức năng quản lý quyền truy cập
Route::middleware('auth')->group(function () {
    Route::get('/httt/roles', [RoleController::class,'index']);
    Route::get('/httt/roles/create', [RoleController::class,'create']);
    Route::post('/httt/roles/store', [RoleController::class,'store']);
    Route::get('/httt/roles/edit/{id}', [RoleController::class,'edit']);
    Route::post('/httt/roles/update/{id}', [RoleController::class,'update']);
    Route::post('/httt/roles/delete/{id}', [RoleController::class,'delete']);
    Route::get('/httt/roles', [RoleController::class,'search']);
});

// Chức năng quản lý chấm công của từng phòng ban
Route::middleware('auth')->group(function () {
    Route::get('/qlcl/attendances', [AttendanceController::class, 'index']);
    Route::get('/qlcl/attendances/edit/{id}', [AttendanceController::class, 'edit']);
    Route::post('/qlcl/attendances/update/{id}', [AttendanceController::class, 'update']);
    Route::get('/qlcl/attendances/delete/{id}', [AttendanceController::class, 'delete']);
    Route::post('/qlcl/attendances/confirm/{id}', [AttendanceController::class,'confirm']);
});

// Chức năng quản lý chấm công phòng hành chính nhân sự
Route::middleware('auth')->group(function () {
    Route::get('/hcns/attendances', [AttendanceControllerHCNS::class, 'index']);
    Route::get('/hcns/attendances/edit/{id}', [AttendanceControllerHCNS::class, 'edit']);
    Route::post('/hcns/attendances/update/{id}', [AttendanceControllerHCNS::class, 'update']);
    Route::get('/hcns/attendances/delete/{id}', [AttendanceControllerHCNS::class, 'delete']);
});

// Chức năng quản lý nhân viên của từng phòng ban
Route::middleware('auth')->group(function () {
    Route::get('/qlcl/employees',[ManageEmployeeControllerQLCL::class,'index']);
    Route::get('/qlcl/employees',[ManageEmployeeControllerQLCL::class,'search']);
    Route::post('/qlcl/employees/show/{id}',[ManageEmployeeControllerQLCL::class,'show']);
});

// Chức năng quản lý hợp đồng lao động
Route::middleware('auth')->group(function () {
    Route::get('/hcns/contracts', [ContractController::class,'index']);
    Route::get('/hcns/contracts/create', [ContractController::class,'create']);
    Route::post('/hcns/contracts/store',[ContractController::class,'store']);
    Route::get('/hcns/contracts/edit/{id}',[ContractController::class,'edit']);
    Route::post('/hcns/contracts/extend/{id}', [ContractController::class,'extend']);
    Route::post('/hcns/contracts/terminate/{id}', [ContractController::class,'terminate']);
    Route::get('/hcns/contracts/view/{id}', [ContractController::class,'viewFile']);
    Route::get('/hcns/contracts', [ContractController::class,'search']);
});

// Chức năng quản lý khen thưởng
Route::middleware('auth')->group(function () {
    Route::get('/hcns/rewards',[ManageEmployeeRewardController::class,'index']);
    Route::get('/hcns/rewards/create',[ManageEmployeeRewardController::class,'create']);
    Route::post('/hcns/rewards/store',[ManageEmployeeRewardController::class,'store']);
    Route::get('/hcns/rewards/edit/{id}',[ManageEmployeeRewardController::class,'edit']);
    Route::post('/hcns/rewards/update/{id}',[ManageEmployeeRewardController::class,'update']);
    Route::post('/hcns/rewards/delete/{id}',[ManageEmployeeRewardController::class,'delete']);
});

// Chức năng quản lý kỷ luật
Route::middleware('auth')->group(function () {
    Route::get('/hcns/disciplines',[ManageEmployeeDisciplinesController::class,'index']);
    Route::get('/hcns/disciplines/create',[ManageEmployeeDisciplinesController::class,'create']);
    Route::post('/hcns/disciplines/store',[ManageEmployeeDisciplinesController::class,'store']);
    Route::get('/hcns/disciplines/edit/{id}',[ManageEmployeeDisciplinesController::class,'edit']);
    Route::post('/hcns/disciplines/update/{id}',[ManageEmployeeDisciplinesController::class,'update']);
    Route::post('/hcns/disciplines/delete/{id}',[ManageEmployeeDisciplinesController::class,'delete']);
});

// Chức năng chấm công cho nhân viên
Route::middleware('auth')->group(function () {
    Route::get('/attendances', [AttendanceControllerNV::class, 'index']);
    Route::post('/attendances/checkin', [AttendanceControllerNV::class, 'checkIn']);
    Route::post('/attendances/checkout', [AttendanceControllerNV::class, 'checkOut']);
});

// Kiểm tra route hợp lệ
Route::fallback(function () {
    if (!auth()->check()) 
    {
        return redirect('/login');
    }
    $role = auth()->user()->role->name ?? '';
    if ($role == 'admin') 
    {
        return back();
    }
    if ($role == 'hcns') 
    {
        return back();
    }
    if ($role == 'qlcl') 
    {
        return back();
    }
    if ($role == 'httt') 
    {
        return back();
    }
    return back();
});