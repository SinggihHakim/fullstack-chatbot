<?php
include '../admin/koneksi.php';

// Proses input data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $tempat_lahir = $_POST['tempat_lahir'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $alamat = $_POST['alamat'];
  $nama_ortu = $_POST['nama_ortu'];
  $nohp_ortu = $_POST['nohp_ortu'];

  $query = "INSERT INTO pendaftar 
        (nama, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, nama_ortu, nohp_ortu) 
        VALUES 
        ('$nama', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$nama_ortu', '$nohp_ortu')";

  $koneksi->query($query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="assets/icon/logo.png" type="image/x-icon" />

  <!-- CSS Extrenal -->
  <link rel="stylesheet" href="style.css" />

  <!-- Icon apk -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <title>SD Negeri 1 Pematang Baru</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg py-2 navbar-scroll" id="navbar">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="assets/icon/logo.png" alt="Logo" width="50" class="d-inline-block align-text-top me-2" />
        <div class="d-flex flex-column align-items-start">
          <span class="fw-bolder text-light">SD Negeri 1</span>
          <span class="fw-bolder text-light">Pematang Baru</span>
        </div>
      </a>
      <button class="navbar-toggler bg-light shadow-none" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar navbar-nav ms-auto fw-medium d-flex gap-3 text-center pt-lg-0 pt-4">
          <li class="nav-item"><a class="nav-link text-white" href="index.html#home">Home</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="index.html#about">Tentang</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="index.html#post">Postingan</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="galeri.html">Galeri</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="perpus.html">Perpustakaan</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="guru.html">Guru</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="kontak.php">Kontak</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="../admin/login.php">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->
  <!-- Form -->
  <div class="container mt-5">
    <h2 class="mb-4 text-center">Formulir Pendaftaran Siswa dan Siswi Baru</h2>
    <!-- Form Pendaftaran -->
    <form action="daftar.php" method="POST" class="mb-5">
      <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required>
      </div>
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Tempat Lahir</label>
          <input type="text" name="tempat_lahir" class="form-control" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir" class="form-control" required>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-select" required>
          <option value="">-- Pilih --</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" required></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Nama Orang Tua/Wali</label>
        <input type="text" name="nama_ortu" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">No HP Orang Tua/Wali</label>
        <input type="text" name="nohp_ortu" class="form-control" required>
      </div>
      <button id="daftar" type="submit" class="btn btn-primary">Daftar</button>
    </form>
  </div>
  <!-- Form -->


  <!-- Footer -->
  <div class="footer bg-dark text-light pt-5">
    <div class="container">
      <div class="row">
        <!-- Logo dan Nama Sekolah -->
        <div class="col-md-4 mb-3">
          <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="assets/icon/logo.png" alt="Logo" width="50" class="d-inline-block align-text-top me-3" />
            <div class="d-flex flex-column align-items-start">
              <span class="fw-bolder text-light">SD Negeri 1</span>
              <span class="fw-bolder text-light">Pematang Baru</span>
            </div>
          </a>
        </div>

        <!-- Menu Navigasi -->
        <div class="col-md-3 mb-3">
            <h5 class="fw-bold mb-4">Menu</h5>
            <div class="row">
                <div class="col-6">
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="index.html#home" class="text-light text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="index.html#about" class="text-light text-decoration-none">Tentang</a></li>
                        <li class="mb-2"><a href="berita.php" class="text-light text-decoration-none">Postingan</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="perpus.html">Perpustakaan</a></li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="guru.html" class="text-light text-decoration-none">Guru</a></li>
                        <li class="mb-2"><a href="galeri.html" class="text-light text-decoration-none">Galeri</a></li>
                        <li class="mb-2"><a href="kontak.php" class="text-light text-decoration-none">Kontak</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Contact Us -->
        <div class="col-md-4 mb-3">
          <h5 class="fw-bold mb-4">Contact Us</h5>
          <ul class="list-unstyled">
            <li class="mb-3 d-flex">
              <i class="fas fa-map-marker-alt mt-1 me-3 flex-shrink-0"></i>
              <span class="text-wrap">Jalan Pematang Binjai, Pematang Baru, Kec. Palas, Kabupaten Lampung Selatan,
                Lampung 35594</span>
            </li>
            <li class="mb-3 d-flex">
              <i class="fas fa-phone mt-1 me-3 flex-shrink-0"></i>
              <span>+62 823-7377-4331</span>
            </li>
            <li class="mb-3 d-flex">
              <i class="fas fa-envelope mt-1 me-3 flex-shrink-1"></i>
              <span>sdn1pematangbarupalas@gmail.com</span>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="waves mt-4">
      <div class="wave" id="wave1"></div>
      <div class="wave" id="wave2"></div>
      <div class="wave" id="wave3"></div>
      <div class="wave" id="wave4"></div>
    </div>
  </div>
  <!-- Footer -->

  <!-- Copyright -->
  <div class="copyright text-center text-light py-2 fs-6">
    <p>&copy; 2024 <span class="fw-bolder">SD Negeri 1 Pematang Baru.</span> All Rights Reserved.</p>
  </div>

  <!-- JS -->
  <script src="script.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script type="text/javascript">
    const btn = document.querySelector('#daftar');
    btn.addEventListener('click', function (e) {
      e.preventDefault(); // Cegah form langsung submit agar alert muncul dulu
      Swal.fire({
        title: 'Berhasil!',
        text: 'Pendaftaran Anda telah berhasil.',
        icon: 'success',
        confirmButtonText: 'OK'
      }).then(() => {
        // Setelah klik OK, baru submit form
        btn.closest('form').submit();
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>