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
              <h3 class="card-title">Data bank</h3>
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
                      <th>Norek</th>
                      <th>Bank</th>
                      <th>Aksi</th>
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
                          <td><?php echo  $r['nama_bank']; ?></td>
                          <td><?php echo  $r['norek_bank']; ?></td>
                          <td><?php echo  $r['bank_bank']; ?></td>

                          <td><a href="bank?page=edit&id=<?php echo  $r['id_bank']; ?>"><button type="button" class="btn btn-circle btn-outline btn-success"><i class="nav-icon fas fa-edit"></i></button></a>

                            <a href="bank?page=hapus&id=<?php echo  $r['id_bank']; ?>" onclick="return confirm('Yakin ingin hapus data ?')"><button type="button" class="btn btn-circle btn-outline btn-danger"><i class="far fa-trash-alt"></i></button></a>
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
                              <label>Nama Pemilik Rekening</label>
                              <input type="text" class="form-control" id="nama_bank" name="nama_bank" value="" required="" />
                            </div><br />
                            <div class="form-group">
                              <label>Bank</label>
                              <input type="text" class="form-control" id="bank_bank" name="bank_bank" value="" required="" />
                            </div><br />
                            <div class="form-group">
                              <label>Nomor Rekening</label>
                              <input type="number" class="form-control" id="norek_bank" name="norek_bank" value="" required="" />
                            </div><br />
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

                    $bank_bank = $_POST['bank_bank'];
                    $norek_bank = $_POST['norek_bank'];
                    $nama_bank = $_POST['nama_bank'];
                    $sql = "INSERT INTO tbank (bank_bank, norek_bank,nama_bank) VALUES ('$bank_bank','$norek_bank','$nama_bank')";
                    if ($koneksi->query($sql) === false) {
                  ?>
                      <script>
                        swal({
                          title: "Gagal!",
                          text: "Data Gagal ditambahkan",
                          type: "error",
                          showConfirmButton: true
                        }, function() {
                          window.location.href = "bank?page=data";
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
                          window.location.href = "bank?page=data";
                        });
                      </script>
                  <?php
                    }
                  }
                  ?>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
</div>

<?php
            } elseif ($page == 'edit') {
              $id = $_GET['id'];
?> <div class="card-body">

    <?php
              $query = mysqli_query($koneksi, "SELECT * FROM tbank WHERE id_bank = '$id'");
              $r = mysqli_fetch_array($query);
    ?>
    <form form id="sign_in" method="POST">
      <div class="row">
        <div class="col-sm">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama_bank" id="nama_bank" placeholder="" required value="<?php echo $r['nama_bank'] ?>" />
          </div>
          <div class="form-group">
            <label>Bank</label>
            <input type="hidden" id="id" name="id" value="<?php echo $r['id_bank'] ?>">
            <input type="text" class="form-control" name="bank_bank" placeholder="" value="<?php echo $r['bank_bank'] ?>" />
          </div>
        </div>
        <div class="col-sm">
          <div class="form-group">
            <label>Nomor Rekening</label>
            <input type="number" class="form-control" name="norek_bank" id="norek_bank" placeholder="" required value="<?php echo $r['norek_bank'] ?>" />
          </div>
        </div>
      </div>
      <hr />
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-icon-split w-100" name="login"> <span class="icon text-white-50">
            <i class="fas fa-save"></i>
          </span>
          <span class="text">SIMPAN PERUBAHAN</span></button>
      </div>
    </form>
    <?php
              if (isset($_POST['login'])) {
                $bank_bank  = $_POST['bank_bank'];
                $nama_bank  = $_POST['nama_bank'];
                $norek_bank  = $_POST['norek_bank'];
                $id = $_POST['id'];
                $queryupdate = mysqli_query($koneksi, "UPDATE tbank SET nama_bank     = '$nama_bank', bank_bank     = '$bank_bank', norek_bank     = '$norek_bank' WHERE id_bank = $id");
                if ($queryupdate) {
    ?>
        <script>
          swal({
            title: "Sukses!",
            text: "Data Berhasil diubah.",
            type: "success",
            showConfirmButton: true
          }, function() {
            window.location.href = "bank?page=data";
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
            window.location.href = "bank?page=data";
          });
        </script>
    <?php
                }
              }
    ?>
  </div>
  </div>
  </div>
  </div>
  </div>
<?php
            } elseif ($page == 'hapus') {
              $id = $_GET['id'];
              $modal = mysqli_query($koneksi, "Delete FROM tbank WHERE id_bank='$id'");
?>
  <script>
    swal({
      title: "Sukses!",
      text: "Data Berhasil dihapus",
      type: "success",
      showConfirmButton: true
    }, function() {
      window.location.href = "bank?page=data";
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