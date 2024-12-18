<?php
include('../config/db.php');

// Memeriksa apakah ada ID yang diterima dari URL
if (isset($_GET['id'])) {
    $no_anggota = $_GET['id'];

    // Query untuk menghapus data anggota berdasarkan no_anggota
    $sql = "DELETE FROM tb_anggota WHERE no_anggota = '$no_anggota'";
    if (mysqli_query($conn, $sql)) {
        // Redirect ke halaman daftar anggota setelah berhasil menghapus
        header("Location: index.php?pesan=hapus_berhasil");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
