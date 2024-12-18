<?php
include('../config/db.php');

// Mengambil data pengunjung dari database
$sql = "SELECT * FROM pengunjung ORDER BY id DESC"; // Ubah 'id' dengan nama kolom ID yang sesuai
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Data Pengunjung - Admin</title>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            padding: 40px;
            margin-top: 50px;
            max-width: 90%;
        }
        h1 {
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
        }
        th {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
        }
        td {
            vertical-align: middle;
            text-align: center;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .btn-block {
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1>Data Pengunjung Perpustakaan</h1>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tujuan Kunjungan</th>
                <th>Saran/Kritik</th>
                <th>Jenis Pengunjung</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Kunjungan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tujuan_kunjungan']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['saran_kritik']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['jenis_pengunjung']) . "</td>";
                    echo "<td>" . ($row['jenis_kelamin'] === 'l' ? 'Laki-laki' : 'Perempuan') . "</td>";
                    echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>Tidak ada data pengunjung.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="statistik.php" class="btn btn-custom btn-block">Lihat Statistik Pengunjung</a>
    <a href="index.php" class="btn btn-primary btn-block">Kembali</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
