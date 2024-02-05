<?php
session_start();
include('config.php');
include('auth.php');

// Menggunakan parameterisasi query untuk menghindari SQL injection
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

// Menguji apakah username dan password kosong
if (empty($username) || empty($password)) {
    header('Location: ../index.php?error=2');
    exit();
}

// Hash password menggunakan password_hash
$password = password_hash($password, PASSWORD_DEFAULT);

// Menguji autentikasi untuk admin
if (authenticateUser($koneksi, $username, $password, 'tb_admin')) {
    $admin_data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username='$username'"));

    $_SESSION['username'] = $username;
    $_SESSION['role'] = $admin_data['role']; // Pastikan nama kolom sesuai
    $_SESSION['nama'] = $admin_data['nama'];

    header('Location: ../app_admin'); // Arahkan ke folder app_admin
    exit();
}

// Menguji autentikasi untuk user
if (authenticateUser($koneksi, $username, $password, 'tb_users')) {
    $user_data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_users WHERE username='$username'"));

    $_SESSION['username'] = $username;
    $_SESSION['role'] = $user_data['role']; // Pastikan nama kolom sesuai
    $_SESSION['nama'] = $user_data['nama'];

    header('Location: ../app'); // Arahkan ke folder app
    exit();
}

// Menguji autentikasi untuk pimpinan
if (authenticateUser($koneksi, $username, $password, 'tb_pimpinan')) {
    $pimpinan_data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_pimpinan WHERE username='$username'"));

    $_SESSION['username'] = $username;
    $_SESSION['role'] = $pimpinan_data['role']; // Pastikan nama kolom sesuai
    $_SESSION['nama'] = $pimpinan_data['nama'];

    header('Location: ../app_pimpinan'); // Arahkan ke folder app_pimpinan
    exit();
}

// Autentikasi gagal untuk semua tipe pengguna
header('Location: ../index.php?error=1');
exit();
