<?php
require_once 'PetShop.php';
session_start();

// Inisialisasi daftar produk jika belum ada
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

// Fungsi untuk menambahkan produk baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $id = count($_SESSION['products']) + 1;
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    
    // Upload gambar
    $image = '';
    $targetDir = "images/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    if (!empty($_FILES['image']['name'])) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES['image']['tmp_name']);
        if (in_array($fileType, $allowedTypes)) {
            $image = $targetDir . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
        }
    }
    $product = new PetShop($id, $name, $category, $price, $image);
    $_SESSION['products'][] = $product;
}

// Fungsi untuk menghapus produk
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    foreach ($_SESSION['products'] as $key => $product) {
        if ($product->getId() == $delete_id) {
            unset($_SESSION['products'][$key]);
            $_SESSION['products'] = array_values($_SESSION['products']);
            break;
        }
    }
}

// Fungsi untuk mengedit produk
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product'])) {
    $edit_id = $_POST['edit_id'];
    foreach ($_SESSION['products'] as $key => $product) {
        if ($product->getId() == $edit_id) {
            $_SESSION['products'][$key]->setName($_POST['name']);
            $_SESSION['products'][$key]->setCategory($_POST['category']);
            $_SESSION['products'][$key]->setPrice($_POST['price']);
            
            // Update gambar jika diunggah
            if (!empty($_FILES['image']['name'])) {
                $target_dir = "uploads/";
                $image = $target_dir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $image);
                $_SESSION['products'][$key]->setImage($image);
            }
            break;
        }
    }
}

// Fungsi untuk mencari produk
$search = $_GET['search'] ?? '';
$filtered_products = array_filter($_SESSION['products'], function ($product) use ($search) {
    return stripos($product->getName(), $search) !== false;
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Shop</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f4f9; margin: 20px; text-align: center; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .product { border: 1px solid #ddd; padding: 15px; margin: 10px; display: inline-block; border-radius: 10px; background: #fff; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); }
        img { width: 100px; height: 100px; object-fit: cover; border-radius: 10px; }
        button { padding: 8px 15px; border: none; cursor: pointer; border-radius: 5px; }
        .delete-btn { background: #e74c3c; color: white; }
        .edit-btn { background: #3498db; color: white; }
        .add-btn { background: #2ecc71; color: white; margin-bottom: 10px; }
        .edit-form, .add-form { display: none; margin-top: 10px; }
        input, select { padding: 8px; margin: 5px 0; width: calc(100% - 16px); border: 1px solid #ddd; border-radius: 5px; }
    </style>
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this product?")) {
                window.location.href = 'index.php?delete=' + id;
            }
        }

        function toggleEditForm(id) {
            var form = document.getElementById('edit-form-' + id);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function toggleAddForm() {
            var form = document.getElementById('add-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Pet Shop</h1>
        
        <form method="GET">
            <input type="text" name="search" placeholder="Search product..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>
        
        <h2>Add Product</h2>
        <button class="add-btn" onclick="toggleAddForm()">Add Product</button>
        <form method="POST" enctype="multipart/form-data" id="add-form" class="add-form">
            <input type="text" name="name" placeholder="Product Name" required>
            <input type="text" name="category" placeholder="Category" required>
            <input type="number" name="price" placeholder="Price" required>
            <input type="file" name="image" required>
            <button type="submit" name="add_product">Add</button>
        </form>
        
        <h2>Product List</h2>
        <div>
            <?php foreach ($filtered_products as $product): ?>
                <div class="product">
                    <img src="<?php echo $product->getImage(); ?>" alt="<?php echo $product->getName(); ?>">
                    <p><strong><?php echo $product->getName(); ?></strong></p>
                    <p>Category: <?php echo $product->getCategory(); ?></p>
                    <p>Price: Rp.<?php echo $product->getPrice(); ?></p>
                    <button class="delete-btn" onclick="confirmDelete(<?php echo $product->getId(); ?>)">Delete</button>
                    <button class="edit-btn" onclick="toggleEditForm(<?php echo $product->getId(); ?>)">Edit</button>
                    
                    <form method="POST" enctype="multipart/form-data" id="edit-form-<?php echo $product->getId(); ?>" class="edit-form">
                        <input type="hidden" name="edit_id" value="<?php echo $product->getId(); ?>">
                        <input type="text" name="name" value="<?php echo $product->getName(); ?>" required>
                        <input type="text" name="category" value="<?php echo $product->getCategory(); ?>" required>
                        <input type="number" name="price" value="<?php echo $product->getPrice(); ?>" required>
                        <input type="file" name="image">
                        <button type="submit" name="edit_product">Save</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
