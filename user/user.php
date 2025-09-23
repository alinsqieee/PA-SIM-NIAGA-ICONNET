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
              <h3 class="card-title">Data User</h3>
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
                      <th>Nama</th>
                      <th>HP</th>
                      <th>Email</th>
                      <th>Alamat</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $bil = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM tuser ORDER BY id_user DESC") or die(mysqli_error($koneksi));
                    if (mysqli_num_rows($query) == 0) {
                      echo "";
                    } else {


                      while ($r = mysqli_fetch_array($query)):
                        $bil++;
                    ?>
                        <tr>
                          <td><?php echo  $bil; ?></td>
                          <td><?php echo  $r['nama_user']; ?></td>
                          <td><?php echo  $r['hp_user']; ?></td>
                          <td><?php echo  $r['email_user']; ?></td>
                          <td><?php echo  $r['alamat_user']; ?></td>
                          <td><a href="user?page=edit&id=<?php echo  $r['id_user']; ?>"><button type="button" class="btn btn-circle btn-outline btn-success"><i class="nav-icon fas fa-edit"></i></button></a>

                            <a href="user?page=hapus&id=<?php echo  $r['id_user']; ?>" onclick="return confirm('Yakin ingin hapus data ?')"><button type="button" class="btn btn-circle btn-outline btn-danger"><i class="far fa-trash-alt"></i></button></a>
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
            } elseif ($page == 'edit') {
              $id = $_GET['id'];
            ?> <div class="card-body">

                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM tuser WHERE id_user = '$id'");
                $r = mysqli_fetch_array($query);
                ?>
                <form form id="sign_in" method="POST">


                  <div class="row">
                    <div class="col-sm">


                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="" required value="<?php echo $r['nama_user'] ?>" />
                      </div>

                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="hidden" id="id" name="id" value="<?php echo $r['id_user'] ?>">
                        <input type="text" class="form-control" name="alamat_user" placeholder="Email" value="<?php echo $r['alamat_user'] ?>" />
                      </div>


                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email_user" id="email_user" placeholder="" required value="<?php echo $r['email_user'] ?>" />
                      </div>



                    </div>
                    <div class="col-sm">

                      <div class="form-group">
                        <label>HP</label>
                        <input type="number" class="form-control" name="hp_user" id="hp_user" placeholder="" required value="<?php echo $r['hp_user'] ?>" />
                      </div>





                      <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" id="pass_user" name="pass_user" placeholder="" value="<?php echo $r['pass_user'] ?>" />


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
                  $email_user  = $_POST['email_user'];
                  $nama_user  = $_POST['nama_user'];
                  $alamat_user  = $_POST['alamat_user'];
                  $hp_user  = $_POST['hp_user'];
                  $pass_user  = $_POST['pass_user'];

                  $id = $_POST['id'];
                  $queryupdate = mysqli_query($koneksi, "UPDATE tuser SET nama_user     = '$nama_user',
                              email_user     = '$email_user',
                              alamat_user     = '$alamat_user',
                              pass_user     = '$pass_user',
                               hp_user     = '$hp_user'
                                WHERE id_user = $id");
                  if ($queryupdate) {
                ?>

                    <script>
                      swal({
                        title: "Sukses!",
                        text: "Data Berhasil diubah.",
                        type: "success",
                        showConfirmButton: true
                      }, function() {
                        window.location.href = "user?page=data";
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
                        window.location.href = "user?page=data";
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