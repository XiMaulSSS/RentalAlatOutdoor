<?php
session_start();

// Hapus informasi admin dari session
unset($_SESSION['admin_logged_in']);
unset($_SESSION['admin_id']);

// Arahkan ke halaman login
header('Location: admin_login.php');
exit();