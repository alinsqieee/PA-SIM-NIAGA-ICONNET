<?php
include_once "inc/header.php";
?>

<div class="content-wrapper">
    <br/>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pengaturan</h3>
                        </div>

                        <div class="card-body">

                            <?php 
                            // Ambil data admin
                            $query = mysqli_query($koneksi, "SELECT * FROM tadmin WHERE id_admin = '$sesi[id_admin]'");
                            $r = mysqli_fetch_array($query);
                            ?>

                            <div class="row">
                                <div class="col-sm">
                                    <form id="sign_in" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="hidden" id="id" name="id" value="<?php echo $r['id_admin'] ?>">
                                            <input type="text" class="form-control" name="email_admin" placeholder="Email" value="<?php echo $r['email_admin'] ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="nama_admin" id="nama_admin" placeholder="" required value="<?php echo $r['nama_admin'] ?>"/>
                                        </div>
                                </div>

                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>HP</label>
                                        <input type="number" class="form-control" name="hp_admin" id="hp_admin" placeholder="" required value="<?php echo $r['hp_admin'] ?>" />
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="password" id="password" placeholder="" value="" />
                                    </div>

                                    <div class="form-group">
                                        <label>Foto Admin <font color="red">( * Kosongi Jika Gambar Tidak diubah )</font></label>
                                        <input type="file" class="form-control" id="foto_admin" name="foto_admin" accept="image/*">
                                        <input type="hidden" name="foto_admin_lama" value="<?php echo isset($r['foto_admin']) ? $r['foto_admin'] : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-icon-split w-100" name="login">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-save"></i>
                                    </span>
                                    <span class="text">SIMPAN PENGATURAN</span>
                                </button>
                            </div>
                        </form>

                        <?php
                        if (isset($_POST['login'])) {
                            $id = $_POST['id'];
                            $nama_admin = $_POST['nama_admin'];
                            $email_admin = $_POST['email_admin'];
                            $hp_admin = $_POST['hp_admin'];

                            // Tangani foto admin
                            $foto_admin_lama = $_POST['foto_admin_lama'];
                            $foto_admin = $foto_admin_lama; // default pakai foto lama

                            if (isset($_FILES['foto_admin']) && $_FILES['foto_admin']['error'] == 0) {
                                $foto_admin = $_FILES['foto_admin']['name'];
                                $tmp = $_FILES['foto_admin']['tmp_name'];
                                move_uploaded_file($tmp, '../foto_admin/'.$foto_admin);
                            }

                            // Jika password kosong, update tanpa password
                            if (empty($_POST['password'])) {
                                $queryupdate = mysqli_query($koneksi, "UPDATE tadmin SET 
                                    nama_admin   = '$nama_admin',
                                    email_admin  = '$email_admin',
                                    hp_admin     = '$hp_admin',
                                    foto_admin   = '$foto_admin'
                                    WHERE id_admin = $id");
                            } else {
                                // Update termasuk password baru
                                $md5 = md5($_POST['password']);
                                $queryupdate = mysqli_query($koneksi, "UPDATE tadmin SET 
                                    nama_admin  = '$nama_admin',
                                    email_admin = '$email_admin',
                                    hp_admin    = '$hp_admin',
                                    pass_admin  = '$md5',
                                    foto_admin  = '$foto_admin'
                                    WHERE id_admin = $id");
                            }

                            if ($queryupdate) {
                                $redirect = empty($_POST['password']) ? "pengaturan.php" : "logout.php";
                                $msg = empty($_POST['password']) ? "Data Berhasil diubah." : "Data Berhasil diubah, silahkan login Lagi.";
                                ?>
                                <script>
                                swal({
                                    title: "Sukses!",
                                    text: "<?php echo $msg; ?>",
                                    type: "success",
                                    showConfirmButton: true
                                }, function(){
                                    window.location.href = "<?php echo $redirect; ?>";
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
                                }, function(){
                                    window.location.href = "pengaturan.php";
                                });
                                </script>
                                <?php
                            }
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
