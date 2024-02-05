<?php
session_start();
include('config.php');

// Menggunakan parameterisasi query untuk menghindari SQL injection
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

// Menggunakan password hash (contoh menggunakan MD5, disarankan menggunakan metode yang lebih aman seperti bcrypt)
$password = md5($password);

// Mencari pengguna di tabel tb_users
$query_user = "SELECT * FROM tb_users WHERE username='$username' AND password='$password'";
$result_user = mysqli_query($koneksi, $query_user);

// Mencari pengguna di tabel tb_admin
$query_admin = "SELECT * FROM tb_admin WHERE username='$username' AND password='$password'";
$result_admin = mysqli_query($koneksi, $query_admin);

// Mencari pengguna di tabel tb_pimpinan
$query_pimpinan = "SELECT * FROM tb_pimpinan WHERE username='$username' AND password='$password'";
$result_pimpinan = mysqli_query($koneksi, $query_pimpinan);

// Periksa apakah query berhasil dieksekusi
if ($result_user && mysqli_num_rows($result_user) == 1) {
    $user_data = mysqli_fetch_assoc($result_user);
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $user_data['role'];
    $_SESSION['nama'] = $user_data['nama'];
    header('Location: ../app_users');
    exit();
} elseif ($result_admin && mysqli_num_rows($result_admin) == 1) {
    $admin_data = mysqli_fetch_assoc($result_admin);
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $admin_data['role'];
    $_SESSION['nama'] = $admin_data['nama'];
    header('Location: ../app_admin');
    exit();
} elseif ($result_pimpinan && mysqli_num_rows($result_pimpinan) == 1) {
    $pimpinan_data = mysqli_fetch_assoc($result_pimpinan);
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $pimpinan_data['role'];
    $_SESSION['nama'] = $pimpinan_data['nama'];
    header('Location: ../app_pimpinan');
    exit();
} elseif (empty($username) || empty($password)) {
    header('Location: ../index.php?error=2');
    exit();
} else {
    header('Location: ../index.php?error=1');
    exit();
}
?>
