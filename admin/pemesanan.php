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
                    $query = mysqli_query($koneksi, "SELECT * FROM tpemesanan ORDER BY id_pemesanan DESC") or die(mysqli_error($koneksi));
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
                          <td><?php
                              if ($layanan && isset($layanan['nama_layanan']) && $layanan['nama_layanan'] != '') {
                                echo $layanan['nama_layanan'];
                              } else {
                                echo "<i>Layanan tidak tersedia</i>";
                              }
                              ?></td>
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

                <?php if ($raa['bayar_pemesanan'] == 'Menunggu Pembayaran') { ?>



                  <hr />
                  <div class="alert alert-success" role="alert">
                    Apabila Pembayaran Sesuai Nominal ada, Ubah Status Ke Proses
                  </div>


                  <!-- Load SweetAlert2 -->
                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                  <!-- Tombol Batalkan dengan SweetAlert2 -->
                  <div class="d-grid mb-3">
                    <button type="button" onclick="proseskak('<?php echo $raa['kode_pemesanan']; ?>')" id="btnBatal" class="btn btn-warning btn-lg w-100">
                      PEMBAYARAN DITERIMA, LANJUTKAN KE PROSES
                    </button>
                  </div>

                  <script>
                    function proseskak(kode) {
                      Swal.fire({
                        title: 'Yakin ingin Mengubah Status?',
                        text: "Status Akan Di Ubah Menjadi Proses & Status Bayar akan Berubah Jadi Pembayaran Diterima",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Lanjutkan!',
                        cancelButtonText: 'Batal'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          // Redirect ke halaman pembatalan
                          window.location.href = 'pemesanan?page=proses&id=' + encodeURIComponent(kode);
                        }
                      });
                    }
                  </script>
                <?php } ?>



                <?php if ($raa['status_pemesanan'] == 'Proses') { ?>
                  <hr />
                  <div class="alert alert-warning" role="alert">
                    Kamu Bsia Merubah Status Sesuai Kondisi, Jika gagal/ batal maka pembayaran akan direfund
                  </div>
                  <!-- Load SweetAlert2 -->
                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                  <div class="row">
                    <div class="col-sm">
                      <button type="button" onclick="selesai('<?php echo $raa['kode_pemesanan']; ?>')" id="btnBatala" class="btn btn-success btn-lg w-100">
                        PROSES SELESAI, LANJUT KE SELESAI
                      </button>
                    </div>
                    <div class="col-sm">
                      <button type="button" onclick="gagal('<?php echo $raa['kode_pemesanan']; ?>')" id="btnBatalb" class="btn btn-danger btn-lg w-100">
                        PROSES GAGAL, LANJUT KE GAGALKAN
                      </button>
                    </div>
                    <div class="col-sm">
                      <button type="button" onclick="batal('<?php echo $raa['kode_pemesanan']; ?>')" id="btnBatalc" class="btn btn-dark btn-lg w-100">
                        PROSES DI BATALKAN, LANJUT BATALKAN
                      </button>
                    </div>
                  </div>

                  <script>
                    function selesai(kode) {
                      Swal.fire({
                        title: 'Yakin ingin Mengubah Status?',
                        text: "Status Akan Di Ubah Menjadi Selesai, Transaksi Selesai",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Lanjutkan!',
                        cancelButtonText: 'Batal'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          // Redirect ke halaman pembatalan
                          window.location.href = 'pemesanan?page=selesai&id=' + encodeURIComponent(kode);
                        }
                      });
                    }
                  </script>

                  <script>
                    function gagal(kode) {
                      Swal.fire({
                        title: 'Yakin ingin Mengubah Status?',
                        text: "Status Akan Di Ubah Menjadi Gagal & Pembayaran Di Refund",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Lanjutkan!',
                        cancelButtonText: 'Batal'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          // Redirect ke halaman pembatalan
                          window.location.href = 'pemesanan?page=gagal&id=' + encodeURIComponent(kode);
                        }
                      });
                    }
                  </script>

                  <script>
                    function batal(kode) {
                      Swal.fire({
                        title: 'Yakin ingin Mengubah Status?',
                        text: "Status Akan Di Ubah Menjadi Batal & Pembayaran Di Refund",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Lanjutkan!',
                        cancelButtonText: 'Batal'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          // Redirect ke halaman pembatalan
                          window.location.href = 'pemesanan?page=batal&id=' + encodeURIComponent(kode);
                        }
                      });
                    }
                  </script>
                <?php } ?>
              <?php
            } elseif ($page == 'proses') {
              $id = $_GET['id'];
              $queryupdate = mysqli_query($koneksi, "UPDATE tpemesanan SET status_pemesanan  = 'Proses', bayar_pemesanan  = 'Pembayaran Diterima' WHERE kode_pemesanan = '$id'");
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
            } elseif ($page == 'selesai') {
              $id = $_GET['id'];
              $queryupdate = mysqli_query($koneksi, "UPDATE tpemesanan SET status_pemesanan  = 'Selesai' WHERE kode_pemesanan = '$id'");
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
            } elseif ($page == 'gagal') {
              $id = $_GET['id'];
              $queryupdate = mysqli_query($koneksi, "UPDATE tpemesanan SET status_pemesanan  = 'Gagal', bayar_pemesanan  = 'Refund' WHERE kode_pemesanan = '$id'");
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
            } elseif ($page == 'batal') {
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