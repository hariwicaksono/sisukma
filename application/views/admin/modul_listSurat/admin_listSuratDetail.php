    <!-- Content Header (Page header) -->
    <div class="content-header">
     <div class="container-fluid">
       <div class="row">
         <div class="col-sm-6">
           <h1 class="mb-2 text-dark"><?= $page ;?> Surat</h1>
           <a class="btn btn-outline-primary" href="<?= base_url('admin/sListSuratEdit/'.$this->encrypt->encode($onesur->id_surat).'')?>"><i class="fas fa-user-edit"></i>&ensp;Edit</a>
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
  <section class="content ">
    <div class="container-fluid">
      <div class="card collapsed-card">
        <div class="card-header">
        <a href="<?php echo base_url('admin/sListSurat');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
            
          <div class="card-tools">
            <button type="button" class="btn btn-secondary btn-xs" data-card-widget="collapse">
              <i class="fas fa-plus"></i>
            </button>
            <button type="button" class="btn btn-danger btn-xs" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
            
          </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="card-body">
          <form>
            <div class="form-group">
              <label for="detailSuratKdSurat" class="col-sm-2 col-form-label">Kode Surat</label>
              <div class="col-sm-12">
                <input type="text" name="kodeSurat" class="form-control" id="detailSuratKdSurat" placeholder="Kode Surat" value="<?= $onesur->kd_surat ;?>" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="detailSuratNmSurat" class="col-sm-2 col-form-label">Nama Surat</label>
              <div class="col-sm-12">
                <input type="text" name="namaSurat" class="form-control" id="detailSuratNmSurat" placeholder="Nama Surat" value="<?= $onesur->nm_surat;?>" disabled>
              </div>
            </div>
            <div class="form-group">
             <label for="detailSuratKopSurat" class="col-sm-2 col-form-label">Kops Surat</label>
             <div class="col-sm-12">
               <textarea name="kopSurat" class="form-control textarea" id="detailSuratKopSurat" placeholder="Kops Surat" disabled>
                 <?= $onesur->kop_surat;?>
               </textarea>
             </div>
           </div>
           <div class="form-group">
            <label for="detailSuratHeaderSurat" class="col-sm-2 col-form-label">Header Surat</label>
            <div class="col-sm-12">
              <textarea name="headerSurat" class="form-control textarea" id="detailSuratHeaderSurat" placeholder="Header Surat" disabled> <?= $onesur->header_surat ;?>
            </textarea>
          </div>
        </div>
        <div class="form-group"> 
          <label for="detailSuratIsiSurat" class="col-sm-2 col-form-label">Isi Surat</label>
          <div class="col-sm-12">
            <textarea name="isiSurat" class="form-control textarea" id="detailSuratIsiSurat" placeholder="Isi Surat" disabled>
              <?= $onesur->isi_surat ;?>
            </textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="detailSuratFooterSurat" class="col-sm-2 col-form-label">Footer Surat</label>
          <div class="col-sm-12">
            <textarea name="footerSurat" class="form-control textarea" id="detailSuratFooterSurat" placeholder="Footer Surat" disabled>
              <?= $onesur->footer_surat ;?>
            </textarea>
          </div>
        </div>

        <?php if($onesur->access == 1) : ?>
          <div class="form-group">
            <div class="col-sm-12">
              <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                  <input type="radio" value="1" id="detailSuratRadioAdministrator" checked>
                  <label for="detailSuratRadioAdministrator">Administrator Only</label>
                </div>
              </div>
            </div>
          </div>
          <?php elseif ($onesur->access == 2) : ?>
            <div class="form-group">
              <div class="col-sm-12">
                <div class="form-group clearfix">
                  <div class="icheck-success d-inline ml-2">
                    <input type="radio" value="2" id="detailSuratRadioAdminMahasiswa" checked>
                    <label for="detailSuratRadioAdminMahasiswa">Admin dan Mahasiswa Only</label>
                  </div>
                </div>
              </div>
            </div>
            <?php endif ;?>
           <!-- /.card-body -->
         </form>
       </div>
     </div>
     <!-- /.card -->
   </div>
   <!-- /.container-fluid -->
 </section>
 <!-- /.content -->

 <section class="content ">
  <div class="container-fluid">
    <!-- solid sales graph -->
    <div class="card">
      <div class="card-header border-0">
        <h3 class="card-title">
          <i class="fas fa-th mr-1"></i>
          Hasil Surat
        </h3>

        <div class="card-tools">
          <button type="button" class="btn btn-secondary btn-xs" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-danger btn-xs" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <textarea name="footerSurat" class="form-control textarea"  placeholder="Footer Surat" disabled>
          <?= $onesur->kop_surat ;?>
          <?= $onesur->header_surat ;?>
          <?= $onesur->isi_surat ;?>
          <?= $onesur->footer_surat ;?>
        </textarea>
      </div>
      <!-- /.card-body -->
     <!-- <div class="card-footer justify-content-between">
       
     </div>-->
     <!-- /.card-footer -->
   </div>
   <!-- /.card -->
 </div>

</section>
<!-- /.content -->