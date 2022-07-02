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
            <th>Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($kategori as $a) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $a->kategori; ?></td>
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
<form action="<?= site_url('Sparepart/tambah_kategori'); ?>" method="POST">
  <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah data kategori</h5>
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
                <label for="nama">Kategori (<span class="text-danger">*</span>)</label>
                <input type="text" name="kategori" class="form-control" placeholder="Masukan kategori..." required>
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
<?php foreach ($kategori as $a) : ?>
  <form action="<?= site_url('Sparepart/ubah_kategori'); ?>" method="POST">
    <div class="modal fade" id="ubah<?= $a->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah data kategori</h5>
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
                  <label for="nama">Kategori (<span class="text-danger">*</span>)</label>
                  <input type="hidden" name="id" value="<?= $a->id; ?>" class="form-control" placeholder="Masukan nama..." required>
                  <input type="text" name="kategori" value="<?= $a->kategori; ?>" class="form-control" placeholder="Masukan kategori..." required>
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
<?php foreach ($kategori as $a) : ?>
  <form action="<?= site_url('Sparepart/hapus_kategori'); ?>" method="POST">
    <div class="modal fade" id="hapus<?= $a->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus data kategori</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Yakin ingin menghapus data kategori dengan nama <b class="text-danger"><?= $a->kategori; ?>?</b>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Batal</button>
            <a href="<?= site_url('Sparepart/hapus_kategori/') . $a->id; ?>" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-circle-check"></i> Ya</a>
          </div>
        </div>
      </div>
    </div>
  </form>
<?php endforeach; ?>