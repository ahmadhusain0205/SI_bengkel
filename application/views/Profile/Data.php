<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
      <?= $judul . ' ' . $user['nama']; ?>
      <button type="button" class="btn btn-warning btn-sm float-right" data-toggle="modal" data-target="#ubah<?= $user['id']; ?>">
        <i class="fa-solid fa-user-pen"></i> Ubah profile
      </button>
    </h6>
  </div>
  <div class="card-body">
    <div class="responsive">
      <div class="row justify-content-center">
        <div class="col-lg-3 my-auto">
          <img src="<?= base_url('assets/img/user/') . $user['gambar']; ?>" class="rounded img-thumbnail">
        </div>
        <div class="col">
          <div class="row">
            <div class="col-lg-3">Username</div>
            <div class="col-lg-1">:</div>
            <div class="col"><?= $user['username']; ?></div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-3">Nama</div>
            <div class="col-lg-1">:</div>
            <div class="col"><?= $user['nama']; ?></div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-3">Status</div>
            <div class="col-lg-1">:</div>
            <div class="col">
              <?php
              if ($user['id_role'] == 1) {
                echo 'Administrator';
              } else if ($user['id_role'] == 2) {
                echo 'Owner';
              } else if ($user['id_role'] == 3) {
                echo 'Kasir';
              } else {
                echo 'Mekanik';
              }
              ?>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-3">Nomor telpon</div>
            <div class="col-lg-1">:</div>
            <div class="col"><?= $user['telepon']; ?></div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-3">alamat</div>
            <div class="col-lg-1">:</div>
            <div class="col"><?= $user['alamat']; ?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal ubah profile -->
<?= form_open_multipart('Profile/ubah') ?>
<div class="modal fade" id="ubah<?= $user['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah profile <?= $user['username']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-sm">
              <div class="row">
                <div class="col-sm-2">
                  <img src="<?= base_url('assets/img/user/') . $user['gambar']; ?>" class="img-thumbnail">
                </div>
                <div class="col-sm-10 my-auto">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                    <label class="custom-file-label" for="gambar">Cari foto...</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <input type="hidden" name="username" class="form-control" value="<?= $user['username']; ?>">
          <input type="text" name="nama" class="form-control" placeholder="Masukan nama..." value="<?= $user['nama']; ?>">
        </div>
        <div class="form-group">
          <input type="number" name="telepon" class="form-control" placeholder="Masukan telepon..." value="<?= $user['telepon']; ?>">
        </div>
        <div class="form-group">
          <textarea name="alamat" class="form-control" placeholder="Masukan alamt..."><?= $user['alamat']; ?></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Batal</button>
        <button type="submit" class="btn btn-warning btn-sm"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
      </div>
    </div>
  </div>
</div>
<?= form_close(); ?>