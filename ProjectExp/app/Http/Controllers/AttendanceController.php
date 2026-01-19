<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Subject;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index($subjectId = null)
    {
        $subjects = Subject::all();

        if ($subjects->isEmpty()) {
            return redirect()->back()->with('error', 'No subjects found.');
        }

        $currentSubject = $subjectId ? Subject::findOrFail($subjectId) : $subjects->first();

        // ✅ get students from pivot instead of subject_id column
        $students = $currentSubject->students;

        $attendanceRecords = Attendance::where('date', Carbon::today())
            ->where('subject_id', $currentSubject->id)
            ->pluck('status', 'student_id');

        return view('attendances.dashboard', compact(
            'students', 'subjects', 'currentSubject', 'attendanceRecords'
        ));
    }

    public function store(Request $request, $subjectId)
    {
        $subject = Subject::findOrFail($subjectId);

        foreach ($request->attendance ?? [] as $studentId => $status) {
            $student = Student::find($studentId);

            if ($student) {
                Attendance::updateOrCreate(
    [
        'student_id' => $student->id,
        'subject_id' => $subject->id,
        'date'       => Carbon::today(),
    ],
    [
        'status'       => $status,
    ]
);

            }
        }

        return redirect()->route('attendance.subject', $subjectId)
                         ->with('success', 'Attendance saved successfully!');
    }

    public function report()
    {
        $attendances = Attendance::with('student', 'subject')
            ->orderBy('date', 'desc')
            ->get();

        return view('attendances.report', compact('attendances'));
    }

    public function showAssign()
    {
        $students = Student::all();
        $subjects = Subject::all();

        return view('assignSubjects', compact('students', 'subjects'));
    }

    public function storeAssign(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $student = Student::findOrFail($request->student_id);

        // ❌ was: $student->subject_id = $request->subject_id; $student->save();
        // ✅ now using pivot
        $student->subjects()->syncWithoutDetaching([$request->subject_id]);

        return redirect()->route('assign.subjects')->with('success', 'Subject assigned successfully!');
    }
}
