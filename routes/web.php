<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    DashboardController, EmployeeController, DepartmentController, PositionController, AttendanceController, SalaryController, AttendanceMonitoringController, AuthController
};

use App\Models\{
    Employee, Department, Position, Attendance, Salary
};

// Authentication Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

// Logout Route (Authenticated only)
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    // Protected Routes - All routes below require authentication
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('employees', EmployeeController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('salaries', SalaryController::class);
    
    Route::get('/salaries/{salary}/download-pdf', 
        [App\Http\Controllers\SalaryController::class, 'downloadPdf'])
        ->name('salaries.downloadPdf');
    Route::get('/employees/export/excel', 
        [App\Http\Controllers\EmployeeController::class, 'exportExcel'])
        ->name('employees.exportExcel');
        
    Route::post('attendances/clock-in/{employee}', [AttendanceController::class, 'clockIn'])->name('attendances.clockIn');
    Route::post('attendances/clock-out/{employee}', [AttendanceController::class, 'clockOut'])->name('attendances.clockOut');
    Route::get('attendances/manual/create', [AttendanceController::class, 'createManual'])->name('attendances.createManual');
    
    Route::get('attendance-monitoring', [AttendanceMonitoringController::class, 'index'])->name('attendance-monitoring.index');
});
?>

