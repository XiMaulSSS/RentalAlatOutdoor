<?php
session_start();
include 'db.php'; // Pastikan Anda memiliki file ini untuk koneksi database

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image']; // Asumsikan Anda menyimpan path gambar

    // Siapkan dan eksekusi pernyataan SQL untuk memasukkan produk
    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $description, $price, $image])) {
        $message = "Produk berhasil ditambahkan!";
    } else {
        $message = "Gagal menambahkan produk.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - AA OUTDOORS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        header {
            background-color: #007BFF;
            color: black;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
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
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 80%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
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
            width: 100%;
            position: relative;
            bottom: 0;
        }
    </style>
</head>

<body>
    <header>
        <h3>Tambah Produk</h3>
        <nav class="navbar">
            <div class="container">
                <ul class="nav-links">
                    <li><a href="admin_dashboard.php">Beranda</a></li>
                    <li><a href="admin_login.php">Admin</a></li>
                    <li><a href="index.php">Lihat Produk</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <?php if (isset($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <div class="container">
            <form method="POST" action="">
                <label for="name">Nama Produk:</label>
                <input type="text" name="name" required>

                <label for="description">Deskripsi:</label>
                <textarea name="description" required></textarea>

                <label for="price">Harga:</label>
                <input type="number" name="price" step="0.01" required>

                <label for="image">Gambar (URL):</label>
                <input type="text" name="image" required>

                <button type="submit">Tambah Produk</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 AA Outdoor. Semua hak dilindungi.</p>
    </footer>
</body>

</html>