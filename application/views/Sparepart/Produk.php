<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
      <?= $judul; ?>
      <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#tambah">
        <i class="fa-solid fa-circle-plus"></i> Tambah data
      </button>
    </h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-bordered" id="table">
        <thead>
          <tr class="text-center">
            <th width="1%">#</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($produk as $a) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $a->nama; ?></td>
              <td><?= $a->kategori; ?></td>
              <td>Rp.
                <a class="float-right text-decoration-none text-dark"><?= number_format($a->harga_beli); ?></a>
              </td>
              <td>Rp.
                <a class="float-right text-decoration-none text-dark"><?= number_format($a->harga_jual); ?></a>
              </td>
              <td>
                <a class="float-right text-decoration-none text-dark"><?= $a->stok; ?></a>
              </td>
              <td class="text-center">
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $a->id; ?>">
                  <i class="fa-solid fa-pen-to-square"></i> Ubah
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $a->id; ?>">
                  <i class="fa-solid fa-circle-minus"></i> Hapus
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- modal tambah -->
<form action="<?= site_url('Sparepart/tambah_produk'); ?>" method="POST">
  <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah data produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="mb-4 text-center">
            <b class="text-sm">Tanda (<span class="text-danger">*</span>) berarti wajib diisi</b>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="nama">Nama (<span class="text-danger">*</span>)</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan nama..." required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="harga_beli">Harga Beli (<span class="text-danger">*</span>)</label>
                <input type="number" name="harga_beli" class="form-control" placeholder="Masukan harga beli..." required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="harga_jual">Harga Jual (<span class="text-danger">*</span>)</label>
                <input type="number" name="harga_jual" class="form-control" placeholder="Masukan harga jual..." required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="stok">Stok (<span class="text-danger">*</span>)</label>
                <input type="number" name="stok" class="form-control" placeholder="Masukan stok barang..." required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="kategori">Kategori (<span class="text-danger">*</span>)</label>
                <select name="id_kategori" class="form-control">
                  <option value="">-- Pilih kategori --</option>
                  <?php foreach ($kategori as $k) : ?>
                    <option value="<?= $k->id; ?>"><?= $k->kategori; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Batal</button>
          <button type="submit" class="btn btn-primary btn-sm"><i class="fa-solid fa-circle-plus"></i> Tambah</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- modal ubah -->
<?php foreach ($produk as $a) : ?>
  <form action="<?= site_url('Sparepart/ubah_produk'); ?>" method="POST">
    <div class="modal fade" id="ubah<?= $a->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah data produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="mb-4 text-center">
              <b class="text-sm">Tanda (<span class="text-danger">*</span>) berarti wajib diisi</b>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="nama">Nama (<span class="text-danger">*</span>)</label>
                  <input type="hidden" name="id" value="<?= $a->id; ?>" class="form-control" placeholder="Masukan nama..." required>
                  <input type="text" name="nama" value="<?= $a->nama; ?>" class="form-control" placeholder="Masukan nama..." required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="harga_beli">Harga Beli (<span class="text-danger">*</span>)</label>
                  <input type="number" name="harga_beli" class="form-control" value="<?= $a->harga_beli; ?>" placeholder="Masukan harga beli..." required>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="harga_jual">Harga Jual (<span class="text-danger">*</span>)</label>
                  <input type="number" name="harga_jual" value="<?= $a->harga_jual; ?>" class="form-control" placeholder="Masukan harga jual..." required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="stok">Stok (<span class="text-danger">*</span>)</label>
                  <input type="number" name="stok" class="form-control" value="<?= $a->stok; ?>" placeholder="Masukan stok barang..." required>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="kategori">Kategori (<span class="text-danger">*</span>)</label>
                  <select name="id_kategori" class="form-control">
                    <option value="<?= $a->id_kategori; ?>">Kategori saat ini <?= $a->kategori; ?></option>
                    <?php foreach ($kategori as $k) : ?>
                      <option value="<?= $k->id; ?>">Ubah ke kategori <?= $k->kategori; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
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
<?php foreach ($produk as $a) : ?>
  <form action="<?= site_url('Sparepart/hapus_produk'); ?>" method="POST">
    <div class="modal fade" id="hapus<?= $a->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus data produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Yakin ingin menghapus data produk dengan nama <b class="text-danger"><?= $a->nama; ?>?</b>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Batal</button>
            <a href="<?= site_url('Sparepart/hapus_produk/') . $a->id; ?>" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-circle-check"></i> Ya</a>
          </div>
        </div>
      </div>
    </div>
  </form>
<?php endforeach; ?>