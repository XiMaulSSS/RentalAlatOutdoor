<?php
$host = '127.0.0.1'; // atau 'localhost'
$dbname = 'camping_rental';
$username = 'root'; // Sesuaikan dengan username database Anda
$password = ''; // Kosong jika tidak ada password pada XAMPP
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>