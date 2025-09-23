<?php
session_start();
include "../db/db.php"; // koneksi database

if (!isset($_SESSION['id_user']) || trim($_SESSION['id_user']) == '') {
    header("location: index");
    exit();
}

$session_id = $_SESSION['id_user'];

// Cek apakah user masih ada di database
$result = mysqli_query($koneksi, "SELECT * FROM tuser WHERE id_user='$session_id'");
if (!$result || mysqli_num_rows($result) == 0) {
    // Hapus session jika user sudah dihapus dari database
    session_destroy();
    header("location: index");
    exit();
}

$sesi = mysqli_fetch_array($result);
