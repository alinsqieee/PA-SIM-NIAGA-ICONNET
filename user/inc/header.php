<?php
include "../db/db.php";
include('session.php');
$result = mysqli_query($koneksi, "select * from tuser where id_user='$session_id'") or die('Error In Session');
$sesi = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $aplikasi ?></title>

  <link rel="shortcut icon" href="<?php echo $url_web ?>/logo.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo $url_web ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo $url_web ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="<?php echo $url_web ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $url_web ?>/plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="<?php echo $url_web ?>/dist/css/adminlte.min.css?v=3.2.0">
  <link rel="stylesheet" href="<?php echo $url_web ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="<?php echo $url_web ?>/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo $url_web ?>/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $url_web ?>/css/sweetalert.css">
  <script src="<?php echo $url_web ?>/js/sweet-alerts.min.js" type="text/javascript"></script>
  <script src="<?php echo $url_web ?>/js/sweetalert.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="<?php echo $url_web ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $url_web ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $url_web ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php
    // Ambil jumlah pesan chat baru untuk user
    $user_id = $sesi['id_user'];
    $sql_notif = "SELECT c.*, b.kode_bantuan FROM tchat c 
              JOIN tbantuan b ON c.id_bantuan = b.id_bantuan 
              WHERE c.id_user = '$user_id' AND c.status='unread' 
              ORDER BY c.tanggal_chat DESC";
    $query_notif = mysqli_query($koneksi, $sql_notif);
    $jumlah_notif = mysqli_num_rows($query_notif);
    ?>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i>
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <!-- Notifikasi Chat -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comment-alt"></i>
            <span class="badge badge-danger navbar-badge" id="notif_chat_count"><?php echo $jumlah_notif; ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" id="notif_chat_list">
            <span class="dropdown-header"><?php echo $jumlah_notif; ?> Pesan Baru</span>
            <div class="dropdown-divider"></div>

            <?php if ($jumlah_notif > 0): ?>
              <?php while ($notif = mysqli_fetch_assoc($query_notif)): ?>
                <a href="bantuan?page=lihat&kode_bantuan=<?php echo $notif['kode_bantuan']; ?>"
                  class="dropdown-item notif-chat-item"
                  data-id="<?php echo $notif['id_chat']; ?>">
                  <strong>Admin</strong>: <?php echo substr($notif['isi_chat'], 0, 30); ?>...
                  <span class="float-right text-muted text-sm"><?php echo $notif['tanggal_chat']; ?></span>
                </a>
                <div class="dropdown-divider"></div>
              <?php endwhile; ?>
            <?php else: ?>
              <span class="dropdown-item text-center text-muted">Tidak ada pesan baru</span>
            <?php endif; ?>
          </div>
        </li>

        <!-- Fullscreen -->
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="beranda" class="brand-link">
        <img src="<?php echo $url_web ?>/logo.png" alt="Logo" class="brand-image elevation-3">
        <span class="brand-text font-weight-light"><?php echo $aplikasi ?></span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo $url_web ?>/foto_user/<?php echo $sesi["foto_user"] ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $sesi["nama_user"] ?></a>
            <small style="margin-top:-5px; display:block; color:#ccc;">User</small>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item"><a href="beranda" class="nav-link"><i class="nav-icon fas fa-home"></i>
                <p>Beranda</p>
              </a></li>
            <li class="nav-item"><a href="layanan?page=data" class="nav-link"><i class="nav-icon fas fa-columns"></i>
                <p>Layanan</p>
              </a></li>
            <li class="nav-item"><a href="pemesanan?page=data" class="nav-link"><i class="fas fa-cart-plus fa-lg mr-2"></i>
                <p>Pemesanan</p>
              </a></li>
            <li class="nav-item"><a href="bantuan?page=data" class="nav-link"><i class="nav-icon fas fa-copy"></i>
                <p>Tiket Bantuan</p>
              </a></li>
            <li class="nav-item"><a href="pengaturan" class="nav-link"><i class="fas fa-laptop"></i>
                <p>Pengaturan</p>
              </a></li>
            <li class="nav-item"><a href="logout" class="nav-link"><i class="nav-icon fas fa-home"></i>
                <p>Logout</p>
              </a></li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- AJAX untuk update status chat -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $(document).on('click', '.notif-chat-item', function(e) {
          e.preventDefault();
          let chat_id = $(this).data('id');
          let url = $(this).attr('href'); // ambil link halaman tiket bantuan

          $.ajax({
            url: 'update_chat.php',
            type: 'POST',
            data: {
              id_chat: chat_id
            },
            success: function(res) {
              let count = parseInt($('#notif_chat_count').text());
              if (count > 0) $('#notif_chat_count').text(count - 1);

              $(`[data-id='${chat_id}']`).remove();

              if ($('#notif_chat_list .notif-chat-item').length == 0) {
                $('#notif_chat_list').append('<span class="dropdown-item text-center text-muted">Tidak ada pesan baru</span>');
              }

              // redirect ke halaman chat tiket bantuan
              window.location.href = url;
            }
          });
        });
      });
    </script>