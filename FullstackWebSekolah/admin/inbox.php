<?php
// Sertakan file koneksi ke database
include 'koneksi.php';

// Proses penghapusan pesan berdasarkan parameter 'hapus' di URL
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    // Hapus pesan dari tabel 'kontak' berdasarkan id
    $koneksi->query("DELETE FROM kontak WHERE id = $id");
    // Redirect kembali ke halaman inbox setelah penghapusan
    header('Location: inbox.php');
}

// Ambil semua data dari tabel 'kontak', diurutkan berdasarkan tanggal terbaru
$result = $koneksi->query("SELECT * FROM kontak ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Metadata dasar -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kotak Masuk</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font dan gaya tambahan -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Gaya tabel agar rapi dan responsif */
        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
            word-wrap: break-word;
            white-space: normal;
            max-width: 150px;
        }

        .table th {
            background-color: #f8f9fa;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>

<body class="container py-5">
    <!-- Header halaman -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📩 Kotak Masuk</h2>
        <!-- Tombol kembali ke dashboard -->
        <a href="index.php" class="btn btn-outline-secondary">← Kembali ke Dashboard</a>
    </div>

    <!-- Tabel untuk menampilkan pesan yang masuk -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Subjek</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Inisialisasi nomor urut
                    $no = 1;

                    // Looping untuk menampilkan data dari database
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>$no</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['subjek']}</td>
                                <td>" . substr($row['pesan'], 0, 50) . "...</td>
                                <td>{$row['tanggal']}</td>
                                <td>
                                    <!-- Tombol hapus dengan konfirmasi -->
                                    <a href='inbox.php?hapus={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pesan ini?\")'>Hapus</a>
                                </td>
                              </tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Optional: Bootstrap JS untuk interaktivitas komponen -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
