    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa')?>">Mahasiswa</a></li>
              <li class="breadcrumb-item active"><?= $page ;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <?php if(validation_errors()) : ?>
          <!-- Row Perhatian -->
          <div class="row">
            <div class="col-12">
              <div class="alert callout callout-danger mt-2" role="alert">
                <h5><i class="fas fa-info"></i> Perhatian:</h5>
                <?php echo validation_errors(); ?>
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
                <?php echo $this->session->flashdata('message'); ?>
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
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
          <a href="<?php echo base_url('mahasiswa');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
          </div>
          <div class="card-body table-responsive">

            <div>
              <table id="example" class="table table-bordered table-striped nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode Surat</th>
                    <th scope="col">Nama Surat</th>
                    <th scope="col" class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                 <?php $i=0; foreach ($surat as $sur) :  $i++;?>
                 <tr>
                  <th scope="row"><?= $i ;?></th>
                  <td><?= $sur->kd_surat; ?></td>
                  <td><?= $sur->nm_surat; ?></td>
                  <td class="text-center">
                    <a class="btn btn-primary btn-sm" type="button" href="<?= base_url('pengajuan/pengajuanDetail/'.$this->encrypt->encode($sur->kd_surat).'/'.$this->encrypt->encode($sur->id_surat).'/'.$this->encrypt->encode('pengajuan'));?>">Pilih Surat</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
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