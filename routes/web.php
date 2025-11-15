<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    DashboardController, EmployeeController, DepartmentController, PositionController, AttendanceController, SalaryController
};

use App\Models\{
    Employee, Department, Position, Attendance, Salary
};

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
?>

