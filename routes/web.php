<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManageUserControllerAdmin;
use App\Http\Controllers\ManageUserControllerUser;
use App\Http\Controllers\DashboardControllerAdmin;
use App\Http\Controllers\LeaveControllerAdmin;
use App\Http\Controllers\LeaveControllerUser;
use App\Http\Controllers\ManageEmployeeControllerAdmin;
use App\Http\Controllers\ManageEmployeeControllerUser;
use App\Http\Controllers\DepartmentControllerAdmin;
use App\Http\Controllers\DepartmentControllerUser;
use App\Http\Controllers\PositionControllerAdmin;
use App\Http\Controllers\PositionControllerUser;
use App\Http\Controllers\PayrollControllerAdmin;
use App\Http\Controllers\PayrollControllerUser;

//-----------------------------------------------------------------------------------
Route::get('/', function () {
    if (auth()->check()) {

        if (auth()->user()->role->name === 'admin') {
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

// Chức năng quản lý đơn xin nghỉ phép
Route::middleware('auth')->group(function () {
    Route::get('/admin/leave', [LeaveControllerAdmin::class, 'index']);
    Route::post('/admin/leave/approve/{id}', [LeaveControllerAdmin::class, 'approve']);
    Route::post('/admin/leave/reject/{id}', [LeaveControllerAdmin::class, 'reject']);
    Route::get('/admin/leave/edit/{id}', [LeaveControllerAdmin::class, 'edit']);
    Route::post('/admin/leave/update/{id}', [LeaveControllerAdmin::class, 'update']);
    Route::delete('/admin/leave/delete/{id}', [LeaveControllerAdmin::class, 'destroy']);

    Route::get('/leave', [LeaveControllerUser::class, 'index']);
    Route::post('/leave/store', [LeaveControllerUser::class, 'store']);
    Route::get('/leave/edit/{id}', [LeaveControllerUser::class, 'edit']);
    Route::post('/leave/update/{id}', [LeaveControllerUser::class, 'update']);
});

// ====== CHỨC NĂNG QUẢN LÝ LƯƠNG ======
Route::middleware('auth')->group(function () {
    Route::get('/admin/payrolls/export', [PayrollControllerAdmin::class, 'export']);
    Route::get('/admin/payrolls', [PayrollControllerAdmin::class, 'index']);
    Route::post('/admin/payrolls', [PayrollControllerAdmin::class, 'store']);
    Route::get('/admin/payrolls/{id}', [PayrollControllerAdmin::class, 'show']);
    Route::get('/admin/payrolls/edit/{id}', [PayrollControllerAdmin::class, 'edit']);
    Route::post('/admin/payrolls/update/{id}', [PayrollControllerAdmin::class, 'update']);
    Route::post('/admin/payrolls/delete/{id}', [PayrollControllerAdmin::class, 'destroy']);

    Route::get('/payrolls', [PayrollControllerUser::class, 'index']);
    Route::get('/payrolls/create', [PayrollControllerUser::class, 'create']);
    Route::post('/payrolls', [PayrollControllerUser::class, 'store']);
    Route::get('/payrolls/{id}', [PayrollControllerUser::class, 'show']);
    Route::get('/payrolls/edit/{id}', [PayrollControllerUser::class, 'edit']);
    Route::post('/payrolls/update/{id}', [PayrollControllerUser::class, 'update']);
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

    Route::get('/departments/export',[DepartmentControllerUser::class,'export']);
    Route::get('/departments',[DepartmentControllerUser::class,'index']);
    Route::get('/departments',[DepartmentControllerUser::class,'search']);
});

// Chức năng quản lý chức vụ
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
    Route::get('/positions', [PositionControllerUser::class,'search']);
    Route::get('/positions/export', [PositionControllerUser::class,'export']);
});