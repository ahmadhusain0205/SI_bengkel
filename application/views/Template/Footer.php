</div>
</div>
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; Your Website 2020</span>
    </div>
  </div>
</footer>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Pilih "Ya" jika anda yakin ingik keluar</div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Batal</button>
        <a class="btn btn-primary btn-sm" href="<?= site_url('Auth/logout'); ?>"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
      </div>
    </div>
  </div>
</div>
<script src="<?= base_url('assets'); ?>/js/jquery-3.5.1.js"></script>
<script src="<?= base_url('assets'); ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
  });
</script>
<script>
  $('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });
</script>
</body>

</html>