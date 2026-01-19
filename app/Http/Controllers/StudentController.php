<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;

class StudentController extends Controller
{
    // Show the add-student form
    public function create()
    {
        $subjects = Subject::all();
        return view('addStudent', compact('subjects'));
    }

    // Store new student
    public function store(Request $request)
    {
        $request->validate([
            'roll_no'    => 'required|string|max:50',
            'name'       => 'required|string|max:100',
            'subjects'   => 'nullable|array',
            'subjects.*' => 'exists:subjects,id'
        ]);

        // check if UID exists
        if (Student::where('roll_no', $request->roll_no)->exists()) {
            return redirect()->back()->with('error', 'Student already registered with this UID!');
        }

        // create student (no subject_id column anymore)
        $student = Student::create([
            'roll_no' => $request->roll_no,
            'name'    => $request->name,
        ]);

        // attach multiple subjects (pivot table student_subject)
        if ($request->filled('subjects')) {
            $student->subjects()->attach($request->subjects);
        }

        return redirect()->back()->with('success', 'Student added successfully!');
    }
}
