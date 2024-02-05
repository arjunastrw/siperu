<?php
// Panggil koneksi database
include "../../conf/config.php";

$tampil = mysqli_query($koneksi, "SELECT * FROM tb_events ORDER BY id");

$dataArr = array();
while ($data = mysqli_fetch_array($tampil)) {
    $dataArr[] = array(
        'id' => $data['id'],
        'title' => $data['keperluan'],
        'start' => $data['tanggalwaktu_mulai'],
        'end' => $data['tanggalwaktu_selesai']
    );
}

echo json_encode($dataArr);
?>
