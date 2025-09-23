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

  <center><img src="<?php echo $url_web ?>/logo-atas.png" width="200"></center><br/>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">

      <a href="<?php echo $url_web ?>/user/" class="h3"><b>DAFTAR USER<br/><?php echo $aplikasi ?></b></a>
    </div>
    <div class="card-body">

      <p class="login-box-msg">Isi Formulir di bawah ini untuk Daftar Akun</p>

   <form id="frmSignin" method="POST">
  <div class="input-group mb-3">
    <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Nama" required>
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-user"></span>
      </div>
    </div>
  </div>

  <div class="input-group mb-3">
    <input type="email" class="form-control" id="email_user" name="email_user" placeholder="Email" required>
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-envelope"></span>
      </div>
    </div>
  </div>

    <div class="input-group mb-3">
    <input type="number" class="form-control" id="hp_user" name="hp_user" placeholder="HP" required>
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-phone"></span>
      </div>
    </div>
  </div>

  <div class="input-group mb-3">
    <input type="text" class="form-control" id="alamat_user" name="alamat_user" placeholder="Alamat" required>
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-map"></span>
      </div>
    </div>
  </div>

  <div class="input-group mb-3">
    <input type="password" class="form-control" id="pass_user" name="pass_user" placeholder="Password" required>
    <div class="input-group-append">
      <div class="input-group-text">
        <span class="fas fa-lock"></span>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
     
      <button type="submit" class="btn btn-primary btn-block w-100" name="simpanlo">Daftar Akun</button><center><br/>

      Sudah Punya Akun ? <a href="index">Login Akun</a></center>
    </div>
  </div>
</form>


 <?php
if (isset($_POST['simpanlo']))
  {

    $email_user = $_POST['email_user'];
    $hp_user = $_POST['hp_user'];
    $nama_user = $_POST['nama_user'];
    $alamat_user = $_POST['alamat_user'];
    $pass_user = $_POST['pass_user'];

  
    $sql="INSERT INTO tuser (email_user, hp_user,nama_user,alamat_user,pass_user, foto_user) VALUES ('$email_user','$hp_user','$nama_user','$alamat_user','$pass_user','foto.png')";    
      
           if($koneksi->query($sql) === false) { 
             ?>
              <script>
                swal({
  title: "Gagal!",
  text: "Akun Gagal ditambahkan, Silahkan Ulangi",
  type: "error",
  showConfirmButton: true
}, function(){
      window.location.href = "layanan?page=data";
});
              </script>
                  <?php
          } else { 
           ?>

              <script>
               swal({
  title: "Sukses!",
  text: "Pendaftaran Berhasil, Silahkan Login",
  type: "success",
  showConfirmButton: true
}, function(){
      window.location.href = "layanan?page=data";
});
              </script>
             

                  <?php          
         }

  }
?>



     <br/><center>
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
