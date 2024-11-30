<?php
session_start();
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
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

        .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .prdk {
            width: 100%;
            max-width: 400px;
            height: auto;
        }

        img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        a {
            display: inline-block;
            margin-top: 5px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        .sewa-form {
            margin-top: 20px;
        }

        .sewa-form input[type="number"] {
            width: 50px;
            margin-right: 10px;
        }

        .sewa-button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .sewa-button:hover {
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
        <div class="logo">
            <img src="image/aa.png" alt="Logo">
        </div>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="index.php">Beranda</a></li>
                <li><a href="sewa.php">Sewa</a></li>
                <li><a href="admin_login.php">Admin</a></li>
                <li><a href="login.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <main>
            <div class="prdk">
                <img src="<?php echo htmlspecialchars($product['image']); ?>"
                    alt="<?php echo htmlspecialchars($product['name']); ?>">
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>Harga: Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
                <form class="sewa-form" action="sewa.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <label for="quantity">Jumlah:</label>
                    <input type="number" name="quantity" id="quantity" min="1" value="1">
                    <button type="submit" class="sewa-button">Sewa</button>
                </form>
                <a href="index.php">Kembali ke daftar produk</a>
            </div>
        </main>
    </div>

    <footer>
        <p>&copy; 2024 AA Outdoor. Semua hak dilindungi.</p>
    </footer>
</body>

</html>