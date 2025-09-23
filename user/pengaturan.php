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
                            <h3 class="card-title">Pengaturan</h3>
                        </div>
                        <div class="card-body">

                            <?php
                            $query = mysqli_query($koneksi, "SELECT * FROM tuser WHERE id_user = '$sesi[id_user]'");
                            $r = mysqli_fetch_array($query);
                            ?>

                            <div class="row">
                                <div class="col-sm">
                                    <form form id="sign_in" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="hidden" id="id" name="id" value="<?php echo $r['id_user'] ?>">
                                            <input type="text" class="form-control" name="email_user" placeholder="Email" value="<?php echo $r['email_user'] ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="" required value="<?php echo $r['nama_user'] ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" class="form-control" name="alamat_user" id="alamat_user" placeholder="" required value="<?php echo $r['alamat_user'] ?>" />
                                        </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label>HP</label>
                                        <input type="number" class="form-control" name="hp_user" id="hp_user" placeholder="" required value="<?php echo $r['hp_user'] ?>" />
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" name="pass_user" id="pass_user" placeholder="" value="<?php echo $r['pass_user'] ?>" />
                                    </div>

                                    <div class="form-group">
                                        <label>Foto User <font color="red">( * Kosongi Jika Gambar Tidak diubah )</font></label>
                                        <input type="file" class="form-control" id="foto_user" name="foto_user" accept="image/*">
                                        <input type="hidden" name="foto_user_lama" value="<?php echo $r['foto_user']; ?>">
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
                                $nama_user  = $_POST['nama_user'];
                                $alamat_user  = $_POST['alamat_user'];
                                $pass_user  = $_POST['pass_user'];
                                $email_user  = $_POST['email_user'];
                                $hp_user  = $_POST['hp_user'];
                                $id = $_POST['id'];

                                // ✅ Perbaikan khusus bagian foto_user dimulai di bawah ini
                                $foto_user_lama = $_POST['foto_user_lama'];
                                $foto_user = $_FILES['foto_user']['name'];

                                if (!empty($foto_user)) {
                                    $tmp = $_FILES['foto_user']['tmp_name'];
                                    move_uploaded_file($tmp, '../foto_user/' . $foto_user);
                                } else {
                                    $foto_user = $foto_user_lama;
                                }
                                // ✅ Perbaikan foto_user selesai di sini

                                $queryupdate = mysqli_query($koneksi, "UPDATE tuser SET 
        nama_user     = '$nama_user',
        email_user    = '$email_user',
        alamat_user   = '$alamat_user',
        pass_user     = '$pass_user',
        foto_user     = '$foto_user',
        hp_user       = '$hp_user'
        WHERE id_user = $id");

                                if ($queryupdate) {
                            ?>
                                    <script>
                                        swal({
                                            title: "Sukses!",
                                            text: "Data Berhasil diubah",
                                            type: "success",
                                            showConfirmButton: true
                                        }, function() {
                                            window.location.href = "pengaturan";
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
                                            window.location.href = "pengaturan";
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