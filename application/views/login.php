<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login UI</title>
  <style>
    body {
      background-color: #1e1e2d;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .login-container {
      background-color: #2a2a3c;
      width: 300px;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    h2 {
      color: #ffffff;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group input {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 4px;
      background-color: #3c3c4f;
      color: #ffffff;
    }

    .form-group input::placeholder {
      color: #a2a5b9;
    }

    .login-button {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 4px;
      background-color: #007bff;
      color: #ffffff;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .login-button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Welcome</h2>
    <form method="post">
      <div class="form-group">
        <input type="text" placeholder="USERNAME" name="username" required>
      </div>
      <div class="form-group">
        <input type="password" placeholder="PASSWORD" name="password" required>
      </div>
      <button type="submit" class="login-button">LOGIN</button>
    </form>
  </div>
</body>
</html>