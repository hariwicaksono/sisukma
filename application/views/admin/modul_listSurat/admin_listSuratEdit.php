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
    <section class="content ">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
          <a href="<?php echo base_url('admin/sListSurat');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
            <!--<div class="card-tools">
              <button type="button" class="btn btn-secondary btn-xs" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-danger btn-xs" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>-->
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <div class="card-body">
            <form action="<?php echo base_url('admin/sListSuratEdit/'.$this->encrypt->encode($onesur->id_surat).'')?>" method="post">

              <input type="hidden" name="zz" value="<?= $onesur->id_surat ;?>">

              <div class="form-group">
                <label for="editSuratKdSurat" class="col-sm-2 col-form-label">Kode Surat</label>
                <div class="col-sm-12">
                  <input type="text" name="kodeSurat" class="form-control" id="editSuratKdSurat" placeholder="Kode Surat" value="<?= $onesur->kd_surat ;?>">
                </div>
              </div>
              <div class="form-group">
                <label for="editSuratNmSurat" class="col-sm-2 col-form-label">Nama Surat</label>
                <div class="col-sm-12">
                  <input type="text" name="namaSurat" class="form-control" id="editSuratNmSurat" placeholder="Nama Surat" value="<?= $onesur->nm_surat;?>">
                </div>
              </div>
              <div class="form-group">
                <label for="editSuratKopSurat" class="col-sm-2 col-form-label">Kops Surat</label>
                <div class="col-sm-12">
                  <textarea name="kopSurat" class="form-control textarea" id="editSuratKopSurat" placeholder="Kops Surat">
                    <?= $onesur->kop_surat;?>
                  </textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="editSuratHeaderSurat" class="col-sm-2 col-form-label">Header Surat</label>
                <div class="col-sm-12">
                  <textarea name="headerSurat" class="form-control textarea" id="editSuratHeaderSurat" placeholder="Header Surat"> <?= $onesur->header_surat ;?>
                </textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="editSuratIsiSurat" class="col-sm-2 col-form-label">Isi Surat</label>
              <div class="col-sm-12">
                <textarea name="isiSurat" class="form-control textarea" id="editSuratIsiSurat" placeholder="Isi Surat">
                  <?= $onesur->isi_surat ;?>
                </textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="editSuratFooterSurat" class="col-sm-2 col-form-label">Footer Surat</label>
              <div class="col-sm-12">
                <textarea name="footerSurat" class="form-control textarea" id="editSuratFooterSurat" placeholder="Footer Surat">
                  <?= $onesur->footer_surat ;?>
                </textarea>
              </div>
            </div>

            <?php if($onesur->access == 1 ) : ?>
              <div class="form-group">
                <div class="col-sm-12">
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="radio" value="1" id="EditSuratRadioAdministrator" name="access" checked>
                      <label for="EditSuratRadioAdministrator">Administrator Only</label>
                    </div>
                    <div class="icheck-success d-inline ml-2">
                      <input type="radio" value="2" id="EditSuratRadioAdminMahasiswa"  name="access">
                      <label for="EditSuratRadioAdminMahasiswa">Admin dan Mahasiswa</label>
                    </div>
                  </div>
                </div>
              </div>
              <?php elseif($onesur->access == 2) :?>
                <div class="form-group">
                  <div class="col-sm-12">
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" value="1" id="EditSuratRadioAdministrator" name="access">
                        <label for="EditSuratRadioAdministrator">Hanya Administrator</label>
                      </div>
                      <div class="icheck-success d-inline ml-2">
                        <input type="radio" value="2" id="EditSuratRadioAdminMahasiswa"  name="access" checked>
                        <label for="EditSuratRadioAdminMahasiswa">Admin dan Mahasiswa</label>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endif ;?>
            </div>
            <div class="card-footer justify-content-between">
                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i>&ensp;Update</button>
            </div>
                   
              <!-- /.card-body -->
              </form>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
      </section>
  <!-- /.content -->