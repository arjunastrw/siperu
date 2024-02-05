<?php
include "../../conf/config.php";

if (isset($_POST['title'], $_POST['start'], $_POST['end'])) {
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Sesuaikan query ini dengan struktur tabel sebenarnya
    $query = "INSERT INTO tb_events (keperluan, tanggalwaktu_mulai, tanggalwaktu_selesai) VALUES ('$title', '$start', '$end')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil disimpan";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
?>
