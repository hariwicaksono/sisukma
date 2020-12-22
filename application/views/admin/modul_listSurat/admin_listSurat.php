    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="mb-2 text-dark"><?= $page ;?></h1>
            <a class="btn btn-outline-primary" href="<?= base_url('admin/sListSuratAdd')?>">
              <i class="fas fa-plus"></i> Tambah Surat
            </a>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sListSurat')?>">Admin</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sListSurat')?>"><?= $page ;?></a></li>
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
      <div class="container-fluid">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
          <a href="<?php echo base_url('admin');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
          </div>
          <div class="card-body table-responsive">
            <div>

              <table id="example" class="table table-bordered table-striped display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode Surat</th>
                    <th scope="col">Nama Surat</th>
                    <th scope="col">Akses Surat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach($surat as $sur) :  $i++;?>
                  <tr>
                    <td><?= $i ;?></td>
                    <td><?php echo $sur->kd_surat; ?></td>
                    <td><?php echo $sur->nm_surat; ?></td>
                    <?php if($sur->access == 1) {
                      echo '<td>Administrator Only</td>';
                    }elseif($sur->access == 2){
                      echo '<td>All</td>';
                    }else{
                      echo '<td>All</td>';
                    };?>
                    <td>
                      <a style="margin-right:10px" href="<?= base_url('admin/sListSuratDetail/'.$this->encrypt->encode($sur->id_surat).'')?>" title="Detail"><i class="fas fa-eye text-primary"></i></a>
                      <a style="margin-right:10px" href="<?= base_url('admin/sListSuratEdit/'.$this->encrypt->encode($sur->id_surat).'')?>" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                      <a href="" style="margin-right:10px" data-toggle="modal" data-target="#suratDeleteModal<?= $sur->id_surat;?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
                      <a style="margin-right:10px" href="<?= base_url('admin/sListSuratPrint/'.$this->encrypt->encode($sur->id_surat).'')?>" target="blank" title="Cetak"><i class="fas fa-print text-warning"></i></a>
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

    <!-- Barang Hapus Modal-->
    <?php $i=0; foreach($surat as $all) :  $i++;?>
    <div class="modal fade" id="suratDeleteModal<?php echo $all->id_surat;?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header card-outline card-danger">
            <h5 class="modal-title">Hapus <?= $page;?> "<?php echo $all->nm_surat;?>" </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Pilih "Hapus" dibawah untuk menghapus <?= $page;?> <b><?php echo $all->nm_surat;?></b>.</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Tutup</button>
            <a class="btn btn-danger btn-sm" href="<?= base_url('admin/sListSuratDelete/').$this->encrypt->encode($all->id_surat).'';?>"><i class="fas fa-trash"></i>&ensp;Hapus</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  <?php endforeach; ?>

</section>
