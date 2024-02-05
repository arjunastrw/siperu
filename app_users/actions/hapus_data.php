<?php
include '../../conf/config.php';

// Check if the 'id' parameter is set and is numeric
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Use prepared statement to prevent SQL injection
    $query = "DELETE FROM tb_peminjaman_users WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the prepared statement
    if ($stmt && mysqli_stmt_execute($stmt)) {
        header('Location: ../index.php?page=data-peminjaman-users');
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    // Handle invalid or missing 'id' parameter
    echo "Invalid or missing 'id' parameter.";
}
?>
