<?php
session_start();
require_once '../config.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit();
}

// Ambil total produk
$stmt = $conn->query("SELECT COUNT(*) as total FROM products");
$totalProducts = $stmt->fetch()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard - Surya Tanjung Jaya</title>
  <link rel="stylesheet" href="../style.css" />
</head>
<body>
  <div class="admin-container">
    <aside class="sidebar">
      <h2>Admin Panel</h2>
      <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <hr style="margin-bottom: 20px;">
        <li><a href="management_product.php">Manage Products</a></li>
        <hr style="margin-bottom: 20px;">
        <li><a href="../index.php">Logout</a></li>
      </ul>
    </aside>

    <main class="main-content">
      <h1>Welcome to the Admin Dashboard</h1>
      <p>Use the sidebar to navigate through the management features.</p>

      <div class="dashboard-stats">
        <div class="cards">
          <h3>Total Products</h3>
          <p><?= $totalProducts ?></p>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
