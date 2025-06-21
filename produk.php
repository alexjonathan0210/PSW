<?php
require_once 'config.php';

// Ambil semua produk dari DB
$stmt = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>All Products - Surya Tanjung Jaya</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <div class="container header">
      <img src="img/untitled-365-x-220-px-10.png" alt="STJ Logo" class="logo" />
      <nav>
        <ul>
          <li><a href="index.php#home">Home</a></li>
          <li><a href="index.php#about">About Us</a></li>
          <li><a href="index.php#product">Product</a></li>
          <li><a href="index.php#brands">Brands</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="brands">
    <h2 style="margin-bottom: 10px;">All Products</h2>
    <p style="text-align: center; font-size: 18px; margin-bottom: 40px;">Discover all of our Food and Beverage brands</p>

    <div class="product-grid">
      <?php foreach ($products as $product): ?>
        <div class="product-card">
          <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
          <div class="product-info">
            <h4><?= htmlspecialchars($product['name']) ?></h4>
            <p><?= htmlspecialchars($product['description']) ?></p>
            <div class="price">Rp <?= number_format($product['price'], 0, ',', '.') ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  
  <footer>
    <div class="container footer">
      <img src="img/untitled-365-x-220-px-11.png" alt="STJ Logo" />
      <div class="footer-text">
        <p>Komplek Union Industrial Park, Blok B1 No. 10-11 29444, Kota Batam Kepulauan Riau</p>
        <p>@stjgroup.id</p>
      </div>
      <img src="img/image-260.png" alt="Map" />
    </div>
  </footer>
</body>
</html>
