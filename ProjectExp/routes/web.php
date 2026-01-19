<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StudentController;

// ----------------- ROOT ----------------- //
Route::get('/', [AuthController::class, 'showSelectLogin'])->name('select.login');

// ----------------- STUDENT LOGIN ----------------- //
Route::get('/student/login', [AuthController::class, 'showStudentLogin'])->name('student.login');
Route::post('/student/login', [AuthController::class, 'studentLogin'])->name('student.login.post');
Route::get('/student/{id}/attendance', [AuthController::class, 'showAttendance'])->name('student.attendance');

// ----------------- STAFF LOGIN ----------------- //
Route::get('/staff/login', [AuthController::class, 'showStaffLogin'])->name('staff.login');
Route::post('/staff/login', [AuthController::class, 'staffLogin'])->name('staff.login.post');

// ----------------- ATTENDANCE ----------------- //
// Attendance dashboard (subject optional)
Route::get('/attendance/{subjectId?}', [AttendanceController::class, 'index'])
    ->name('attendance.subject');

// Save attendance
Route::post('/attendance/{subjectId}', [AttendanceController::class, 'store'])
    ->name('attendance.store');

// Attendance report
Route::get('/attendance-report', [AttendanceController::class, 'report'])
    ->name('attendance.report');

// Show assign form
Route::get('/assign-subjects', [AttendanceController::class, 'showAssign'])
    ->name('assign.subjects');

// Save assignment
Route::post('/assign-subjects', [AttendanceController::class, 'storeAssign'])
    ->name('assign.subjects.store');

// ----------------- STUDENTS ----------------- //
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
