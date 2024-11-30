<?php
session_start();

// Pastikan ada sesi pemesanan yang valid
if (!isset($_SESSION['order'])) {
    header("Location: index.php");
    exit;
}

// Ambil detail pemesanan dari sesi
$order = $_SESSION['order'];

// Pastikan metode pembayaran dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];

    // Validasi metode pembayaran
    $valid_payment_methods = ['credit_card', 'bank_transfer', 'paypal'];
    if (!in_array($payment_method, $valid_payment_methods)) {
        echo "Metode pembayaran tidak valid.";
        exit;
    }

    // Di sini, Anda bisa menambahkan logika untuk memproses pembayaran
    // Misalnya, simpan informasi pembayaran ke database, integrasikan dengan API pembayaran, dll.

    // Setelah pembayaran berhasil diproses, Anda bisa mengosongkan sesi pemesanan
    unset($_SESSION['order']);

    // Tampilkan konfirmasi pembayaran
    echo "<!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Konfirmasi Pembayaran | AA OUTDOORS</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                background-color: #f4f4f4;
                color: #333;
                text-align: center;
                padding: 50px;
            }
            h1 {
                color: #007bff;
            }
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
        </style>
    </head>
    <body>
        <h1>Pembayaran Berhasil!</h1>
        <p>Terima kasih telah melakukan pembayaran.</p>
        <p>Metode Pembayaran: " . htmlspecialchars(ucwords(str_replace('_', ' ', $payment_method))) . "</p>
        <p>Silakan kembali ke <a href='index.php'>halaman utama</a>.</p>
    </body>
    </html>";
} else {
    // Jika tidak ada data POST, redirect ke halaman utama
    header("Location: index.php");
    exit;
}
?>