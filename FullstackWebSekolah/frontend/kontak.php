<?php
include '../admin/koneksi.php';

// Proses kirim pesan
if (isset($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $subjek = $_POST['subjek'];
    $pesan = $_POST['pesan'];

    // Masukkan pesan ke dalam database
    $koneksi->query("INSERT INTO kontak (nama, email, subjek, pesan) VALUES ('$nama', '$email', '$subjek', '$pesan')");
    echo "<script>alert('Pesan Anda telah terkirim!'); window.location.href = 'kontak.php';</script>";
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
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
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
                    <li class="nav-item"><a class="nav-link text-white" href="#">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->

    <!-- Form -->
    <section id="kontak" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="text-center fw-bolder mb-3 mt-5 pt-4">Hubungi Kami</h2>
                    <p class="text-center fw-normal pb-3">Jika Anda memiliki pertanyaan atau ingin menghubungi kami,
                        silakan isi formulir di bawah ini.</p>

                    <form action="kontak.php" method="POST">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="subjek" class="form-label">Subjek</label>
                            <input type="text" class="form-control" id="subjek" name="subjek" required>
                        </div>

                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="5" required></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="kirim" class="btn btn-primary">Kirim Pesan</button>
                        </div>
                        </form>


                </div>
            </div>
        </div>
    </section>

    <!-- Form -->

    <!-- FAQ -->
    <section id="faq" class="py-5">
        <div class="container">
            <h2 class="text-center fw-bolder mb-4">Pertanyaan yang Sering Diajukan (FAQ)</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button  fw-bolder" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Apa saja program unggulan di SD Negeri 1 Pematang Baru?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            SD Negeri 1 Pematang Baru memiliki berbagai program unggulan, termasuk program pembelajaran
                            berbasis teknologi, kegiatan ekstrakurikuler yang beragam, dan program pengembangan karakter
                            siswa.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed  fw-bolder" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Bagaimana cara mendaftar di SD Negeri 1 Pematang Baru?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Untuk mendaftar, Anda dapat mengunjungi halaman pendaftaran di situs web kami atau
                            menghubungi pihak sekolah melalui kontak yang tersedia.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed fw-bolder" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Apakah ada biaya pendaftaran di SD Negeri 1 Pematang Baru?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body fw">
                            Biaya pendaftaran di SD Negeri 1 Pematang Baru tergantung pada program yang dipilih. Untuk
                            informasi lebih lanjut, silakan hubungi pihak sekolah.
                        </div>
                    </div>
                </div>
            </div> <!-- end of #faqAccordion -->
        </div> <!-- end of .container -->
    </section> <!-- end of #faq -->

    <!-- FAQ -->




    <!-- Maps -->
    <section class="">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1985.1608680432585!2d105.702171!3d-5.666532!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e410611bb2a6435%3A0x7335ab509eeb1c30!2sSDN%2001%20PEMATANG%20BARU!5e0!3m2!1sid!2sid!4v1731297508072!5m2!1sid!2sid"
            width="100%" height="550" style="border:1px;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
    <!-- Maps -->

    <!-- Footer -->
    <div class="footer bg-dark text-light pt-5">
        <div class="container">
            <div class="row">
                <!-- Logo dan Nama Sekolah -->
                <div class="col-md-4 mb-3">
                    <a class="navbar-brand d-flex align-items-center" href="#">
                        <img src="assets/icon/logo.png" alt="Logo" width="50"
                            class="d-inline-block align-text-top me-3" />
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
                            <span class="text-wrap">Jalan Pematang Binjai, Pematang Baru, Kec. Palas, Kabupaten Lampung
                                Selatan, Lampung 35594</span>
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