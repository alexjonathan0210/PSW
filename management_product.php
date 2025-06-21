<?php
session_start();
require_once '../config.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id          = isset($_POST['id']) ? $_POST['id'] : null;
  $name        = $_POST['name'];
  $category    = $_POST['category'];
  $description = $_POST['description'];
  $price       = $_POST['price'];

  $imagePath = null;
  if (!empty($_FILES['image']['name'])) {
    $targetDir = "uploads/";
    if (!is_dir("../" . $targetDir)) {
      mkdir("../" . $targetDir, 0777, true);
    }
    $imageName  = basename($_FILES["image"]["name"]);
    $uniqueName = time() . "_" . $imageName;
    $targetFile = $targetDir . $uniqueName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], "../" . $targetFile)) {
      $imagePath = $targetFile;
    }
  }

  if (empty($id)) {
    // Insert baru
    $stmt = $conn->prepare("INSERT INTO products (name, image, category, description, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $imagePath, $category, $description, $price]);
  } else {
    // Ambil image lama jika tidak upload baru
    if (!$imagePath) {
      $stmtOld = $conn->prepare("SELECT image FROM products WHERE id = ?");
      $stmtOld->execute([$id]);
      $row = $stmtOld->fetch();
      $imagePath = $row['image'];
    }

    $stmt = $conn->prepare("UPDATE products SET name = ?, image = ?, category = ?, description = ?, price = ? WHERE id = ?");
    $stmt->execute([$name, $imagePath, $category, $description, $price, $id]);
  }

  header("Location: management_product.php");
  exit();
}

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];

  // Hapus gambar jika ada
  $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
  $stmt->execute([$id]);
  $product = $stmt->fetch();

  if ($product && !empty($product['image']) && file_exists('../' . $product['image'])) {
    unlink('../' . $product['image']);
  }

  // Hapus produk
  $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
  $stmt->execute([$id]);

  header("Location: management_product.php");
  exit();
}

// Ambil data produk
$stmt = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Products - Surya Tanjung Jaya</title>
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
      <h1>Manage Products</h1>
      <button class="btn-add" onclick="openAddModal()">+ Add New Product</button>

      <table class="product-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Image</th>
              <th>Name</th>
              <th>Description</th>
              <th>Price (Rp)</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 1;
              foreach ($products as $product):
            ?>
            <tr>
              <td><?= $no++; ?></td>
              <td>
                <?php if ($product['image']): ?>
                  <img src="../<?= $product['image'] ?>" width="60">
                <?php else: ?>
                  <em>No image</em>
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($product['name']) ?></td>
              <td><?= htmlspecialchars($product['description']) ?></td>
              <td><?= number_format($product['price'], 0, ',', '.') ?></td>
              <td>
              <button class="btn-edit"
              data-id="<?= $product['id'] ?>"
              data-name="<?= htmlspecialchars($product['name'], ENT_QUOTES) ?>"
              data-category="<?= htmlspecialchars($product['category'], ENT_QUOTES) ?>"
              data-description="<?= htmlspecialchars($product['description'], ENT_QUOTES) ?>"
              data-price="<?= $product['price'] ?>"
              onclick="handleEdit(this)"
            >Edit</button>
                <a href="?delete=<?= $product['id'] ?>" onclick="return confirm('Delete this product?')">
                  <button class="btn-delete">Delete</button>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
      </table>
    </main>
  </div>

  <!-- Modal Tambah Produk -->
  <div class="modal" id="modalAdd">
    <div class="modal-content">
      <span class="close" onclick="closeModal('modalAdd')">&times;</span>
      <h2>Add New Product</h2>
      <form action="management_product.php" method="POST" enctype="multipart/form-data">
        <label>Name</label>
        <input type="text" name="name" required>

        <label>Image</label>
        <input type="file" name="image">

        <label>Category</label>
        <input type="text" name="category">

        <label>Description</label>
        <textarea name="description" rows="4"></textarea>

        <label>Price (Rp)</label>
        <input type="number" name="price" step="0.01" required>

        <button type="submit" class="btn-add">Save</button>
      </form>
    </div>
  </div>

  <!-- Modal Edit Produk -->
  <div class="modal" id="modalEdit">
    <div class="modal-content">
      <span class="close" onclick="closeModal('modalEdit')">&times;</span>
      <h2>Edit Product</h2>
      <form id="editForm" action="management_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="editId">

        <label>Name</label>
        <input type="text" name="name" id="editName" required>

        <label>Image</label>
        <input type="file" name="image">

        <label>Category</label>
        <input type="text" name="category" id="editCategory">

        <label>Description</label>
        <textarea name="description" id="editDescription" rows="4"></textarea>

        <label>Price (Rp)</label>
        <input type="number" name="price" id="editPrice" step="0.01" required>

        <button type="submit" class="btn-edit">Update</button>
      </form>
    </div>
  </div>

  <script>
  function closeModal(id) {
    document.getElementById(id).style.display = "none";
  }

  function openAddModal() {
    document.getElementById('modalAdd').style.display = "block";
  }

  function handleEdit(button) {
    const id = button.getAttribute('data-id');
    const name = button.getAttribute('data-name');
    const category = button.getAttribute('data-category');
    const description = button.getAttribute('data-description');
    const price = button.getAttribute('data-price');

    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editCategory').value = category;
    document.getElementById('editDescription').value = description;
    document.getElementById('editPrice').value = price;

    document.getElementById('modalEdit').style.display = 'block';
  }
</script>
</body>
</html>
