<!DOCTYPE html>
<html>
<head>
    <title>{{ $student->name }} Attendance</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #dfe9f3, #ffffff);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 85%;
            max-width: 1000px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        h1 { text-align: center; color: #2c3e50; margin-bottom: 15px; }
        h2 { margin: 30px 0 15px; color: #16a085; border-left: 5px solid #16a085; padding-left: 10px; }

        .filter {
            text-align: right;
            margin-bottom: 20px;
        }

        .filter input[type="date"] {
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            background: #16a085;
            color: white;
            cursor: pointer;
            margin-left: 5px;
        }

        button:hover { background: #13856e; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 14px; border-bottom: 1px solid #eee; text-align: center; }
        th { background: #16a085; color: white; }

        .present { color: #27ae60; font-weight: bold; }
        .absent { color: #e74c3c; font-weight: bold; }

        .progress { background: #ecf0f1; border-radius: 10px; height: 16px; }
        .progress-bar { height: 100%; text-align: right; padding-right: 6px; color: white; font-weight: bold; }
        .low { background: #e74c3c; }
        .medium { background: #f39c12; }
        .high { background: #27ae60; }
    </style>
</head>
<body>

<div class="container">
    <h1>{{ $student->name }} Attendance</h1>

    <!-- 🔹 Date Filter -->
    <div class="filter">
        <form method="GET" action="{{ route('student.attendance', $student->id) }}">
            <label for="date">Select Date: </label>
            <input type="date" name="date" value="{{ $selectedDate }}">
            <button type="submit">View</button>
        </form>
    </div>

    <!-- 🔹 Attendance for Selected Date -->
    <div class="card">
        <h2>Attendance on {{ \Carbon\Carbon::parse($selectedDate)->format('d M, Y') }}</h2>
        <table>
            <tr>
                <th>Subject</th>
                <th>Status</th>
            </tr>
            @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->name }}</td>
                <td class="{{ isset($attendanceByDate[$subject->id]) && $attendanceByDate[$subject->id]->status=='Present' ? 'present' : 'absent' }}">
                    {{ isset($attendanceByDate[$subject->id]) ? $attendanceByDate[$subject->id]->status : 'Absent' }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- 🔹 Overall Attendance -->
    <div class="card">
        <h2>Overall Attendance</h2>
        <table>
            <tr>
                <th>Subject</th>
                <th>Attendance %</th>
            </tr>
            @foreach($subjects as $subject)
            @php 
                $percent = $overallAttendance[$subject->id] ?? 0; 
                $barClass = $percent < 40 ? 'low' : ($percent < 75 ? 'medium' : 'high');
            @endphp
            <tr>
                <td>{{ $subject->name }}</td>
                <td>
                    <div class="progress">
                        <div class="progress-bar {{ $barClass }}" style="width: {{ $percent }}%;">{{ $percent }}%</div>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

</body>
</html>
