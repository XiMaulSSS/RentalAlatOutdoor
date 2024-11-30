<?php
session_start();
include 'db.php';

// Pastikan ada sesi pemesanan yang valid
if (!isset($_SESSION['order'])) {
    header("Location: index.php");
    exit;
}

// Ambil detail pemesanan dari sesi
$order = $_SESSION['order'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran | AA OUTDOORS</title>
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

        .payment-details {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
        }

        .payment-details h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .payment-details p {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 15px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
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
                    <li><a href="sewa.php">Sewa</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <h2>Detail Pembayaran</h2>
        <div class="payment-details">
            <h3>Produk yang Dipesan:</h3>
            <p>Nama Produk: <?php echo htmlspecialchars($order['name']); ?></p>
            <p>Jumlah: <?php echo htmlspecialchars($order['jumlah']); ?></p>
            <p>Harga per unit: Rp <?php echo number_format($order['price'], 0, ',', '.'); ?></p>
            <p>Total : Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></p>

            <h3>Metode Pembayaran</h3>
            <form method="POST" action="proses-payment.php">
                <label for="payment_method">Pilih Metode Pembayaran:</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="credit_card">Kartu Kredit</option>
                    <option value="bank_transfer">Transfer Bank</option>
                    <option value="paypal">PayPal</option>
                </select>
                <button type="submit">Bayar Sekarang</button>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 AA Outdoor. Semua hak dilindungi.</p>
    </footer>
</body>

</html>