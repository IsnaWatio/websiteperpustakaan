<?php
include('../config/db.php');

// Memeriksa apakah ada ID yang diterima dari URL
if (isset($_GET['id'])) {
    $no_anggota = $_GET['id'];

    // Query untuk mengambil data anggota berdasarkan no_anggota
    $sql = "SELECT * FROM tb_anggota WHERE no_anggota = '$no_anggota'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}

// Memproses data jika form telah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $ttl = $_POST['ttl'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $pekerjaan = $_POST['pekerjaan'];
    $target_file = $row['pas_foto']; // Menggunakan foto lama secara default

    // Memproses pengunggahan foto baru jika ada
    if (!empty($_FILES['pas_foto']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["pas_foto"]["name"]);
        
        // Memindahkan file foto baru
        if (move_uploaded_file($_FILES["pas_foto"]["tmp_name"], $target_file)) {
            // Jika berhasil, simpan nama file baru
        } else {
            echo "Error uploading file.";
        }
    }

    // Query untuk mengupdate data anggota
    $sql_update = "UPDATE tb_anggota SET 
                    nama = '$nama', 
                    ttl = '$ttl', 
                    jenis_kelamin = '$jenis_kelamin', 
                    alamat = '$alamat', 
                    pekerjaan = '$pekerjaan', 
                    pas_foto = '$target_file'
                   WHERE no_anggota = '$no_anggota'";

    if (mysqli_query($conn, $sql_update)) {
        header("Location: index.php?pesan=edit_berhasil");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Edit Anggota</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Edit Anggota</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
        </div>
        <div class="form-group">
            <label for="ttl">Tempat, Tanggal Lahir:</label>
            <input type="text" class="form-control" id="ttl" name="ttl" value="<?php echo $row['ttl']; ?>" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="L" <?php if ($row['jenis_kelamin'] == 'L') echo 'selected'; ?>>Laki-laki</option>
                <option value="P" <?php if ($row['jenis_kelamin'] == 'P') echo 'selected'; ?>>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required>
        </div>
        <div class="form-group">
            <label for="pekerjaan">Pekerjaan:</label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?php echo $row['pekerjaan']; ?>" required>
        </div>
        <div class="form-group">
            <label for="pas_foto">Foto Anggota:</label>
            <input type="file" class="form-control" id="pas_foto" name="pas_foto">
            <small>Biarkan kosong jika tidak ingin mengganti foto.</small>
            <?php if (!empty($row['pas_foto'])): ?>
                <img src="<?php echo $row['pas_foto']; ?>" alt="Foto Anggota" class="img-thumbnail mt-2" style="max-width: 200px;">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
