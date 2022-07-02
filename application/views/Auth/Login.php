<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-4">

    <div class="card o-hidden border-0 shadow-lg" style="margin-top: 150px;">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-4">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4"><?= $judul; ?></h1>
              </div>
              <form action="<?= site_url('Auth'); ?>" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="Masukan Username...">
                  <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Masukan Sandi...">
                  <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                  Masuk
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?= site_url('Auth/register'); ?>">Buat akun baru!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>