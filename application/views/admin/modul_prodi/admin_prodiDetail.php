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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dProdi')?>"><?= $parent ;?></a></li>
              <li class="breadcrumb-item"><?= $page ;?></li>
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
        <div class="card">
          <div class="card-header">
          <a href="<?php echo base_url('admin/dProdi');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
            <a class="float-right" href="<?= base_url('admin/dProdiEdit/'.$this->encrypt->encode($onepro->kdpro).'')?>"><i class="fas fa-user-edit"></i>&ensp;Edit</a>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal" action="<?php echo base_url('admin/dProdiAdd')?>" method="post">
            <div class="card-body">
              <div class="form-group row ml-3 mr-3">
                <label for="detailProdiKode" class="col-sm-2 col-form-label">Kode Prodi</label>
                <div class="col-sm-10">
                  <input type="text" name="kdpro" class="form-control" id="detailProdiKode" placeholder="Kode Prodi" value="<?= $onepro->kdpro ;?>" disabled>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="detailProdiNama" class="col-sm-2 col-form-label">Nama Prodi</label>
                <div class="col-sm-10">
                  <input type="text" name="nmpro" class="form-control" id="detailProdiNama" placeholder="Nama Prodi" value="<?= $onepro->prodi ;?>" disabled>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="detailProdiJenjang" class="col-sm-2 col-form-label">Jenjang Prodi</label>
                <div class="col-sm-10">
                  <input type="text" name="jenpro" class="form-control" id="detailProdiJenjang" placeholder="Jenjang Prodi" value="<?= $onepro->jen;?>" disabled>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="detailProdiKaprodi" class="col-sm-2 col-form-label">Nama Kaprodi</label>
                <div class="col-sm-10">
                  <input type="text" name="kapro" class="form-control" id="detailProdiKaprodi" placeholder="Nama Kaprodi" value="<?= $onepro->kaprodi ;?>" disabled>
                </div>
              </div>
              <div class="form-group row ml-3 mr-3">
                <label for="detailProdikdmk" class="col-sm-2 col-form-label">Kode MK Prodi</label>
                <div class="col-sm-10">
                  <input type="text" name="kdmkpro" class="form-control" id="detailProdikdmk" placeholder="Kode MK Prodi" value="<?= $onepro->kdmk ;?>" disabled>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
           <!-- <div class="card-footer justify-content-between">
          
             
            </div>-->
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
      <!-- /.content -->