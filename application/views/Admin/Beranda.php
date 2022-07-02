<div class="row ">
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Keuntungan Servis</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php foreach ($c_keuntungan_service as $ks) {
                echo 'Rp ' . number_format($ks->benefit);
              } ?>

            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-concierge-bell fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Keuntungan Hari Ini</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php foreach ($c_keuntungan_jual as $kj) {
                foreach ($c_keuntungan_service as $ks) {
                  $all = (int)$ks->benefit + (int)$kj->benefit;
                  echo 'Rp. ' . number_format($all);
                }
              } ?>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Item Terjual
            </div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                  <?php foreach ($qty_s as $kj) {
                    echo 'Rp. ' . number_format($kj->benefit);
                  } ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
// query
$service = $this->db->query('select id, mekanik as nama, sum(harga_servis) as qty from servis_selesai where tanggal_keluar between "' . date('Y-m-d', time() - (60 * 60 * 24 * 7)) . '" and "' . date('Y-m-d') . '" group by tanggal_keluar')->result();
$sparepart = $this->db->query('select id, nama_sparepart as nama, sum(sub_total) as qty from transaksi where tanggal  between "' . date('Y-m-d', time() - (60 * 60 * 24 * 7)) . '" and "' . date('Y-m-d') . '" group by tanggal order by id desc limit 4')->result();
// $service = $this->db->query('select id, nama_sparepart as nama, sum(qty_sparepart) as qty from transaksi group by nama_sparepart')->result();
foreach ($service as $m) {
  // mengambil nama menu
  $nama = $m->nama;
  $nama_sparepart = $nama;
  // mengambil qty
  $qty = $m->qty;
  $qty_sparepart = $qty;
}
?>
<div class="row mb-4">
  <div class="col-xl-8">
    <div class="card h-100 shadow mb-4">
      <div class="card-body">
        <h6 class="m-0 font-weight-bold text-primary">Keuntungan Servis Seminggu Terkahir</h6>
        <hr>
        <div class="chart-area">
          <canvas id="myLine"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <div class="card h-100 shadow mb-4">
      <div class="card-body">
        <h6 class="m-0 font-weight-bold text-primary">Keuntungan Jual Seminggu Terkahir</h6>
        <hr>
        <div class="chart-pie pt-4 pb-2">
          <canvas id="myPie"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var ctx = document.getElementById("myLine").getContext('2d');
  var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        <?php
        foreach ($service as $me) {
          echo json_encode($me->nama) . ',';
        }
        ?>
      ],
      datasets: [{
        label: "Servis",
        lineTension: 0.3,
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        pointRadius: 3,
        pointBackgroundColor: "rgba(78, 115, 223, 1)",
        pointBorderColor: "rgba(78, 115, 223, 1)",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        data: [
          <?php
          foreach ($service as $me) {
            echo json_encode($me->qty) . ',';
          }
          ?>
        ],
      }],
    }
  });


  // Pie Chart Example
  var ctx = document.getElementById("myPie");
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: [
        <?php
        foreach ($sparepart as $me) {
          echo json_encode($me->nama) . ',';
        }
        ?>
      ],
      datasets: [{
        data: [
          <?php
          foreach ($sparepart as $me) {
            echo json_encode($me->qty) . ',';
          }
          ?>
        ],
        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });
</script>