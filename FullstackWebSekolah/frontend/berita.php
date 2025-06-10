<?php include '../admin/koneksi.php'; ?>
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
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar -->

  <!-- Form -->
  <!-- Section Postingan -->
  <div class="container mt-5">
    <h2 class="text-center fw-bold">Postingan</h2>
    <p class="py-3 text-center">Ini adalah beberapa Postingan dari sekolah kami.</p>
    <div class="row">
      <?php
      $result = $koneksi->query("SELECT * FROM postingan ORDER BY id DESC");
      while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $judul = htmlspecialchars($row['judul']);
        $isi = strip_tags($row['isi']);
        $gambar = $row['gambar'];

        echo '
        <div class="col-md-4 mb-4">
            <div class="card h-100" data-bs-toggle="modal" data-bs-target="#postModal' . $id . '" style="cursor:pointer;">
                <img src="../admin/upload/' . $gambar . '" class="card-img-top" alt="' . $judul . '" style="height:200px; object-fit:cover;">
                <div class="card-body">
                    <h5 class="card-title">' . $judul . '</h5>
                    <p class="card-text">' . substr($isi, 0, 100) . '...</p>
                </div>
            </div>
        </div>

        <!-- Modal untuk setiap postingan -->
<div class="modal fade" id="postModal' . $id . '" tabindex="-1" aria-labelledby="postModalLabel' . $id . '" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="postModalLabel' . $id . '">' . $judul . '</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-5">
            <img src="../admin/upload/' . $gambar . '" class="img-fluid" alt="' . $judul . '" />
          </div>
          <div class="col-md-7">
            <h5>' . $judul . '</h5>
            <p>' . $isi . '</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
';
      }
      ?>
    </div>
  </div>
  <!-- Section Postingan -->


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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>