<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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
public function showAttendance(Request $request, $studentId)
{
    $student = Student::findOrFail($studentId);
    $subjects = Subject::all();

    // If a date is selected, use it; otherwise default to today
    $selectedDate = $request->input('date', Carbon::today()->toDateString());

    // Attendance records for the selected date
    $attendanceByDate = Attendance::where('student_id', $student->id)
        ->whereDate('date', $selectedDate)
        ->get()
        ->keyBy('subject_id');

    // Overall attendance percentage
    $overallAttendance = [];
    foreach ($subjects as $subject) {
        $total = Attendance::where('student_id', $student->id)
            ->where('subject_id', $subject->id)
            ->count();
        $present = Attendance::where('student_id', $student->id)
            ->where('subject_id', $subject->id)
            ->where('status', 'Present')
            ->count();

        $overallAttendance[$subject->id] = $total > 0 ? round(($present / $total) * 100) : 0;
    }

    return view('studentAttendance', compact(
        'student',
        'subjects',
        'attendanceByDate',
        'overallAttendance',
        'selectedDate'
    ));
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
                  ->where('password', $request->password) // demo only
                  ->first();

    if (! $staff) {
        return back()->withErrors(['invalid' => 'Invalid staff credentials']);
    }

    // store minimal staff info in session (safer than storing full model)
    session(['staff' => $staff->only(['id','name'])]);

    // redirect to attendance dashboard (AttendanceController@index will pick first subject)
    return redirect()->route('attendance.subject', ['subjectId' => null]);

}

public function staffLogout(Request $request)
{
    $request->session()->forget('staff'); // clear staff session
    return redirect()->route('staff.login')->with('success', 'Logged out successfully');
}

}
