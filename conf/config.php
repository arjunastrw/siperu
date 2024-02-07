<?php
$host = "localhost";
$username = "root";
$password = "Since2024.";
$database = "db_siperu";

$koneksi = new mysqli($host, $username, $password, $database);

// Mengecek koneksi
if ($koneksi->connect_error) {
    die("Koneksi Gagal: " . $koneksi->connect_error);
}


// Menentukan nilai default untuk $user_role jika belum ada dalam sesi
if (!isset($_SESSION['user_role'])) {
    $_SESSION['user_role'] = 'guest';
}

// Mendapatkan nilai $user_role dari sesi
$user_role = $_SESSION['user_role'];
