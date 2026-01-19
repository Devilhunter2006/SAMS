<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Staff Login - Attendance Management System</title>
  <style>
    body {
      margin: 0;
      height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #667eea, #764ba2, #ff758c, #ff7eb3);
      background-size: 400% 400%;
      animation: gradientShift 15s ease infinite;
    }
    .wrapper {
      display: flex;
      width: 80%;
      max-width: 1000px;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      animation: fadeIn 1s ease forwards;
    }
    .login-container {
      flex: 1;
      max-width: 450px;
      padding: 60px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    .login-container h1 {
      margin-bottom: 30px;
      color: #764ba2;
      font-size: 2rem;
      letter-spacing: 1px;
      text-transform: uppercase;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 14px;
      margin: 10px 0 20px;
      border: none;
      border-radius: 25px;
      background: #f7f7f7;
      font-size: 16px;
      box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    input[type="text"]:focus,
    input[type="password"]:focus {
      outline: none;
      background: #fff;
      box-shadow: 0 0 10px rgba(118, 75, 162, 0.3);
    }
    button {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border: none;
      border-radius: 25px;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    button:hover {
      background: linear-gradient(135deg, #ff758c, #ff7eb3);
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(255, 118, 186, 0.4);
    }
    .logo-side {
      flex: 1;
      background: rgba(255, 255, 255, 0.95);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px;
    }
    .logo-side img {
      max-width: 250px;
      height: auto;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 1s ease forwards;
      animation-delay: 0.3s;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    @media (max-width: 768px) {
      .wrapper { flex-direction: column; text-align: center; }
      .logo-side { order: -1; padding: 20px; }
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="login-container">
      <h1>Staff Log In</h1>
      <form method="POST" action="{{ route('staff.login.post') }}">
  @csrf
  <input type="text" placeholder="Staff Name" name="name" value="{{ old('name') }}" required>
  <input type="password" placeholder="Password" name="password" required>
  <button type="submit">Login</button>
</form>

@if($errors->any())
  <div style="color:red; margin-top:10px;">
    {{ $errors->first() }}
  </div>
@endif

    </div>
    <div class="logo-side">
      <img src="{{ asset('staff.png') }}" alt="Staff Logo">
    </div>
  </div>
</body>
</html>
