<?php
include "db/db.php";
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

      <a href="<?php echo $url_web ?>/" class="h2"><b><?php echo $aplikasi ?></b></a>
    </div>
    <div class="card-body">
      
      <center>PILIH AKSES LOGIN AKUN</center>
 <div class="card-body row">
                <div class="col-md-6">
      <a class="btn btn-app bg-secondary w-100" href="admin">
             
                  <i class="fas fa-user"></i> ADMIN
                </a>
              </div>
               <div class="col-md-6">
                <a class="btn btn-app bg-success w-100" href="user">
  
                  <i class="fas fa-users"></i> USER
                </a>
              </div></div>

              <style>
    .marquee-container {
      background-color: red;
      overflow: hidden;
      white-space: nowrap;
      position: relative;
      height: 40px;
      display: flex;
      align-items: center;
    }

    .marquee-track {
      display: inline-block;
      white-space: nowrap;
      animation: scroll-left 15s linear infinite;
    }

    @keyframes scroll-left {
      0% {
        transform: translateX(0%);
      }
      100% {
        transform: translateX(-50%);
      }
    }

    .marquee-text {
      display: inline-block;
      color: white;
      font-size: 18px;
      font-weight: bold;
    }
  </style>
  <div class="marquee-container">
  <div class="marquee-track">
    <span class="marquee-text">
      PILIH AKSES SESUAI ROLE & SELALU AMANKAN PASSWORD ANDA &#9679 
      PILIH AKSES SESUAI ROLE & SELALU AMANKAN PASSWORD ANDA &#9679 
    </span>
  </div>
</div>
   
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
