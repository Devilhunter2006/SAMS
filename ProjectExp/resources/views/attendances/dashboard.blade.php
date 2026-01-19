
<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #eef2f3, #ffffff);
            margin: 0;
            padding: 0;
        }
        .container {
            width: 85%;
            max-width: 1000px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
            font-weight: 600;
        }
        /* Subject flashcards */
        .subjects {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .subject-card {
            padding: 12px 20px;
            background-color: #3498db;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            font-weight: 500;
            min-width: 140px;
            transition: 0.3s;
        }
        .subject-card.active, .subject-card:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            font-size: 16px;
        }
        table th, table td {
            padding: 14px 18px;
            text-align: left;
        }
        table th {
            background-color: #1abc9c;
            color: #fff;
        }
        table tr:nth-child(even) { background-color: #f9f9f9; }
        table tr:hover { background-color: #d1f2eb; }
        input[type="checkbox"] { width: 22px; height: 22px; cursor: pointer; accent-color: #1abc9c; }
        button {
            display: block;
            width: 100%;
            padding: 15px;
            font-size: 17px;
            background-color: #1abc9c;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }
        .success-message { background-color: #2ecc71; color: #fff; padding: 12px; text-align:center; margin-bottom:20px; border-radius:6px;}
        .error-message { background-color: #e74c3c; color: #fff; padding: 12px; text-align:center; margin-bottom:20px; border-radius:6px;}
    </style>
</head>
<body>

<div class="container">
    <h1>Mark Attendance</h1>

    <!-- Subjects flashcards -->
    <div class="subjects">
        @foreach($subjects as $subject)
            <a href="{{ route('attendance.subject', $subject->id) }}"
               class="subject-card {{ $currentSubject->id == $subject->id ? 'active' : '' }}">
               {{ $subject->name }}
            </a>
        @endforeach
    </div>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('attendance.store', $currentSubject->id) }}">
        @csrf
        <table>
            <thead>
                <tr>
                    <th>Roll No</th>
                    <th>Student Name</th>
                    <th>Present</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->roll_no }}</td>
                        <td>{{ $student->name }}</td>
                        <td>
                            <input type="checkbox" name="attendance[{{ $student->id }}]" value="present"
                            @if(isset($attendanceRecords[$student->id]) && $attendanceRecords[$student->id]=='present') checked @endif>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit">Save Attendance</button>
    </form>
</div>

</body>
</html>
