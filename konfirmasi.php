<?php
session_start();
include 'db.php';

// Pastikan ada data yang dikirim dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['jumlah'])) {
    $product_id = $_POST['product_id'];
    $jumlah = $_POST['jumlah'];

    // Ambil detail produk berdasarkan ID
    $query = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $query->execute(['id' => $product_id]);
    $product = $query->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Simpan informasi pemesanan ke sesi
        $_SESSION['order'] = [
            'product_id' => $product['id'],
            'name' => $product['name'],
            'jumlah' => $jumlah,
            'price' => $product['price'],
            'total' => $product['price'] * $jumlah,
        ];
    } else {
        // Jika produk tidak ditemukan, redirect ke halaman utama
        header("Location: index.php");
        exit;
    }
} else {
    // Jika tidak ada data POST, redirect ke halaman utama
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pemesanan | AA OUTDOORS</title>
    <style>
        /* Reset dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background: #007bff;
            color: white;
            padding: 10px 0;
        }

        .navbar .container {
            width: 80%;
            margin: auto;
        }

        .nav-links {
            list-style: none;
            display: flex;
            justify-content: flex-end;
        }

        .nav-links li {
            margin-left: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        /* Main Content */
        main {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        .order-confirmation {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
        }

        .order-confirmation h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .order-confirmation p {
            margin-bottom: 10px;
        }

        /* Tautan */
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background: #0056b3;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 15px 0;
            background: #007bff;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 768px) {
            .navbar .container {
                width: 90%;
            }

            main {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <ul class="nav-links">
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="se wa.php">Sewa</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <h2>Konfirmasi Pemesanan</h2>
        <div class="order-confirmation">
            <h3>Terima kasih telah melakukan pemesanan!</h3>
            <p>Berikut adalah detail pemesanan Anda:</p>
            <p>Nama Produk: <?php echo htmlspecialchars($_SESSION['order']['name']); ?></p>
            <p>Jumlah: <?php echo htmlspecialchars($_SESSION['order']['jumlah']); ?></p>
            <p>Harga per unit: Rp <?php echo number_format($_SESSION['order']['price'], 0, ',', '.'); ?></p>
            <p>Total: Rp <?php echo number_format($_SESSION['order']['total'], 0, ',', '.'); ?></p>
            <p>Silakan lanjutkan ke pembayaran untuk menyelesaikan pemesanan Anda.</p>
            <a href="payment.php">Lanjut ke Pembayaran</a>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 AA Outdoor. Semua hak dilindungi.</p>
    </footer>
</body>

</html>