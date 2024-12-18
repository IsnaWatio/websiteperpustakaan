<?php
session_start();  // Harus ada di baris pertama

include('../config/db.php');  // Pastikan file koneksi benar

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query untuk mendapatkan data admin berdasarkan username
    $sql = "SELECT * FROM tb_admin WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Verifikasi password yang di-hash
        if (password_verify($password, $row['password'])) {
            // Set session untuk admin
            $_SESSION['admin'] = $username;
            
            // Redirect ke halaman index.php
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Password salah!');window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!');window.location='login.php';</script>";
    }
} else {
    echo "<script>alert('Harap isi username dan password!');window.location='login.php';</script>";
}
?>
