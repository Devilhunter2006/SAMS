<!DOCTYPE html>
<html>
<head>
    <title>Assign Subjects</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 40px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 10px; }
        select, button { width: 100%; padding: 10px; margin: 10px 0; }
        .success { background: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Assign Subject to Student</h2>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('assign.subjects.store') }}">
            @csrf
            <label for="student">Select Student:</label>
            <select name="student_id" id="student" required>
                <option value="">-- Select Student --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }} (Roll No: {{ $student->roll_no }})</option>
                @endforeach
            </select>

            <label for="subject">Select Subject:</label>
            <select name="subject_id" id="subject" required>
                <option value="">-- Select Subject --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>

            <button type="submit">Assign Subject</button>
        </form>
    </div>
</body>
</html>
