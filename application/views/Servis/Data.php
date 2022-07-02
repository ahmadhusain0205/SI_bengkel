<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
      <?= $judul; ?>
    </h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped table-bordered" id="table">
        <thead>
          <tr class="text-center">
            <th width="1%">#</th>
            <th>Invoice</th>
            <th>Tanggal Masuk</th>
            <th>Nama Kostumer</th>
            <th>Motor</th>
            <th>Nomor Plat</th>
            <th>Nama Mekanik</th>
            <th>Status Servis</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($servis as $a) : ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $a->invoice; ?></td>
              <td><?= $a->tanggal_masuk; ?></td>
              <td><?= $a->kostumer; ?></td>
              <td><?= $a->motor; ?></td>
              <td><?= $a->no_plat; ?></td>
              <td><?= $a->mekanik; ?></td>
              <td class="text-center">
                <?php if ($a->keterangan != 1) { ?>
                  <a href="<?= site_url('Servis/selesai/') . $a->id; ?>" class="btn btn-sm btn-warning"><i class="fa-regular fa-hourglass"></i> Pending</a>
                <?php } ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>