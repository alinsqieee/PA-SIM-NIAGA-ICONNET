<?php
include_once "inc/header.php";

if (isset($_POST['kode_pemesanan'])) {
    $kode = mysqli_real_escape_string($koneksi, $_POST['kode_pemesanan']);
    $sql = "UPDATE tpemesanan SET notif_pemesanan = 'Dibaca' WHERE kode_pemesanan = '$kode'";
    $result = mysqli_query($koneksi, $sql);

    if ($result) {
        // hitung ulang jumlah notif yang "Baru"
        $count = mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM tpemesanan WHERE notif_pemesanan = 'Baru'"));
        echo json_encode(["success" => true, "count" => $count[0]]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
