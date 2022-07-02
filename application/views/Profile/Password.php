<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-header py-3"><?= $judul . ' ' . $user['nama']; ?></div>
      <form action="<?= site_url('Profile/password'); ?>" method="POST">
        <div class="card-body">
          <div class="form-group">
            <label for="password">Password Baru</label>
            <input type="hidden" name="username" value="<?= $user['username']; ?>" class="form-control">
            <input type="password" name="password" placeholder="Masukan password baru..." class="form-control">
            <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="konfirmasi">Konfirmasi Password Baru</label>
            <input type="password" name="konfirmasi" placeholder="Konfirmasi password baru..." class="form-control">
            <?php echo form_error('konfirmasi', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="float-right mb-4">
            <button type="submit" class="btn btn-warning btn-sm"><i class="fa-solid fa-circle-check"></i> Simpan perubahan password</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>