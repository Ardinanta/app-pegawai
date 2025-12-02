<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceMonitoringController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php'; // Breeze auth routes

Route::get('/', function () {
    return redirect()->route('login');
});

// Protected routes with auth middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Employee routes
    Route::resource('employees', EmployeeController::class);
    
    // Department routes
    Route::resource('departments', DepartmentController::class);
    
    // Position routes
    Route::resource('positions', PositionController::class);
    
    // Salary routes
    Route::resource('salaries', SalaryController::class);
    Route::get('salaries/{salary}/download-pdf', [SalaryController::class, 'downloadPdf'])->name('salaries.downloadPdf');
    Route::get('salaries/{salary}/print', [SalaryController::class, 'print'])->name('salaries.print');
    
    // Attendance routes
    Route::get('attendances/create', [AttendanceController::class, 'create'])->name('attendances.create');
    Route::post('attendances/{employee}/clock-in', [AttendanceController::class, 'clockIn'])->name('attendances.clock-in');
    Route::post('attendances/{employee}/clock-out', [AttendanceController::class, 'clockOut'])->name('attendances.clock-out');
    Route::get('attendances/manual/create', [AttendanceController::class, 'createManual'])->name('attendances.create.manual');
    Route::post('attendances/manual', [AttendanceController::class, 'storeManual'])->name('attendances.store.manual');
    Route::resource('attendances', AttendanceController::class)->except(['create']);
    
    // Attendance monitoring
    Route::get('attendance-monitoring', [AttendanceMonitoringController::class, 'index'])->name('attendance-monitoring.index');
});
