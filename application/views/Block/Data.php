<div class="text-center">
  <div class="error mx-auto" data-text="404">404</div>
  <p class="lead text-gray-800 mb-5">Page Not Found</p>
  <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
  <?php if ($this->session->userdata('id_role') == 2) { ?>
    <a href="<?= site_url('Admin'); ?>">&larr; Kembali</a>
  <?php } ?>
  <?php if ($this->session->userdata('id_role') == 3) { ?>
    <a href="<?= site_url('Kasir'); ?>">&larr; Kembali</a>
  <?php } ?>
  <?php if ($this->session->userdata('id_role') == 4) { ?>
    <a href="<?= site_url('Mekanik'); ?>">&larr; Kembali</a>
  <?php } ?>
</div>