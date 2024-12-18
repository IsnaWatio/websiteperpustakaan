<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Sistem Perpustakaan</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../admin/index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../anggota/index.php">Anggota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/statistik.php">Statistik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/pengunjung.php">Pengunjung</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../surat/index.php">Arsip Surat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/logout.php">Keluar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Navbar Styling */
    .navbar {
            background-color: #004080;
            padding: 15px 30px;
        }

        .navbar-brand {
            font-weight: 600;
            color: #ffffff;
            font-size: 24px;
        }

        .navbar-brand:hover {
            color: #e0e0e0;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
            font-weight: 500;
            margin: 0 15px;
        }

        .navbar-nav .nav-link:hover {
            color: #e0e0e0;
        }

        .navbar-nav .nav-item.active .nav-link {
            color: #ffcc00;
            font-weight: 600;
        }

</style>
