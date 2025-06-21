<?php
require_once 'config.php';

// Ambil 8 produk terbaru
$stmt = $conn->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 8");
$featuredProducts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surya Tanjung Jaya</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <div class="container header">
      <img src="img/untitled-365-x-220-px-10.png" alt="STJ Logo" class="logo">
      <nav>
        <ul>
          <li><a href="#home">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#product">Product</a></li>
          <li><a href="#brands">Brands</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="hero" id="home">
    <div class="container hero-content">
      <div class="text">
        <h1>Surya <br> Tanjung Jaya</h1>
        <p>Founded by Mr. Budijaya Go in 1989 with the first fast-food outlet in BCS Batam.</p>
        <div class="brand-logos-wrapper">
          <div class="brand-logos"><img src="img/image-210.png" alt="brands"></div>
          <div class="brand-logos"><img src="img/image-220.png" alt="brands"></div>
          <div class="brand-logos"><img src="img/image-230.png" alt="brands"></div>
          <div class="brand-logos"><img src="img/image-240.png" alt="brands"></div>
          <div class="brand-logos"><img src="img/image-250.png" alt="brands"></div>
          <div class="brand-logos"><img src="img/untitled-1-01-11.png" alt="brands"></div>
        </div>
      </div>
      <div class="hero-img">
        <img src="img/dsc-07316-660-x-420-10.png" alt="Outlet">
      </div>
    </div>
  </section>

  <section class="move-on">
    <h2>Move On</h2>
    <div class="move-categories">
      <div><img src="img/food.png" alt="icon"><p>Food</p></div>
      <div><img src="img/beverages.png" alt="icon"><p>Beverages</p></div>
      <div><img src="img/desert.png" alt="icon"><p>Dessert</p></div>
    </div>
  </section>

  <section class="see-all-brands">
    <img src="img/image-210.png" alt="brands">
    <img src="img/image-210.png" alt="brands">
    <img src="img/image-210.png" alt="brands">
    <img src="img/image-210.png" alt="brands">
    <img src="img/image-210.png" alt="brands">
    <img src="img/image-210.png" alt="brands">
    <a href="#">See all Brands <img src="img/right0.svg" alt="" class="rightimg"></a>
  </section>

  <section class="stats" id="about">
    <div class="stats-left">
      <h3>Provide The Best <span>Culinary Delights for Customers</span></h3>
      <p>We reached here with our hard work and dedication</p>
    </div>
    <div class="facts">
      <div><img src="img/icon0.svg"><strong>2,000 +</strong><p>Employees</p></div>
      <div><img src="img/group-20.svg"><strong>27</strong><p>Brands</p></div>
      <div><img src="img/icon2.svg"><strong>2</strong><p>Culinary Schools</p></div>
      <div><img src="img/icon3.svg"><strong>86</strong><p>Outlets</p></div>
    </div>
  </section>
  
  <section class="leader">
    <div class="item">
      <img src="img/screenshot-2025-02-18-124322-10.png" alt="Dessert">
      <div>
        <h3>No.1 Leader in Food and Beverage Sector</h3>
        <p>Founded in 1998 by Mr. Buyong Goh, PT Surya Tanjung Jaya is now the largest F&B company in the Riau Islands. Starting with Batam’s first fast-food restaurant, the company has grown to 27 brands, 2 culinary schools, 86 outlets, and over 2,000 employees.</p>
      </div>
    </div>
    <div class="item">
      <img src="img/image-90.png" alt="Bread">
      <p>Has rapidly grown to become a leader in the food and beverage industry in Batam, Riau Islands. Founded by Mr. Buyong Goh in 1998, the company started with the first fast-food restaurant in Batam, BFC. Recognizing the city's growth, Mr. Goh expanded by introducing a variety of cuisines that were previously unavailable in Batam, making the city a diverse culinary destination. Today, PT. Surya Tanjung Jaya is the largest food and beverage company in the Riau Islands, with 27 café and restaurant brands, 2 culinary schools, a kitchen equipment distributor, 86 outlets, and over 2,000 employees.</p>
    </div>
  </section>  

  <section class="brands">

    <div class="section-title-with-link centered" id="product">
      <h2>Featured Products</h2>
      <a href="produk.php" class="see-all-link">
        See all Products
        <img src="img/right0.svg" alt="" class="rightimg">
      </a>
    </div>

    <div class="brand-slider-wrapper">
      <button class="slider-btn left" onclick="slideLeft()">‹</button>
      <div class="brand-slider" id="brandSlider">
        <?php foreach ($featuredProducts as $product): ?>
          <div class="product-card">
            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            <p class="product-name"><?= htmlspecialchars($product['name']) ?></p>
            <p class="product-price">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
          </div>
        <?php endforeach; ?>
      </div>
      <button class="slider-btn right" onclick="slideRight()">›</button>
    </div>

    <h2 id="brands">School</h2>
    <div class="brand-group">
      <img src="img/smt-school-brand-1024-x-616-10.png" alt="SMT">
      <img src="img/adimulia-website-brand-1024-x-616-10.png" alt="Adimulia">
      <img src="img/edunesia-brand-1-1024-x-616-10.png" alt="Edunesia">
    </div>
  
    <h2>Food and Beverage</h2>
    <div class="brand-group">
      <img src="img/malaya-website-1-10.png" alt="Malaka Cafe">
      <img src="img/coffeetown-bakery-website-10.png" alt="row1">
      <img src="img/coffee-town-logo-revisi-website-10.png" alt="row2">
      <img src="img/baresto-website-10.png" alt="row2">
      <img src="img/the-smith-website-10.png" alt="The Smith">
      <img src="img/duck-kitchen-website-10.png" alt="DX">
      <img src="img/chaleaf-website-10.png" alt="The Tea">
      <img src="img/godiva-website-10.png" alt="Godiva">
      <img src="img/untitled-1-01-10.png" alt="Yorks Estate">
      <img src="img/untitled-1-03-10.png" alt="Riqi">
      <img src="img/untitled-1-05-10.png" alt="Golden Bao">
      <img src="img/toby-estate-website-10.png" alt="Tata">
      <img src="img/renuin-website-10.png" alt="Renuin">
      <img src="img/garden-bay-10.png" alt="Renuin">
      <img src="img/papa-ron-website-10.png" alt="Renuin">
      <img src="img/justeak-website-10.png" alt="Justeak">
      <img src="img/serenu-1-10.png" alt="Sheem">
      <img src="img/tiptop-website-10.png" alt="Big Top">
      <img src="img/lapisa-new-logo-website-10.png" alt="Lapisa">
      <img src="img/bread-social-website-10.png" alt="Bread Social">
      <img src="img/_2-bakers-website-10.png" alt="2Bakers">
      <img src="img/cakeya-website-10.png" alt="Cake Yo">
      <img src="img/glamour-website-10.png" alt="GS">
      <img src="img/mie-cekban-logo-website-10.png" alt="Cekian">
      <img src="img/sucre-logo-website-10.png" alt="Sweetbar">
      <img src="img/oriental-palace-website-10.png" alt="Oriental Palace">
      <img src="img/kencana-catering-website-10.png" alt="KC">
    </div>
  
    <h2>Department Store</h2>
    <div class="brand-group">
      <img src="img/ok-10.png" alt="Living">
      <img src="img/gomax-10.png" alt="Domax">
      <img src="img/gk-logo-website-10.png" alt="GK">
    </div>
  
    <h2>Entertainment</h2>
    <div class="brand-group">
      <img src="img/kiddos-website-10.png" alt="Kiddos">
    </div>
  </section>
  
  <h1 class="aboutfoot">About Us</h1>

  <footer>
    <div class="container footer">
      <img src="img/untitled-365-x-220-px-11.png" alt="STJ Logo">
      <div class="footer-text">
        <p>Komplek Union Industrial Park, Blok B1 No. 10-11 29444, Kota Batam Kepulauan Riau</p>
        <p>@stjgroup.id</p>
      </div>
      <img src="img/image-260.png" alt="Map">
    </div>
  </footer>

  <script>
    function slideLeft() {
      const slider = document.getElementById("brandSlider");
      slider.scrollBy({ left: -300, behavior: 'smooth' });
    }
  
    function slideRight() {
      const slider = document.getElementById("brandSlider");
      slider.scrollBy({ left: 300, behavior: 'smooth' });
    }
  </script>
  
</body>
</html>