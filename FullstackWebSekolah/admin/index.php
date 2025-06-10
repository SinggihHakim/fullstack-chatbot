<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Sekolah</title>

    <!-- Link ke Bootstrap untuk styling responsif dan komponen siap pakai -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styling tambahan dengan font Poppins dari Google Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        /* Sidebar kiri */
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar atas -->
<nav class="navbar navbar-dark bg-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Sekolah</a>
        <span class="navbar-text text-white">Selamat Datang, Admin!</span>
    </div>
</nav>

<!-- Layout utama terdiri dari sidebar dan konten -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar navigasi -->
        <div class="col-md-3 col-lg-2 pt-3 sidebar">
            <a href="postingan.php" class="fw-semibold">📝 Kelola Postingan</a>
            <a href="pendaftar.php" class="fw-semibold">🧾 Form Pendaftaran</a>
            <a href="inbox.php" class="fw-semibold">📩 Kotak Masuk</a>
            <a href="#" class="fw-semibold">📊 Laporan</a>
            <a href="#" class="fw-semibold">⚙️ Pengaturan</a>
            <a href="login.php" class="text-danger fw-semibold">🚪 Logout</a>
        </div>

        <!-- Konten utama -->
        <div class="col-md-9 col-lg-10 content">
            <h2 class="fw-bold">Dashboard Utama</h2>
            <p>Gunakan menu di samping untuk mengelola konten website sekolah Anda.</p>

            <!-- Statistik hari ini -->
            <div class="row">
                <!-- Tanggal -->
                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-body">
                            <h5 class="card-title">📅 Tanggal Hari Ini</h5>
                            <p class="card-text fs-5" id="tanggal"></p>
                        </div>
                    </div>
                </div>
                <!-- Hari -->
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">📆 Hari Ini</h5>
                            <p class="card-text fs-5" id="hari"></p>
                        </div>
                    </div>
                </div>
                <!-- Jam -->
                <div class="col-md-4">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-body">
                            <h5 class="card-title">⏰ Jam Saat Ini</h5>
                            <p class="card-text fs-5" id="jam"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- To-Do List sederhana -->
            <div class="card mt-4">
                <div class="card-header bg-primary text-white">
                    📝 To-Do List Hari Ini
                </div>
                <div class="card-body">
                    <ul class="list-group mb-3" id="todo-list">
                        <!-- Tugas akan ditambahkan secara dinamis dengan JS -->
                    </ul>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tambahkan tugas baru..." id="todo-input">
                        <button class="btn btn-success" type="button" onclick="addTodo()">Tambah</button>
                    </div>
                </div>
            </div>

            <!-- Pesan penting -->
            <div class="alert alert-info mt-4" role="alert">
                Tips: Pastikan Anda selalu logout setelah selesai menggunakan dashboard.
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS bundle (dengan Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script untuk jam dan to-do list -->
<script>
    // Fungsi untuk memperbarui tanggal, hari, dan jam setiap detik
    function updateDateTime() {
        const now = new Date();
        const optionsTanggal = { year: 'numeric', month: 'long', day: 'numeric' };
        const optionsHari = { weekday: 'long' };

        document.getElementById('tanggal').innerText = now.toLocaleDateString('id-ID', optionsTanggal);
        document.getElementById('hari').innerText = now.toLocaleDateString('id-ID', optionsHari);
        document.getElementById('jam').innerText = now.toLocaleTimeString('id-ID');
    }

    updateDateTime(); // Panggil saat pertama kali
    setInterval(updateDateTime, 1000); // Update jam setiap detik

    // Fungsi untuk menambahkan item ke to-do list
    function addTodo() {
        const input = document.getElementById('todo-input');
        const task = input.value.trim();
        if (task === "") return;

        // Buat elemen list baru
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        li.innerHTML = `
            ${task}
            <button class="btn btn-sm btn-danger" onclick="this.parentElement.remove()">Hapus</button>
        `;
        document.getElementById('todo-list').appendChild(li);
        input.value = ''; // Kosongkan input setelah ditambahkan
    }
</script>

</body>
</html>
