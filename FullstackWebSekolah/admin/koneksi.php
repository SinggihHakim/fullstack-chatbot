<?php
$koneksi = new mysqli("localhost", "root", "", "sekolah_db");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
