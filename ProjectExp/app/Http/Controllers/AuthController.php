<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Staff;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Attendance;

class AuthController extends Controller
{
    // ---------------- SELECT LOGIN ----------------
    public function showSelectLogin()
    {
        return view('selectLogin');
    }

    // ---------------- STUDENT LOGIN ----------------
    public function showStudentLogin()
    {
        return view('studentLogin'); 
    }

    public function studentLogin(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'pass' => 'required'
        ]);

        $login = Login::where('name', $request->user)
                      ->where('password', $request->pass)
                      ->first();

        if ($login) {
            return redirect()->route('student.attendance', ['id' => $login->id]);
        } else {
            return back()->withErrors(['invalid' => 'Invalid credentials']);
        }
    }

    // ---------------- STUDENT ATTENDANCE ----------------
    public function showAttendance($id)
    {
        $student = Student::findOrFail($id);
        $subjects = Subject::all();

        $todayAttendance = Attendance::where('student_id', $id)
            ->whereDate('date', now()->toDateString())
            ->get()
            ->keyBy('subject_id');

        $overallAttendance = [];
        foreach ($subjects as $subject) {
            $total = Attendance::where('student_id', $id)
                ->where('subject_id', $subject->id)
                ->count();

            $present = Attendance::where('student_id', $id)
                ->where('subject_id', $subject->id)
                ->where('status', 'Present')
                ->count();

            $overallAttendance[$subject->id] = $total > 0 ? round(($present / $total) * 100) : 0;
        }

        return view('studentAttendance', compact('student', 'subjects', 'todayAttendance', 'overallAttendance'));
    }
    
    // ---------------- STAFF LOGIN ----------------
    public function showStaffLogin()
    {
        return view('staffLogin');
    }

    public function staffLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $staff = Staff::where('name', $request->name)
                      ->where('password', $request->password) // ⚠️ for demo only
                      ->first();

        if ($staff) {
            $subjects = Subject::all();
            $currentSubject = $subjects->first();

            $students = collect();
            $attendanceRecords = collect();

            if ($currentSubject) {
                // ✅ fetch students via pivot
                $students = $currentSubject->students;

                // ✅ attendance for current subject
                $attendanceRecords = Attendance::where('subject_id', $currentSubject->id)
                                               ->pluck('status', 'student_id');
            }

            return view('attendances.dashboard', compact('subjects', 'currentSubject', 'students', 'attendanceRecords'));
        } else {
            return back()->withErrors(['invalid' => 'Invalid staff credentials']);
        }
    }
}
