<?php
include 'db.php';
include 'session-check.php'; // Memastikan pengguna sudah login

// Ambil data produk dari database
$query = $pdo->query("SELECT * FROM products"); // Ganti 'products' dengan nama tabel produk Anda
$products = $query->fetchAll(PDO::FETCH_ASSOC);

// Ambil data sewa
$query = $pdo->query("SELECT * FROM sewa");
$sewa = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa | AA OUTDOORS</title>
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
            padding: 20px;
            text-align: center;
        }

        .navbar {
            margin: 20px 0;
        }

        .nav-links {
            list-style: none;
            padding: 0;
        }

        .nav-links li {
            display: inline;
            margin: 0 15px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        main {
            padding: 20px;
            flex: 1;
            /* Memungkinkan main untuk mengisi ruang yang tersisa */
        }

        h2 {
            text-align: center;
        }

        .product-list,
        .sewa-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .product,
        .sewa-item {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            width: 200px;
            /* Ukuran tetap untuk kartu produk/sewa */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .product img,
        .sewa-item img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .product h3,
        .sewa-item h3 {
            font-size: 16px;
            margin: 10px 0;
        }

        .product p,
        .sewa-item p {
            font-size: 14px;
            margin: 5px 0;
            color: #666;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f1f1f1;
            margin-top: auto;
            /* Memastikan footer berada di bawah */
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <ul class="nav-links">
                    <li><a href="index.php">Kembali</a></li>
                    <li><a href="sewa.php">Sewa</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <h2>Produk Yang Tersedia</h2>
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>"
                        alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p>Harga: Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                    <a href="product.php?id=<?php echo $product['id']; ?>">Detail</a>

                    <!-- Tombol Sewa -->
                    <form method="POST" action="konfirmasi.php" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="number" name="jumlah" min="1" value="1" style="width: 50px;" required>
                        <button type="submit">Sewa</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="sewa-list">
            <?php foreach ($sewa as $sewa_item): ?>
                <div class="sewa-item">
                    <h3><?php echo $sewa_item['nama_sewa']; ?></h3>
                    <p><?php echo $sewa_item['deskripsi']; ?></p>
                    <p>Harga: Rp <?php echo number_format($sewa_item['harga'], 0, ',', '.'); ?></p>
                    <a href="bukti-penyewaan.php?id=<?php echo $sewa_item['id']; ?>">Detail</a>
                    <form method="POST" action="add-to-cart.php" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?php echo $sewa_item['id']; ?>">
                        <input type="number" name="jumlah" min="1" value="1" style="width: 50px;" required>
                        <button type="submit">Sewa</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 AA Outdoor. Semua hak dilindungi.</p>
    </footer>
</body>

</html>