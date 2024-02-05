<?php
include "../../conf/config.php";

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    mysqli_query($koneksi, "DELETE FROM tb_events WHERE id = '$id'");
}
?>
