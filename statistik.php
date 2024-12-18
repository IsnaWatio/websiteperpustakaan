<?php
include('../config/db.php');


// Ambil data statistik pengunjung
$query = "SELECT MONTH(tanggal) AS bulan, jenis_pengunjung, COUNT(*) AS jumlah 
          FROM pengunjung 
          GROUP BY bulan, jenis_pengunjung";
$result = mysqli_query($conn, $query);

// Debugging: Cek jika query gagal
if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}

// Siapkan data untuk grafik
$bulan = [];
$jumlahPelajar = [];
$jumlahMahasiswa = [];
$jumlahMasyarakat = [];

// Proses data
while ($row = mysqli_fetch_assoc($result)) {
    $bulan[] = $row['bulan'];
    
    if ($row['jenis_pengunjung'] == 'pelajar') {
        $jumlahPelajar[$row['bulan']] = $row['jumlah'];
    } elseif ($row['jenis_pengunjung'] == 'mahasiswa') {
        $jumlahMahasiswa[$row['bulan']] = $row['jumlah'];
    } else {
        $jumlahMasyarakat[$row['bulan']] = $row['jumlah'];
    }
}

// Menghitung total jumlah untuk setiap bulan
$uniqueBulan = array_unique($bulan);
foreach ($uniqueBulan as $b) {
    $jumlahPelajar[$b] = isset($jumlahPelajar[$b]) ? $jumlahPelajar[$b] : 0;
    $jumlahMahasiswa[$b] = isset($jumlahMahasiswa[$b]) ? $jumlahMahasiswa[$b] : 0;
    $jumlahMasyarakat[$b] = isset($jumlahMasyarakat[$b]) ? $jumlahMasyarakat[$b] : 0;
}

// Format untuk Chart.js
$dataBulan = array_values($uniqueBulan);
$dataPelajar = array_values($jumlahPelajar);
$dataMahasiswa = array_values($jumlahMahasiswa);
$dataMasyarakat = array_values($jumlahMasyarakat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> <!-- Menambahkan Google Fonts -->
    <title>Statistik Pengunjung</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #e9ecef; /* Warna latar belakang lebih lembut */
            font-family: 'Roboto', sans-serif; /* Menggunakan font modern */
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .btn-kembali {
            background-color: #007bff; /* Warna tombol */
            color: #fff;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            display: inline-block;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan */
        }
        .btn-kembali:hover {
            background-color: #0056b3; /* Warna tombol saat hover */
            transform: translateY(-2px); /* Efek naik sedikit */
        }
        h1 {
            font-weight: 500; /* Mengatur bobot font */
        }
        .chart-container {
            margin-top: 30px; /* Menambahkan jarak antara elemen */
        }
    </style>
</head>
<body>
<div class="container">
    <a href="javascript:history.back()" class="btn btn-kembali mb-4">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <h1 class="text-center">Statistik Pengunjung</h1>
    <div class="chart-container">
        <canvas id="statistikChart" width="400" height="200"></canvas>
    </div>
    <script>
        var ctx = document.getElementById('statistikChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar', // Tipe grafik
            data: {
                labels: <?= json_encode($dataBulan); ?>,
                datasets: [{
                    label: 'Pelajar',
                    data: <?= json_encode($dataPelajar); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, {
                    label: 'Mahasiswa',
                    data: <?= json_encode($dataMahasiswa); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Masyarakat',
                    data: <?= json_encode($dataMasyarakat); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    },
                    title: {
                        display: true,
                        text: 'Statistik Pengunjung per Bulan'
                    }
                }
            }
        });
    </script>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
