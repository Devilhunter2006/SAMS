<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Select Login - Attendance Management System</title>
  <style>
    body {
      margin: 0;
      height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #667eea, #764ba2, #759effff, #6a73d3ff);
      color: #333;
    }

    .logo {
      font-size: 2.8rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 2px;
      color: #ffffff;
      text-align: center;
      margin-bottom: 50px;
      text-shadow: 0 2px 8px rgba(0,0,0,0.3);
      animation: fadeInDown 1s ease forwards;
    }

    .container {
      display: flex;
      gap: 40px;
      flex-wrap: wrap;
      justify-content: center;
      animation: fadeInUp 1.2s ease forwards;
    }

    .card {
      background: #ffffff;
      border-radius: 16px;
      padding: 30px 25px;
      width: 260px;
      height: 320px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      text-align: center;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      text-decoration: none;
      color: inherit;
    }

    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 16px 40px rgba(0, 0, 0, 0.25);
    }

    .card img {
      width: 90px;
      height: auto;
      margin-bottom: 20px;
    }

    .card h2 {
      margin: 10px 0;
      font-size: 1.4rem;
      color: #2c3e50;
    }

    .card p {
      font-size: 0.95rem;
      color: #555;
      line-height: 1.4;
    }

    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 650px) {
      .container {
        flex-direction: column;
        gap: 25px;
      }
      .logo {
        font-size: 2rem;
        margin-bottom: 35px;
      }
      .card {
        width: 220px;
        padding: 25px 20px;
        height: auto;
      }
    }
  </style>
</head>
<body>
  <div class="logo">Attendance Management System</div>

  <div class="container">
    <!-- Student Login -->
   <a href="{{ route('student.login') }}" class="card">
  <img src="{{ asset('Student.png') }}" alt="Student Logo">
  <h2>Student Login</h2>
  <p>Access your dashboard to view attendance, meals, and manage your account efficiently.</p>
</a>
    <!-- Staff Login -->
    <a href="{{ route('staff.login') }}" class="card">
  <img src="{{ asset('staff.png') }}" alt="Staff Logo">
  <h2>Staff Login</h2>
  <p>Manage students, attendance, and other administrative tasks from your staff portal.</p>
</a>
    
  </div>
</body>
</html>
