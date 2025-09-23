<?php
include_once "inc/header.php";
?>

<div class="content-wrapper">
  <br />

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php
                  $sqlCommand = "SELECT COUNT(*) FROM tpemesanan";
                  $query = mysqli_query($koneksi, $sqlCommand) or die(mysqli_error($koneksi));
                  $row = mysqli_fetch_row($query);
                  echo $row[0];
                  mysqli_free_result($query);
                  ?></h3>

              <p>Pemesanan</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>

          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php
                  $sqlCommand = "SELECT COUNT(*) FROM tlayanan";
                  $query = mysqli_query($koneksi, $sqlCommand) or die(mysqli_error($koneksi));
                  $row = mysqli_fetch_row($query);
                  echo $row[0];
                  mysqli_free_result($query);
                  ?></h3>

              <p>Layanan</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>

          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php
                  $sqlCommand = "SELECT COUNT(*) FROM tuser";
                  $query = mysqli_query($koneksi, $sqlCommand) or die(mysqli_error($koneksi));
                  $row = mysqli_fetch_row($query);
                  echo $row[0];
                  mysqli_free_result($query);
                  ?></h3>

              <p>User</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>

          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php
                  $sqlCommand = "SELECT COUNT(*) FROM tbank";
                  $query = mysqli_query($koneksi, $sqlCommand) or die(mysqli_error($koneksi));
                  $row = mysqli_fetch_row($query);
                  echo $row[0];
                  mysqli_free_result($query);
                  ?></h3>

              <p>Bank</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>

          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <?php
            $data = [
              'Semua' => [],
              'Menunggu Pembayaran' => [],
              'Proses' => [],
              'Selesai' => [],
              'Gagal' => []
            ];

            // Ambil data Semua (tanpa filter status)
            $querySemua = mysqli_query($koneksi, "SELECT tanggal_pemesanan, COUNT(*) as total FROM tpemesanan GROUP BY tanggal_pemesanan");
            while ($row = mysqli_fetch_assoc($querySemua)) {
              $data['Semua'][] = $row;
            }

            // Ambil data berdasarkan status
            $statusList = ['Menunggu Pembayaran', 'Proses', 'Selesai', 'Gagal'];
            foreach ($statusList as $status) {
              $query = mysqli_query($koneksi, "SELECT tanggal_pemesanan, COUNT(*) as total FROM tpemesanan WHERE status_pemesanan='$status' GROUP BY tanggal_pemesanan");
              while ($row = mysqli_fetch_assoc($query)) {
                $data[$status][] = $row;
              }
            }
            ?>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Pemesanan Layanan
              </h3>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item"><a class="nav-link active" href="#semua-chart" data-toggle="tab">Semua</a></li>
                  <li class="nav-item"><a class="nav-link" href="#pembayaran-chart" data-toggle="tab">Menunggu Pembayaran</a></li>
                  <li class="nav-item"><a class="nav-link" href="#proses-chart" data-toggle="tab">Proses</a></li>
                  <li class="nav-item"><a class="nav-link" href="#selesai-chart" data-toggle="tab">Selesai</a></li>
                  <li class="nav-item"><a class="nav-link" href="#gagal-chart" data-toggle="tab">Gagal</a></li>
                </ul>
              </div>
            </div>

            <div class="card-body">
              <div class="tab-content p-0">
                <div class="chart tab-pane active" id="semua-chart" style="position: relative; height: 300px;">
                  <canvas id="chartSemua"></canvas>
                </div>
                <div class="chart tab-pane" id="pembayaran-chart" style="position: relative; height: 300px;">
                  <canvas id="chartPembayaran"></canvas>
                </div>
                <div class="chart tab-pane" id="proses-chart" style="position: relative; height: 300px;">
                  <canvas id="chartProses"></canvas>
                </div>
                <div class="chart tab-pane" id="selesai-chart" style="position: relative; height: 300px;">
                  <canvas id="chartSelesai"></canvas>
                </div>
                <div class="chart tab-pane" id="gagal-chart" style="position: relative; height: 300px;">
                  <canvas id="chartGagal"></canvas>
                </div>
              </div>
            </div>
          </div>
      </div>

      <!-- Script Chart.js -->
      <script>
        const chartData = {
          semua: {
            labels: <?= json_encode(array_column($data['Semua'], 'tanggal_pemesanan')) ?>,
            data: <?= json_encode(array_column($data['Semua'], 'total')) ?>
          },
          pembayaran: {
            labels: <?= json_encode(array_column($data['Menunggu Pembayaran'], 'tanggal_pemesanan')) ?>,
            data: <?= json_encode(array_column($data['Menunggu Pembayaran'], 'total')) ?>
          },
          proses: {
            labels: <?= json_encode(array_column($data['Proses'], 'tanggal_pemesanan')) ?>,
            data: <?= json_encode(array_column($data['Proses'], 'total')) ?>
          },
          selesai: {
            labels: <?= json_encode(array_column($data['Selesai'], 'tanggal_pemesanan')) ?>,
            data: <?= json_encode(array_column($data['Selesai'], 'total')) ?>
          },
          gagal: {
            labels: <?= json_encode(array_column($data['Gagal'], 'tanggal_pemesanan')) ?>,
            data: <?= json_encode(array_column($data['Gagal'], 'total')) ?>
          }
        };

        function renderChart(canvasId, label, data, color = 'rgba(60,141,188,0.9)') {
          new Chart(document.getElementById(canvasId), {
            type: 'bar',
            data: {
              labels: data.labels,
              datasets: [{
                label: label,
                data: data.data,
                backgroundColor: color,
                borderColor: color,
                borderWidth: 1
              }]
            },
            options: {
              responsive: true,
              plugins: {
                legend: {
                  display: false
                },
                tooltip: {
                  enabled: true
                }
              },
              scales: {
                y: {
                  beginAtZero: true,
                  ticks: {
                    precision: 0
                  }
                }
              }
            }
          });
        }

        renderChart('chartSemua', 'Semua Pemesanan', chartData.semua, 'rgba(60,141,188,0.9)');
        renderChart('chartPembayaran', 'Menunggu Pembayaran', chartData.pembayaran, 'rgba(255,193,7,0.9)');
        renderChart('chartProses', 'Proses', chartData.proses, 'rgba(0,123,255,0.9)');
        renderChart('chartSelesai', 'Selesai', chartData.selesai, 'rgba(40,167,69,0.9)');
        renderChart('chartGagal', 'Gagal', chartData.gagal, 'rgba(220,53,69,0.9)');
      </script>
    </div>
    <!-- /.card -->


  </section>
  <!-- /.Left col -->

</div>
<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<?php
include_once "inc/footer.php";
?>