<?php
require_once 'config.php';

if (isset($_POST['register'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  try {
    $stmt->execute([$username, $email, $password]);
    header("Location: login.php");
    exit();
  } catch (PDOException $e) {
    $error = "Username atau email sudah digunakan.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
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
    input[type="text"], input[type="email"], input[type="password"] {
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
    <h2>Register Admin</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
      <input type="text" name="username" placeholder="Username" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit" name="register">Register</button>
    </form>
    <div class="text-link">
      <a href="login.php">Sudah punya akun? Login</a>
    </div>
  </div>
</body>
</html>
