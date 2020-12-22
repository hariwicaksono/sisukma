  <!-- Logout Modal-->
  <div class="modal fade" id="logOutModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header card-outline card-danger">
          <h5 class="modal-title">Logout?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda akan keluar dari sistem.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Tutup</button>
          <a class="btn btn-sm btn-danger" href="<?= base_url('auth/logout') ;?>"><i class="fas fa-sign-out-alt"></i>&ensp;Logout</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>