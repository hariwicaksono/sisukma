    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="mb-2 text-dark"><?= $page ;?></h1>
            <a class="btn btn-outline-primary" href="#" data-toggle="modal" data-target="#roleAdd">
              <i class="fas fa-plus"></i> Tambah Role
            </a>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin')?>">Admin</a></li>
              <li class="breadcrumb-item active"><a href="<?= base_url('admin/nRole')?>"><?= $page ;?></a></li>
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
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
          <a href="<?php echo base_url('admin');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
          </div>
          <div class="card-body table-responsive">
            <div>
              <table id="example" class="table table-bordered table-striped nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Access</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach ($allrole as $alro) :  $i++;?>
                  <tr>
                    <th scope="row"><?= $i ;?></th>
                    <td><?= $alro->access; ?></td>
                    <td>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#roleDetail<?= $alro->id?>" title="Detail"><i class="fas fa-eye text-primary"></i></a>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#roleEdit<?= $alro->id?>"  title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                      <a href="#" data-toggle="modal" data-target="#roleDelete<?= $alro->id?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
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

    <!-- Role Modal Add-->
    <div class="modal fade" id="roleAdd">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Role Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('admin/nRole'); ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label for="addRoleName">Nama Role</label>
                <input type="text" name="a" class="form-control" id="addRoleName" placeholder="Role Name">
                <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>&ensp;Simpan</button>
              <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i>&ensp;Tutup</button>
              
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- ROle Detail Modal -->
    <?php $i=0; foreach($allrole as $alro) : $i++; ?>
    <div class="modal fade" id="roleDetail<?= $alro->id?>">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail Role "<?= $alro->access;?>"</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
            <div class="modal-body">
              <div class="form-group">
                <label id="detailRoleName">Nama Role</label>
                <input type="text" disabled class="form-control" for="detailRoleName" placeholder="Nama Role" value="<?= $alro->access;?>">
              </div>
            </div>
            <div class="modal-footer" style='clear:both'>
              <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i>&ensp;Tutup</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <?php endforeach; ?>
  <!-- /.modal -->

  <!-- Role Edit Modal -->
  <?php $i=0; foreach($allrole as $alro) : $i++; ?>
  <div class="modal fade" id="roleEdit<?= $alro->id?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Role "<?= $alro->access;?>"</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('admin/nRoleEdit'); ?>" method="post">
          <div class="modal-body">

            <input type="hidden" readonly value="<?= $alro->id ;?>" name="b" class="form-control" >

            <div class="form-group">
              <label id="editRoleName">Nama Role</label>
              <input type="text" name="a" class="form-control" for="editRoleName" placeholder="Nama Role" value="<?= $alro->access;?>">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>&ensp;Update</button>

            <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm"><i class="fas fa-times"></i>&ensp;Tutup</button>
          
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php endforeach; ?>
<!-- /.modal -->

<!-- Role Hapus Modal-->
<?php $i=0; foreach($allrole as $alro) : $i++; ?>
<div class="modal fade" id="roleDelete<?= $alro->id ;?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header card-outline card-danger">
        <h5 class="modal-title">Hapus Role <?= $alro->access ;?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pilih "Hapus" dibawah untuk menghapus Role <?= $alro->access;?>.</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Tutup</button>
        <a class="btn btn-danger btn-sm" href="<?= base_url('admin/nRoleDelete/').$alro->id.'';?>"><i class="fas fa-trash"></i>&ensp;Hapus</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php endforeach; ?>
<!-- /.modal -->

</section>
    <!-- /.content -->