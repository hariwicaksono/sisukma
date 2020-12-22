
<!-- Left navbar links -->
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
  </li>
  <li class="nav-item d-none d-sm-inline-block">
   
  </li>
</ul>


<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">

  <li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
      <img src="<?= base_url('assets/img/profile/').$user->image.''; ?>" class="user-image img-circle elevation-2" alt="User Image">
      <span class="d-none d-md-inline"><?= $user->username; ?></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <!-- User image -->
      <li class="user-header">
        <img src="<?= base_url('assets/img/profile/').$user->image.''; ?>" class="img-circle elevation-2" alt="User Image">

        <p>
          <?= $user->username; ?>
          <small>Member sejak <?php echo date('F d Y', $user->date_created); ?></small>
        </p>
      </li>
      <!-- Menu Footer-->
      <li class="user-footer">
        <?php $profile= $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();?>
        <a href="<?= base_url('admin/dAdministratorDetail/'.$this->encrypt->encode($profile->id).'');?>" class="btn btn-primary btn-flat btn-sm"><i class="fas fa-user"></i>&ensp;Profil Saya</a>
        <a href="#" class="btn btn-danger btn-flat float-right btn-sm" data-toggle="modal" data-target="#logOutModal" data-backdrop="static" data-keyboard="true"><i class="fas fa-sign-out-alt"></i>&ensp;Logout</a>
      </li>
    </ul>
  </li>
</ul>