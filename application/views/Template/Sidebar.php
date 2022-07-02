    <?php if ($this->uri->segment(1) == 'Transaksi') { ?>
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion hold-transition sidebar-mini 1 sidebar-toggled 1 toggled" id="accordionSidebar">
      <?php } else { ?>
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <?php } ?>
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('Admin') ?>">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-solid fa-toolbox"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Bengkel Dian Motor<sup></sup></div>
        </a>
        <hr class="sidebar-divider my-0">
        <?php if ($this->session->userdata('id_role') == 1 or $this->session->userdata('id_role') == 2) { ?>
          <?php if (($this->uri->segment(1) == 'Admin') && ($this->uri->segment(2) == '')) { ?>
            <li class="nav-item active">
            <?php } else { ?>
            <li class="nav-item">
            <?php } ?>
            <a class="nav-link" href="<?= site_url('Admin'); ?>">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Beranda</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
              Master
            </div>
            <?php if (($this->uri->segment(1) == 'Admin') && ($this->uri->segment(2) == 'admin' or $this->uri->segment(2) == 'owner' or $this->uri->segment(2) == 'kasir' or $this->uri->segment(2) == 'mekanik')) { ?>
              <li class="nav-item active">
              <?php } else { ?>
              <li class="nav-item">
              <?php } ?>
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user-cog"></i>
                <span>Management user</span>
              </a>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">User:</h6>
                  <a class="collapse-item" href="<?= site_url('Admin/admin') ?>">Admin</a>
                  <a class="collapse-item" href="<?= site_url('Admin/owner') ?>">Owner</a>
                  <a class="collapse-item" href="<?= site_url('Admin/kasir') ?>">Kasir</a>
                  <a class="collapse-item" href="<?= site_url('Admin/mekanik') ?>">Mekanik</a>
                </div>
              </div>
              </li>
              <hr class="sidebar-divider">
              <div class="sidebar-heading">
                Pengelola
              </div>
              <?php if (($this->uri->segment(1) == 'Sparepart') && ($this->uri->segment(2) == 'kategori' or $this->uri->segment(2) == '')) { ?>
                <li class="nav-item active">
                <?php } else { ?>
                <li class="nav-item">
                <?php } ?>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                  <i class="fa-solid fa-screwdriver-wrench"></i>
                  <span>Sparepart</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item" href="<?= site_url('Sparepart/kategori'); ?>">Kategori</a>
                    <a class="collapse-item" href="<?= site_url('Sparepart'); ?>">Produk</a>
                  </div>
                </div>
                </li>
                <?php if (($this->uri->segment(1) == 'Laporan') && ($this->uri->segment(2) == 'servis' or $this->uri->segment(2) == '')) { ?>
                  <li class="nav-item active">
                  <?php } else { ?>
                  <li class="nav-item">
                  <?php } ?>
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-chart-column"></i>
                    <span>Laporan</span>
                  </a>
                  <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                      <h6 class="collapse-header">Report:</h6>
                      <a class="collapse-item" href="<?= site_url('Laporan/servis'); ?>">Servis</a>
                      <a class="collapse-item" href="<?= site_url('Laporan'); ?>">Transaksi</a>
                    </div>
                  </div>
                  </li>
                <?php } ?>
                <?php if ($this->session->userdata('id_role') == 1 or $this->session->userdata('id_role') == 4) { ?>
                  <?php if ($this->uri->segment(1) == 'Servis') { ?>
                    <li class="nav-item active">
                    <?php } else { ?>
                    <li class="nav-item">
                    <?php } ?>
                    <a class="nav-link" href="<?= site_url('Servis'); ?>">
                      <i class="fa-solid fa-toolbox"></i>
                      <span>Servis</span></a>
                    </li>
                  <?php } ?>
                  <?php if ($this->session->userdata('id_role') == 1 or $this->session->userdata('id_role') == 3) { ?>
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">
                      Transaksi
                    </div>
                    <?php if ($this->uri->segment(1) == 'Transaksi') { ?>
                      <li class="nav-item active">
                      <?php } else { ?>
                      <li class="nav-item">
                      <?php } ?>
                      <a class="nav-link" href="<?= site_url('Transaksi'); ?>">
                        <i class="fa-solid fa-arrow-right-arrow-left"></i>
                        <span>Penjualan</span></a>
                      </li>
                    <?php } ?>
                    <hr class="sidebar-divider d-none d-md-block">
                    <div class="text-center d-none d-md-inline">
                      <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>
        </ul>