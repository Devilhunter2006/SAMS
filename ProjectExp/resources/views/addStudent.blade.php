<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Outer container for responsiveness */
        .container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
        }

        .form-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            animation: fadeIn 0.6s ease-in-out;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            color: #444;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #667eea;
            box-shadow: 0 0 6px rgba(102, 126, 234, 0.5);
        }

        .subjects {
            margin-top: 10px;
            padding-left: 10px;
        }

        .subjects label {
            font-weight: normal;
            color: #555;
            margin-left: 5px;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #5a67d8, #6b46c1);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        p {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
        }

        p[style*="color:green"] {
            color: #2ecc71 !important;
        }

        p[style*="color:red"] {
            color: #e74c3c !important;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Add Student</h2>

            @if(session('success'))
                <p style="color:green;">{{ session('success') }}</p>
            @endif
            @if(session('error'))
                <p style="color:red;">{{ session('error') }}</p>
            @endif

            <form method="POST" action="{{ route('students.store') }}">
                @csrf
                <label>Roll No:</label>
                <input type="text" name="roll_no" required>

                <label>Name:</label>
                <input type="text" name="name" required>

               

                <button type="submit">Add Student</button>
            </form>
        </div>
    </div>
</body>
</html>
