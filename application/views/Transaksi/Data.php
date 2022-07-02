<form action="<?= site_url('Transaksi/add') ?>" method="POST">
  <div class="row">
    <div class="col justify-content-center">
      <div class="card shadow mb-4 bg-primary">
        <div class="card-body">
          <h6 class="m-0 font-weight-bold text-white">
            Data Kostumer
            <!-- <a href="<?= site_url('Transaksi/penjualan'); ?>" type="button" class="btn btn-light text-primary btn-sm float-right">
            <i class="fa-solid fa-forward"></i> Lewati
          </a> -->
            <div class="float-right"><?= $invoice; ?></div>
          </h6>
        </div>
      </div>
    </div>
  </div>
  <div class="row mb-4">
    <div class="col-xl-8">
      <div class="card shadow h-100 mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="form-group row">
                <label for="kostumer" class="col-sm-4 col-form-label">Nama</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="kostumer" required>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group row">
                <label for="id_user" class="col-sm-4 col-form-label">Mekanik (<b class="text-danger">opt</b>)</label>
                <div class="col-sm-8">
                  <select name="mekanik" class="form-control">
                    <option value="">-- Pilih Mekanik --</option>
                    <?php foreach ($mekanik as $m) : ?>
                      <option value="<?= $m->nama; ?>"><?= $m->nama; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group row">
                <label for="motor" class="col-sm-4 col-form-label">Motor</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="motor">
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group row">
                <label for="no_plat" class="col-sm-4 col-form-label">No. Plat</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="no_plat">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card shadow h-100 mb-4">
        <div class="card-body">
          <div class="h6">Jasa Servis (<b class="text-danger">opt</b>)</div>
          <hr>
          <div class="form-group row">
            <label for="harga_servis" class="col-sm-4 col-form-label">Rp.</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" name="harga_servis">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col mb-4">
      <div class="justify-content-center shadow">
        <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fa-regular fa-circle-check"></i> Selanjutnya</button>
      </div>
    </div>
  </div>
</form>