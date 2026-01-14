
<div align="center">

# 🏫 Fullstack Web Sekolah + AI Chatbot

**Sistem Informasi Sekolah Modern dengan Integrasi Asisten Virtual Cerdas (Google Gemini)**

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Node.js](https://img.shields.io/badge/Node.js-43853D?style=for-the-badge&logo=node.js&logoColor=white)
![Express.js](https://img.shields.io/badge/Express.js-404D59?style=for-the-badge)
![Google Gemini](https://img.shields.io/badge/Google%20Gemini-8E75B2?style=for-the-badge&logo=google&logoColor=white)

[Demo (Coming Soon)] • [Dokumentasi] • [Laporkan Bug]

</div>

---

## 📖 Deskripsi Proyek

Proyek ini adalah solusi website sekolah komprehensif yang menggabungkan portal informasi publik, sistem manajemen konten (CMS) berbasis **PHP Native**, dan layanan Chatbot cerdas yang dibangun menggunakan **Node.js** dan **Google Generative AI (Gemini)**.

Website ini memungkinkan sekolah untuk mengelola pendaftaran siswa baru (PPDB), mempublikasikan berita, galeri kegiatan, serta memberikan layanan tanya jawab otomatis 24/7 kepada pengunjung melalui Chatbot.

---

## ✨ Fitur Utama

### 🌍 Halaman Publik (Frontend)
* **Beranda Informatif:** Menampilkan slider, sambutan kepala sekolah, dan ringkasan profil.
* **Portal Berita:** Daftar pengumuman dan artikel terbaru seputar sekolah.
* **Galeri Kegiatan:** Dokumentasi foto kegiatan sekolah.
* **Profil Guru & Staff:** Direktori pengajar dan staff tata usaha.
* **Pendaftaran Online (PPDB):** Formulir digital untuk calon siswa baru.
* **Perpustakaan Digital:** Informasi seputar perpustakaan sekolah.
* **AI Chatbot Widget:** Asisten virtual yang bisa menjawab pertanyaan tentang sekolah secara otomatis.

### 🛡️ Panel Admin (Backend PHP)
* **Dashboard Statistik:** Ringkasan jumlah pendaftar, berita, dll.
* **Manajemen Berita:** Tambah, edit, dan hapus postingan berita.
* **Manajemen Galeri:** Upload foto kegiatan sekolah.
* **Manajemen Pendaftar:** Melihat data calon siswa yang mendaftar online.
* **Inbox Pesan:** Melihat pesan masuk dari pengunjung.
* **Pengaturan Akun:** Manajemen pengguna admin.

### 🤖 AI Chatbot Service (Backend Node.js)
* **Integrasi Google Gemini:** Menggunakan model bahasa canggih untuk memproses pertanyaan.
* **Contextual Response:** Chatbot dilatih dengan informasi spesifik sekolah (melalui `prompt_cmd.txt`).
* **REST API:** Menghubungkan antarmuka chat di website dengan mesin AI.

---

## 🛠️ Teknologi yang Digunakan

| Komponen | Teknologi |
| :--- | :--- |
| **Frontend Web** | HTML5, CSS3, JavaScript (Vanilla), Bootstrap/Tailwind (sesuaikan) |
| **Backend Web** | PHP Native (Tanpa Framework) |
| **Database** | MySQL / MariaDB |
| **Chatbot Server** | Node.js, Express.js |
| **AI Model** | Google Generative AI (Gemini Pro) |
| **Library Lain** | `dotenv`, `cors`, `multer` (untuk upload) |

---

## 📂 Struktur Folder

```text
root/
├── FullstackWebSekolah/       # Aplikasi Web Utama (PHP)
│   ├── admin/                 # Halaman Admin (Protected)
│   ├── frontend/              # Halaman Publik (User Interface)
│   │   ├── assets/            # Gambar, CSS, JS
│   │   ├── chatbot-script.js  # Logika Frontend Chatbot
│   │   └── ... (file .html/.php)
│   └── ...
├── chatbot-backend/           # Server API Chatbot (Node.js)
│   ├── node_modules/
│   ├── server.js              # Entry point server chatbot
│   ├── prompt_cmd.txt         # Instruksi sistem untuk AI
│   └── .env                   # API Keys konfigurasi
└── README.md

```

---

## 🚀 Panduan Instalasi & Menjalankan

Proyek ini terdiri dari dua bagian yang harus dijalankan: **Web Server (PHP)** dan **Chatbot Server (Node.js)**.

### Langkah 1: Persiapan Database

1. Pastikan **XAMPP** (atau web server sejenis) sudah terinstall.
2. Buat database baru di phpMyAdmin (misal: `db_sekolah`).
3. Import file SQL (jika ada) ke database tersebut.
4. Sesuaikan konfigurasi database di file `FullstackWebSekolah/admin/koneksi.php`:
```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_sekolah";

```



### Langkah 2: Menjalankan Website (PHP)

1. Pindahkan folder `FullstackWebSekolah` ke dalam folder `htdocs` (di XAMPP).
2. Buka browser dan akses:
* **Halaman Utama:** `http://localhost/FullstackWebSekolah/frontend/index.html` (atau `.php`)
* **Halaman Admin:** `http://localhost/FullstackWebSekolah/admin/login.php`



### Langkah 3: Menjalankan Chatbot Server (Node.js)

1. Buka terminal/CMD dan masuk ke folder `chatbot-backend`:
```bash
cd chatbot-backend

```


2. Instal dependensi yang diperlukan:
```bash
npm install

```


3. Buat file `.env` di dalam folder `chatbot-backend` dan isi dengan API Key Google Gemini Anda:
```env
API_KEY=isi_dengan_api_key_google_anda_disini
PORT=3000

```


*(Dapatkan API Key di: [aistudio.google.com](https://aistudio.google.com/))*
4. Jalankan server:
```bash
node server.js

```


*Server akan berjalan di `http://localhost:3000*`

### Langkah 4: Menghubungkan Frontend ke Chatbot

1. Buka file `FullstackWebSekolah/frontend/chatbot-script.js`.
2. Cari baris `fetch` atau URL API, dan pastikan mengarah ke server Node.js Anda:
```javascript
// Contoh
const response = await fetch('http://localhost:3000/chat', { ... });

```



---

## 📝 Konfigurasi AI (Prompt Engineering)

Agar Chatbot menjawab seolah-olah dia adalah staff sekolah, Anda dapat mengubah instruksinya di file:
📂 `chatbot-backend/prompt_cmd.txt`

Contoh isi file:

> "Kamu adalah asisten virtual untuk SDN 01. Jawablah dengan sopan dan ramah. Jam operasional sekolah adalah 07.00 - 14.00..."

---

## 🤝 Kontribusi

Ingin berkontribusi?

1. Fork repository ini.
2. Buat branch fitur baru (`git checkout -b fitur-baru`).
3. Commit perubahan (`git commit -m 'Menambahkan fitur X'`).
4. Push ke branch (`git push origin fitur-baru`).
5. Buat Pull Request.

---

<div align="center">

Dibuat oleh Singgih Hakim

</div>

```

```
