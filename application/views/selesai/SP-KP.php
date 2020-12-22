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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sSuratSelesai')?>"><?= $parent ;?></a></li>
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

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
          <a href="<?php echo base_url('admin/sSuratSelesai');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
          </div>
          <div class="card-body">

            <form action="" method="post">

              <div class="row">
                <div class="col-md-6">

                  <!-- No Surat And Button Generate -->
                  <div class="form-group">
                    <label for="no_surat" class="col-form-label">No Surat<text class="text-danger"><b>*</b></text></label>

                    <input name="no_surat" id="no_surat" type="text" class="form-control" value="<?= $onesls->no_surat?>" readonly>

                    <?= form_error('no_surat', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <!-- / No Surat And Button Generate -->

                  <!-- Tanda Tangan -->
                  <div class="form-group">
                    <label for="spkpTTD" class="col-form-label">Tanda Tangan</label>
                    <?php
                    // $dosenalll = "SELECT * FROM esurat_dosen";
                    if($onedos->id == $onesls->ttd) : ?>
                      <input name="ttd" id="no_surat" type="text" class="form-control" value="<?= $onedos->nama?>" readonly>
                      <?php else : ?>
                        <input name="ttd" id="no_surat" type="text" class="form-control" value="Unknown" readonly>
                      <?php endif;?>
                      <?= form_error('ttd', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Tanda Tangan -->

                    <!-- Kode Surat -->
                    <div class="form-group">
                      <label for="spkpKodeSurat" class="col-form-label">Kode Surat</label>
                      <input type="text" name="kodeSurat" class="form-control" id="spkpKodeSurat" placeholder="Kode Surat" value="<?= $onesls->kd_surat?>" readonly>
                      <?= form_error('kodeSurat', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Kode Surat -->

                  </div>

                  <div  class="col-md-6">

                    <!-- Hasil Enkripsi -->
                    <div class="form-group">
                      <label for="spkpHasilEnkripsi" class="col-form-label">Hasil Enkripsi</label>

                      <textarea type="text" class="form-control" id="spkpHasilEnkripsi" placeholder="Hasil Enkripsi" readonly><?= $onesls->enkripsi?></textarea>


                    </div>
                    <!-- / Hasil Enkripsi -->

                    <!-- QR COde -->
                    <div class="form-group">
                      <label for="qrcode" class="col-form-label">QR Code</label>
                      <div class="input-group">

                        <img id="qrcode" src="<?= base_url('assets/img/QRCode/'.str_replace("/", "_",$onesls->no_surat).'.png')?>" alt="QRCode" width="150"/>

                      </div>
                    </div>
                    <!-- / QR COde -->

                  </div>

                </div>

                <!-- Row -->
                <div class="row">
                  <!-- col-md-6 -->
                  <div class="col-md-6">

                    <!-- Nama Surat -->
                    <div class="form-group">
                      <label for="spkpNamaSurat" class="col-form-label">Nama Surat</label>
                      <input type="text" name="namaSurat" class="form-control" id="spkpNamaSurat" placeholder="Nama Surat" value="<?= $onesls->nm_surat?>" readonly>
                      <?= form_error('namaSurat', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Nama Surat -->

                    <!-- Kepada Yth. Surat Di Ajukan -->
                    <div class="form-group">
                      <label for="spkpKepada" class="col-form-label">Kepada Yth.</label>
                      <textarea type="text" rows="1" name="kepada" class="form-control" id="spkpKepada" placeholder="Kepada Yth." readonly><?= $onesls->kepada ;?></textarea>
                      <?= form_error('kepada', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Kepada Yth. Surat Di Ajukan -->

                    <!-- Keperluan Surat Di Ajukan -->
                    <div class="form-group">
                      <label for="spkpKeperluan" class="col-form-label">Keperluan</label>
                      <textarea type="text" rows="1" name="keperluan" class="form-control" id="spkpKeperluan" placeholder="Keperluan" readonly><?= $onesls->keperluan ;?></textarea>
                      <?= form_error('keperluan', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Keperluan Surat Di Ajukan -->

                    <!-- Dosen -->
                    <div class="form-group">
                      <label for="spkpDosen" class="col-form-label">Dosen</label>
                      <input type="text" name="dosen" class="form-control" id="spkpDosen" placeholder="Dosen" value="<?= $onedos->nama ;?>" readonly>
                      <?= form_error('dosen', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Dosen -->

                  </div>
                  <!-- / col-md-6 -->

                  <!-- col-md-6 -->
                  <div class="col-md-6">

                    <!-- NIM Mahasiswa YAng Mengajukan Surat -->
                    <div class="form-group">
                      <label for="spkpNIM" class="col-form-label">NIM Mahasiswa</label>
                      <input type="text" name="nim" class="form-control" id="spkpNIM" placeholder="NIM Mahasiswa" value="<?= $onesls->permintaan_by?>" readonly>
                      <?= form_error('nim', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / NIM Mahasiswa YAng Mengajukan Surat -->

                    <!-- Nama Mahasiswa YAng Mengajukan Surat -->
                    <div class="form-group">
                      <label for="spkpNama" class="col-form-label">Nama Mahasiswa</label>
                      <input type="text" class="form-control" id="spkpNama" placeholder="Nama Mahasiswa" value="<?= $onemhs->nmmhs;?>" readonly>
                      <?= form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Nama Mahasiswa YAng Mengajukan Surat -->

                    <!-- Prodi Mahasiswa YAng Mengajukan Surat -->
                    <div class="form-group">
                      <label for="spkpNamaProdi" class="col-form-label">Prodi</label>
                      <input type="text" name="prodi" class="form-control" id="spkpNamaProdi" placeholder="Prodi" value="<?= $onepro->prodi?>" readonly>
                      <?= form_error('prodi', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Prodi Mahasiswa YAng Mengajukan Surat -->

                    <!-- Prodi Mahasiswa YAng Mengajukan Surat -->
                    <div class="form-group">
                      <label for="spkpSemester" class="col-form-label">Semester</label>
                      <input type="text" name="semester" class="form-control" id="spkpSemester" placeholder="Semester" value="<?= semester($onemhs->thaka)?>" readonly>
                      <?= form_error('semester', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <!-- / Prodi Mahasiswa YAng Mengajukan Surat -->

                  </div>
                  <!-- / col-md-6 -->

                </div>
                <!-- / Row -->

                <div class="card collapsed-card">
                  <div class="card-header">
                    <h4 class="card-title " text-align="center"><strong>Surat yang diminta</strong></h4>
                    <div class="card-tools">
                      <button type="button" class="btn btn-secondary btn-xs" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                      </button>
                      <button type="button" class="btn btn-danger btn-xs" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">

                    <!-- Hasil Surat -->
                    <div class="form-group row">

                      <label for="spkpHasilSurat" class="col-md-2 col-form-label"><?= $page ?></label>
                      <div class="col-md-12">
                        <textarea  class="form-control textarea" id="spkpHasilSurat" placeholder="Header Surat" rows="10" disabled="true"> 
                          <?= $this->parser->parse_string($isi, $komponen, TRUE);
                          ?>
                        </textarea>
                      </div>

                    </div>
                    <!-- / Hasil Surat -->

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="form-group justify-content-between">
                  <a class="btn btn-primary" href="<?= base_url('Prints/printSurat/'.$this->encrypt->encode($onesls->id_selesai).'/'.$this->encrypt->encode($onesls->kd_surat))?>" target="_blank">Cetak &ensp;<i class="fas fa-print" target="_blank"></i></a>
                </div>             
              </form>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
