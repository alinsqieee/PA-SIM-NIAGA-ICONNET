<?php
include_once "inc/header.php";
?>
<div class="content-wrapper">
  <br />
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Pemesanan</h3>
            </div>



            <?php
            $page = $_GET['page'];
            if ($page == 'data') {
            ?>

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Pemesanan</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>HP</th>
                      <th>Layanan</th>
                      <th>Status</th>
                      <th>Pembayaran</th>
                      <th>Total</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $bil = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM tpemesanan WHERE id_user = '$sesi[id_user]' ORDER BY id_pemesanan DESC") or die(mysqli_error($koneksi));
                    if (mysqli_num_rows($query) == 0) {
                      echo "";
                    } else {
                      while ($r = mysqli_fetch_array($query)):
                        $bil++;
                        $querys = mysqli_query($koneksi, "SELECT * FROM tlayanan WHERE id_layanan = '$r[id_layanan]'");
                        $layanan = mysqli_fetch_array($querys);
                        $queryss = mysqli_query($koneksi, "SELECT * FROM tuser WHERE id_user = '$r[id_user]'");
                        $user = mysqli_fetch_array($queryss);
                    ?>
                        <tr>
                          <td><?php echo  $bil; ?></td>
                          <td><?php echo  $r['kode_pemesanan']; ?></td>
                          <td><?php echo  tgl_indo($r['tanggal_pemesanan']); ?> [ <?php echo  $r['jam_pemesanan']; ?> ]</td>
                          <td><?php echo  $user['nama_user']; ?></td>
                          <td><?php echo  $user['hp_user']; ?></td>
                          <td>
                            <?php
                            if ($layanan && isset($layanan['nama_layanan']) && $layanan['nama_layanan'] != '') {
                              echo $layanan['nama_layanan'];
                            } else {
                              echo "<i>Layanan tidak tersedia</i>";
                            }
                            ?>
                          </td>
                          <td><?php echo  $r['status_pemesanan']; ?></td>
                          <td><?php echo  $r['bayar_pemesanan']; ?></td>
                          <td><?php echo  "Rp. " . number_format("$r[total_pemesanan]", 0, ",", "."); ?></td>
                          <td><a href="pemesanan?page=detail&kode_pemesanan=<?php echo  $r['kode_pemesanan']; ?>"><button type="button" class="btn btn-circle btn-outline btn-warning"><i class="nav-icon fas fa-eye"></i></button></a>
                          </td>
                        </tr>

                    <?php
                      endwhile;
                    }
                    ?>
                  </tbody>
                </table>
              </div>

            <?php
            } elseif ($page == 'detail') {
              $id = $_GET['kode_pemesanan'];
            ?> <div class="card-body">

                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM tpemesanan WHERE kode_pemesanan = '$id'");
                $raa = mysqli_fetch_array($query);
                $querys = mysqli_query($koneksi, "SELECT * FROM tuser WHERE id_user = '$raa[id_user]'");
                $user = mysqli_fetch_array($querys);


                $queryupdate = mysqli_query($koneksi, "UPDATE tpemesanan SET notif_pemesanan  = 'Baru' WHERE kode_pemesanan = '$id'");
                ?>

                <div class="row">


                  <div class="col-sm">

                    <dl class="row mb-0">

                      <dt class="col-sm-4">Kode Pemesanan</dt>
                      <dd class="col-sm-8">: <?php echo  $raa['kode_pemesanan']; ?></dd>


                      <dt class="col-sm-4">Tanggal Pemesanan</dt>
                      <dd class="col-sm-8">: <?php echo  tgl_indo($raa['tanggal_pemesanan']); ?> [ <?php echo  $raa['jam_pemesanan']; ?> ]</dd>

                      <dt class="col-sm-4">Nama </dt>
                      <dd class="col-sm-8">: <?php echo  $user['nama_user']; ?></dd>

                      <dt class="col-sm-4">HP </dt>
                      <dd class="col-sm-8">: <?php echo  $user['hp_user']; ?></dd>

                      <dt class="col-sm-4">Alamat </dt>
                      <dd class="col-sm-8">: <?php echo  $user['alamat_user']; ?></dd>

                      <dt class="col-sm-4">Email </dt>
                      <dd class="col-sm-8">: <?php echo  $user['email_user']; ?></dd>
                    </dl>
                  </div>


                  <div class="col-sm">
                    <dl class="row mb-0">
                      <dt class="col-sm-4">Status </dt>
                      <dd class="col-sm-8">: <?php echo  $raa['status_pemesanan']; ?></dd>

                      <dt class="col-sm-4">Status Pembayaran </dt>
                      <dd class="col-sm-8">: <?php echo  $raa['bayar_pemesanan']; ?></dd>

                      <?php
                      $id_layanan = $raa['id_layanan'];
                      $query = mysqli_query($koneksi, "SELECT * FROM tlayanan WHERE id_layanan = '$id_layanan'");
                      $layanan = mysqli_fetch_array($query);

                      ?> <dt class="col-sm-4">Layanan </dt>
                      <dd class="col-sm-8">:
                        <?php
                        echo ($layanan && isset($layanan['nama_layanan']))
                          ? $layanan['nama_layanan']
                          : "<i>Layanan tidak tersedia</i>";
                        ?></dd>

                      <dt class="col-sm-4">Harga </dt>
                      <dd class="col-sm-8">: <?php echo  "Rp. " . number_format("$raa[harga_pemesanan]", 0, ",", "."); ?></dd>

                      <dt class="col-sm-4">Kode Unik </dt>
                      <dd class="col-sm-8">: <?php echo  $raa['unik_pemesanan']; ?></dd>

                      <dt class="col-sm-4">Total </dt>
                      <dd class="col-sm-8">: <?php echo  "Rp. " . number_format("$raa[total_pemesanan]", 0, ",", "."); ?></dd>
                    </dl>
                  </div>
                </div>

                <hr />
                <?php
                $status = $raa['status_pemesanan'];
                $statuses = ['Menunggu Pembayaran', 'Proses', 'Selesai', 'Gagal', 'Batal'];
                ?>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <?php foreach ($statuses as $step): ?>
                    <div class="text-center flex-fill position-relative">
                      <!-- Titik lingkaran -->
                      <div class="rounded-circle mx-auto mb-2"
                        style="width: 30px; height: 30px;
                  background-color: <?= ($status == $step || array_search($step, $statuses) < array_search($status, $statuses)) ? '#28a745' : '#ccc'; ?>">
                      </div>
                      <!-- Label status -->
                      <small class="d-block"><?= $step ?></small>
                      <!-- Garis penghubung -->
                      <?php if ($step !== end($statuses)): ?>
                        <div class="position-absolute" style="top: 15px; right: -50%; width: 100%; height: 3px; background-color: <?= (array_search($step, $statuses) < array_search($status, $statuses)) ? '#28a745' : '#ccc'; ?>"></div>
                      <?php endif; ?>
                    </div>
                  <?php endforeach; ?>
                </div>



                <!-- Tampilkan tombol jika status masih "Menunggu Pembayaran" -->
                <?php if ($raa['bayar_pemesanan'] == 'Menunggu Pembayaran') { ?>

                  <?php
                  $querys = mysqli_query($koneksi, "SELECT * FROM tadmin WHERE id_admin = '1'");
                  $waku = mysqli_fetch_array($querys);
                  ?>


                  <hr />
                  <div class="alert alert-success" role="alert">Lakukan Transfer Sebesar <font color="red"><b><?php echo  "Rp. " . number_format("$raa[total_pemesanan]", 0, ",", "."); ?></b></font> Dengan Kode Unik Kemudian Lakukan Konfirmasi Whatsapp Admin, <a href="https://wa.me/<?php echo  $waku['hp_admin']; ?>" target="_BLANK">Hubungi Whatsapp admin</a></div>

                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th>Bank</th>
                        <th>Pemilik Rekening</th>
                        <th>Nomor Rekening</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $bil = 0;
                      $query = mysqli_query($koneksi, "SELECT * FROM tbank ORDER BY id_bank DESC") or die(mysqli_error($koneksi));
                      if (mysqli_num_rows($query) == 0) {
                        echo "";
                      } else {


                        while ($r = mysqli_fetch_array($query)):
                          $bil++;
                      ?>

                          <tr>
                            <td><?php echo  $bil; ?></td>
                            <td><?php echo  $r['bank_bank']; ?></td>
                            <td><?php echo  $r['nama_bank']; ?></td>
                            <td>
                              <?php echo $r['norek_bank']; ?>
                              <button onclick="salinRekening('<?php echo $r['norek_bank']; ?>')" style="border: none; background: none; padding-left: 5px;" title="Salin">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#007bff" class="bi bi-clipboard" viewBox="0 0 16 16">
                                  <path d="M10 1.5v1H6v-1h4Z" />
                                  <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4Zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z" />
                                </svg>
                              </button>
                            </td>
                          </tr>
                      <?php
                        endwhile;
                      }
                      ?>

                    </tbody>
                  </table><br />


                  <!-- Load SweetAlert2 -->
                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                  <!-- Tombol Batalkan dengan SweetAlert2 -->
                  <div class="d-grid mb-3">
                    <button type="button" onclick="konfirmasiPembatalan('<?php echo $raa['kode_pemesanan']; ?>')" id="btnBatal" class="btn btn-danger btn-lg w-100">
                      BATALKAN PEMESANAN
                    </button>
                  </div>

                  <script>
                    function konfirmasiPembatalan(kode) {
                      Swal.fire({
                        title: 'Yakin ingin membatalkan?',
                        text: "Pemesanan akan dibatalkan dan tidak dapat dikembalikan.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, batalkan!',
                        cancelButtonText: 'Batal'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          // Redirect ke halaman pembatalan
                          window.location.href = 'pemesanan?page=ubahstatus&id=' + encodeURIComponent(kode);
                        }
                      });
                    }
                  </script>
                  <script>
                    function salinRekening(norek) {
                      navigator.clipboard.writeText(norek).then(function() {
                        Swal.fire({
                          icon: 'success',
                          title: 'Disalin!',
                          text: 'Nomor rekening berhasil disalin ke clipboard.',
                          timer: 2000,
                          showConfirmButton: false
                        });
                      }, function(err) {
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops!',
                          text: 'Gagal menyalin nomor rekening.',
                        });
                      });
                    }
                  </script>
                <?php } ?>


              <?php
            } elseif ($page == 'ubahstatus') {
              $id = $_GET['id'];
              $queryupdate = mysqli_query($koneksi, "UPDATE tpemesanan SET status_pemesanan  = 'Batal', bayar_pemesanan  = 'Refund' WHERE kode_pemesanan = '$id'");
              ?>
                <script>
                  swal({
                    title: "Sukses!",
                    text: "Data Berhasil Diubah",
                    type: "success",
                    showConfirmButton: true
                  }, function() {
                    window.location.href = "pemesanan?page=detail&kode_pemesanan=<?php echo $id ?>";
                  });
                </script>






              <?php
            } elseif ($page == 'hapus') {
              $id = $_GET['id'];
              $modal = mysqli_query($koneksi, "Delete FROM tuser WHERE id_user='$id'");
              ?>
                <script>
                  swal({
                    title: "Sukses!",
                    text: "Data Berhasil dihapus",
                    type: "success",
                    showConfirmButton: true
                  }, function() {
                    window.location.href = "user?page=data";
                  });
                </script>


              <?php
            }
              ?>






              </div>
              <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


<?php
include_once "inc/footer.php";
?>