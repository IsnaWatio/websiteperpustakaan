<?php
include('../config/db.php');

$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT); // Hash password sebelum disimpan

$sql = "INSERT INTO tb_admin (username, password) VALUES ('$username', '$password')";

if (mysqli_query($conn, $sql)) {
    echo "Admin berhasil ditambahkan!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
