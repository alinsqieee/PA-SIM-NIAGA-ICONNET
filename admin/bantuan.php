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
              <h3 class="card-title">Data Tiket Bantuan</h3>
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
                      <th>Kode Tiket</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>HP</th>
                      <th>Jenis Layanan</th>
                      <th>Prioritas</th>
                      <th>Status</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $bil = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM tbantuan ORDER BY id_bantuan DESC") or die(mysqli_error($koneksi));
                    if (mysqli_num_rows($query) == 0) {
                      echo "";
                    } else {


                      while ($r = mysqli_fetch_array($query)):
                        $bil++;
                        $queryss = mysqli_query($koneksi, "SELECT * FROM tuser WHERE id_user = '$r[id_user]'");
                        $user = mysqli_fetch_array($queryss);
                    ?>
                        <tr>
                          <td><?php echo  $bil; ?></td>
                          <td><?php echo  $r['kode_bantuan']; ?></td>
                          <td><?php echo  tgl_indo($r['tanggal_bantuan']); ?> [ <?php echo  $r['jam_bantuan']; ?> ]</td>
                          <td><?php echo  $user['nama_user']; ?></td>
                          <td><?php echo  $user['hp_user']; ?></td>
                          <td><?php echo  $r['jenis_layanan']; ?></td>
                          <td><?php echo  $r['prioritas_bantuan']; ?></td>
                          <td><?php echo  $r['status_bantuan']; ?></td>
                          <td><a href="bantuan?page=lihat&kode_bantuan=<?php echo  $r['kode_bantuan']; ?>"><button type="button" class="btn btn-circle btn-outline btn-warning"><i class="nav-icon fas fa-eye"></i></button></a>
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
            } elseif ($page == 'lihat') {
              $id = $_GET['kode_bantuan'];
            ?> <div class="card-body">

                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM tbantuan WHERE kode_bantuan = '$id'");
                $raa = mysqli_fetch_array($query);
                $querys = mysqli_query($koneksi, "SELECT * FROM tuser WHERE id_user = '$raa[id_user]'");
                $user = mysqli_fetch_array($querys);
                ?>


                <div class="row">
                  <div class="col-sm">
                    <dl class="row mb-0">
                      <dt class="col-sm-4">Kode Tiket</dt>
                      <dd class="col-sm-8">: <?php echo  $raa['kode_bantuan']; ?></dd>
                      <dt class="col-sm-4">Tanggal Tiket</dt>
                      <dd class="col-sm-8">: <?php echo  tgl_indo($raa['tanggal_bantuan']); ?> [ <?php echo  $raa['jam_bantuan']; ?> ]</dd>
                      <dt class="col-sm-4">Nama </dt>
                      <dd class="col-sm-8">: <?php echo  $user['nama_user']; ?></dd>
                      <dt class="col-sm-4">HP </dt>
                      <dd class="col-sm-8">: <?php echo  $user['hp_user']; ?></dd>
                      <dt class="col-sm-4">Alamat </dt>
                      <dd class="col-sm-8">: <?php echo  $user['alamat_user']; ?></dd>
                      <dt class="col-sm-4">Email </dt>
                      <dd class="col-sm-8">: <?php echo  $user['email_user']; ?></dd>
                      <dt class="col-sm-4">Jenis Layanan</dt>
                      <dd class="col-sm-8">: <?= $raa['jenis_layanan']; ?></dd>
                      <dt class="col-sm-4">Status </dt>
                      <dd class="col-sm-8">: <?php echo  $raa['status_bantuan']; ?></dd>
                      <dt class="col-sm-4">Prioritas </dt>
                      <dd class="col-sm-8">: <?php echo  $raa['prioritas_bantuan']; ?></dd>
                      <dt class="col-sm-4">Keterangan </dt>
                      <dd class="col-sm-8">: <?php echo  $raa['keterangan_bantuan']; ?></dd>
                    </dl>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <?php if ($raa['status_bantuan'] == 'Proses') { ?>


                      <hr />
                      <button type="button" onclick="selesai('<?php echo $raa['kode_bantuan']; ?>')" id="btnBatala" class="btn btn-success btn-lg w-100">
                        UBAH KE SELESAI
                      </button>
                      <script>
                        function selesai(kode) {
                          Swal.fire({
                            title: 'Yakin ingin Mengubah Status?',
                            text: "Status Tiket Bantuan Akan Di Ubah Menjadi Selesai, Diskusi Chat akan Di tutup",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, Lanjutkan!',
                            cancelButtonText: 'Batal'
                          }).then((result) => {
                            if (result.isConfirmed) {
                              // Redirect ke halaman pembatalan
                              window.location.href = 'bantuan?page=selesai&id=' + encodeURIComponent(kode);
                            }
                          });
                        }
                      </script>
                    <?php } ?>
                  </div>
                  <div class="col-sm">
                    <?php

                    if (isset($_POST['kirim_chat'])) {
                      $isi_chat = mysqli_real_escape_string($koneksi, $_POST['message']);
                      $id_bantuan = $_POST['id_bantuan'];
                      $id_user = $user['id_user'];
                      $jenis_chat = 'Admin';
                      $tanggal_chat = date("d/m/Y - H:i:s");

                      mysqli_query($koneksi, "INSERT INTO tchat 
        (id_bantuan, id_user, jenis_chat, tanggal_chat, isi_chat) 
        VALUES 
        ('$id_bantuan', '$id_user', '$jenis_chat', '$tanggal_chat', '$isi_chat')");
                      exit;
                    }
                    ?>

                    <div class="card-body" style="height: 300px; overflow-y: auto;">
                      <div id="chatContainer">
                        <?php
                        $queryChat = mysqli_query($koneksi, "SELECT * FROM tchat WHERE id_bantuan = '$raa[id_bantuan]' ORDER BY id_chat ASC");
                        while ($chat = mysqli_fetch_array($queryChat)) {
                          $chatClass = $chat['jenis_chat'] == 'Admin' ? ' right' : '';
                          if ($chat['jenis_chat'] == 'Admin') {
                            $namaPengirim = 'Admin';
                            $foto = 'admin.png';
                          } else {
                            $idUser = $chat['id_user'];
                            $qUser = mysqli_query($koneksi, "SELECT nama_user FROM tuser WHERE id_user = '$idUser'");
                            $dUser = mysqli_fetch_array($qUser);
                            $namaPengirim = $dUser['nama_user'] ?? 'User';
                          }
                        ?>
                          <div class="direct-chat-msg<?= $chatClass ?>">
                            <div class="direct-chat-infos clearfix">
                              <span class="direct-chat-name float-left"><?= htmlspecialchars($namaPengirim) ?></span>
                              <span class="direct-chat-timestamp float-right"><?= $chat['tanggal_chat'] ?></span>
                            </div>
                            <img class="direct-chat-img" src="../user.png" alt="user image">
                            <div class="direct-chat-text">
                              <?= nl2br(htmlspecialchars($chat['isi_chat'])) ?>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                    <?php if ($raa['status_bantuan'] == 'Proses') { ?>
                      <div class="card-footer">
                        <form id="formChat" method="post">
                          <div class="input-group">
                            <input type="text" name="message" id="message" placeholder="Type message..." class="form-control" required>
                            <input type="hidden" id="id_bantuan" value="<?= $raa['id_bantuan'] ?>">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    <?php } ?>
                  </div>
                </div>

                <!-- jQuery -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <!-- AJAX Script -->
                <script>
                  $('#formChat').on('submit', function(e) {
                    e.preventDefault();
                    var message = $('#message').val();
                    var id_bantuan = $('#id_bantuan').val();
                    if (message.trim() === '') return;

                    $.ajax({
                      type: 'POST',
                      url: '', // same file
                      data: {
                        kirim_chat: true,
                        message: message,
                        id_bantuan: id_bantuan
                      },
                      success: function() {
                        $('#message').val('');
                        $('#chatContainer').load(location.href + " #chatContainer>*", "");
                      }
                    });
                  });
                </script>


              <?php
            } elseif ($page == 'selesai') {
              $id = $_GET['id'];
              $queryupdate = mysqli_query($koneksi, "UPDATE tbantuan SET status_bantuan  = 'Selesai' WHERE kode_bantuan = '$id'");
              ?>
                <script>
                  swal({
                    title: "Sukses!",
                    text: "Data Berhasil Diubah",
                    type: "success",
                    showConfirmButton: true
                  }, function() {
                    window.location.href = "bantuan?page=lihat&kode_bantuan=<?php echo $id ?>";
                  });
                </script>





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