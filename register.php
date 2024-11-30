<?php
session_start();
include 'db.php'; // Pastikan Anda memiliki koneksi database yang benar

// Cek apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect ke halaman utama jika sudah login
    exit;
}

// Proses pendaftaran jika formulir dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error_message = "Semua kolom harus diisi.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Kata sandi dan konfirmasi kata sandi tidak cocok.";
    } else {
        // Cek apakah nama pengguna sudah ada
        $query = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $query->execute(['username' => $username]);
        if ($query->rowCount() > 0) {
            $error_message = "Nama pengguna sudah terdaftar. Silakan pilih nama pengguna lain.";
        } else {
            // Hash kata sandi
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan pengguna baru ke database
            $insert_query = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $insert_query->execute(['username' => $username, 'password' => $hashed_password]);

            // Redirect ke halaman login setelah berhasil mendaftar
            header("Location: login.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | AA OUTDOORS</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
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
            width: 100%;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2>Daftar</h2>
        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Nama Pengguna:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Kata Sandi:</label>
            <input type="password" name="password" id="password" required>

            <label for="confirm_password">Konfirmasi Kata Sandi:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>

            <button type="submit">Daftar</button>
        </form>
        <p style="text-align: center; margin-top: 10px;">Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>

</html>