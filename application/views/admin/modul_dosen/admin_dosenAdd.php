    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><small>Admin</small></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dDosen')?>"><small><?= $parent ;?></small></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dDosenAdd')?>"><small><?= $page ;?></small></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <?php if(validation_errors()) : ?>
          <!-- Row Perhatian -->
          <div class="row">
            <div class="col-12">
              <div class="alert callout callout-danger" role="alert">
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
              <div class="alert callout callout-danger" role="alert">
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
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title"><?php echo $page; ?>&ensp;</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" action="<?php echo base_url('admin/dDosenAdd')?>" method="post">
            <div class="card-body">
              <div class="form-group row ml-3 mr-3">
                <label for="addDosenNama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" name="nama" class="form-control" id="addDosenNama" placeholder="Nama" value="<?= set_value('nama');?>">
                  <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="addDosenNIP" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                  <input type="text" name="nip" class="form-control" id="addDosenNIP" placeholder="NIP" value="<?= set_value('nip')?>">
                  <?php echo form_error('nip', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="addDosenJabatan" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                  <input type="text" name="jabatan" class="form-control" id="addDosenJabatan" placeholder="Jabatan" value="<?= set_value('jabatan')?>">
                  <?php echo form_error('jabatan', '<small class="text-danger pl-3">', '</small>');?> 
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer justify-content-between">
              <a class="btn btn-secondary btn-sm" href="<?php echo base_url('admin/ddosen');?>">
                <i class="fas fa-arrow-left"></i>&ensp;Back
              </a>
              <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus"></i>&ensp;Add</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
      <!-- /.content -->