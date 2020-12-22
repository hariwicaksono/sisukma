    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?> Profil: <?php echo $oneadm->username;?></h1>
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
              <div class="alert callout callout-info bg-danger" role="alert">
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
              <div class="alert callout callout-info bg-danger" role="alert">
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
          <?php echo form_open_multipart('admin/dAdministratorEdit/'.$this->encrypt->encode($oneadm->id).'');?>
          <div class="card-body">

            <input type="hidden" name="zz" readonly value="<?php echo $oneadm->id;?>"  class="form-control">

            <div class="form-group row ml-3  mr-3">
              <label for="editdAdministratorUsername" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                  <input type="text" name="username" class="form-control" id="editdAdministratorUsername" placeholder="Username" value="<?php echo $oneadm->username;?>">
                </div>
                <?php echo form_error('username', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-3 mr-3">
              <label for="editdAdministratorPassword" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="editdAdministratorPassword" placeholder="Password">
                <input type="hidden" class="form-control" id="editdAdministratorPassword" placeholder="Password" value="<?= $oldpassword?>">
                <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-3 mr-3">
              <label for="editdAdministratorFullName" class="col-sm-2 col-form-label">Full Name</label>
              <div class="col-sm-10">
                <input type="text" name="fullname" class="form-control" id="editdAdministratorFullName" placeholder="Fullname" value="<?php echo $oneadm->fullname?>">
                <?php echo form_error('fullname', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-3 mr-3">
              <label for="editdAdministratorEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="text" name="email" class="form-control" id="editdAdministratorEmail" placeholder="Email" value="<?php echo $oneadm->email; ?>">
                </div>
                <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group row ml-3 mr-3">
              <div class="col-sm-2">
               <label for="editdAdministratorImage"  class="col-form-label">Picture</label>
             </div>
             <div class="col-sm-10">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?php echo base_url('assets/esurat/img/profile/').$oneadm->image;?>" id="editdAdministratorImage" class="img-thumbnail mb-2">
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input type="file" name="picture" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                  <?php echo form_error('picture', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
            </div>`
          </div>
          <div class="form-group row ml-3 mr-3">
            <label for="editdAdministratorPhone" class="col-sm-2 col-form-label">Phone</label>
            <div class="col-sm-10">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" name="phone" class="form-control" id="editdAdministratorPhone" placeholder="Number Phone" value="<?php echo $oneadm->phone; ?>">
              </div>
              <?php echo form_error('phone', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-3 mr-3">
            <label for="editdAdministratorAddress" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="address" id="editdAdministratorAddress" rows="3" placeholder="Addess"><?php echo $oneadm->address; ?></textarea>
              <?php echo form_error('address', '<small class="text-danger pl-3">', '</small>');?>
            </div>
          </div>
          <div class="form-group row ml-3 mr-3">
            <label for="editdAdministratorActive" class="col-sm-2 col-form-label">Active</label>
            <div class="col-sm-10">
              <div class="form-group clearfix">
                <div class="icheck-primary d-inline" id="editdAdministratorActive">
                  <?php if($oneadm->is_active == 1) : ?>
                    <input class="form-check-input" value="1" name="status" type="checkbox" value="" id="checkboxPrimaryStatus" checked>
                    <?php else : ?>
                      <input class="form-check-input" value="1" name="status" type="checkbox" value="" id="checkboxPrimaryStatus" >
                    <?php endif; ?>
                    <label for="checkboxPrimaryStatus">
                      Status
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i>&ensp;Simpan</button>
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
  </section>