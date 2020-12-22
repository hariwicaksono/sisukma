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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sPermintaanSurat')?>"><?= $page ;?></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <?php if(validation_errors()) : ?>
          <!-- Row Perhatian -->
          <div class="row">
            <div class="col-12">
              <div class="alert callout callout-danger mt-2" role="alert">
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
              <div class="alert callout callout-danger mt-2" role="alert">
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
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
      <a href="<?php echo base_url('admin');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
      </div>
      <div class="card-body table-responsive">
        <div>

          <table id="pmr_data" class="table table-bordered table-striped display nowrap" style="width:100%">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kd Surat</th>
                <th scope="col">No Surat</th>
                <th scope="col">Nama Surat</th>
                <th scope="col">Permintaan Oleh</th>
                <th scope="col">Permintaan Tgl</th>
                <th scope="col">Status Surat</th>
                <th scope="col" class="text-center">Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </div>
  <!-- /.container-fluid -->
</section>
    <!-- /.content -->