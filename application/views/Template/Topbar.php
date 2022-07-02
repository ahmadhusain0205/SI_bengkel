<div id="content-wrapper" class="d-flex flex-column">
  <div id="content">
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>
      <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
              <?php if ($this->uri->segment(1) == 'Profile') { ?>
                <b class="text-primary"><?= $user['nama']; ?></b>
              <?php } else { ?>
                <b><?= $user['nama']; ?></b>
              <?php } ?>
            </span>
            <img class="img-profile rounded-circle" src="<?= base_url('assets/img/user/') . $user['gambar']; ?>">
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?= site_url('Profile'); ?>">
              <i class="fa-solid fa-id-badge fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="<?= site_url('Profile/password'); ?>">
              <i class="fa-solid fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
              Ubah Password
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <div class="container-fluid">