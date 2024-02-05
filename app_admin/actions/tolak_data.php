<?php
include(__DIR__ . '/../../conf/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Ambil data terlebih dahulu (jika perlu)
    $querySelect = mysqli_prepare($koneksi, "SELECT * FROM tb_peminjaman_admin WHERE id=?");
    mysqli_stmt_bind_param($querySelect, "s", $id);
    $resultSelect = mysqli_stmt_execute($querySelect) ? mysqli_stmt_get_result($querySelect) : false;

    if ($resultSelect) {
        $row = mysqli_fetch_assoc($resultSelect);

        // Hapus data dari tabel data_peminjaman
        $queryDelete = mysqli_prepare($koneksi, "DELETE FROM tb_peminjaman_admin WHERE id=?");
        mysqli_stmt_bind_param($queryDelete, "s", $id);

        if (mysqli_stmt_execute($queryDelete)) {
            // Tutup statement
            mysqli_stmt_close($queryDelete);

            // Redirect kembali ke halaman data_peminjaman
            header('Location: ../index.php?page=data-peminjaman-admin');
            exit();
        } else {
            // Handle error
            echo "Error deleting record: " . mysqli_stmt_error($queryDelete);
        }

        // Tutup statement
        mysqli_stmt_close($querySelect);
    } else {
        // Handle error
        echo "Error executing select statement: " . mysqli_error($koneksi);
    }
} else {
    // Jika bukan metode GET atau tidak ada parameter 'id', redirect atau berikan pesan kesalahan
    echo "Invalid request or missing 'id' parameter.";
}
?>
