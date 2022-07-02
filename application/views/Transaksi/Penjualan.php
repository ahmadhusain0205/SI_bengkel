<div class="row mb-4">
  <div class="col-8">
    <div class="card shadow h-100">
      <div class="card-body">
        <form action="<?= site_url('Transaksi/add_penjualan'); ?>" method="POST">
          <div class="form-group row">
            <label for="kostumer" class="col-sm-4 col-form-label">Kostumer</label>
            <div class="col-sm-8">
              <?php $kostumer = $this->db->query('select kostumer from servis limit 1')->result(); ?>
              <?php foreach ($kostumer as $k) : ?>
                <input type="text" class="form-control" placeholder="<?= $k->kostumer ?>" readonly>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="qty" class="col-sm-4 col-form-label">Qty</label>
            <div class="col-sm-8">
              <input type="hidden" name="invoice" value="<?= $invoice; ?>">
              <input type="number" min="1" placeholder="1" name="qty" class="form-control">
            </div>
          </div>
          <div class="form-group row">
            <label for="sparepart" class="col-sm-4 col-form-label">Sparepart</label>
            <div class="col-sm-8">
              <div class="row">
                <div class="col-9">
                  <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
                <div class="form-group col-3">
                  <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#modal_sparepart">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col justify-content-center">
              <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fa-solid fa-cart-plus"></i> Tambah</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="card shadow mb-4 h-100">
      <div class="card-body">
        <div class="h6 font-weight-bold mb-5">Invoice <b class="text-primary"><?= $invoice; ?></b></div>
        <table>
          <tr>
            <td>
              <div class="h4">Servis</div>
            </td>
            <td>:</td>
            <td class="text-right">
              Rp.
              <?php
              $harga_servis = $this->db->query('select harga_servis from servis where invoice = "' . $invoice . '"')->row_array();
              if ($harga_servis['harga_servis'] == null or empty($harga_servis['harga_servis'])) {
                echo 0;
              } else {
                echo number_format($harga_servis['harga_servis']);
              }
              ?>
            </td>
          </tr>
          <tr>
            <td>
              <div class="h4">Sparepart</div>
            </td>
            <td width="1%">:</td>
            <td class="text-right">
              Rp.
              <?php
              $penjualanx = $this->db->query('select sum(sub_total) as sub_total, total from penjualan where invoice = "' . $invoice . '" limit 1')->row_array();
              if (empty($penjualan)) {
                echo 0;
              } else {
                echo number_format($penjualanx['sub_total']);
              }
              ?>
            </td>
          </tr>
          <tr>
            <td>
              <div class="h4 font-weight-bold">Total</div>
            </td>
            <td width="1%">:</td>
            <td class="text-right font-weight-bold">
              Rp.
              <?php
              // foreach ($penjualanx as $p) {
              if (empty($penjualan)) {
                echo number_format($harga_servis['harga_servis']);
              } else {
                echo number_format($penjualanx['total']);
              }
              // }
              ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="row mb-4">
  <div class="col-8">
    <div class="card shadow mb-4 h-100">
      <div class="card-body">
        <div class="table-resposive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr class="text-center">
                <th width=" 1%">#</th>
                <th>Sparepart</th>
                <th>Qty</th>
                <th>Harga Sparepart</th>
                <th width="25%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($penjualan as $p) : ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $p->nama_sparepart; ?></td>
                  <td>
                    <a class="text-decoration-none text-secondary float-right"><?= $p->qty_sparepart; ?></a>
                  </td>
                  <td>
                    Rp. <a class="text-dark text-decoration-none float-right"><?= number_format($p->sub_total); ?></a>
                  </td>
                  <td class="text-center">
                    <?php if ($p->kembalian == null) { ?>
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $p->id; ?>">
                        <i class="fa-solid fa-pen-to-square"></i> Ubah
                      </button>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $p->id; ?>">
                        <i class="fa-solid fa-circle-minus"></i> Hapus
                      </button>
                    <?php } else { ?>
                      <button type="button" class="btn btn-success btn-sm" disabled>
                        <i class="fa-solid fa-cash-register"></i> Selesai
                      </button>
                    <?php } ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="card shadow h-100 mb-4">
      <div class="card-body">
        <?php
        $y = $this->db->query('select pembayaran, kembalian from penjualan limit 1')->result();
        foreach ($y as $yy) :
          if ($yy->kembalian != null) {
        ?>
            <div class="form-group">
              <label for="kembalian">Kembalian <span>(Rp.)</span></label>
              <div class="h1">Rp. <a class="text-secondary text-decoration-none float-right"><?= number_format($p->kembalian); ?></a></div>
            </div>
            <div class="justify-content-center">
              <a href="<?= site_url('Transaksi/selesaikan/') . $p->invoice; ?>" type="button" class="btn btn-success btn-sm float-right"><i class="fa-solid fa-circle-chevron-right"></i> Selesaikan</a>
            </div>
          <?php } else { ?>
            <form action="<?= site_url('Transaksi/bayar'); ?>" method="POST">
              <div class="form-group">
                <label for="bayar">Bayar</label>
                <input type="hidden" name="invoice" value="<?= $invoice; ?>">
                <?php foreach ($penjualan as $p) : ?>
                  <input type="hidden" name="nama" value="<?= $p->nama_sparepart; ?>">
                <?php endforeach; ?>
                <input type="number" class="form-control" name="bayar" placeholder="Rp....">
              </div>
              <div class="justify-content-center">
                <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fa-solid fa-money-bill-1-wave"></i> Bayar</button>
              </div>
            </form>
        <?php }
        endforeach; ?>
      </div>
    </div>
  </div>
</div>

<!-- modal sparepart -->
<div class="modal fade" id="modal_sparepart">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">pilih barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
          <span arial-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-reponsive">
        <table class="table table-striped table-bordered" id="table1">
          <thead>
            <tr class="text-center">
              <th width="1%">#</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Harga Jual</th>
              <th>Stok</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            foreach ($sparepart as $i) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $i->nama; ?></td>
                <td><?= $i->kategori; ?></td>
                <td>Rp.
                  <a class="float-right text-decoration-none text-secondary"><?= number_format($i->harga_jual); ?></a>
                </td>
                <td><a class="float-right"><?= $i->stok; ?></a></td>
                <td class="text-center">
                  <button type="button" class="btn btn-success btn-sm" id="select_abc" data-id="<?= $i->id; ?>" data-nama="<?= $i->nama; ?>" data-stok="<?= $i->stok; ?>">
                    <i class="fas fa-check"></i> pilih
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- modal ubah -->
<?php foreach ($penjualan as $p) : ?>
  <form action="<?= site_url('Transaksi/ubah_data'); ?>" method="POST">
    <div class="modal fade" id="ubah<?= $p->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah data <?= $p->nama_sparepart; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="qty" class="col-sm-4 col-form-label">Qty</label>
              <div class="col-sm-8">
                <input type="hidden" name="nama" value="<?= $p->nama_sparepart; ?>">
                <input type="number" min="1" name="qty" class="form-control" value="<?= $p->qty_sparepart; ?>">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Batal</button>
            <button type="submit" class="btn btn-warning btn-sm"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </form>
<?php endforeach; ?>

<!-- modal hapus -->
<?php foreach ($penjualan as $p) : ?>
  <div class="modal fade" id="hapus<?= $p->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Yakin ingin menghapus data sparepart dengan nama <b class="text-danger"><?= $p->nama_sparepart; ?>?</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Batal</button>
          <a href="<?= site_url('Transaksi/hapus_data/') . $p->id; ?>" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-circle-check"></i> Ya</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', '#select_abc', function() {
      // var $id = $(this).data('id');
      var $nama = $(this).data('nama');
      // var $stok = $(this).data('stok');
      // $('#id').val($id);
      $('#nama').val($nama);
      // $('#stok').val($stok);
      $('#modal_sparepart').modal('hide');
    });
  });
</script>