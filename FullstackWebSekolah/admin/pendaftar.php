<?php
include 'koneksi.php';

// Hapus data pendaftar
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $koneksi->query("DELETE FROM pendaftar WHERE id = $id");
    header('Location: pendaftar.php');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Pendaftar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }

    .table th,
    .table td {
      vertical-align: middle;
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
<body>
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-bold">📋 Data Pendaftar</h2>
      <a href="index.php" class="btn btn-outline-secondary">← Kembali ke Dashboard</a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Nama Orang Tua/Wali</th>
                <th>No HP Ortu/Wali</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $result = $koneksi->query("SELECT * FROM pendaftar ORDER BY id DESC");
              while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td class='text-center'>$no</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['tempat_lahir']}, {$row['tanggal_lahir']}</td>
                        <td class='text-center'>{$row['jenis_kelamin']}</td>
                        <td>{$row['alamat']}</td>
                        <td>{$row['nama_ortu']}</td>
                        <td>{$row['nohp_ortu']}</td>
                        <td class='text-center'>
                          <a href='pendaftar.php?hapus={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                        </td>
                      </tr>";
                $no++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
