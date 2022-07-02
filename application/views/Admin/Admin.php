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
            <th>Profile</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Nomor Telpon</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($admin as $a) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td>
                <div class="row justify-content-center">
                  <img src="<?= base_url('assets/img/user/') . $a->gambar; ?>" class="rounded" style="width: 50px; border-radius:50%;">
                </div>
              </td>
              <td><?= $a->username; ?></td>
              <td><?= $a->nama; ?></td>
              <td><?= $a->alamat; ?></td>
              <td>
                <a class="float-right text-decoration-none text-dark"><?= $a->telepon; ?></a>
              </td>
              <td class="text-center">
                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $a->id; ?>">
                  <i class="fa-solid fa-pen-to-square"></i> Ubah
                </button>
                <?php if ($user['id'] != $a->id) { ?>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $a->id; ?>">
                    <i class="fa-solid fa-circle-minus"></i> Hapus
                  </button>
                <?php } else { ?>
                  <button type="button" class="btn btn-danger btn-sm" disabled>
                    <i class="fa-solid fa-circle-minus"></i> Hapus
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

<!-- modal tambah -->
<form action="<?= site_url('Admin/tambah_admin'); ?>" method="POST">
  <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah data admin</h5>
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
                <label for="username">Username (<span class="text-danger">*</span>)</label>
                <input type="text" name="username" class="form-control" placeholder="Masukan username..." required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="password">Password (<span class="text-danger">*</span>)</label>
                <input type="password" name="password" class="form-control" placeholder="Masukan password..." required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="nama">Nama (<span class="text-danger">*</span>)</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan nama..." required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="telepon">Telepon (<span class="text-danger">*</span>)</label>
                <input type="number" name="telepon" class="form-control" placeholder="Masukan telepon..." required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="alamat">Alamat (<span class="text-danger">*</span>)</label>
              <textarea name="alamat" class="form-control" placeholder="Masukan alamat..." required></textarea>
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
<?php foreach ($admin as $a) : ?>
  <form action="<?= site_url('Admin/ubah_admin'); ?>" method="POST">
    <div class="modal fade" id="ubah<?= $a->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ubah data admin</h5>
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
                  <label for="username">Username (<span class="text-danger">*</span>)</label>
                  <input type="text" name="username" class="form-control" placeholder="Masukan username..." value="<?= $a->username; ?>" readonly required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="nama">Nama (<span class="text-danger">*</span>)</label>
                  <input type="text" name="nama" class="form-control" placeholder="Masukan nama..." value="<?= $a->nama; ?>" required>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="telepon">Telepon (<span class="text-danger">*</span>)</label>
                  <input type="number" name="telepon" class="form-control" placeholder="Masukan telepon..." value="<?= $a->telepon; ?>" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label for="alamat">Alamat (<span class="text-danger">*</span>)</label>
                <textarea name="alamat" class="form-control" placeholder="Masukan alamat..." required><?= $a->alamat; ?></textarea>
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
<?php foreach ($admin as $a) : ?>
  <form action="<?= site_url('Admin/hapus_admin'); ?>" method="POST">
    <div class="modal fade" id="hapus<?= $a->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus data admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Yakin ingin menghapus data admin dengan nama <b class="text-danger"><?= $a->nama; ?>?</b>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Batal</button>
            <a href="<?= site_url('Admin/hapus_admin/') . $a->id; ?>" type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-circle-check"></i> Ya</a>
          </div>
        </div>
      </div>
    </div>
  </form>
<?php endforeach; ?>