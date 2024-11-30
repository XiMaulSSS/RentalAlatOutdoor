<?php
session_start();
include 'db.php'; // Pastikan Anda memiliki file ini untuk koneksi database

// Ambil data produk dari database
$query = $pdo->prepare("SELECT * FROM products");
$query->execute();
$products = $query->fetchAll(PDO::FETCH_ASSOC); // Ambil semua produk sebagai array asosiatif
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AA OUTDOORS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 100px;
            margin-right: 10px;
        }

        .navbar {
            display: flex;
        }

        .nav-links {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .nav-links li {
            margin: 0 15px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        main {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            flex: 1;
            /* Memungkinkan main untuk mengisi ruang yang tersisa */
        }

        .product-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            /* Mengubah lebar gambar menjadi 100% dari kontainer */
            height: auto;
        }

        .product-card h3 {
            font-size: 18px;
            margin: 10px 0;
        }

        .product-card p {
            font-size: 14px;
            margin: 5px 0;
            color: #666;
        }

        .button-wrapper {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            padding: 10px 20px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .button-wrapper:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f1f1f1;
            margin-top: auto;
            /* Memastikan footer berada di bawah */
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icon {
            width: 50px;
            /* Atur ukuran ikon sesuai kebutuhan */
            height: auto;
            /* Agar proporsional */
            margin: 0 10px;
            /* Jarak antar ikon */
            vertical-align: middle;
            /* Mengatur posisi vertikal */
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img src="image/aa.png" alt="Logo">
        </div>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="admin_dashboard.php">Beranda</a></li>
                <li><a href="admin_login.php">Admin</a></li>
                <li><a href="rent-items.php">Rent</a></li>
                <li><a href="manage_products.php">Add Product</a></li>
                <li><a href="index.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="<?php echo htmlspecialchars($product['image']); ?>"
                    alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>Harga: Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                <a href="product.php?id=<?php echo $product['id']; ?>" class="button-wrapper">Selengkapnya</a>
            </div>
        <?php endforeach; ?>
    </main>
    <footer>
        <p>&copy; 2024 AA Outdoor. Semua hak dilindungi.</p>
        <div class="social-icons">
            <a href="https://www.facebook.com/irwan.selaloe?" target="_blank">
                <img src="image/fb.png" alt="Facebook" class="social-icon">
            </a>
            <a href="https://www.tiktok.com/@irwangularso?" target="_blank">
                <img src="image/tt.png" alt="Tiktok" class="social-icon">
            </a>
            <a href="https://www.instagram.com/endelweisss_?" target="_blank">
                <img src="image/ig.png" alt="Instagram" class="social-icon">
            </a>
        </div>
    </footer>
</body>

</html>