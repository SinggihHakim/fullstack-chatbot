<?php
include 'koneksi.php';

// Tambah atau Update
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if ($gambar != "") {
        move_uploaded_file($tmp, "upload/" . $gambar);
    }

    if ($id == "") {
        $koneksi->query("INSERT INTO postingan (judul, isi, gambar) VALUES ('$judul', '$isi', '$gambar')");
    } else {
        if ($gambar != "") {
            $koneksi->query("UPDATE postingan SET judul='$judul', isi='$isi', gambar='$gambar' WHERE id=$id");
        } else {
            $koneksi->query("UPDATE postingan SET judul='$judul', isi='$isi' WHERE id=$id");
        }
    }

    header("Location: postingan.php");
}

// DELETE
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $koneksi->query("DELETE FROM postingan WHERE id=$id");
    header("Location: postingan.php");
}

// GET DATA untuk edit
$data_edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $data_edit = $koneksi->query("SELECT * FROM postingan WHERE id=$id")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Postingan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        .form-control,
        .btn {
            border-radius: 0.375rem;
        }

        .form-label {
            font-weight: bold;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table img {
            width: 100px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Tambah Postingan</h2>
            <a href="index.php" class="btn btn-outline-secondary">← Kembali ke Dashboard</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" class="mb-5">
                    <input type="hidden" name="id" value="<?= $data_edit['id'] ?? '' ?>">

                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" value="<?= $data_edit['judul'] ?? '' ?>"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi</label>
                        <textarea name="isi" class="form-control" rows="5"
                            required><?= $data_edit['isi'] ?? '' ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                        <?php if ($data_edit && $data_edit['gambar'])
                            echo "<img src='upload/{$data_edit['gambar']}' class='mt-2' width='150'>"; ?>
                    </div>

                    <button type="submit" name="simpan" class=" btn btn-primary" id="simpan">Simpan</button>
                    <a href="postingan.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>

        <hr>

        <h2 class="mb-3">Daftar Postingan</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $koneksi->query("SELECT * FROM postingan ORDER BY id DESC");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                    <td><img src='upload/{$row['gambar']}' class='img-fluid'></td>
                    <td>{$row['judul']}</td>
                    <td>
                        <a href='postingan.php?edit={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='postingan.php?hapus={$row['id']}' class='hapus btn btn-danger btn-sm'>Hapus</a>
                    </td>
                </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  // Script untuk tombol Hapus
  document.querySelectorAll('.hapus').forEach(function(button) {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const href = this.getAttribute('href');

      Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = href;
        }
      });
    });
  });
</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>