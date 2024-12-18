<?php include('../config/db.php'); ?>
<?php include('../navbar/navbar.php'); // Menyertakan navbar ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <title>Arsip Surat Masuk/Keluar</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa; /* Background yang lebih lembut */
        }
        .container {
            margin-top: 50px;
        }
        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden; /* Menjaga border-radius tetap terlihat */
        }
        .table th {
            background-color: #007bff; /* Warna biru untuk header */
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1; /* Warna hover untuk baris tabel */
        }
        .btn-custom {
            transition: background-color 0.3s;
            margin: 0 5px; /* Menjaga jarak antar tombol */
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838; /* Warna saat hover */
        }
        .btn-info {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-info:hover {
            background-color: #0056b3; /* Warna saat hover */
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center mb-4">Arsip Surat Masuk/Keluar</h1>
    <div class="d-flex justify-content-between mb-3">
        <div>
            <a href="../admin/index.php" class="btn btn-success btn-custom">Kembali</a>
        </div>
        <div>
            <a href="tambah.php" class="btn btn-success btn-custom">Tambah Surat</a>
            <a href="../admin/export.php" class="btn btn-info btn-custom">Ekspor ke Excel</a> <!-- Tombol Ekspor -->
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Surat</th>
                    <th>Hari/Tanggal</th>
                    <th>Perihal</th>
                    <th>Alamat Surat</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM tb_arsip_surat";
                $result = mysqli_query($conn, $sql);
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['nomor_surat']}</td>
                            <td>{$row['hari_tanggal']}</td>
                            <td>{$row['perihal']}</td>
                            <td>{$row['alamat_surat']}</td>
                            <td>{$row['keterangan']}</td>
                          </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
