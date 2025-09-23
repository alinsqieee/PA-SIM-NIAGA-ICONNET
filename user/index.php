<?php
session_start();
include "../db/db.php";

// Ambil data email dari cookie jika ada
$email_remember = isset($_COOKIE['email_remember']) ? $_COOKIE['email_remember'] : '';
$remember_checked = isset($_COOKIE['email_remember']) ? 'checked' : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $aplikasi ?></title>

  <link rel="shortcut icon" href="<?php echo $url_web ?>/logo.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $url_web ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo $url_web ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $url_web ?>/dist/css/adminlte.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo $url_web ?>/css/sweetalert.css">
  <script src="<?php echo $url_web ?>/js/sweet-alerts.min.js" type="text/javascript"></script>
  <script src="<?php echo $url_web ?>/js/sweetalert.min.js" type="text/javascript"></script>

</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->

    <center><img src="<?php echo $url_web ?>/logo-atas.png" width="270"></center><br />
    <div class="card card-outline card-primary">
      <div class="card-header text-center">

        <a href="<?php echo $url_web ?>/user/" class="h3"><b>LOGIN USER<br /><?php echo $aplikasi ?></b></a>
      </div>
      <div class="card-body">

        <p class="login-box-msg">Login Menggunakan Email & Password</p>

        <form id="frmSignin" method="POST">
          <div class="input-group mb-3">
            <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" required value="<?php echo $email_remember; ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember" <?php echo $remember_checked; ?>>
                <label for="remember">Ingatkan Saya Selalu</label>
              </div><br />
              <button type="submit" class="btn btn-primary btn-block w-100" name="login">Login Akun</button>
              <center><br />

                Belum Punya Akun ? <a href="daftar">Daftar Akun</a></center>
            </div>
          </div>
        </form>

        <?php
        if (isset($_POST['login'])) {
          $username = mysqli_real_escape_string($koneksi, $_POST['Email']);
          $password = mysqli_real_escape_string($koneksi, $_POST['pass']);

          $query   = mysqli_query($koneksi, "SELECT * FROM tuser WHERE pass_user='$password' AND email_user='$username'");
          $row     = mysqli_fetch_array($query);
          $num_row = mysqli_num_rows($query);

          if ($num_row > 0) {
            $_SESSION['id_user'] = $row['id_user'];

            // Jika checkbox "remember" dicentang
            if (isset($_POST['remember'])) {
              setcookie("email_remember", $_POST['Email'], time() + (86400 * 30), "/"); // Simpan 30 hari
            } else {
              setcookie("email_remember", "", time() - 3600, "/"); // Hapus cookie
            }

            echo '<script>window.location.href = "beranda";</script>';
          } else {
        ?>
            <script>
              swal("Gagal Login", "Masukkan Username / Password dengan Benar! & Status Akun Aktif", "error")
            </script>
        <?php
          }
        }
        ?>

        <br />
        <center>
          <p class="mb-0">
            <a href="<?php echo $url_web ?>" class="text-center">KEMBALI KE WEBSITE</a>
          </p>
        </center>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo $url_web ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo $url_web ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo $url_web ?>/dist/js/adminlte.min.js"></script>
</body>

</html>