<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManageUserControllerAdmin;
use App\Http\Controllers\ManageUserControllerUser;
use App\Http\Controllers\DashboardControllerAdmin;
use App\Http\Controllers\ManageCandidateControllerAdmin;
use App\Http\Controllers\ManageCandidateControllerUser;
use App\Http\Controllers\ManageEmployeeControllerAdmin;
use App\Http\Controllers\ManageEmployeeControllerUser;
use App\Http\Controllers\DepartmentControllerAdmin;
use App\Http\Controllers\DepartmentControllerUser;
use App\Http\Controllers\PositionControllerAdmin;
use App\Http\Controllers\PositionControllerUser;

use App\Http\Controllers\PositionController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollControllerAdmin;
use App\Http\Controllers\PayrollControllerUser;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceControllerHCNS;
use App\Http\Controllers\AttendanceControllerNV;
use App\Http\Controllers\LeaveControllerHCNS;
use App\Http\Controllers\ManageEmployeeControllerQLCL;

//-----------------------------------------------------------------------------------
Route::get('/', function () {
    if (auth()->check()) {

        if (auth()->user()->role->name === 'admin') {
            return redirect('/admin/home');
        }

        if (auth()->user()->role->name === 'hcns') {
            return redirect('/admin/home');
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

    Route::get('/home', function () {
        return view('user.home');
    });

    Route::get('/admin/home', function () {
        return view('admin.home');
    });

    Route::get('/profile', [ManageUserControllerAdmin::class, 'editProfile']);
    Route::post('/profile', [ManageUserControllerAdmin::class, 'updateProfile']);
    Route::get('/profile', [ManageUserControllerUser::class, 'editProfile']);
    Route::post('/profile', [ManageUserControllerUser::class, 'updateProfile']);

    Route::get('/change-password', [ManageUserControllerAdmin::class, 'showChangePassword']);
    Route::post('/change-password', [ManageUserControllerAdmin::class, 'changePassword']);
    Route::get('/change-password', [ManageUserControllerUser::class, 'showChangePassword']);
    Route::post('/change-password', [ManageUserControllerUser::class, 'changePassword']);

    Route::get('/admin/accounts', [ManageUserControllerAdmin::class,'index']);
    Route::get('/admin/accounts/create', [ManageUserControllerAdmin::class,'create']);
    Route::post('/admin/accounts/store', [ManageUserControllerAdmin::class,'store']);
    Route::get('/admin/accounts/edit/{id}', [ManageUserControllerAdmin::class,'edit']);
    Route::post('/admin/accounts/update/{id}', [ManageUserControllerAdmin::class,'update']);
    Route::get('/admin/accounts/delete/{id}', [ManageUserControllerAdmin::class,'delete']);
    Route::get('/admin/accounts', [ManageUserControllerAdmin::class,'search']);
    Route::get('/admin/accounts/export', [ManageUserControllerAdmin::class,'export']);
});

// Chức năng báo cáo thống kê
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard',[DashboardControllerAdmin::class,'adminDashboard']);
});

// Chức năng quản lý nhân viên
Route::middleware('auth')->group(function () {
    Route::get('/admin/employees',[ManageEmployeeControllerAdmin::class,'index']);
    Route::get('/admin/employees/create',[ManageEmployeeControllerAdmin::class,'create']);
    Route::post('/admin/employees/store',[ManageEmployeeControllerAdmin::class,'store']);
    Route::get('/admin/employees/edit/{id}',[ManageEmployeeControllerAdmin::class,'edit']);
    Route::post('/admin/employees/update/{id}',[ManageEmployeeControllerAdmin::class,'update']);
    Route::get('/admin/employees/delete/{id}',[ManageEmployeeControllerAdmin::class,'delete']);
    Route::get('/admin/employees/show/{id}',[ManageEmployeeControllerAdmin::class,'show']);

    Route::get('/employees',[ManageEmployeeControllerUser::class,'index']);
    Route::get('/employees/create',[ManageEmployeeControllerUser::class,'create']);
    Route::post('/employees/store',[ManageEmployeeControllerUser::class,'store']);
    Route::get('/employees/edit/{id}',[ManageEmployeeControllerUser::class,'edit']);
    Route::post('/employees/update/{id}',[ManageEmployeeControllerUser::class,'update']);
    Route::get('/employees/show/{id}',[ManageEmployeeControllerUser::class,'show']);
});

// Chức năng quản lý phòng ban
Route::middleware('auth')->group(function () {
    Route::get('/admin/departments',[DepartmentControllerAdmin::class,'index']);
    Route::get('/admin/departments/create',[DepartmentControllerAdmin::class,'create']);
    Route::post('/admin/departments/store',[DepartmentControllerAdmin::class,'store']);
    Route::get('/admin/departments/edit/{id}',[DepartmentControllerAdmin::class,'edit']);
    Route::post('/admin/departments/update/{id}',[DepartmentControllerAdmin::class,'update']);
    Route::get('/admin/departments/delete/{id}',[DepartmentControllerAdmin::class,'delete']);
    Route::get('/admin/departments',[DepartmentControllerAdmin::class,'search']);
    Route::get('/admin/departments/export',[DepartmentControllerAdmin::class,'export']);

    Route::get('/departments',[DepartmentControllerUser::class,'index']);
    Route::get('/departments/create',[DepartmentControllerUser::class,'create']);
    Route::post('/departments/store',[DepartmentControllerUser::class,'store']);
    Route::get('/departments/edit/{id}',[DepartmentControllerUser::class,'edit']);
    Route::post('/departments/update/{id}',[DepartmentControllerUser::class,'update']);
    Route::get('/departments',[DepartmentControllerUser::class,'search']);
    Route::get('/departments/export',[DepartmentControllerUser::class,'export']);
});

// Chức năng quản lý công việc
Route::middleware('auth')->group(function () {
    Route::get('/admin/positions', [PositionControllerAdmin::class,'index']);
    Route::get('/admin/positions/create', [PositionControllerAdmin::class,'create']);
    Route::post('/admin/positions/store', [PositionControllerAdmin::class,'store']);
    Route::get('/admin/positions/edit/{id}', [PositionControllerAdmin::class,'edit']);
    Route::post('/admin/positions/update/{id}', [PositionControllerAdmin::class,'update']);
    Route::get('/admin/positions/delete/{id}', [PositionControllerAdmin::class,'delete']);
    Route::get('/admin/positions', [PositionControllerAdmin::class,'search']);
    Route::get('/admin/positions/export', [PositionControllerAdmin::class,'export']);

    Route::get('/positions', [PositionControllerUser::class,'index']);
    Route::get('/positions/create', [PositionControllerUser::class,'create']);
    Route::post('/positions/store', [PositionControllerUser::class,'store']);
    Route::get('/positions/edit/{id}', [PositionControllerUser::class,'edit']);
    Route::post('/positions/update/{id}', [PositionControllerUser::class,'update']);
    Route::get('/positions', [PositionControllerUser::class,'search']);
    Route::get('/positions/export', [PositionControllerUser::class,'export']);
});

// Chức năng quản lý hồ sơ ứng viên
Route::middleware('auth')->group(function () {
    Route::get('/admin/candidates',[ManageCandidateControllerAdmin::class,'index']);
    Route::get('/admin/candidates/create',[ManageCandidateControllerAdmin::class,'create']);
    Route::post('/admin/candidates/store',[ManageCandidateControllerAdmin::class,'store']);
    Route::get('/admin/candidates/edit/{id}',[ManageCandidateControllerAdmin::class,'edit']);
    Route::post('/admin/candidates/update/{id}',[ManageCandidateControllerAdmin::class,'update']);
    Route::get('/admin/candidates/delete/{id}',[ManageCandidateControllerAdmin::class,'delete']);
    Route::get('/admin/candidates/show/{id}',[ManageCandidateControllerAdmin::class,'show']);
    Route::get('/admin/candidates',[ManageCandidateControllerAdmin::class,'search']);

    Route::get('/candidates',[ManageCandidateControllerUser::class,'index']);
    Route::get('/candidates/create',[ManageCandidateControllerUser::class,'create']);
    Route::post('/candidates/store',[ManageCandidateControllerUser::class,'store']);
    Route::get('/candidates/edit/{id}',[ManageCandidateControllerUser::class,'edit']);
    Route::post('/candidates/update/{id}',[ManageCandidateControllerUser::class,'update']);
    Route::get('/candidates/show/{id}',[ManageCandidateControllerUser::class,'show']);
    Route::get('/candidates',[ManageCandidateControllerUser::class,'search']);
});

// ====== CHỨC NĂNG QUẢN LÝ LƯƠNG ======

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('payrolls/export', [PayrollControllerAdmin::class, 'export']);
    Route::get('payrolls/calculate/{month?}/{year?}', [PayrollControllerAdmin::class, 'calculate']);
    Route::get('payrolls', [PayrollControllerAdmin::class, 'index']);
    Route::get('payrolls/create', [PayrollControllerAdmin::class, 'create']);
    Route::post('payrolls', [PayrollControllerAdmin::class, 'store']);
    Route::get('payrolls/{id}', [PayrollControllerAdmin::class, 'show']);
    Route::get('payrolls/edit/{id}', [PayrollControllerAdmin::class, 'edit']);
    Route::post('payrolls/update/{id}', [PayrollControllerAdmin::class, 'update']);
    Route::post('payrolls/delete/{id}', [PayrollControllerAdmin::class, 'destroy']);
});

Route::prefix('/')->name('user.')->group(function () {
    Route::get('payrolls', [PayrollControllerUser::class, 'show']);
});

// Chức năng quản lý đơn xin nghỉ phép

Route::middleware(['auth'])->prefix('leave')->name('leave.')->group(function () {
    
    Route::get('/', [LeaveController::class, 'index'])->name('index');
    
    Route::post('/store', [LeaveController::class, 'store']);

    Route::get('/edit/{id}', [LeaveController::class, 'edit']);
    Route::post('/update/{id}', [LeaveController::class, 'update']);
    
});

Route::middleware(['auth'])->prefix('admin/leave')->name('admin.leave.')->group(function () {
  
    Route::get('/', [LeaveController::class, 'adminIndex'])->name('adminIndex');
    
    Route::post('/approve/{id}', [LeaveController::class, 'approve']);
    Route::post('/reject/{id}', [LeaveController::class, 'reject']);
    Route::get('/edit/{id}', [LeaveController::class, 'adminEdit']);
    Route::post('/update/{id}', [LeaveController::class, 'adminUpdate']);
    Route::delete('/delete/{id}', [LeaveController::class, 'destroy']);
    
});

Route::middleware(['auth'])->prefix('hcns/leave')->name('hcns.leave.')->group(function () {
  
    Route::get('/', [LeaveControllerHCNS::class, 'adminIndex'])->name('adminIndex');
    
    Route::post('/approve/{id}', [LeaveControllerHCNS::class, 'approve']);
    Route::post('/reject/{id}', [LeaveControllerHCNS::class, 'reject']);
    Route::get('/edit/{id}', [LeaveControllerHCNS::class, 'adminEdit']);
    Route::post('/update/{id}', [LeaveControllerHCNS::class, 'adminUpdate']);
    Route::delete('/delete/{id}', [LeaveControllerHCNS::class, 'destroy']);
    
});

// Chức năng quản lý quyền truy cập
Route::middleware('auth')->group(function () {
    Route::get('/admin/roles', [RoleController::class,'index']);
    Route::get('/admin/roles/create', [RoleController::class,'create']);
    Route::post('/admin/roles/store', [RoleController::class,'store']);
    Route::get('/admin/roles/edit/{id}', [RoleController::class,'edit']);
    Route::post('/admin/roles/update/{id}', [RoleController::class,'update']);
    Route::get('/admin/roles/delete/{id}', [RoleController::class,'delete']);
    Route::get('/admin/roles', [RoleController::class,'search']);
});

// --- CHỨC NĂNG QUẢN LÝ CHẤM CÔNG ---
Route::middleware('auth')->group(function () {
    Route::get('/attendances', [AttendanceController::class, 'index']);
    Route::get('/admin/attendances', [AttendanceController::class, 'adminIndex']);
    Route::get('/admin/attendances/edit/{id}', [AttendanceController::class, 'adminEdit']);
    Route::post('/admin/attendances/update/{id}', [AttendanceController::class, 'adminUpdate']);
    Route::get('/admin/attendances/delete/{id}', [AttendanceController::class, 'adminDelete']);
    Route::get('/attendances/edit/{id}', [AttendanceController::class, 'edit']);
    Route::post('/attendances/update/{id}', [AttendanceController::class, 'update']);

    Route::get('/admin/attendances/confirm/{id}', [AttendanceController::class,'confirm']);
});

// --- CHỨC NĂNG QUẢN LÝ CHẤM CÔNG CHO PHÒNG HÀNH CHÍNH NHÂN SỰ---
Route::middleware('auth')->group(function () {
    Route::get('/hcns/attendances', [AttendanceControllerHCNS::class, 'adminIndex']);
    Route::get('/hcns/attendances/edit/{id}', [AttendanceControllerHCNS::class, 'adminEdit']);
    Route::post('/hcns/attendances/update/{id}', [AttendanceControllerHCNS::class, 'adminUpdate']);
    Route::get('/hcns/attendances/delete/{id}', [AttendanceControllerHCNS::class, 'adminDelete']);
});

// --- CHỨC NĂNG CHẤM CÔNG ---
Route::middleware('auth')->group(function () {
    Route::get('/attendances', [AttendanceControllerNV::class, 'index']);
    Route::post('/attendances/checkin', [AttendanceControllerNV::class, 'checkIn']);
    Route::post('/attendances/checkout', [AttendanceControllerNV::class, 'checkOut']);
});

// Chức năng quản lý nhân viên của từng phòng ban
Route::middleware('auth')->group(function () {
    Route::get('/qlcl/employees',[ManageEmployeeControllerQLCL::class,'index']);
    Route::get('/qlcl/employees/create',[ManageEmployeeControllerQLCL::class,'create']);
    Route::post('/qlcl/employees/store',[ManageEmployeeControllerQLCL::class,'store']);
    Route::get('/qlcl/employees/edit/{id}',[ManageEmployeeControllerQLCL::class,'edit']);
    Route::post('/qlcl/employees/update/{id}',[ManageEmployeeControllerQLCL::class,'update']);
    Route::get('/qlcl/employees/delete/{id}',[ManageEmployeeControllerQLCL::class,'delete']);
    Route::get('/qlcl/employees/show/{id}',[ManageEmployeeControllerQLCL::class,'show']);
});