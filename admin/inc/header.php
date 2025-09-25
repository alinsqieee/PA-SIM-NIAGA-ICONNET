<?php
include "../db/db.php";
include('session.php');
$result = mysqli_query($koneksi, "select * from tadmin where id_admin='$session_id'") or die('Error In Session');
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

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <!-- Notifikasi Pemesanan -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">
              <?php
              $sqlCommand = "SELECT COUNT(*) FROM tpemesanan WHERE notif_pemesanan = 'Baru'";
              $query = mysqli_query($koneksi, $sqlCommand) or die(mysqli_error($koneksi));
              $row = mysqli_fetch_row($query);
              echo $row[0];
              mysqli_free_result($query);
              ?>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">
              <?php
              $sqlCommand = "SELECT COUNT(*) FROM tpemesanan WHERE notif_pemesanan = 'Baru'";
              $query = mysqli_query($koneksi, $sqlCommand) or die(mysqli_error($koneksi));
              $row = mysqli_fetch_row($query);
              echo $row[0];
              mysqli_free_result($query);
              ?> Pemesanan Baru
            </span>
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM tpemesanan WHERE notif_pemesanan = 'Baru' ORDER BY id_pemesanan DESC") or die(mysqli_error($koneksi));
            if (mysqli_num_rows($query) > 0) {
              while ($r = mysqli_fetch_array($query)):
                $querys = mysqli_query($koneksi, "SELECT * FROM tlayanan WHERE id_layanan = '$r[id_layanan]'");
                $layanan = mysqli_fetch_array($querys);
                $queryss = mysqli_query($koneksi, "SELECT * FROM tuser WHERE id_user = '$r[id_user]'");
                $user = mysqli_fetch_array($queryss);
            ?>
                <div class="dropdown-divider"></div>
                <a href="pemesanan?page=detail&kode_pemesanan=<?php echo $r['kode_pemesanan']; ?>"
                  class="dropdown-item notif-item"
                  data-kode="<?php echo $r['kode_pemesanan']; ?>">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i><?php echo $r['kode_pemesanan']; ?>
                  <span class="float-right text-muted text-sm"><?php echo $r['jam_pemesanan']; ?></span>
                </a>
            <?php
              endwhile;
            }
            ?>
          </div>
        </li>

        <!-- Notifikasi Chat -->
        <?php
        $sql_notif_admin = "SELECT * FROM tchat WHERE jenis_chat='User' AND status='unread' ORDER BY tanggal_chat DESC";
        $query_notif_admin = mysqli_query($koneksi, $sql_notif_admin);
        $jumlah_notif_admin = mysqli_num_rows($query_notif_admin);
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comment-alt"></i>
            <span class="badge badge-danger navbar-badge" id="notif_chat_count_admin"><?php echo $jumlah_notif_admin; ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" id="notif_chat_list_admin">
            <span class="dropdown-header"><?php echo $jumlah_notif_admin; ?> Pesan Baru</span>
            <div class="dropdown-divider"></div>
            <?php if ($jumlah_notif_admin > 0): ?>
              <?php while ($notif = mysqli_fetch_assoc($query_notif_admin)): ?>
                <?php
                // Ambil kode_bantuan dari tabel tbantuan
                $id_bantuan = $notif['id_bantuan'];
                $queryBantuan = mysqli_query($koneksi, "SELECT kode_bantuan FROM tbantuan WHERE id_bantuan='$id_bantuan'");
                $kode = mysqli_fetch_assoc($queryBantuan)['kode_bantuan'];
                ?>
                <a href="bantuan?page=lihat&kode_bantuan=<?php echo $kode; ?>"
                  class="dropdown-item notif-chat-item-admin"
                  data-id="<?php echo $notif['id_chat']; ?>">
                  <strong>User</strong>: <?php echo substr($notif['isi_chat'], 0, 30); ?>...
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
          <a class="nav-link" data-widget="fullscreen" href="#" role="button"><i class="fas fa-expand-arrows-alt"></i></a>
        </li>
      </ul>
    </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $(document).on('click', '.notif-item', function(e) {
          let kode = $(this).data("kode");
          $.ajax({
            url: "update_notif.php",
            type: "POST",
            data: {
              kode_pemesanan: kode
            },
            dataType: "json",
            success: function(res) {
              if (res.success) {
                $(".navbar-badge").text(res.count);
              }
            }
          });
        });

        $(document).on('click', '.notif-chat-item-admin', function(e) {
          e.preventDefault();
          let chat_id = $(this).data('id');
          let url = $(this).attr('href');

          $.ajax({
            url: 'update_chat.php',
            type: 'POST',
            data: {
              id_chat: chat_id
            },
            success: function(res) {
              let count = parseInt($('#notif_chat_count_admin').text());
              if (count > 0) $('#notif_chat_count_admin').text(count - 1);

              $(`[data-id='${chat_id}']`).remove();

              if ($('#notif_chat_list_admin .notif-chat-item-admin').length == 0) {
                $('#notif_chat_list_admin').append('<span class="dropdown-item text-center text-muted">Tidak ada pesan baru</span>');
              }

              window.location.href = url;
            }
          });
        });
      });
    </script>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="beranda" class="brand-link">
        <img src="<?php echo $url_web ?>/logo.png" alt="AdminLTE Logo" class="brand-image elevation-3">
        <span class="brand-text font-weight-light"><?php echo $aplikasi ?></span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo $url_web ?>/<?php echo !empty($sesi['foto_admin']) ? 'foto_admin/' . $sesi['foto_admin'] : 'dist/img/user.png'; ?>?t=<?php echo time(); ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $sesi["nama_admin"] ?></a>
            <small style="margin-top:-5px; display:block; color:#ccc;">Admin</small>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="beranda" class="nav-link"><i class="nav-icon fas fa-home"></i>
                <p>Beranda</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="user?page=data" class="nav-link"><i class="nav-icon fas fa-user"></i>
                <p>User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="layanan?page=data" class="nav-link"><i class="nav-icon fas fa-columns"></i>
                <p>Layanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="bank?page=data" class="nav-link"><i class="nav-icon fas fa-book"></i>
                <p>Bank</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pemesanan?page=data" class="nav-link"><i class="fas fa-cart-plus fa-lg mr-2"></i>
                <p>Pemesanan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="bantuan?page=data" class="nav-link"><i class="nav-icon fas fa-copy"></i>
                <p>Tiket Bantuan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pengaturan" class="nav-link"><i class="fas fa-laptop"></i>
                <p>Pengaturan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout" class="nav-link"><i class="nav-icon fas fa-home"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>