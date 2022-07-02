<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $judul; ?></title>
  <link href="<?= base_url('assets'); ?>/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url('assets'); ?>/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/jquery.dataTables.min.css" type="text/css">
  <!-- jquery -->
  <script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
  <!-- chart js -->
  <script type="text/javascript" src="<?= base_url('assets'); ?>/js/Chart.js"></script>
</head>

<body>
  <div class="mt-5 text-center h2"><u>Laporan</u></div>
  <div class="text-center mr-3">Tanggal: <?= date('D, d-M-Y') ?></div>
  <hr>
  <div class="row p-5">
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead>
          <tr class="text-center">
            <th width="1%">#</th>
            <th>Tanggal</th>
            <th>Invoice</th>
            <th>Kostumer</th>
            <th>Motor</th>
            <th>Nomor Plat</th>
            <th>Mekanik</th>
            <th>Servis</th>
            <th>Sub Total</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($pembukuan as $p) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $p->tanggal; ?></td>
              <td><?= $p->invoice; ?></td>
              <td><?= $p->kostumer; ?></td>
              <td><?= $p->motor; ?></td>
              <td><?= $p->no_plat; ?></td>
              <td><?= $p->mekanik; ?></td>
              <td>Rp.
                <a class="float-right text-decoration-none text-secondary"><?= number_format($p->harga_servis); ?></a>
              </td>
              <td>Rp.
                <a class="float-right text-decoration-none text-secondary"><?= number_format($p->total); ?></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="8" class="text-center">Total</th>
            <th>Rp.
              <?php
              $totalz = 0;
              $total = $this->db->query('select total as tl from pembukuan group by invoice')->result();
              foreach ($total as $t) {
                $totalz += $t->tl;
              }
              ?>
              <a class="float-right text-decoration-none text-danger"><?= number_format($totalz); ?></a>
            </th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <script src="<?= base_url('assets'); ?>/js/jquery-3.5.1.js"></script>
  <script src="<?= base_url('assets'); ?>/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#table').DataTable();
    });
  </script>
  <!-- sweetalert -->
  <script src="<?= base_url('assets'); ?>/sweetalert/dist/sweetalert2.all.min.js"></script>

  <script src="<?= base_url('assets'); ?>/js/myscript.js"></script>
</body>

</html>