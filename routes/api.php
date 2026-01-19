<?php
use App\Http\Controllers\AttendanceController;

Route::post('/mark-attendance', [AttendanceController::class, 'markViaAI']);
