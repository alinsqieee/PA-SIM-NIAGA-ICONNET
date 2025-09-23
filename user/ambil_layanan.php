<?php
include "../db/db.php";

$start = isset($_POST['start']) ? (int)$_POST['start'] : 0;
$limit = isset($_POST['limit']) ? (int)$_POST['limit'] : 8;
$keyword = isset($_POST['keyword']) ? mysqli_real_escape_string($koneksi, $_POST['keyword']) : '';

$sql = "SELECT * FROM tlayanan";
if ($keyword != '') {
  $sql .= " WHERE nama_layanan LIKE '%$keyword%'";
}
$sql .= " ORDER BY id_layanan DESC LIMIT $start, $limit";

$query = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($query) == 0) {
  if ($start == 0) {
    echo "<div class='col-12'><p class='text-center'>Tidak ditemukan layanan.</p></div>";
  }
} else {
  while ($r = mysqli_fetch_array($query)) {
    $gambar = (!empty($r['gambar_layanan']) && file_exists("../gambar_layanan/" . $r['gambar_layanan']))
              ? "../gambar_layanan/" . $r['gambar_layanan']
              : "https://via.placeholder.com/200x180?text=No+Image";
    ?>
    <div class="col-md-3 col-sm-6 mb-4">
      <div class="item">
        <img src="<?= $gambar ?>" alt="">
        <div class="item-dtls">
          <h5>
            <a href="layanan?page=lihat&id=<?= $r['id_layanan'] ?>">
              <?= htmlspecialchars($r['nama_layanan']) ?>
            </a>
          </h5>
          <span class="price lblue">Rp. <?= number_format($r['harga_layanan'], 0, ',', '.') ?></span>
        </div>
        <div class="ecom bg-lblue mt-2">
          <a class="btn btn-sm btn-success" href="layanan?page=lihat&id=<?= $r['id_layanan'] ?>">Pesan Layanan</a>
        </div>
      </div>
    </div>
    <?php
  }
}
?></div>