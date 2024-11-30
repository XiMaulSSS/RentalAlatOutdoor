<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit();
}

// Koneksi ke database
include 'db.php';

// Ambil semua produk
$query = $pdo->prepare("SELECT * FROM products");
$query->execute();
$products = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
            text-align: center;
            margin: 20px 0;
        }

        nav {
            background-color: #007bff;
            padding: 10px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        img {
            width: 100px;
            height: auto;
        }

        .button {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            background-color: #28a745;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #218838;
        }

        .action-buttons a {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            margin-right: 5px;
            font-size: 14px;
        }

        .action-buttons .edit-btn {
            background-color: #007bff;
        }

        .action-buttons .edit-btn:hover {
            background-color: #0056b3;
        }

        .action-buttons .delete-btn {
            background-color: #dc3545;
        }

        .action-buttons .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <h1>Daftar Produk</h1>
    <nav>
        <ul>
            <li><a href="admin_dashboard.php">Beranda</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>


    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($product['image']); ?>"
                            alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </td>
                    <td class="action-buttons">
                        <a class="edit-btn" href="edit_produk.php?id=<?php echo $product['id']; ?>">Edit</a>
                        <a class="delete-btn" href="delete_produk.php?id=<?php echo $product['id']; ?>"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="add_products.php" class="button">Tambah Produk</a>
</body>

</html>