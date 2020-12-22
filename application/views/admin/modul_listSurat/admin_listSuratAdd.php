    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?> Surat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin')?>">Admin</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sListSurat')?>"><?= $parent ;?></a></li>
              <li class="breadcrumb-item"><?= $page ;?></li>
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
        <div class="card">
          <div class="card-header">
          <a href="<?php echo base_url('admin/sListSurat');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="<?= base_url('admin/sListSuratAdd');?>" method="post">
            <div class="card-body">

              <div class="form-group">
                <label for="addSuratKdSurat" class="col-sm-2 col-form-label">Kode Surat</label>
                <div class="col-sm-12">
                  <input type="text" name="kodeSurat" class="form-control" id="addSuratKdSurat" placeholder="Kode Surat" value="<?= set_value('kodeSurat');?>">
                  <?= form_error('kodeSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group">
                <label for="addSuratNmSurat" class="col-sm-2 col-form-label">Nama Surat</label>
                <div class="col-sm-12">
                  <input type="text" name="namaSurat" class="form-control" id="addSuratNmSurat" placeholder="Nama Surat" value="<?= set_value('namaSurat');?>">
                  <?= form_error('namaSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group">
                <label for="addSuratKopSurat" class="col-sm-2 col-form-label">Kops Surat</label>
                <div class="col-sm-12">
                  <textarea name="kopSurat" class="form-control textarea" id="addSuratKopSurat" placeholder="Kops Surat">
                    <?= set_value('kopSurat')?>
                  </textarea>
                  <?= form_error('kopSurat', '<small class="text-danger pl-3">', '</small>');?>
                </div>
              </div>
              <div class="form-group">
                <label for="addSuratHeaderSurat" class="col-sm-2 col-form-label">Header Surat</label>
                <div class="col-sm-12">
                  <textarea name="headerSurat" class="form-control textarea" id="addSuratHeaderSurat" placeholder="Seluruh Surat"> <?= set_value('headerSurat')?>
                </textarea>
                <?= form_error('headerSurat', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group">
              <label for="addSuratIsiSurat" class="col-sm-2 col-form-label">Isi Surat</label>
              <div class="col-sm-12">
                <textarea name="isiSurat" class="form-control textarea" id="addSuratIsiSurat" placeholder="Seluruh Surat">
                  <?= set_value('isiSurat')?>
                </textarea>
                <?= form_error('isiSurat', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group">
              <label for="addSuratFooterSurat" class="col-sm-2 col-form-label">Footer Surat</label>
              <div class="col-sm-12">
                <textarea name="footerSurat" class="form-control textarea" id="addSuratFooterSurat" placeholder="Seluruh Surat">
                  <?= set_value('footerSurat')?>
                </textarea>
                <?= form_error('footerSurat', '<small class="text-danger pl-3">', '</small>');?>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="form-group clearfix">
                  <div class="icheck-primary d-inline">
                    <input type="radio" value="1" id="addSuratRadioAdministrator" name="access" checked>
                    <label for="addSuratRadioAdministrator">Hanya Administrator</label>
                  </div>
                  <div class="icheck-success d-inline">
                    <input type="radio" value="2" id="addSuratRadioAdminMahasiswa" name="access" checked>
                    <label for="addSuratRadioAdminMahasiswa">Admin dan Mahasiswa</label>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer justify-content-between">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&ensp;Simpan</button>
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
  </section>
      <!-- /.content -->