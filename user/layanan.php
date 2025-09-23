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
              <h3 class="card-title">Layanan</h3>
            </div>



            <?php
            $page = $_GET['page'];
            if ($page == 'data') {
            ?>


              <style>
                /* Background color classes */
                .bg-white {
                  background-color: #ffffff !important;
                }

                .bg-grey {
                  background-color: #eeeeee !important;
                }

                .bg-black {
                  background-color: #555555 !important;
                }

                .bg-red {
                  background-color: #f75353 !important;
                }

                .bg-green {
                  background-color: #51d466 !important;
                }

                .bg-lblue {
                  background-color: #32c8de !important;
                }

                .bg-blue {
                  background-color: #609cec !important;
                }

                .bg-orange {
                  background-color: #f78153 !important;
                }

                .bg-yellow {
                  background-color: #fcd419 !important;
                }

                .bg-purple {
                  background-color: #cb79e6 !important;
                }

                .bg-rose {
                  background-color: #ff61e7 !important;
                }

                .bg-brown {
                  background-color: #d08166 !important;
                }

                /* Button classes */
                .btn {
                  border-radius: 2px;
                  position: relative;
                }

                .btn.btn-no-border {
                  border: 0px !important;
                }

                /* Button colors */
                .btn.btn-white {
                  background: #ffffff;
                  color: #666666;
                  border: 1px solid #dddddd;
                }

                .btn.btn-white:hover,
                .btn.btn-white:focus,
                .btn.btn-white.active,
                .btn.btn-white:active {
                  background: #f7f7f7;
                  color: #666666;
                }

                .btn.btn-grey {
                  background: #eeeeee;
                  color: #666666;
                  border: 1px solid #d5d5d5;
                }

                .btn.btn-grey:hover,
                .btn.btn-grey:focus,
                .btn.btn-grey.active,
                .btn.btn-grey:active {
                  background: #d5d5d5;
                  color: #999;
                }

                .btn.btn-black {
                  color: #ffffff;
                  background: #666666;
                  border: 1px solid #4d4d4d;
                }

                .btn.btn-black:hover,
                .btn.btn-black:focus,
                .btn.btn-black.active,
                .btn.btn-black:active {
                  background: #4d4d4d;
                  color: #ffffff;
                }

                .btn.btn-red {
                  color: #ffffff;
                  background: #ed5441;
                  border: 1px solid #e52d16;
                }

                .btn.btn-red:hover,
                .btn.btn-red:focus,
                .btn.btn-red.active,
                .btn.btn-red:active {
                  color: #ffffff;
                  background: #e52d16;
                }

                .btn.btn-green {
                  color: #ffffff;
                  background: #51d466;
                  border: 1px solid #30c247;
                }

                .btn.btn-green:hover,
                .btn.btn-green:focus,
                .btn.btn-green.active,
                .btn.btn-green:active {
                  background: #30c247;
                  color: #ffffff;
                }

                .btn.btn-lblue {
                  color: #ffffff;
                  background: #32c8de;
                  border: 1px solid #1faabe;
                }

                .btn.btn-lblue:hover,
                .btn.btn-lblue:focus,
                .btn.btn-lblue.active,
                .btn.btn-lblue:active {
                  background: #1faabe;
                  color: #ffffff;
                }

                .btn.btn-blue {
                  color: #ffffff;
                  background: #609cec;
                  border: 1px solid #3280e7;
                }

                .btn.btn-blue:hover,
                .btn.btn-blue:focus,
                .btn.btn-blue.active,
                .btn.btn-blue:active {
                  background: #3280e7;
                  color: #ffffff;
                }

                .btn.btn-orange {
                  color: #ffffff;
                  background: #f8a841;
                  border: 1px solid #f69110;
                }

                .btn.btn-orange:hover,
                .btn.btn-orange:focus,
                .btn.btn-orange.active,
                .btn.btn-orange:active {
                  background: #f69110;
                  color: #ffffff;
                }

                .btn.btn-yellow {
                  background: #fcd419;
                  color: #ffffff;
                  border: 1px solid #dfb803;
                }

                .btn.btn-yellow:hover,
                .btn.btn-yellow:focus,
                .btn.btn-yellow.active,
                .btn.btn-yellow:active {
                  background: #dfb803;
                  color: #ffffff;
                }

                .btn.btn-purple {
                  background: #cb79e6;
                  color: #ffffff;
                  border: 1px solid #ba4ede;
                }

                .btn.btn-purple:hover,
                .btn.btn-purple:focus,
                .btn.btn-purple.active,
                .btn.btn-purple:active {
                  background: #ba4ede;
                  color: #ffffff;
                }

                .btn.btn-rose {
                  background: #ff61e7;
                  color: #ffffff;
                  border: 1px solid #ff2edf;
                }

                .btn.btn-rose:hover,
                .btn.btn-rose:focus,
                .btn.btn-rose.active,
                .btn.btn-rose:active {
                  background: #ff2edf;
                  color: #ffffff;
                }

                .btn.btn-brown {
                  background: #d08166;
                  color: #ffffff;
                  border: 1px solid #c4613f;
                }

                .btn.btn-brown:hover,
                .btn.btn-brown:focus,
                .btn.btn-brown.active,
                .btn.btn-brown:active {
                  background: #c4613f;
                  color: #ffffff;
                }

                .shop-items {
                  max-width: 1150px;
                  margin: 0px auto;
                  padding: 0px 0px;
                }

                .shop-items .item {
                  position: relative;
                  max-width: 360px;
                  margin: 15px auto;
                  padding: 5px;
                  text-align: center;
                  border-radius: 4px;
                  overflow: hidden;
                  border: 2px solid #eee;
                }

                .shop-items .item:hover {
                  border: 2px solid #32c8de;
                }

                .shop-items .item img {
                  width: 100%;
                  max-width: 360px;
                  margin: 0 auto;
                  border: 1px solid #eee;
                  border-radius: 3px;
                }

                .shop-items .item .item-dtls h4 {
                  margin-top: 13px;
                  margin-bottom: 10px;
                  text-transform: uppercase;
                }

                .shop-items .item .item-dtls .price {
                  display: block;
                  margin-bottom: 13px;
                  font-size: 25px;
                }

                .shop-items .item .ecom {
                  position: absolute;
                  top: 100%;
                  left: 0;
                  width: 100%;
                  padding-bottom: 10px;
                  padding-top: 10px;
                  -webkit-transition: all 0.35s ease-in;
                  -moz-transition: all 0.35s ease-in;
                  -ms-transition: all 0.35s ease-in;
                  -o-transition: all 0.35s ease-in;
                  transition: all 0.35s ease-in;
                }

                .shop-items .item:hover .ecom {
                  margin-top: -50px;
                }

                .shop-items .item .ecom a.btn {
                  border: 1px solid #fff;
                  color: #fff;
                  background: transparent;
                  -webkit-transition: all 0.35s ease-in;
                  -moz-transition: all 0.35s ease-in;
                  -ms-transition: all 0.35s ease-in;
                  -o-transition: all 0.35s ease-in;
                  transition: all 0.35s ease-in;
                }

                .shop-items .item .ecom a.btn:hover {
                  background: #fff;
                  color: #777;
                }
              </style>

              <div class="card-body">
                <div class="shop-items">
                  <div class="container-fluid">
                    <div class="row">

                      <h4 class="mb-3">Cari Layanan</h4>
                      <input type="text" id="search" class="form-control mb-4" placeholder="Ketik nama layanan...">

                      <div class="row" id="hasil-layanan"></div>

                      <div class="text-center my-3">
                        <button class="btn btn-primary" id="load-more" data-start="0">Muat Lainnya</button>
                      </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                      let start = 0;
                      const limit = 8;

                      function loadLayanan(reset = false) {
                        let keyword = $('#search').val();
                        $.ajax({
                          url: 'ambil_layanan.php',
                          method: 'POST',
                          data: {
                            start: start,
                            limit: limit,
                            keyword: keyword
                          },
                          success: function(data) {
                            if (reset) {
                              $('#hasil-layanan').html(data);
                            } else {
                              $('#hasil-layanan').append(data);
                            }

                            // Jika kurang dari 8, sembunyikan tombol
                            if ($(data).filter('.col-md-3').length < limit) {
                              $('#load-more').hide();
                            } else {
                              $('#load-more').show();
                            }
                          }
                        });
                      }

                      $(document).ready(function() {
                        loadLayanan();

                        $('#load-more').on('click', function() {
                          start += limit;
                          loadLayanan();
                        });

                        $('#search').on('input', function() {
                          start = 0;
                          loadLayanan(true); // reset saat cari
                        });
                      });
                    </script>



                  </div>
                </div>
              </div>
          </div>

        <?php
            } elseif ($page == 'lihat') {
              $id = $_GET['id'];
        ?> <div class="card-body">

            <?php
              $id = $_GET['id'];
              $query = mysqli_query($koneksi, "SELECT * FROM tlayanan WHERE id_layanan = '$id'");
              $raa = mysqli_fetch_array($query);
            ?>



            <div class="row">
              <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none"><?php echo $raa['nama_layanan'] ?></h3>
                <div class="col-12">
                  <img src="../gambar_layanan/<?php echo  $raa['gambar_layanan']; ?>" class="product-image" alt="Product Image">
                </div>

              </div>
              <div class="col-12 col-sm-6">
                <h3 class="my-3"><?php echo $raa['nama_layanan'] ?></h3>
                <p><?php echo $raa['keterangan_layanan'] ?></p>



                <div class="bg-gray py-2 px-3 mt-4">
                  <h2 class="mb-0">
                    Rp. <?= number_format($raa['harga_layanan'], 0, ',', '.') ?>
                  </h2>

                </div>
                <a href="layanan?page=pemesanan&id=<?php echo $raa['id_layanan'] ?>">
                  <div class="mt-4">
                    <div class="btn btn-primary btn-lg btn-flat w-100">
                      <i class="fas fa-cart-plus fa-lg mr-2"></i>
                      Pesan Layanan
                    </div>
                  </div>


              </div>



            </div>
          </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

  </section>



<?php
            } elseif ($page == 'pemesanan') {
              $id = $_GET['id'];
?> <div class="card-body">

    <?php
              $id = $_GET['id'];
              $query = mysqli_query($koneksi, "SELECT * FROM tlayanan WHERE id_layanan = '$id'");
              $raa = mysqli_fetch_array($query);
    ?>

    <div class="row">
      <div class="col-sm">
        <h5>Detail Pemesanan</h5>
        <hr />

        <form form id="sign_in" method="post" enctype="multipart/form-data">

          <?php
              $panjang = "10";
              function bilu($panjang)
              {
                $pengacak = "123456789ABCDEFGHIJKLMNPQRSTUVWXYZ";
                $hasil = "";
                for ($i = 0; $i < $panjang = 10; $i++) {
                  $pos = rand(0, strlen($pengacak) - 1);
                  $hasil .= $pengacak[$pos];
                }
                return $hasil;
              }
          ?><input id="kode_pemesanan" type="hidden" name="kode_pemesanan" value="<?php echo bilu(10) ?>" required>

          <div class="row">
            <div class="col-sm">

              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" id="nama_user" name="nama_user" value="<?php echo $sesi['nama_user'] ?>" required="" />
              </div>

            </div>
            <div class="col-sm">

              <div class="form-group">
                <label>HP</label>
                <input type="number" class="form-control" id="hp_user" name="hp_user" value="<?php echo $sesi['hp_user'] ?>" required="" />
              </div>

            </div>
          </div>

          <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control" id="alamat_user" name="alamat_user" value="<?php echo $sesi['alamat_user'] ?>" required="" />
          </div>

          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" placeholder="Keterangan" name="keterangan_pemesanan" id="keterangan_pemesanan" rows="3"></textarea>
          </div>








      </div>
      <div class="col-sm">
        <h5>Detail Layanan</h5>
        <hr />



        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0"><b><?php echo $raa['nama_layanan'] ?></b></h6>
              <small class="text-muted"><?php echo substr($raa['keterangan_layanan'], 0, 20); ?>...</small>
            </div>
            <span class="text-muted">Rp. <?= number_format($raa['harga_layanan'], 0, ',', '.') ?></span>
          </li>
        </ul>


        <?php
              $angkaAcak = rand(111, 599);
              $angkaku = $angkaAcak;
              $has = $raa["harga_layanan"];
              $total = $has + $angkaku;
        ?>


        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal :</th>
              <td>Rp. <?= number_format($raa['harga_layanan'], 0, ',', '.') ?></td>
            </tr>
            <tr>
              <th>Kode Unik</th>
              <td><?= $angkaku ?></td>
            </tr>

            <tr>
              <th>Total:</th>
              <td>Rp. <?= number_format($total, 0, ',', '.') ?></td>
            </tr>
          </table>
        </div>

        <button type="submit" name="kirim" class="btn btn-danger w-100">PESAN LAYANAN</button>



      </div>
    </div>

    </form>

    <?php
              if (isset($_POST['kirim'])) {

                $nama_user = $_POST['nama_user'];
                $alamat_user = $_POST['alamat_user'];
                $hp_user = $_POST['hp_user'];

                $harga_pemesanan = $raa['harga_layanan'];
                $id_user = $sesi['id_user'];
                $id_layanan = $raa['id_layanan'];
                $kode_pemesanan = $_POST['kode_pemesanan'];
                $a = date("Y-m-d");
                $b = date("H:i:s");
                $keterangan_pemesanan = $_POST['keterangan_pemesanan'];
                $sql = "INSERT INTO tpemesanan (total_pemesanan,id_layanan,id_user, kode_pemesanan, tanggal_pemesanan,jam_pemesanan, keterangan_pemesanan, status_pemesanan,bayar_pemesanan,harga_pemesanan,unik_pemesanan,notif_pemesanan) VALUES ('$total','$id_layanan','$id_user','$kode_pemesanan','$a','$b','$keterangan_pemesanan','Menunggu Pembayaran','Menunggu Pembayaran','$harga_pemesanan','$angkaku','Baru')";

                $queryupdate = mysqli_query($koneksi, "UPDATE tuser SET nama_user     = '$nama_user', alamat_user     = '$alamat_user', hp_user     = '$hp_user' WHERE id_user = $id_user");

                if ($koneksi->query($sql) === false) {
    ?>
        <script>
          swal({
            title: "Gagal!",
            text: "Pemesanan Gagal, Silahkan Ulangi Lagi",
            type: "error",
            showConfirmButton: true
          }, function() {
            window.location.href = "layanan?page=pemesanan&id=<?php echo $id_layanan ?>";
          });
        </script>
      <?php
                } else {

      ?>

        <script>
          swal({
            title: "Sukses!",
            text: "Pemesanan Berhasil, Silahkan Lihat Detail Pemesanan",
            type: "success",
            showConfirmButton: true
          }, function() {
            window.location.href = "pemesanan?page=detail&kode_pemesanan=<?php echo $kode_pemesanan ?>";
          });
        </script>


    <?php
                }
              }
    ?>

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