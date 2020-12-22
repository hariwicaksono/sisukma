    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="mb-2 text-dark"><?= $page ;?></h1>
            <a class="btn btn-outline-primary" href="#" data-toggle="modal" data-target="#menuAdd">
              <i class="fas fa-plus"></i> Tambah Menu
            </a>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin')?>">Admin</a></li>
              <li class="breadcrumb-item active"><a href="<?= base_url('admin/nMenu')?>"><?= $page ;?></a></li>
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
              <table id="example" class="table table-bordered table-striped nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Url</th>
                    <th scope="col">Ikon</th>
                    <th scope="col">Menu untuk</th>
                    <th scope="col" class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach ($allmenu as $alme) :  $i++;?>
                  <tr>
                    <th scope="row"><?= $i ;?></th>
                    <td><?= $alme->title; ?></td>
                    <td><?= $alme->url; ?></td>
                    <td><?= $alme->icon; ?></td>
                    <td>
                      <?php
                      if($alme->role_id == 1 ){
                        echo 'Admin';
                      }else{
                        echo 'Mahasiswa';
                      }
                      ?>
                    </td>
                    <td class="text-center">
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#menuDetail<?= $alme->id_menu?>" title="Detail"><i class="fas fa-eye text-primary"></i></a>
                      <a style="margin-right:10px" href="#" data-toggle="modal" data-target="#menuEdit<?= $alme->id_menu?>" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
                      <a href="#" data-toggle="modal" data-target="#menuDelete<?= $alme->id_menu?>" title="Delete"><i class="fas fa-trash text-danger"></i></a>
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

    <!-- Menu Modal Add-->
    <div class="modal fade" id="menuAdd">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Menu Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('admin/nMenu'); ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label for="addMenuTitle">Nama Menu</label>
                <input type="text" name="a" class="form-control" id="addMenuTitle" placeholder="Menu title">
                <?php echo form_error('a', '<small class="text-danger pl-3">', '</small>');?>
              </div>
              <div class="form-group">
                <label for="addMenuFor">Menu Untuk</label>
                <select name="b" id="addMenuFor" class="form-control">
                  <option value="">Select Menu For</option>
                  <option value="1">Admin</option>
                  <option value="2">Mahasiswa</option>
                </select>
                <?php echo form_error('b', '<small class="text-danger pl-3">', '</small>');?>
              </div>
              <div class="form-group">
                <label for="addMenuUrl">Menu Url</label>
                <input type="text" name="c" class="form-control" id="addMenuUrl" placeholder="Menu url">
                <?php echo form_error('c', '<small class="text-danger pl-3">', '</small>');?>
              </div>
              <div class="form-group">
                <label for="addMenuIcon">Menu Ikon</label>
                <input type="text" name="d" class="form-control" id="addMenuIcon" placeholder="Menu icon">
                <?php echo form_error('d', '<small class="text-danger pl-3">', '</small>');?>
              </div>
              <div class="form-group">
                <label for="addMenuTree">Menu Tree / <text style="color: red">Bisa dikosongkan</text></label>
                <select name="e" id="addMenuTree" class="form-control">
                  <option value="0">Pilih Menu Tree</option>
                </select>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" value="1" name="f" type="checkbox" value="1" id="addMenuActive" checked>
                  <label class="form-check-label" for="addMenuActive">
                    Aktif?
                  </label>
                </div>
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

    <!-- Menu Detail Modal -->
    <?php $i=0; foreach($allmenu as $alme) : $i++; ?>
    <div class="modal fade" id="menuDetail<?= $alme->id_menu ;?>">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail Menu "<?= $alme->title;?>"</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
            <div class="modal-body">
              <div class="form-group">
                <label id="detailMenuTitle">Nama Menu</label>
                <input type="text" disabled class="form-control" for="detailMenuTitle" placeholder="Menu title" value="<?= $alme->title;?>">
              </div>
              <div class="form-group">
                <label id="detailMenuMfor">Menu Untuk</label>
                <?php if($alme->role_id == 1){
                  echo '<input type="text" disabled class="form-control" for="detailMenuUrl" placeholder="Menu url" value="Admin">';
                }else{
                  echo '<input type="text" disabled class="form-control" for="detailMenuUrl" placeholder="Menu url" value="Mahasiswa">';
                };?>
              </div>
              <div class="form-group">
                <label id="detailMenuUrl">Menu Url</label>
                <input type="text" disabled class="form-control" for="detailMenuUrl" placeholder="Menu url" value="<?= $alme->url;?>">
              </div>
              <div class="form-group">
                <label id="detailMenuIcon">Menu Ikon</label>
                <input type="text" disabled class="form-control" for="detailMenuIcon" placeholder="Menu icon" value="<?= $alme->icon;?>">
              </div>
              <div class="form-group">
                <label id="detailMenuTree">Menu Tree</label>
                <?php 
                $treeMenu = $this->db->get_where('tb_menu',['id_menu' => $alme->is_main_menu])->row_array();
                if($treeMenu['id_menu'] == $alme->is_main_menu){
                  echo '<input type="text" disabled class="form-control" for="detailMenuTree" placeholder="Menu Tree" value="'.$treeMenu['title'].'">';
                }else{
                  echo '<input type="text" disabled class="form-control" for="detailMenuTree" placeholder="Menu Tree" value="Kosong">';
                }
                ;?>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <?php 
                  if($alme->is_active == 1){
                    echo '<input class="form-check-input" value="1" name="f" type="checkbox" for="editSubMenuActive" checked disabled>';
                  }else{
                    echo '<input class="form-check-input" value="1" name="f" type="checkbox" for="editSubMenuActive" disabled>';
                  }
                  ;?>
                  <label class="form-check-label" id="editSubMenuActive">Aktif?</label>
                </div>
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

  <!-- Menu Edit Modal -->
  <?php $i=0; foreach($allmenu as $alme) : $i++; ?>
  <div class="modal fade" id="menuEdit<?= $alme->id_menu ;?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Menu "<?= $alme->title;?>"</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('admin/nMenuedit'); ?>" method="post">
          <div class="modal-body">

            <input type="hidden" readonly value="<?= $alme->id_menu ;?>" name="g" class="form-control" >

            <div class="form-group">
              <label id="editMenuTitle">Nama Menu</label>
              <input type="text" name="a" class="form-control" for="editMenuTitle" placeholder="Menu Title" value="<?= $alme->title;?>">
            </div>
            <div class="form-group">
              <label id="editMenuFor">Menu Untuk</label>
              <select name="b" for="editMenuFor" class="form-control">
                <?php
                foreach ($role as $rol) {
                  if($alme->role_id == $rol->id){
                    echo '<option value="'.$rol->id.'" selected>'.$rol->access.'</option>';
                  }else{
                    echo '<option value="'.$rol->id.'">'.$rol->access.'</option>';
                  }
                }
                ;?>
              </select>
            </div>
            <div class="form-group">
              <label id="editMenuUrl">Menu Url</label>
              <input type="text" name="c" class="form-control" for="editMenuUrl" placeholder="Menu url" value="<?= $alme->url;?>">
            </div>
            <div class="form-group">
              <label id="editMenuIcon">Menu Ikon</label>
              <input type="text" name="d" class="form-control" for="editMenuIcon" placeholder="Menu icon" value="<?= $alme->icon;?>">
            </div>
            <div class="form-group">
              <label id="editMenuTree">Menu Tree</label>
              <select name="e" for="editMenuTree" class="form-control">
                <option value="0">Pilih Menu Tree</option>
                <option  value="0" selected>Kosong</option>
                <?php
                foreach ($allmenu as $allme) {
                  if($alme->is_main_menu == $allme->id_menu && $allme->is_main_menu == 0){
                    echo '<option value="'. $allme->id_menu.'" selected>'.$allme->title.'</option>';
                  }elseif($allme->is_main_menu == 0){
                    echo '<option value="'. $allme->id_menu.'">'.$allme->title.'</option>';
                  }
                }
                ;?>
              </select>
            </div>
            <div class="form-group">
              <div class="form-check">
                <?php 
                if($alme->is_active == 1){
                  echo '<input class="form-check-input" value="1" name="f" type="checkbox" for="editSubMenuActive" checked>';
                }else{
                  echo '<input class="form-check-input" value="1" name="f" type="checkbox" for="editSubMenuActive">';
                }
                ;?>
                <label class="form-check-label" id="editSubMenuActive">Aktif?</label>
              </div>
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

<!-- Menu Hapus Modal-->
<?php $i=0; foreach($allmenu as $alme) : $i++; ?>
<div class="modal fade" id="menuDelete<?= $alme->id_menu ;?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header card-outline card-danger">
        <h5 class="modal-title">Hapus Menu <?= $alme->title ;?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Pilih "Hapus" dibawah untuk menghapus Menu <?= $alme->title;?>.</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times"></i>&ensp;Tutup</button>
        <a class="btn btn-danger btn-sm" href="<?= base_url('admin/nMenudelete/').$this->encrypt->encode($alme->id_menu).'';?>"><i class="fas fa-trash"></i>&ensp;Hapus</a>
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