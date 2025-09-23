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

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i> Tambah Data</button><br /><br />

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
                    $query = mysqli_query($koneksi, "SELECT * FROM tbantuan WHERE id_user = '$sesi[id_user]' ORDER BY id_bantuan DESC") or die(mysqli_error($koneksi));
                    if (mysqli_num_rows($query) == 0) {
                      echo "";
                    } else {
                      while ($r = mysqli_fetch_array($query)):
                        $bil++;
                        $queryss = mysqli_query($koneksi, "SELECT * FROM tuser WHERE id_user = '$r[id_user]'");
                        $user = mysqli_fetch_array($queryss);
                    ?>
                        <tr>
                          <td><?= $bil; ?></td>
                          <td><?= $r['kode_bantuan']; ?></td>
                          <td><?= tgl_indo($r['tanggal_bantuan']); ?> [ <?= $r['jam_bantuan']; ?> ]</td>
                          <td><?= $user['nama_user']; ?></td>
                          <td><?= $user['hp_user']; ?></td>
                          <td><?= $r['jenis_layanan']; ?></td>
                          <td><?= $r['prioritas_bantuan']; ?></td>
                          <td><?= $r['status_bantuan']; ?></td>
                          <td>
                            <a href="bantuan?page=lihat&kode_bantuan=<?= $r['kode_bantuan']; ?>">
                              <button type="button" class="btn btn-circle btn-outline btn-warning"><i class="nav-icon fas fa-eye"></i></button>
                            </a>
                          </td>
                        </tr>
                    <?php
                      endwhile;
                    }
                    ?>
                  </tbody>
                </table>
              </div>

              <!-- Modal Tambah Data -->
              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="defaultModalLabel">Tambah Data</h4>
                    </div>
                    <div class="modal-body">

                      <form id="sign_in" method="post" enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-sm">

                            <div class="form-group">
                              <label>Prioritas</label>
                              <select name="prioritas_bantuan" id="prioritas_bantuan" class="form-control">
                                <option value="Biasa">Biasa</option>
                                <option value="Penting">Penting</option>
                                <option value="Sangat Penting">Sangat Penting</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label>Jenis Layanan</label>
                              <input type="text" name="jenis_layanan" id="jenis_layanan" class="form-control" placeholder="Masukkan Jenis Layanan" required>
                            </div>

                            <?php
                            function bilu($panjang = 10)
                            {
                              $pengacak = "123456789ABCDEFGHIJKLMNPQRSTUVWXYZ";
                              $hasil = "";
                              for ($i = 0; $i < $panjang; $i++) {
                                $pos = rand(0, strlen($pengacak) - 1);
                                $hasil .= $pengacak[$pos];
                              }
                              return $hasil;
                            }
                            ?>
                            <input id="kode_bantuan" type="hidden" name="kode_bantuan" value="<?= bilu(10) ?>" required>

                            <div class="form-group">
                              <label>Keluhan</label>
                              <textarea class="form-control" placeholder="Keterangan" name="keterangan_bantuan" id="keterangan_bantuan" rows="3"></textarea>
                            </div>

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
                    $id_user = $sesi['id_user'];
                    $prioritas_bantuan = $_POST['prioritas_bantuan'];
                    $jenis_layanan = $_POST['jenis_layanan'];
                    $kode_bantuan = $_POST['kode_bantuan'];
                    $keterangan_bantuan = $_POST['keterangan_bantuan'];
                    $a = date("Y-m-d");
                    $b = date("H:i:s");

                    $sql = "INSERT INTO tbantuan (keterangan_bantuan, id_user, prioritas_bantuan, jenis_layanan, kode_bantuan, tanggal_bantuan, jam_bantuan, status_bantuan) 
                            VALUES ('$keterangan_bantuan','$id_user','$prioritas_bantuan','$jenis_layanan','$kode_bantuan','$a','$b','Proses')";

                    if ($koneksi->query($sql) === false) {
                  ?>
                      <script>
                        swal({
                          title: "Gagal!",
                          text: "Data Gagal ditambahkan",
                          type: "error",
                          showConfirmButton: true
                        }, function() {
                          window.location.href = "bantuan?page=data";
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
                          window.location.href = "bantuan?page=lihat&kode_bantuan=<?= $kode_bantuan ?>";
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
            } elseif ($page == 'lihat') {
              $id = $_GET['kode_bantuan'];
?>
  <div class="card-body">
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
          <dd class="col-sm-8">: <?= $raa['kode_bantuan']; ?></dd>

          <dt class="col-sm-4">Tanggal Tiket</dt>
          <dd class="col-sm-8">: <?= tgl_indo($raa['tanggal_bantuan']); ?> [ <?= $raa['jam_bantuan']; ?> ]</dd>

          <dt class="col-sm-4">Nama</dt>
          <dd class="col-sm-8">: <?= $user['nama_user']; ?></dd>

          <dt class="col-sm-4">HP</dt>
          <dd class="col-sm-8">: <?= $user['hp_user']; ?></dd>

          <dt class="col-sm-4">Alamat</dt>
          <dd class="col-sm-8">: <?= $user['alamat_user']; ?></dd>

          <dt class="col-sm-4">Email</dt>
          <dd class="col-sm-8">: <?= $user['email_user']; ?></dd>

          <dt class="col-sm-4">Jenis Layanan</dt>
          <dd class="col-sm-8">: <?= $raa['jenis_layanan']; ?></dd>

          <dt class="col-sm-4">Status</dt>
          <dd class="col-sm-8">: <?= $raa['status_bantuan']; ?></dd>

          <dt class="col-sm-4">Prioritas</dt>
          <dd class="col-sm-8">: <?= $raa['prioritas_bantuan']; ?></dd>

          <dt class="col-sm-4">Keterangan</dt>
          <dd class="col-sm-8">: <?= $raa['keterangan_bantuan']; ?></dd>
        </dl>
      </div>
      <!-- kolom kanan chat tetap sama -->
      <div class="col-sm">
        <?php
              if (isset($_POST['kirim_chat'])) {
                $isi_chat = mysqli_real_escape_string($koneksi, $_POST['message']);
                $id_bantuan = $_POST['id_bantuan'];
                $id_user = $_SESSION['id_user'];
                $jenis_chat = 'User';
                $tanggal_chat = date("d/m/Y - H:i:s");

                mysqli_query($koneksi, "INSERT INTO tchat (id_bantuan, id_user, jenis_chat, tanggal_chat, isi_chat) 
                                  VALUES ('$id_bantuan', '$id_user', '$jenis_chat', '$tanggal_chat', '$isi_chat')");
                exit;
              }
        ?>
        <div class="card-body" style="height: 300px; overflow-y: auto;">
          <div id="chatContainer">
            <?php
              $queryChat = mysqli_query($koneksi, "SELECT * FROM tchat WHERE id_bantuan = '$raa[id_bantuan]' ORDER BY id_chat ASC");
              while ($chat = mysqli_fetch_array($queryChat)) {
                $chatClass = $chat['jenis_chat'] == 'User' ? ' right' : '';
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
    <script>
      $('#formChat').on('submit', function(e) {
        e.preventDefault();
        var message = $('#message').val();
        var id_bantuan = $('#id_bantuan').val();
        if (message.trim() === '') return;

        $.ajax({
          type: 'POST',
          url: '',
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
            }
  ?>
  </div>
  </div>
  </div>
  </section>
  </div>

  <?php
  include_once "inc/footer.php";
  ?>