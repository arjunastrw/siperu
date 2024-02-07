<?php
include '../../conf/config.php';

echo "<pre>";
print_r($koneksi);
echo "</pre>";

$title = $_POST['event-title'];
$description = $_POST['event-description'];
$start = $_POST['start-date'];
$end = $_POST['end-date'];

$sql = "INSERT INTO events (title, description, start_date, end_date) VALUES ('$title', '$description', '$start', '$end')";

if ($koneksi->query($sql) === TRUE) {
    echo "Event saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

$koneksi->close();
