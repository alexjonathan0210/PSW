<?php
session_start();
require_once 'config.php';

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    header("Location: backend/dashboard.php");
    exit();
  } else {
    $error = "Username atau password salah!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    body {
      background-color: #f5f9f5;
      font-family: Arial, sans-serif;
    }
    .form-container {
      width: 400px;
      margin: 80px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }
    h2 {
      color: #28a745;
      text-align: center;
    }
    input[type="text"], input[type="password"] {
      width: 93%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    button {
      width: 100%;
      padding: 12px;
      background: #28a745;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 10px;
    }
    .text-link {
      text-align: center;
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Login Admin</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit" name="login">Login</button>
    </form>
    <div class="text-link">
      <a href="register.php">Belum punya akun? Register</a>
    </div>
  </div>
</body>
</html>
