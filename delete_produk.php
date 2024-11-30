<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php'); // Arahkan ke halaman login jika belum login
    exit();
}

include 'db.php'; // Pastikan Anda memiliki file ini untuk koneksi database

// Cek apakah ID produk diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Siapkan dan eksekusi query untuk menghapus produk
    $query = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $query->execute([$id]);

    // Redirect setelah menghapus produk
    header('Location: admin_dashboard.php');
    exit();
} else {
    echo "ID produk tidak ditemukan.";
}
?>