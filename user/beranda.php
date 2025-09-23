<?php
include_once "inc/header.php";
?>

<div class="content-wrapper">
  <br/>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-6 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>
              <?php
                $sqlCommand = "SELECT COUNT(*) FROM tpemesanan WHERE id_user = '$sesi[id_user]'";
                $query = mysqli_query($koneksi, $sqlCommand) or die(mysqli_error($koneksi));
                $row = mysqli_fetch_row($query);
                echo $row[0];
                mysqli_free_result($query);
              ?>
              </h3>
              <p>Pemesanan</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        
        <!-- ./col -->
        <div class="col-lg-6 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>
              <?php
                $sqlCommand = "SELECT COUNT(*) FROM tbantuan WHERE id_user = '$sesi[id_user]'";
                $query = mysqli_query($koneksi, $sqlCommand) or die(mysqli_error($koneksi));
                $row = mysqli_fetch_row($query);
                echo $row[0];
                mysqli_free_result($query);
              ?>
              </h3>
              <p>Tiket Bantuan</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <!-- Chart Pemesanan & Layanan -->
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-chart-bar mr-1"></i>
                Statistik Pemesanan & Layanan
              </h3>
            </div>
            <div class="card-body">
              <div class="row">
                <!-- Chart Pemesanan per Bulan -->
                <div class="col-md-6">
                  <div style="height:200px;">
                    <canvas id="pemesananChart"></canvas>
                  </div>
                </div>

                <!-- Chart Layanan (Doughnut) -->
                <div class="col-md-6 d-flex justify-content-center">
                  <div style="width:240px; height:240px;">
                    <canvas id="layananChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<?php
// --- Data untuk chart pemesanan per bulan ---
$data_bulan = [];
$data_jumlah = [];

for ($i = 1; $i <= 12; $i++) {
    $sql = "SELECT COUNT(*) as total 
            FROM tpemesanan 
            WHERE id_user = '$sesi[id_user]' 
              AND MONTH(tanggal_pemesanan) = $i 
              AND YEAR(tanggal_pemesanan) = YEAR(CURDATE())";
    $q = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
    $r = mysqli_fetch_assoc($q);

    $data_bulan[] = date("M", mktime(0,0,0,$i,10));
    $data_jumlah[] = $r['total'];
}

// --- Data untuk chart layanan ---
$layanan_labels = [];
$layanan_data = [];
$sqlLayanan = "SELECT l.nama_layanan, COUNT(p.id_pemesanan) as total 
               FROM tpemesanan p
               JOIN tlayanan l ON p.id_layanan = l.id_layanan
               WHERE p.id_user = '$sesi[id_user]'
               GROUP BY l.nama_layanan";
$qLayanan = mysqli_query($koneksi, $sqlLayanan) or die(mysqli_error($koneksi));
while ($row = mysqli_fetch_assoc($qLayanan)) {
    $layanan_labels[] = $row['nama_layanan'];
    $layanan_data[] = $row['total'];
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Chart Pemesanan per Bulan
  new Chart(document.getElementById('pemesananChart'), {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($data_bulan); ?>,
      datasets: [{
        label: 'Jumlah Pemesanan',
        data: <?php echo json_encode($data_jumlah); ?>,
        backgroundColor: '#17a2b8'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } }
    }
  });

  // Chart Layanan (Doughnut)
  new Chart(document.getElementById('layananChart'), {
    type: 'doughnut',
    data: {
      labels: <?php echo json_encode($layanan_labels); ?>,
      datasets: [{
        data: <?php echo json_encode($layanan_data); ?>,
        backgroundColor: ['#007bff','#17a2b8','#ffc107','#28a745','#dc3545']
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: true,
          position: 'bottom',
          labels: {
            boxWidth: 20,
            padding: 15
          }
        }
      }
    }
  });
</script>

<?php
include_once "inc/footer.php";
?> 
