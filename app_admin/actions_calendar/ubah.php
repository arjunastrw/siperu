<?php
include "../../conf/config.php";

if (isset($_POST['id'], $_POST['title'], $_POST['start'], $_POST['end'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Sesuaikan query ini dengan struktur tabel sebenarnya
    $query = "UPDATE tb_events SET keperluan = '$title', tanggalwaktu_mulai = '$start', tanggalwaktu_selesai = '$end' WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil diubah";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>
