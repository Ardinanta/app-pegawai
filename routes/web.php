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

?>

