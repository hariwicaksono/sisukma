    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">

            <?php if($name == 'permohonan') : ?>

              <!---------------------------------------------------------------------------------------->
              <!---------------------- Code Di bawah Untuk Admin Mengajukan Surat ---------------------->
              <!---------------------------------------------------------------------------------------->

              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('admin')?>">Admin</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/sPermintaanSurat')?>"><?= $parent ;?></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('pengajuan/pengajuanDetail/'.$this->encrypt->encode($onesur->kd_surat).'/'.$this->encrypt->encode($onesur->id_surat).'/'.$this->encrypt->encode('permohonan'))?>"><?= $page ;?></a></li>
              </ol>

              <?php elseif($name == 'pengajuan') : ?>

                <!---------------------------------------------------------------------------------------->
                <!-------------------- Code Di bawah Untuk mahasiswa Mengajukan Surat -------------------->
                <!---------------------------------------------------------------------------------------->

                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa')?>">Mahasiswa</a></li>
                  <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa/pengajuanSurat')?>"><?= $parent ;?></a></li>
                  <li class="breadcrumb-item"><a href="<?= base_url('pengajuan/pengajuanDetail/'.$this->encrypt->encode($onesur->kd_surat).'/'.$this->encrypt->encode($onesur->id_surat).'/'.$this->encrypt->encode('pengajuan'))?>"><?= $page ;?></a></li>
                </ol>

                <?php elseif($name == 'permintaan') :?>

                  <!---------------------------------------------------------------------------------------->
                  <!---- Code Di bawah Untuk Konfirmasi Permintaan Surat Yang telah di Ajukan Mahasiswa ---->
                  <!---------------------------------------------------------------------------------------->


                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin')?>">Admin</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/sPermintaanSurat')?>"><?= $parent ;?></a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('pengajuan/pengajuanDetail/'.$this->encrypt->encode($onesur->kd_surat).'/'.$this->encrypt->encode($onesur->id_permintaan).'/'.$this->encrypt->encode('permintaan'))?>"><?= $page ;?></a></li>
                  </ol>

                <?php endif ;?>

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


        <?php if($name == 'permohonan') : ?>

          <!---------------------------------------------------------------------------------------->
          <!---------------------- Code Di bawah Untuk Admin Mengajukan Surat ---------------------->
          <!---------------------------------------------------------------------------------------->

          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <!-- Default box -->
              <div class="card">
                <div class="card-header">
                <a href="<?php echo base_url('admin/sPermintaanSurat');?>">
                  <i class="fas fa-arrow-left"></i>&ensp;Kembali
                </a>
                </div>
                <div class="card-body">

                  <form action="<?= base_url('pengajuan/pengajuanDetail/'.$this->encrypt->encode($onesur->kd_surat).'/'.$this->encrypt->encode($onesur->id_surat).'/'.$this->encrypt->encode('permohonan'));?>" method="post">

                    <input type="hidden" readonly name="penyetuju_by" class="form-control" value="<?= $user->username ;?>">
                    <input type="hidden" readonly name="p" class="form-control" id="spkpCosP">
                    <input type="hidden" readonly name="q" class="form-control" id="spkpCosQ">
                    <input type="hidden" readonly name="n" class="form-control" id="spkpCosN">
                    <input type="hidden" readonly name="e" class="form-control" id="spkpCosE">
                    <input type="hidden" readonly name="d" class="form-control" id="spkpCosD">

                    <div class="row">

                      <div class="col-md-6">

                        <!-- No Surat And Button Generate -->
                        <div class="form-group">
                          <label for="spkpCosNo_surat" class="col-form-label">No Surat <text class="text-danger"><b>*</b></text></label>
                          <div class="input-group">
                            <input name="no_surat" id="spkpCosNo_surat" type="text" class="form-control" readonly>
                            <span class="input-group-append">
                              <button type="button" class="btn btn-primary" id="generateCos"><i class="fa fa-check text-white"></i>&ensp;Generate</button>
                            </span>
                          </div>
                          <?= form_error('no_surat', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / No Surat And Button Generate -->

                        <!-- Dosen -->
                        <div class="form-group">
                          <label for="spkpCosDosen" class="col-form-label">Dosen</label>
                          <select name="dosen" id="spkpCosDosen" class="form-control select2" style="width: 100%;" >
                            <option value="" selected>Pilih Dosen</option>
                            <?php
                            foreach ($dosenall as $dosen) {
                              echo '<option value="'.$dosen->id.'">'.$dosen->nama.'</option>';
                            }
                            ;?>
                          </select>
                          <?= form_error('dosen', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Dosen -->

                        <!-- Tanda Tangan -->
                        <div class="form-group">
                          <label for="spkpCosTTD" class="col-form-label">Tanda Tangan</label>
                          <input type="text" class="form-control" id="spkpCosTTD" placeholder="Tanda Tangan" readonly>
                          <?= form_error('dosen', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Tanda Tangan -->

                      </div>

                      <div class="col-md-6">

                        <!-- Hasil Enkripsi -->
                        <div class="form-group">
                          <label for="spkpCosHasilEnkripsi" class="col-form-label">Hasil Enkripsi</label>
                          <textarea type="text" name="enkripsi" class="form-control" id="spkpCosHasilEnkripsi" placeholder="Hasil Enkripsi" readonly></textarea>
                        </div>
                        <!-- / Hasil Enkripsi -->

                        <!-- QR COde -->
                        <div class="form-group">
                          <label for="qrcode" class="col-form-label">QR Code</label>
                          <div class="input-group">
                            <img id="qrcodeCos" src="<?= base_url('assets/img/qrcode_sample.png')?>" alt="QRCode" width="150" />
                          </div>
                        </div>
                        <!-- / QR COde -->

                      </div>

                    </div>

                    <div class="row">

                      <div class="col-md-6">

                        <!-- Kepada Yth. Surat Di Ajukan -->
                        <div class="form-group">
                          <label for="spkpCosKepada" class="col-form-label">Kepada Yth.</label>
                          <textarea type="text" rows="1" name="kepada" class="form-control" id="spkpCosKepada" placeholder="Kepada Yth."><?= set_value('kepada')?></textarea>
                          <?= form_error('kepada', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Kepada Yth. Surat Di Ajukan -->

                        <!-- Keperluan Surat Di Ajukan -->
                        <div class="form-group">
                          <label for="spkpCosKeperluan" class="col-form-label">Keperluan</label>
                          <textarea type="text" rows="1" name="keperluan" class="form-control" id="spkpCosKeperluan" placeholder="Keperluan"><?= set_value('keperluan')?></textarea>
                          <?= form_error('keperluan', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Keperluan Surat Di Ajukan -->

                        <!-- Kode Surat -->
                        <div class="form-group">
                          <label for="spkpCosKodeSurat" class="col-form-label">Kode Surat</label>
                          <input type="text" name="kodeSurat" class="form-control" id="spkpCosKodeSurat" placeholder="Kode Surat" value="<?= $onesur->kd_surat?>" readonly>
                          <?= form_error('kodeSurat', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Kode Surat -->

                        <!-- Nama Surat -->
                        <div class="form-group">
                          <label for="spkpCosNamaSurat" class="col-form-label">Nama Surat</label>
                          <input type="text" name="namaSurat" class="form-control" id="spkpCosNamaSurat" placeholder="Nama Surat" value="<?= $onesur->nm_surat?>" readonly>
                          <?= form_error('namaSurat', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Nama Surat -->

                      </div>

                      <div class="col-md-6">

                        <!-- NIM Mahasiswa YAng Mengajukan Surat -->
                        <div class="form-group">
                          <label for="spkpCosNIM" class="col-form-label">NIM Mahasiswa</label>
                          <select name="cosnim" id="spkpCosNIM" class="form-control select2" style="width: 100%;" >
                            <option value="" selected>Tulis Nim mahasiswa / Nama Mahasiswa </option>
                            <?php
                            foreach ($mahasiswaall as $mhsa) {
                              echo '<option value="'.$mhsa->nim.'">'.$mhsa->nim.' / '.$mhsa->nmmhs.'</option>';
                            }
                            ;?>
                          </select>
                          <?= form_error('cosnim', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / NIM Mahasiswa YAng Mengajukan Surat -->

                        <!-- Nama Mahasiswa YAng Mengajukan Surat -->
                        <div class="form-group">
                          <label for="spkpCosNama" class="col-form-label">Nama Mahasiswa</label>
                          <input type="text" class="form-control" id="spkpCosNama" placeholder="Nama Mahasiswa" readonly>
                          <?= form_error('cosnim', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Nama Mahasiswa YAng Mengajukan Surat -->

                        <!-- Prodi Mahasiswa YAng Mengajukan Surat -->
                        <div class="form-group">
                          <label for="spkpCosProdi" class="col-form-label">Prodi</label>
                          <input type="text" class="form-control" id="spkpCosProdi" placeholder="Prodi" readonly>
                          <?= form_error('cosnim', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Prodi Mahasiswa YAng Mengajukan Surat -->

                        <!-- Prodi Mahasiswa YAng Mengajukan Surat -->
                        <div class="form-group">
                          <label for="spkpCosSemester" class="col-form-label">Semester</label>
                          <input type="text" class="form-control" id="spkpCosSemester" placeholder="Semester" readonly>
                          <?= form_error('cosnim', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Prodi Mahasiswa YAng Mengajukan Surat -->

                      </div>

                    </div>

                    <div class="card card-outline collapsed-card card-info">
                      <div class="card-header">
                        <h4 class="card-title " text-align="center"><strong>Surat Yang Di Minta</strong></h4>
                        <div class="card-tools">
                          <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                          </button>
                          <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">

                        <!-- Hasil Surat -->
                        <div class="form-group row">

                          <label for="spkpHasilSurat" class="col-md-2 col-form-label"><?= $page ?></label>
                          <div class="col-md-12">
                            <textarea name="semua"  class="form-control textarea" id="spkpHasilSurat" placeholder="Header Surat" rows="10" readonly> 
                              <?= $onesur->kop_surat ;?>
                              <?= $onesur->header_surat ;?>
                              <?= $onesur->isi_surat ;?>
                              <?= $onesur->footer_surat ;?>
                            </textarea>
                          </div>

                        </div>

                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="form-group justify-content-between">
                   
                      <button type="submit" class="btn btn-primary">Submit &ensp;<i class="fas fa-arrow-right"></i></button>
                    </div>  

                  </form>

                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
          </section>
          <!-- / Main content -->

          <?php elseif($name == 'pengajuan') : ?>

            <!---------------------------------------------------------------------------------------->
            <!-------------------- Code Di bawah Untuk mahasiswa Mengajukan Surat -------------------->
            <!---------------------------------------------------------------------------------------->

            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <!-- Default box -->
                <div class="card">
                  <div class="card-header">
                  <a href="<?php echo base_url('mahasiswa/pengajuanSurat');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
                  </div>
                  <div class="card-body">
                    <form action="<?= base_url('pengajuan/pengajuanDetail/'.$this->encrypt->encode($onesur->kd_surat).'/'.$this->encrypt->encode($onesur->id_surat).'/'.$this->encrypt->encode('pengajuan'));?>" method="post">
                      <div class="row">
                        <!-- col-md-6 -->
                        <div class="col-md-6">

                          <!-- Kode Surat -->
                          <div class="form-group">
                            <label for="spkpKodeSurat" class="col-form-label">Kode Surat</label>
                            <input type="text" name="kodeSurat" class="form-control" id="spkpKodeSurat" placeholder="Kode Surat" value="<?= $onesur->kd_surat?>" readonly>
                            <?= form_error('kodeSurat', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                          <!-- / Kode Surat -->

                          <!-- Nama Surat -->
                          <div class="form-group">
                            <label for="spkpNamaSurat" class="col-form-label">Nama Surat</label>
                            <input type="text" name="namaSurat" class="form-control" id="spkpNamaSurat" placeholder="Nama Surat" value="<?= $onesur->nm_surat?>" readonly>
                            <?= form_error('namaSurat', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                          <!-- / Nama Surat -->

                          <!-- Kepada Yth. Surat Di Ajukan -->
                          <div class="form-group">
                            <label for="spkpKepada" class="col-form-label">Kepada Yth.</label>
                            <textarea type="text" rows="1" name="kepada" class="form-control" id="spkpKepada" placeholder="Kepada Yth."><?= set_value('kepada');?></textarea>
                            <?= form_error('kepada', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                          <!-- / Kepada Yth. Surat Di Ajukan -->

                          <!-- Kepada Yth. Surat Di Ajukan -->
                          <div class="form-group">
                            <label for="spkpKeperluan" class="col-form-label">Keperluan</label>
                            <textarea type="text" rows="1" name="keperluan" class="form-control" id="spkpKeperluan" placeholder="Keperluan"><?= set_value('keperluan');?></textarea>
                            <?= form_error('keperluan', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                          <!-- / Kepada Yth. Surat Di Ajukan -->

                          <!-- Dosen -->
                          <div class="form-group">
                            <label for="spkpDosen" class="col-form-label">Dosen</label>
                            <input type="text" name="dosen" class="form-control" id="spkpDosen" placeholder="Dosen" value="Wakil Dekan" readonly>
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
                            <input type="text" name="nim" class="form-control" id="spkpNIM" placeholder="NIM Mahasiswa" value="<?= $user->nim?>" readonly>
                            <?= form_error('nim', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                          <!-- / NIM Mahasiswa YAng Mengajukan Surat -->

                          <!-- Nama Mahasiswa YAng Mengajukan Surat -->
                          <div class="form-group">
                            <label for="spkpNama" class="col-form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="spkpNama" placeholder="Nama Mahasiswa" value="<?= $user->nim?>" readonly>
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                          <!-- / Nama Mahasiswa YAng Mengajukan Surat -->

                          <!-- Kode Prodi -->
                          <div class="form-group">
                            <input type="hidden" name="kdpro" class="form-control" id="spkpKodeProdi" placeholder="Kode Prodi" value="<?= $user->kdpro;?>" readonly>
                            <?= form_error('kdpro', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                          <!-- / Kode Prodi -->

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
                            <input type="text" name="semester" class="form-control" id="spkpSemester" placeholder="Semester" value="<?= semester($user->thaka)?>" readonly>
                            <?= form_error('semester', '<small class="text-danger pl-3">', '</small>');?>
                          </div>
                          <!-- / Prodi Mahasiswa YAng Mengajukan Surat -->

                        </div>
                        <!-- / col-md-6 -->

                        <!-- Semua Isi Surat -->
                        <div class="form-group col-md-12" style="display: none;">
                          <textarea  name="semua" class="form-control textarea" id="spkpKeperluan" placeholder="Keperluan" readonly >
                            <?= $onesur->kop_surat ;?>
                            <?= $onesur->header_surat ;?>
                            <?= $onesur->isi_surat ;?>
                            <?= $onesur->footer_surat ;?>
                          </textarea>
                          <?= form_error('semua', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / Semua Isi Surat -->

                      </div>
                      <hr>
                      <div class="form-group justify-content-between">
                   
                        <button type="submit" class="btn btn-primary">Submit &ensp;<i class="fas fa-arrow-right"></i></button>
                      </div>             
                    </form>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.container-fluid -->
            </section>
            <!-- / Main content -->

            <?php elseif($name == 'permintaan') :?>

              <!---------------------------------------------------------------------------------------->
              <!---- Code Di bawah Untuk Konfirmasi Permintaan Surat Yang telah di Ajukan Mahasiswa ---->
              <!---------------------------------------------------------------------------------------->

              <!-- Main content -->
              <section class="content">
                <div class="container-fluid">
                  <!-- Default box -->
                  <div class="card">
                    <div class="card-header">
                    <a href="<?php echo base_url('admin/sPermintaanSurat');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
                    </div>
                    <div class="card-body">

                      <form action="<?= base_url('pengajuan/pengajuanDetail/'.$this->encrypt->encode($onesur->kd_surat).'/'.$this->encrypt->encode($onesur->id_permintaan).'/'.$this->encrypt->encode('permintaan'));?>" method="post">

                        <input type="hidden" readonly name="zz" id="zz" value="<?= $onepmr->id_permintaan;?>"  class="form-control">
                        <input type="hidden" readonly name="penyetuju_by" class="form-control" value="<?= $user->username ;?>">

                        <div class="row">
                          <div class="col-md-6">

                            <!-- No Surat And Button Generate -->
                            <div class="form-group">
                              <label for="no_surat" class="col-form-label">No Surat <text class="text-danger"><b>*</b></text></label>
                              <div class="input-group">
                                <?php if($onepmr->id_permintaan == NULL) : ?>
                                  <input id="no_surat" type="text" class="form-control" readonly>
                                  <?php else : ?>
                                    <input name="no_surat" id="no_surat" type="text" class="form-control" value="<?= $onepmr->no_surat?>" readonly>
                                  <?php endif ;?>
                                  <span class="input-group-append">
                                    <button type="button" class="btn btn-primary" id="generatePmr"><i class="fa fa-check text-white"></i>&ensp;Generate</button>
                                  </span>
                                </div>
                                <?= form_error('no_surat', '<small class="text-danger pl-3">', '</small>');?>
                              </div>
                              <!-- / No Surat And Button Generate -->

                              <!-- Tanda Tangan -->
                              <div class="form-group">
                                <label for="spkpTTD" class="col-form-label">Tanda Tangan</label>
                                <select name="ttd" for="spkpTTD" class="form-control select2" style="width: 100%;" >
                                  <option value="" selected>Pilih Tanda Tangan</option>
                                  <?php
                                  foreach ($dosenall as $dosen) {
                                    echo '<option value="'.$dosen->id.'">'.$dosen->nama.'</option>';
                                  }
                                  ;?>
                                </select>
                                <?= form_error('ttd', '<small class="text-danger pl-3">', '</small>');?>
                              </div>
                              <!-- / Tanda Tangan -->

                              <!-- Kode Surat -->
                              <div class="form-group">
                                <label for="spkpKodeSurat" class="col-form-label">Kode Surat</label>
                                <input type="text" name="kodeSurat" class="form-control" id="spkpKodeSurat" placeholder="Kode Surat" value="<?= $onepmr->kd_surat?>" readonly>
                                <?= form_error('kodeSurat', '<small class="text-danger pl-3">', '</small>');?>
                              </div>
                              <!-- / Kode Surat -->

                            </div>

                            <div  class="col-md-6">

                              <!-- Hasil Enkripsi -->
                              <div class="form-group">
                                <label for="spkpHasilEnkripsi" class="col-form-label">Hasil Enkripsi</label>
                                <?php if($onepmr->no_surat == NULL) : ?>
                                  <textarea type="text" class="form-control" id="spkpHasilEnkripsi" placeholder="Hasil Enkripsi" readonly></textarea>
                                  <?php else : ?>
                                    <textarea type="text" class="form-control" id="spkpHasilEnkripsi" placeholder="Hasil Enkripsi" readonly><?= $onepmr->enkripsi?></textarea>
                                  <?php endif ;?>

                                </div>
                                <!-- / Hasil Enkripsi -->

                                <!-- QR COde -->
                                <div class="form-group">
                                  <label for="qrcode" class="col-form-label">QR Code</label>
                                  <div class="input-group">
                                    <?php if($onepmr->no_surat == NULL) : ?>
                                      <img id="qrcode" src="<?= base_url('assets/img/qrcode_sample.png')?>" alt="QRCode" width="150" />
                                      <?php else :?>
                                        <img id="qrcode" src="<?= base_url('assets/img/QRCode/'.str_replace("/", "_",$onepmr->no_surat).'.png')?>" alt="QRCode" width="150"/>
                                      <?php endif ;?>
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
                                    <input type="text" name="namaSurat" class="form-control" id="spkpNamaSurat" placeholder="Nama Surat" value="<?= $onepmr->nm_surat?>" readonly>
                                    <?= form_error('namaSurat', '<small class="text-danger pl-3">', '</small>');?>
                                  </div>
                                  <!-- / Nama Surat -->

                                  <!-- Kepada Yth. Surat Di Ajukan -->
                                  <div class="form-group">
                                    <label for="spkpKepada" class="col-form-label">Kepada Yth.</label>
                                    <textarea type="text" rows="1" name="kepada" class="form-control" id="spkpKepada" placeholder="Kepada Yth." readonly><?= $onepmr->kepada ;?></textarea>
                                    <?= form_error('kepada', '<small class="text-danger pl-3">', '</small>');?>
                                  </div>
                                  <!-- / Kepada Yth. Surat Di Ajukan -->

                                  <!-- Keperluan Surat Di Ajukan -->
                                  <div class="form-group">
                                    <label for="spkpKeperluan" class="col-form-label">Keperluan</label>
                                    <textarea type="text" rows="1" name="keperluan" class="form-control" id="spkpKeperluan" placeholder="Keperluan" readonly><?= $onepmr->keperluan ;?></textarea>
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
                                    <input type="text" name="nim" class="form-control" id="spkpNIM" placeholder="NIM Mahasiswa" value="<?= $onepmr->permintaan_by?>" readonly>
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
                                  <h4 class="card-title" text-align="center"><strong>Surat yang diminta</strong></h4>
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
                                      <textarea  class="form-control textarea" id="spkpHasilSurat" placeholder="Header Surat" rows="10" > 
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

                              
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer justify-content-between">
                                <button type="submit" class="btn btn-primary">Konfirmasi &nbsp;<i class="fas fa-check"></i></button>
                              </div>             
                            </form>
                        </div>
                        <!-- /.card -->
                      </div>
                      <!-- /.container-fluid -->
                    </section>
                    <!-- / Main content -->

                    <?php endif ;?>