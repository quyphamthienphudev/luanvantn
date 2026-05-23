<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PayrollController;

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

   

    Route::get('/profile', [UserController::class, 'editProfile']);
    Route::post('/profile', [UserController::class, 'updateProfile']);

    Route::get('/change-password', [UserController::class, 'showChangePassword']);
    Route::post('/change-password', [UserController::class, 'changePassword']);

    Route::get('/admin/accounts', [UserController::class,'index']);
    Route::get('/admin/accounts/create', [UserController::class,'create']);
    Route::post('/admin/accounts/store', [UserController::class,'store']);
    Route::get('/admin/accounts/edit/{id}', [UserController::class,'edit']);
    Route::post('/admin/accounts/update/{id}', [UserController::class,'update']);
    Route::get('/admin/accounts/delete/{id}', [UserController::class,'delete']);

    Route::get('/admin/accounts', [UserController::class,'search']);
    Route::get('/admin/accounts/export', [UserController::class,'export']);

    Route::post('/admin/accounts/{id}/reset-password', 
    [UserController::class, 'resetPassword'])
    ->name('admin.accounts.resetPassword');

    Route::get('/admin/dashboard',[DashboardController::class,'dashboard']);
    Route::get('/dashboard',[DashboardController::class,'userdashboard']);
});

// Chức năng quản lý đơn xin nghỉ phép
    
Route::get('/leave', [LeaveController::class, 'index'])->name('index');
    
Route::post('/leave/store', [LeaveController::class, 'store']);

Route::get('/leave/edit/{id}', [LeaveController::class, 'edit']);
Route::post('/leave/update/{id}', [LeaveController::class, 'update']);
  
Route::get('/admin/leave', [LeaveController::class, 'adminIndex'])->name('adminIndex');
    
Route::post('/admin/leave/approve/{id}', [LeaveController::class, 'approve']);
Route::post('/admin/leave/reject/{id}', [LeaveController::class, 'reject']);
Route::get('/admin/leave/edit/{id}', [LeaveController::class, 'adminEdit']);
Route::post('/admin/leave/update/{id}', [LeaveController::class, 'adminUpdate']);
Route::delete('/admin/leave/delete/{id}', [LeaveController::class, 'destroy']);

// ====== CHỨC NĂNG QUẢN LÝ LƯƠNG ======

Route::get('/admin/payrolls/export', [PayrollController::class, 'export']);
Route::get('/admin/payrolls', [PayrollController::class, 'adminIndex']);
Route::post('/admin/payrolls', [PayrollController::class, 'store']);
Route::get('/admin/payrolls/{id}', [PayrollController::class, 'adminShow']);
Route::get('/admin/payrolls/edit/{id}', [PayrollController::class, 'adminEdit']);
Route::post('/admin/payrolls/update/{id}', [PayrollController::class, 'adminUpdate']);
Route::post('/admin/payrolls/delete/{id}', [PayrollController::class, 'destroy']);

Route::get('/payrolls', [PayrollController::class, 'index']);
Route::get('/payrolls/create', [PayrollController::class, 'create']);
Route::post('/payrolls', [PayrollController::class, 'store']);
Route::get('/payrolls/{id}', [PayrollController::class, 'show']);
Route::get('/payrolls/edit/{id}', [PayrollController::class, 'edit']);
Route::post('/payrolls/update/{id}', [PayrollController::class, 'update']);

// Chức năng quản lý nhân viên
Route::get('/employees',[EmployeeController::class,'index']);
Route::get('/employees/create',[EmployeeController::class,'create']);
Route::post('/employees/store',[EmployeeController::class,'store']);
Route::get('/employees/edit/{id}',[EmployeeController::class,'edit']);
Route::post('/employees/update/{id}',[EmployeeController::class,'update']);
Route::get('/employees/show/{id}',[EmployeeController::class,'show']);

Route::get('/admin/employees',[EmployeeController::class,'adminIndex']);
Route::get('/admin/employees/create',[EmployeeController::class,'adminCreate']);
Route::post('/admin/employees/store',[EmployeeController::class,'adminStore']);
Route::get('/admin/employees/edit/{id}',[EmployeeController::class,'adminEdit']);
Route::post('/admin/employees/update/{id}',[EmployeeController::class,'adminUpdate']);
Route::get('/admin/employees/delete/{id}',[EmployeeController::class,'delete']);
Route::get('/admin/employees/show/{id}',[EmployeeController::class,'adminShow']);

// Chức năng quản lý phòng ban
Route::get('/departments',[DepartmentController::class,'index']);

Route::get('/departments',[DepartmentController::class,'search']);

Route::get('/admin/departments',[DepartmentController::class,'adminIndex']);
Route::get('/admin/departments/create',[DepartmentController::class,'create']);
Route::post('/admin/departments/store',[DepartmentController::class,'store']);
Route::get('/admin/departments/edit/{id}',[DepartmentController::class,'edit']);
Route::post('/admin/departments/update/{id}',[DepartmentController::class,'update']);
Route::get('/admin/departments/delete/{id}',[DepartmentController::class,'delete']);

Route::get('/admin/departments',[DepartmentController::class,'adminSearch']);
Route::get('/admin/departments/export',[DepartmentController::class,'adminExport']);
Route::get('/departments/export',[DepartmentController::class,'export']);

// Chức năng quản lý chức vụ
Route::get('/admin/positions', [PositionController::class,'index']);
Route::get('/admin/positions/create', [PositionController::class,'create']);
Route::post('/admin/positions/store', [PositionController::class,'store']);
Route::get('/admin/positions/edit/{id}', [PositionController::class,'edit']);
Route::post('/admin/positions/update/{id}', [PositionController::class,'update']);
Route::get('/admin/positions/delete/{id}', [PositionController::class,'delete']);

Route::get('/admin/positions', [PositionController::class,'adminSearch']);
Route::get('/admin/positions/export', [PositionController::class,'adminExport']);

Route::get('/positions', [PositionController::class,'userIndex']);

Route::get('/positions', [PositionController::class,'search']);
Route::get('/positions/export', [PositionController::class,'export']);