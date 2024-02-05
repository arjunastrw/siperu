<?php
include('../../conf/config.php');

$gedung = mysqli_real_escape_string($koneksi, $_POST['gedung']);
$ruangan = mysqli_real_escape_string($koneksi, $_POST['ruangan']);
$keperluan = mysqli_real_escape_string($koneksi, $_POST['keperluan']);
$tanggalwaktu_mulai = mysqli_real_escape_string($koneksi, $_POST['tanggalwaktu_mulai']);
$tanggalwaktu_selesai = mysqli_real_escape_string($koneksi, $_POST['tanggalwaktu_selesai']);
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$details = mysqli_real_escape_string($koneksi, $_POST['details']);
$id = mysqli_real_escape_string($koneksi, $_POST['id']);
$nama_file = $_FILES['lampiran']['name'];
$file_tmp = $_FILES['lampiran']['tmp_name'];

if (!empty($nama_file)) {
    $upload_path = '../lampiran/' . $nama_file;

    if (move_uploaded_file($file_tmp, $upload_path)) {
        $query = "UPDATE tb_peminjaman_admin SET gedung=?, ruangan=?, keperluan=?, 
                  tanggalwaktu_mulai=?, tanggalwaktu_selesai=?, nama=?, details=?, lampiran=? WHERE id=?";

        $stmt = mysqli_prepare($koneksi, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssssssi", $gedung, $ruangan, $keperluan,
                date('Y-m-d H:i:s', strtotime($tanggalwaktu_mulai)),
                date('Y-m-d H:i:s', strtotime($tanggalwaktu_selesai)),
                $nama, $details, $nama_file, $id);

            if (mysqli_stmt_execute($stmt)) {
                header('Location: ../index.php?page=data-peminjaman-admin');
                exit();
            } else {
                echo "Error executing statement: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($koneksi);
        }
    } else {
        $error_message = "Error uploading file.";
        header('Location: ../index.php?page=data-peminjaman-admin&error=' . urlencode($error_message));
        exit();
    }
} else {
    $query = "UPDATE tb_peminjaman_admin SET gedung=?, ruangan=?, keperluan=?, 
              tanggalwaktu_mulai=?, tanggalwaktu_selesai=?, nama=?, details=? WHERE id=?";

    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssi", $gedung, $ruangan, $keperluan,
            date('Y-m-d H:i:s', strtotime($tanggalwaktu_mulai)),
            date('Y-m-d H:i:s', strtotime($tanggalwaktu_selesai)),
            $nama, $details, $id);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: ../index.php?page=data-peminjaman-admin');
            exit();
        } else {
            echo "Error executing statement: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>
