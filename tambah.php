<?php include('../config/db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Tambah Surat</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Tambah Surat</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label>Nomor Surat:</label>
            <input type="text" name="nomor_surat" class="form-control">
        </div>
        <div class="form-group">
            <label>Hari/Tanggal:</label>
            <input type="date" name="hari_tanggal" class="form-control">
        </div>
        <div class="form-group">
            <label>Perihal:</label>
            <input type="text" name="perihal" class="form-control">
        </div>
        <div class="form-group">
            <label>Alamat Surat:</label>
            <textarea name="alamat_surat" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Keterangan:</label>
            <select name="keterangan" class="form-control">
                <option value="Masuk">Masuk</option>
                <option value="Keluar">Keluar</option>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Tambah Surat</button>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $nomor_surat = $_POST['nomor_surat'];
    $hari_tanggal = $_POST['hari_tanggal'];
    $perihal = $_POST['perihal'];
    $alamat_surat = $_POST['alamat_surat'];
    $keterangan = $_POST['keterangan'];

    $sql = "INSERT INTO tb_arsip_surat (nomor_surat, hari_tanggal, perihal, alamat_surat, keterangan) 
            VALUES ('$nomor_surat', '$hari_tanggal', '$perihal', '$alamat_surat', '$keterangan')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Surat berhasil ditambahkan!');window.location='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
</body>
</html>
