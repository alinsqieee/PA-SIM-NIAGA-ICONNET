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
              <h3 class="card-title">Data layanan</h3>
            </div>



            <?php
            $page = $_GET['page'];
            if ($page == 'data') {
            ?>



              <div class="card-body">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i> Tambah Data</button><br /><br />

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Harga</th>
                      <th>Gambar</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $bil = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM tlayanan ORDER BY id_layanan DESC") or die(mysqli_error($koneksi));
                    if (mysqli_num_rows($query) == 0) {
                      echo "";
                    } else {


                      while ($r = mysqli_fetch_array($query)):
                        $bil++;
                    ?>
                        <tr>
                          <td><?php echo  $bil; ?></td>
                          <td><?php echo  $r['nama_layanan']; ?></td>
                          <td><?php echo  "Rp. " . number_format("$r[harga_layanan]", 0, ",", "."); ?></td>
                          <td> <img src="../gambar_layanan/<?php echo $r['gambar_layanan']; ?>"
                              width="80" height="80"
                              style="object-fit: cover; border-radius: 5px;">
                          </td>
                          <td><a href="layanan?page=edit&id=<?php echo  $r['id_layanan']; ?>"><button type="button" class="btn btn-circle btn-outline btn-success"><i class="nav-icon fas fa-edit"></i></button></a>

                            <a href="layanan?page=hapus&id=<?php echo  $r['id_layanan']; ?>" onclick="return confirm('Yakin ingin hapus data ?')"><button type="button" class="btn btn-circle btn-outline btn-danger"><i class="far fa-trash-alt"></i></button></a>
                          </td>
                        </tr>

                    <?php
                      endwhile;
                    }
                    ?>
                  </tbody>
                </table>
              </div>


              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="defaultModalLabel">Tambah Data</h4>
                    </div>
                    <div class="modal-body">

                      <form form id="sign_in" method="post" enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-sm">

                            <div class="form-group">
                              <label>Nama</label>
                              <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" value="" required="" />
                            </div>

                            <div class="form-group">
                              <label>Harga</label>
                              <input type="number" class="form-control" id="harga_layanan" name="harga_layanan" value="" required="" />
                            </div>

                            <div class="form-group">
                              <label>Keterangan</label>
                              <textarea class="form-control" rows="3" id="keterangan_layanan" name="keterangan_layanan"></textarea>
                            </div>

                            <div class="form-group">
                              <label>Gambar layanan</label>
                              <input type="file" class="form-control" id="gambar_layanan" name="gambar_layanan" accept="image/*" required="">
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" name="simpanlo" class="btn btn-danger">Simpan</button>
                      </form>

                    </div>
                  </div>
                  <?php
                  if (isset($_POST['simpanlo'])) {

                    $keterangan_layanan = $_POST['keterangan_layanan'];
                    $harga_layanan = $_POST['harga_layanan'];
                    $nama_layanan = $_POST['nama_layanan'];
                    $gambar_layanan = $_FILES['gambar_layanan']['name'];

                    $sql = "INSERT INTO tlayanan (keterangan_layanan, harga_layanan,nama_layanan,gambar_layanan) VALUES ('$keterangan_layanan','$harga_layanan','$nama_layanan','$gambar_layanan')";
                    move_uploaded_file($_FILES['gambar_layanan']['tmp_name'], '../gambar_layanan/' . $gambar_layanan);

                    if ($koneksi->query($sql) === false) {
                  ?>
                      <script>
                        swal({
                          title: "Gagal!",
                          text: "Data Gagal ditambahkan",
                          type: "error",
                          showConfirmButton: true
                        }, function() {
                          window.location.href = "layanan?page=data";
                        });
                      </script>
                    <?php
                    } else {
                    ?>

                      <script>
                        swal({
                          title: "Sukses!",
                          text: "Data Berhasil ditambahkan",
                          type: "success",
                          showConfirmButton: true
                        }, function() {
                          window.location.href = "layanan?page=data";
                        });
                      </script>


                  <?php
                    }
                  }
                  ?>
                </div>

              </div>
          </div>
        </div>3
      </div>
    </div>
</div>

<?php
            } elseif ($page == 'edit') {
              $id = $_GET['id'];
?> <div class="card-body">

    <?php
              $id = $_GET['id'];
              $query = mysqli_query($koneksi, "SELECT * FROM tlayanan WHERE id_layanan = '$id'");
              $raa = mysqli_fetch_array($query);
    ?>

    <form form id="sign_in" method="post" enctype="multipart/form-data">



      <input type="hidden" name="id" id="id" value="<?php echo $raa['id_layanan'] ?>" />

      <div class="row">
        <div class="col">
          <div class="mb-3">
            <label for="nama_layanan" class="form-label">Nama layanan</label>
            <input type="text" id="nama_layanan" name="nama_layanan" required class="form-control" value="<?php echo $raa['nama_layanan'] ?>">
          </div>



          <div class="mb-3">
            <label for="harga_layanan" class="form-label">Harga layanan</label>
            <input type="number" id="harga_layanan" name="harga_layanan" required class="form-control" value="<?php echo $raa['harga_layanan'] ?>">
          </div>



          <div class="mb-3">
            <label>Keterangan</label>
            <div>
              <textarea required name="keterangan_layanan" id="keterangan_layanan" class="form-control" rows="3"><?php echo $raa['keterangan_layanan'] ?></textarea>
            </div>
          </div>


          <div class="form-group">
            <label>Gambar layanan</label>
            <input type="file" class="form-control" id="gambar_layanan" name="gambar_layanan" accept="image/*">
            * Kosongi Bila Gambar Tidak DIubah
          </div>



        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" onclick="history.back()">Kembali</button>
        <button type="submit" name="simpanlo" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>

    <?php

              if (isset($_POST['simpanlo'])) {

                $gambar_layanan = $_FILES['gambar_layanan']['name'];


                if (empty($gambar_layanan)) {
                  $nama_layanan = $_POST['nama_layanan'];
                  $harga_layanan = $_POST['harga_layanan'];
                  $keterangan_layanan = $_POST['keterangan_layanan'];
                  $id = $_POST['id'];
                  $queryupdate = mysqli_query($koneksi, "UPDATE tlayanan SET nama_layanan     = '$nama_layanan',
          harga_layanan     = '$harga_layanan',
          keterangan_layanan     = '$keterangan_layanan' WHERE id_layanan = $id");
                  if ($queryupdate) {
    ?>

          <script>
            swal({
              title: "Sukses!",
              text: "Data Berhasil diubah",
              type: "success",
              showConfirmButton: true
            }, function() {
              window.location.href = "layanan?page=data";
            });
          </script>


        <?php
                  } else {
        ?>
          <script>
            swal({
              title: "Gagal!",
              text: "Data Gagal diubah.",
              type: "error",
              showConfirmButton: true
            }, function() {
              window.location.href = "layanan?page=data";
            });
          </script>
        <?php
                  }
                } else {

                  $nama_layanan = $_POST['nama_layanan'];
                  $harga_layanan = $_POST['harga_layanan'];
                  $keterangan_layanan = $_POST['keterangan_layanan'];
                  $gambar_layanan = $_FILES['gambar_layanan']['name'];
                  $queryupdate = mysqli_query($koneksi, "UPDATE tlayanan SET nama_layanan     = '$nama_layanan',
          harga_layanan     = '$harga_layanan',
          keterangan_layanan     = '$keterangan_layanan',
         gambar_layanan     = '$gambar_layanan'
                        WHERE id_layanan = $id");
                  move_uploaded_file($_FILES['gambar_layanan']['tmp_name'], '../gambar_layanan/' . $gambar_layanan);
                  if ($queryupdate) {
        ?>
          <script>
            swal({
              title: "Sukses!",
              text: "Data Berhasil diubah",
              type: "success",
              showConfirmButton: true
            }, function() {
              window.location.href = "layanan?page=data";
            });
          </script>

        <?php
                  } else {
        ?>
          <script>
            swal({
              title: "Gagal!",
              text: "Data Gagal diubah.",
              type: "error",
              showConfirmButton: true
            }, function() {
              window.location.href = "layanan?page=data";
            });
          </script>
    <?php
                  }
                }
              }
    ?>




  <?php
            } elseif ($page == 'hapus') {
              $id = $_GET['id'];
              $modal = mysqli_query($koneksi, "Delete FROM tlayanan WHERE id_layanan='$id'");
  ?>
    <script>
      swal({
        title: "Sukses!",
        text: "Data Berhasil dihapus",
        type: "success",
        showConfirmButton: true
      }, function() {
        window.location.href = "layanan?page=data";
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