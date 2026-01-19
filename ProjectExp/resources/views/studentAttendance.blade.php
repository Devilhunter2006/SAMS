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
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 2.4rem;
            margin-bottom: 15px;
        }

        h2 {
            text-align: left;
            color: #16a085;
            margin: 35px 0 15px;
            font-size: 1.4rem;
            border-left: 5px solid #16a085;
            padding-left: 10px;
        }

        .card {
            background: #fafafa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #eee;
            text-align: center;
            font-size: 15px;
        }

        th {
            background: #16a085;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: #fdfdfd;
        }

        tr:hover {
            background-color: #f1fdf9;
            transition: background 0.3s ease-in-out;
        }

        .present {
            color: #27ae60;
            font-weight: bold;
        }

        .absent {
            color: #e74c3c;
            font-weight: bold;
        }

        .percentage {
            font-weight: bold;
            color: #2980b9;
        }

        /* Progress bar */
        .progress {
            background: #ecf0f1;
            border-radius: 10px;
            overflow: hidden;
            height: 16px;
            margin-top: 5px;
        }

        .progress-bar {
            height: 100%;
            text-align: right;
            padding-right: 6px;
            font-size: 12px;
            color: white;
            font-weight: bold;
            line-height: 16px;
            border-radius: 10px;
        }

        .low { background: #e74c3c; }
        .medium { background: #f39c12; }
        .high { background: #27ae60; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>{{ $student->name }} Attendance</h1>

    <div class="card">
        <h2>Today's Attendance</h2>
        <table>
            <tr>
                <th>Subject</th>
                <th>Status</th>
            </tr>
            @foreach($subjects as $subject)
            <tr>
                <td>{{ $subject->name }}</td>
                <td class="{{ isset($todayAttendance[$subject->id]) && $todayAttendance[$subject->id]->status=='Present' ? 'present' : 'absent' }}">
                    {{ isset($todayAttendance[$subject->id]) ? $todayAttendance[$subject->id]->status : 'Absent' }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>

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
                    <div class="percentage">{{ $percent }}%</div>
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
