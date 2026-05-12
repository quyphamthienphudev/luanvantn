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
use App\Http\Controllers\Week3Controller;

//Kiểm tra kết quả tuần 3
Route::get('/users', [Week3Controller::class,'view']);
Route::get('/users/{id}', [Week3Controller::class,'detail']);
Route::post('/users/add', [Week3Controller::class,'store']);
Route::post('/users/update/{id}', [Week3Controller::class,'update']);
Route::get('/users/delete/{id}', [Week3Controller::class,'delete']);

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

    Route::post('/admin/accounts/{id}/reset-password', 
    [UserController::class, 'resetPassword'])
    ->name('admin.accounts.resetPassword');

    Route::get('/admin/dashboard',[DashboardController::class,'dashboard']);
    Route::get('/dashboard',[DashboardController::class,'userdashboard']);
});

//Route::get('/dashboard',[DashboardController::class,'userdashboard'])->middleware('auth');


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

// ====== CHỨC NĂNG QUẢN LÝ LƯƠNG ======

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('payrolls/export', [PayrollController::class, 'export']);
    Route::get('payrolls/calculate/{month?}/{year?}', [PayrollController::class, 'calculate']);
    Route::get('payrolls', [PayrollController::class, 'index']);
    Route::get('payrolls/create', [PayrollController::class, 'create']);
    Route::post('payrolls', [PayrollController::class, 'store']);
    Route::get('payrolls/{id}', [PayrollController::class, 'show']);
    Route::get('payrolls/edit/{id}', [PayrollController::class, 'edit']);
    Route::post('payrolls/update/{id}', [PayrollController::class, 'update']);
    Route::post('payrolls/delete/{id}', [PayrollController::class, 'destroy']);
});

Route::prefix('/')->name('user.')->group(function () {
    Route::get('payrolls/calculate/{month?}/{year?}', [PayrollController::class, 'calculate']);
    Route::get('payrolls', [PayrollController::class, 'index']);
    Route::get('payrolls/create', [PayrollController::class, 'create']);
    Route::post('payrolls', [PayrollController::class, 'store']);
    Route::get('payrolls/{id}', [PayrollController::class, 'show']);
});

// Chức năng quản lý nhân viên
Route::get('/employees',[EmployeeController::class,'index']);
Route::get('/employees/create',[EmployeeController::class,'create']);
Route::post('/employees/store',[EmployeeController::class,'store']);
Route::get('/employees/edit/{id}',[EmployeeController::class,'edit']);
Route::post('/employees/update/{id}',[EmployeeController::class,'update']);
Route::get('/employees/delete/{id}',[EmployeeController::class,'delete']);
Route::get('/employees/show/{id}',[EmployeeController::class,'show']);

Route::get('/admin/employees',[EmployeeController::class,'adminIndex']);
Route::get('/admin/employees/create',[EmployeeController::class,'adminCreate']);
Route::post('/admin/employees/store',[EmployeeController::class,'adminStore']);
Route::get('/admin/employees/edit/{id}',[EmployeeController::class,'adminEdit']);
Route::post('/admin/employees/update/{id}',[EmployeeController::class,'adminUpdate']);
Route::get('/admin/employees/delete/{id}',[EmployeeController::class,'adminDelete']);
Route::get('/admin/employees/show/{id}',[EmployeeController::class,'adminShow']);

// Chức năng quản lý phòng ban
Route::get('/departments',[DepartmentController::class,'index']);
Route::get('/departments/create',[DepartmentController::class,'create']);
Route::post('/departments/store',[DepartmentController::class,'store']);
Route::get('/departments/edit/{id}',[DepartmentController::class,'edit']);
Route::post('/departments/update/{id}',[DepartmentController::class,'update']);
Route::get('/departments/delete/{id}',[DepartmentController::class,'delete']);

Route::get('/admin/departments',[DepartmentController::class,'adminIndex']);
Route::get('/admin/departments/create',[DepartmentController::class,'adminCreate']);
Route::post('/admin/departments/store',[DepartmentController::class,'adminStore']);
Route::get('/admin/departments/edit/{id}',[DepartmentController::class,'adminEdit']);
Route::post('/admin/departments/update/{id}',[DepartmentController::class,'adminUpdate']);
Route::get('/admin/departments/delete/{id}',[DepartmentController::class,'adminDelete']);

// Chức năng quản lý chức vụ
Route::get('/admin/positions', [PositionController::class,'index']);
Route::get('/admin/positions/create', [PositionController::class,'create']);
Route::post('/admin/positions/store', [PositionController::class,'store']);
Route::get('/admin/positions/edit/{id}', [PositionController::class,'edit']);
Route::post('/admin/positions/update/{id}', [PositionController::class,'update']);
Route::get('/admin/positions/delete/{id}', [PositionController::class,'delete']);

Route::get('/positions', [PositionController::class,'userIndex']);

// --- CHỨC NĂNG QUẢN LÝ CHẤM CÔNG ---
Route::middleware('auth')->group(function () {
    Route::get('/attendances', [AttendanceController::class, 'index']);
    Route::get('/admin/attendances', [AttendanceController::class, 'adminIndex']);
    Route::get('/admin/attendances/edit/{id}', [AttendanceController::class, 'adminEdit']);
    Route::post('/admin/attendances/update/{id}', [AttendanceController::class, 'adminUpdate']);
    Route::get('/admin/attendances/delete/{id}', [AttendanceController::class, 'adminDelete']);
    Route::get('/attendances/edit/{id}', [AttendanceController::class, 'edit']);
    Route::post('/attendances/update/{id}', [AttendanceController::class, 'update']);
});
