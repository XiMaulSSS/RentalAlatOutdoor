<?php
session_start();
include 'db.php'; // Pastikan Anda memiliki file ini untuk koneksi database

// Ambil data barang yang dirental oleh pengguna
$query = $pdo->prepare("
    SELECT rentals.id, users.name AS user_name, products.name AS product_name, rentals.rental_date, rentals.return_date 
    FROM rentals 
    JOIN users ON rentals.user_id = users.id 
    JOIN products ON rentals.product_id = products.id
");
$rented_items = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang yang Dirental - AA OUTDOORS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        h1 {
            color: #007BFF;
        }

        .navbar {
            margin-bottom: 20px;
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
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <ul class="nav-links">
                <li><a href="admin_dashboard.php">Beranda</a></li>
                <li><a href="admin_login.php">Admin</a></li>
                <li><a href="manage_products.php">Add Product</a></li>
                <li><a href="rented_items.php">Barang yang Dirental</a></li>
                <li><a href="index.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <h1>Barang yang Dirental</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pengguna</th>
                <th>Nama Produk</th>
                <th>Tanggal Sewa</th>
                <th>Tanggal Pengembalian</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rented_items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['id']); ?></td>
                    <td><?php echo htmlspecialchars($item['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['rental_date']); ?></td>
                    <td><?php echo htmlspecialchars($item['return_date']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>