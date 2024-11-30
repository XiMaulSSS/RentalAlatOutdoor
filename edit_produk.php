<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

// Koneksi ke database
include 'db.php';

// Cek apakah ID produk ada
if (!isset($_GET['id'])) {
    header('Location: kelola_produk.php');
    exit();
}

$id = $_GET['id'];

// Ambil data produk berdasarkan ID
$query = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$product = $query->fetch(PDO::FETCH_ASSOC);

// Cek apakah produk ditemukan
if (!$product) {
    header('Location: kelola_produk.php');
    exit();
}

// Proses form jika ada pengiriman
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image']; // Pastikan Anda menangani upload gambar jika diperlukan

    // Update produk
    $updateQuery = $pdo->prepare("UPDATE products SET name = :name, description = :description, price = :price, image = :image WHERE id = :id");
    $updateQuery->bindParam(':name', $name);
    $updateQuery->bindParam(':description', $description);
    $updateQuery->bindParam(':price', $price);
    $updateQuery->bindParam(':image', $image);
    $updateQuery->bindParam(':id', $id);
    $updateQuery->execute();

    header('Location: manage_products.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Edit Produk</h1>
    <form method="POST">
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

        <label for="description">Deskripsi:</label>
        <textarea name="description" id="description"
            required><?php echo htmlspecialchars($product['description']); ?></textarea>

        <label for="price">Harga:</label>
        <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($product['price']); ?>"
            required>

        <label for="image">Gambar:</label>
        <input type="text" name="image" id="image" value="<?php echo htmlspecialchars($product['image']); ?>">

        <button type="submit">Simpan Perubahan</button>
    </form>
    <a href="manage_products.php">Kembali</a>
</body>

</html>