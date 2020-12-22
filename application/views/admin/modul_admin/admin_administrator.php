    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="mb-2 text-dark"><?= $page ;?></h1>
            <a class="btn btn-outline-primary" href="<?= base_url('admin/dAdministratorAdd');?>">
              <i class="fas fa-plus"></i> Tambah Admin
            </a>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin')?>">Admin</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dAdministrator')?>"><?= $page ;?></a></li>
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
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach($adminis as $admin) :  $i++;?>
                  <tr>
                    <td><?= $i ;?></td>
                    <td><?php echo $admin->username; ?></td>
                    <?php if ($admin->is_active == '1'){
                      echo '<td>Aktif</td>';
                    }else{
                      echo '<td>Tidak Aktif</td>';
                    };
                    ?>
                    <td>
                      <a style="margin-right:10px" href="<?= base_url('admin/dAdministratorDetail/').$this->encrypt->encode($admin->id).''?>" title="Detail"><i class="fas fa-eye text-primary"></i></a>
                      <a style="margin-right:10px" href="<?= base_url('admin/dAdministratorEdit/').$this->encrypt->encode($admin->id).''?>" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#adminDeleteModal<?= $admin->id;?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
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
    <?php $i=0; foreach($adminis as $all) :  $i++;?>
    <div class="modal fade" id="adminDeleteModal<?php echo $all->id;?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h5 class="modal-title">Hapus <?= $page;?> "<?php echo $all->username;?>" </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Pilih "Hapus" dibawah untuk menghapus <?= $page;?> <b><?php echo $all->username;?></b>.</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Tutup</button>
            <a class="btn btn-danger btn-sm" href="<?= base_url('admin/dAdministratorDelete/').$this->encrypt->encode($all->id).'';?>"><i class="fas fa-trash"></i>&ensp;Hapus</a>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  <?php endforeach; ?>

</section>
<!-- /.content -->
