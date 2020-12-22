    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin')?>">Admin</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dAdministrator')?>"><?= $parent ;?></a></li>
              <li class="breadcrumb-item"><?= $page ;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <?php if(validation_errors()) : ?>
          <!-- Row Perhatian -->
          <div class="row">
            <div class="col-12">
              <div class="alert callout bg-danger" role="alert">
                <h5><i class="fas fa-info"></i> Perhatian:</h5>
                <?= validation_errors(); ?>
              </div>
            </div>
            <!--/. Col -->
          </div>
        <?php endif ;?>
        <?php if($this->session->flashdata('message') == TRUE) : ?>
          <!-- Row Perhatian -->
          <div class="row">
            <div class="col-12">
              <div class="alert callout bg-danger" role="alert">
                <h5><i class="fas fa-info"></i> Perhatian:</h5>
                <?= $this->session->flashdata('message'); ?>
              </div>
            </div>
            <!--/. Col -->
          </div>
        <?php endif ;?>             
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
          <a href="<?php echo base_url('admin/dAdministrator');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" action="<?php echo base_url('admin/dAdministratorAdd')?>" method="post">
            <div class="card-body">
              <?php echo $this->session->flashdata('message'); ?>
              <div class="form-group row ml-3 mr-3">
                <label for="addUserSettings" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@</span>
                    </div>
                    <input type="text" name="username" class="form-control" id="addUserSettings" placeholder="Username" value="<?php echo set_value('username');?>">
                  </div>
                  <?php echo form_error('username', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="addPasswordSett" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control" id="addPasswordSett" placeholder="Password">
                  <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="addPasswordSettings" class="col-sm-2 col-form-label">Ulangi Password</label>
                <div class="col-sm-10">
                  <input type="password" name="repeatpassword" class="form-control" id="addPasswordSettings" placeholder="Ulangi Password" >
                  <?php echo form_error('repeatpassword', '<small class="text-danger pl-3">', '</small>');?> 
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer justify-content-between">
              <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i>&ensp;Simpan</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
