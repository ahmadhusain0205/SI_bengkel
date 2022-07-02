<form action="<?= site_url('Laporan/cari') ?>" method="POST">
  <div class="row mb-4">
    <div class="col">
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="dari">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="sampai">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col justify-content-center">
              <button type="submit" class="btn float-right btn-primary btn-sm"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<div class="row mb-4">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="justify-content-center">
          <a href="<?= site_url('Laporan/cetak'); ?>" type="button" class="btn btn-success btn-sm float-right" target="_BLANK"><i class="fa-solid fa-print"></i> Cetak</a>
          <a href="<?= site_url('Laporan/hapus'); ?>" type="button" class="btn btn-danger btn-sm float-right" style="margin-right: 10px;"><i class="fa-solid fa-repeat"></i> Hapus Semua</a>
        </div>
        <hr class="mt-5">
        <div class="table-responsive">
          <table class="table table-striped table-bordered" id="table">
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
    </div>
  </div>
</div>

<!-- modal detail -->
<?php
foreach ($pembukuan as $a) :
  $kondisi = $this->db->query('select * from pembukuan where id = ' . $a->id)->row_array();
?>
  <div class="modal fade" id="detail<?= $kondisi['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Kostumer <b class="text-danger"><?= $kondisi['kostumer']; ?></b> dengan invoice <b class="text-danger"><?= $kondisi['invoice']; ?></b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered" id="table">
              <thead>
                <tr class="text-center">
                  <th>Harga Servis</th>
                  <th>Harga Sparepart</th>
                  <th>Harga Jual</th>
                  <th>Harga Beli</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Rp. <a class="text-secondary text-decoration-none float-right"><?= number_format($kondisi['harga_servis']); ?></a></td>
                  <td>Rp. <a class="text-secondary text-decoration-none float-right"><?= number_format($kondisi['sub_total']); ?></a></td>
                  <td>Rp. <a class="text-secondary text-decoration-none float-right"><?= number_format($kondisi['harga_jual_sparepart']); ?></a></td>
                  <td>Rp. <a class="text-secondary text-decoration-none float-right"><?= number_format($kondisi['harga_beli_sparepart']); ?></a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>