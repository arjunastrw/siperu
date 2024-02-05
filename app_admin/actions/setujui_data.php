<?php
include(__DIR__ . '/../../conf/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Ambil data dari tabel data_peminjaman
    $querySelect = mysqli_prepare($koneksi, "SELECT * FROM tb_peminjaman_admin WHERE id=?");
    mysqli_stmt_bind_param($querySelect, "s", $id);
    $resultSelect = mysqli_stmt_execute($querySelect) ? mysqli_stmt_get_result($querySelect) : false;

    if ($resultSelect) {
        if ($row = mysqli_fetch_assoc($resultSelect)) {
            // Pindahkan data ke tabel report_data_peminjaman
            $queryInsert = mysqli_prepare($koneksi, "INSERT INTO tb_report_peminjaman (gedung, ruangan, keperluan, tanggalwaktu_mulai, tanggalwaktu_selesai, nama, details, lampiran, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            // Periksa apakah prepare statement berhasil
            if ($queryInsert) {
                mysqli_stmt_bind_param($queryInsert, "sssssssss", $row['gedung'], $row['ruangan'], $row['keperluan'], $row['tanggalwaktu_mulai'], $row['tanggalwaktu_selesai'], $row['nama'], $row['details'], $row['lampiran'], $status);

                // Set status
                $status = 'Disetujui';

                mysqli_stmt_execute($queryInsert);

                // Hapus data dari tabel data_peminjaman
                $queryDelete = mysqli_prepare($koneksi, "DELETE FROM tb_peminjaman_admin WHERE id=?");
                mysqli_stmt_bind_param($queryDelete, "s", $id);
                
                if (mysqli_stmt_execute($queryDelete)) {
                    // Redirect kembali ke halaman data_peminjaman
                    header('Location: ../index.php?page=report-data-peminjaman');
                    exit();
                } else {
                    // Handle error
                    echo "Error deleting record: " . mysqli_stmt_error($queryDelete);
                }
            } else {
                // Handle error
                echo "Error preparing insert statement: " . mysqli_error($koneksi);
            }
        } else {
            // Data tidak ditemukan
            echo "Data tidak ditemukan.";
        }
    } else {
        // Handle error
        echo "Error executing select statement: " . mysqli_error($koneksi);
    }
} else {
    // Jika bukan metode GET atau tidak ada parameter 'id', redirect atau berikan pesan kesalahan
    echo "Permintaan tidak valid atau parameter 'id' tidak ada.";
}
?>
