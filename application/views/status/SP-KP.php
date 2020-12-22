    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">

            <?php if($status == 'PENDING') : ?>

              <!----------------------------------------------------------------------------------------->
              <!------------------------- Tampilan Ketika Surat Masih "PENDING" ------------------------->
              <!----------------------------------------------------------------------------------------->

              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa')?>">Mahasiswa</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa/statusSurat')?>"><?= $parent ;?></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('status/statusDetail/'.$this->encrypt->encode($onestatus->status_surat).'/'.$this->encrypt->encode($onestatus->id_permintaan).'/'.$this->encrypt->encode($onestatus->kd_surat))?>"><?= $page ;?></a></li>
              </ol>

              <?php elseif($status == 'CONFIRM') : ?>

                <!----------------------------------------------------------------------------------------->
                <!------------------------- Tampilan Ketika Surat Masih "CONFIRM" ------------------------->
                <!----------------------------------------------------------------------------------------->

                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa')?>">Mahasiswa</a></li>
                  <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa/statusSurat')?>"><?= $parent ;?></a></li>
                  <li class="breadcrumb-item"><a href="<?= base_url('status/statusDetail/'.$this->encrypt->encode($onestatus->status_surat).'/'.$this->encrypt->encode($onestatus->id_selesai).'/'.$this->encrypt->encode($onestatus->kd_surat))?>"><?= $page ;?></a></li>
                </ol>

              <?php endif ;?>

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

      <?php if($status == 'PENDING') : ?>

        <!----------------------------------------------------------------------------------------->
        <!------------------------- Tampilan Ketika Surat Masih "PENDING" ------------------------->
        <!----------------------------------------------------------------------------------------->

        <!-- Main content -->
        <section class="content">

          <div class="container-fluid">
            <div class="callout callout-danger">
              <h5><i class="fas fa-bullhorn"></i> Status Surat!</h5>

              <p>Mohon Maaf Surat Yang Anda Ajukan Masih Dalam Proses Konfirmasi</p>
            </div>

            <div>

              <!-- Default box -->
              <div class="card">
                <div class="card-header">
                <a href="<?php echo base_url('mahasiswa/statusSurat');?>">
                        <i class="fas fa-arrow-left"></i>&ensp;Kembali
                      </a>
                </div>
                <div class="card-body">
                  <form action="#" method="post">
                    <div class="row">
                      <!-- col-md-6 -->
                      <div class="col-md-6">

                        <!-- Kode Surat -->
                        <div class="form-group">
                          <label for="spkpKodeSurat" class="col-form-label">Kode Surat</label>
                          <input type="text" name="kodeSurat" class="form-control" id="spkpKodeSurat" placeholder="Kode Surat" value="<?= $onestatus->kd_surat?>" readonly>
                        </div>
                        <!-- / Kode Surat -->

                        <!-- Nama Surat -->
                        <div class="form-group">
                          <label for="spkpNamaSurat" class="col-form-label">Nama Surat</label>
                          <input type="text" name="namaSurat" class="form-control" id="spkpNamaSurat" placeholder="Nama Surat" value="<?= $onestatus->nm_surat?>" readonly>
                        </div>
                        <!-- / Nama Surat -->

                        <!-- Kepada Yth. Surat Di Ajukan -->
                        <div class="form-group">
                          <label for="spkpKepada" class="col-form-label">Kepada Yth.</label>
                          <textarea type="text" rows="1" name="kepada" class="form-control" id="spkpKepada" placeholder="Kepada Yth." readonly><?= $onestatus->kepada;?></textarea>
                        </div>
                        <!-- / Kepada Yth. Surat Di Ajukan -->

                        <!-- Kepada Yth. Surat Di Ajukan -->
                        <div class="form-group">
                          <label for="spkpKeperluan" class="col-form-label">Keperluan</label>
                          <textarea type="text" rows="1" name="keperluan" class="form-control" id="spkpKeperluan" placeholder="Keperluan" readonly><?= $onestatus->keperluan;?></textarea>
                        </div>
                        <!-- / Kepada Yth. Surat Di Ajukan -->

                        <!-- Dosen -->
                        <div class="form-group">
                          <label for="spkpDosen" class="col-form-label">Dosen</label>
                          <input type="text" name="dosen" class="form-control" id="spkpDosen" placeholder="Dosen" value="<?= $onedosen->nama?>" readonly>
                        </div>
                        <!-- / Dosen -->

                      </div>
                      <!-- / col-md-6 -->

                      <!-- col-md-6 -->
                      <div class="col-md-6">

                        <!-- NIM Mahasiswa YAng Mengajukan Surat -->
                        <div class="form-group">
                          <label for="spkpNIM" class="col-form-label">NIM Mahasiswa</label>
                          <input type="text" name="nim" class="form-control" id="spkpNIM" placeholder="NIM Mahasiswa" value="<?= $onestatus->permintaan_by?>" readonly>
                          <?= form_error('nim', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <!-- / NIM Mahasiswa YAng Mengajukan Surat -->

                        <!-- Nama Mahasiswa YAng Mengajukan Surat -->
                        <div class="form-group">
                          <label for="spkpNama" class="col-form-label">Nama Mahasiswa</label>
                          <input type="text" class="form-control" id="spkpNama" placeholder="Nama Mahasiswa" value="<?= $onemhs->nmmhs?>" readonly>
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
                    <hr>
                    <div class="form-group justify-content-between">
                      <button type="submit" class="btn btn-default btn-sm float-right disabled">Cetak&ensp;<i class="fas fa-print text-danger"></i></button>
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

          <?php elseif($status == 'CONFIRM') : ?>

            <!----------------------------------------------------------------------------------------->
            <!------------------------- Tampilan Ketika Surat Masih "CONFIRM" ------------------------->
            <!----------------------------------------------------------------------------------------->

            <!-- Main content -->
            <section class="content">

              <div class="container-fluid">
                <div class="callout callout-success">
                  <h5><i class="fas fa-bullhorn"></i> Status Surat!</h5>
                  <p>Selamat Surat Yang Anda Ajukan Telah di Konfirmasi</p>
                </div>

                <div>

                  <!-- Default box -->
                  <div class="card">
                    <div class="card-header">
                    <a href="<?php echo base_url('mahasiswa/statusSurat');?>">
                        <i class="fas fa-arrow-left"></i>&ensp;Kembali
                      </a>
                    </div>
                    <div class="card-body">
                      <form action="#" method="post">
                        <div class="row">
                          <!-- col-md-6 -->
                          <div class="col-md-6">

                            <!-- Kode Surat -->
                            <div class="form-group">
                              <label for="spkpKodeSurat" class="col-form-label">Kode Surat</label>
                              <input type="text" name="kodeSurat" class="form-control" id="spkpKodeSurat" placeholder="Kode Surat" value="<?= $onestatus->kd_surat?>" readonly>
                            </div>
                            <!-- / Kode Surat -->

                            <!-- Nama Surat -->
                            <div class="form-group">
                              <label for="spkpNamaSurat" class="col-form-label">Nama Surat</label>
                              <input type="text" name="namaSurat" class="form-control" id="spkpNamaSurat" placeholder="Nama Surat" value="<?= $onestatus->nm_surat?>" readonly>
                            </div>
                            <!-- / Nama Surat -->

                            <!-- Kepada Yth. Surat Di Ajukan -->
                            <div class="form-group">
                              <label for="spkpKepada" class="col-form-label">Kepada Yth.</label>
                              <textarea type="text" rows="1" name="kepada" class="form-control" id="spkpKepada" placeholder="Kepada Yth." readonly><?= $onestatus->kepada;?></textarea>
                            </div>
                            <!-- / Kepada Yth. Surat Di Ajukan -->

                            <!-- Kepada Yth. Surat Di Ajukan -->
                            <div class="form-group">
                              <label for="spkpKeperluan" class="col-form-label">Keperluan</label>
                              <textarea type="text" rows="1" name="keperluan" class="form-control" id="spkpKeperluan" placeholder="Keperluan" readonly><?= $onestatus->keperluan;?></textarea>
                            </div>
                            <!-- / Kepada Yth. Surat Di Ajukan -->

                            <!-- Dosen -->
                            <div class="form-group">
                              <label for="spkpDosen" class="col-form-label">Dosen</label>
                              <input type="text" name="dosen" class="form-control" id="spkpDosen" placeholder="Dosen" value="<?= $onedosen->nama?>" readonly>
                            </div>
                            <!-- / Dosen -->

                          </div>
                          <!-- / col-md-6 -->

                          <!-- col-md-6 -->
                          <div class="col-md-6">

                            <!-- NIM Mahasiswa YAng Mengajukan Surat -->
                            <div class="form-group">
                              <label for="spkpNIM" class="col-form-label">NIM Mahasiswa</label>
                              <input type="text" name="nim" class="form-control" id="spkpNIM" placeholder="NIM Mahasiswa" value="<?= $onestatus->permintaan_by?>" readonly>
                              <?= form_error('nim', '<small class="text-danger pl-3">', '</small>');?>
                            </div>
                            <!-- / NIM Mahasiswa YAng Mengajukan Surat -->

                            <!-- Nama Mahasiswa YAng Mengajukan Surat -->
                            <div class="form-group">
                              <label for="spkpNama" class="col-form-label">Nama Mahasiswa</label>
                              <input type="text" class="form-control" id="spkpNama" placeholder="Nama Mahasiswa" value="<?= $onemhs->nmmhs?>" readonly>
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
                        <hr>
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer justify-content-between">
                          <a class="btn btn-default" href="<?= base_url('Prints/printSurat/'.$this->encrypt->encode($onestatus->id_selesai).'/'.$this->encrypt->encode($onestatus->kd_surat))?>" target="blank">Cetak&ensp;<i class="fas fa-print text-primary"></i></a>
                        </div>             
                      </form>
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.container-fluid -->
              </section>
              <!-- / Main content -->

              <?php endif;?>