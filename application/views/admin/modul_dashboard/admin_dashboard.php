    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Admin</li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin')?>"><?= $page ;?></a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <?php if(validation_errors()) : ?>
          <!-- Row Note -->
          <div class="row">
            <div class="col-12">
              <div class="alert callout callout-info bg-danger" role="alert">
                <h5><i class="fas fa-info"></i> Note:</h5>
                <?= validation_errors(); ?>
              </div>
            </div>
            <!--/. Col -->
          </div>
        <?php endif ;?>
        <?php if($this->session->flashdata('message') == TRUE) : ?>
          <!-- Row Note -->
          <div class="row">
            <div class="col-12">
              <div class="alert callout callout-info bg-danger" role="alert">
                <h5><i class="fas fa-info"></i> Note:</h5>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?= $mhs?></h3>

                <p>Data Mahasiswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
              </div>
              <a href="<?= base_url('admin/dMahasiswa')?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $permintaan?></h3>

                <p>Permintaan Surat</p>
              </div>
              <div class="icon">
                <i class="ion ion-email-unread"></i>
              </div>
              <a href="<?= base_url('admin/sPermintaanSurat')?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $selesai?></h3>

                <p>Surat Selesai</p>
              </div>
              <div class="icon">
                <i class="ion ion-folder"></i>
              </div>
              <a href="<?= base_url('admin/sSuratSelesai')?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-white">
              <div class="inner">
                <h3><?= $surat?></h3>

                <p>List Surat</p>
              </div>
              <div class="icon">
                <i class="ion ion-email"></i>
              </div>
              <a href="<?= base_url('admin/sListSurat')?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">

            <div class="card">
              <div class="card-header ">
                <h3 class="card-title">
                  <i class="far fa-bell mr-1"></i>
                  Permintaan Surat terbaru
                </h3>
                <!-- tools card -->
                <!-- <div class="card-tools"> -->
                  <!-- button with a dropdown -->
                  <!-- <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div> -->
                <!-- /. tools -->
              </div>
              <div class="card-body ">

                <?php foreach($pmrlimit as $pl) :?>
                  <div class="post ">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="<?= base_url('assets/esurat/img/profile/avatar04.png')?>" alt="user image">
                      <span class="username">
                        <a href="#"><?= $pl->nmmhs?></a>
                      </span>
                      <span class="description"><?= $pl->nim;?> - <?= date('d F Y H:i:s', strtotime($pl->permintaan_tgl));?></span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                      <?= $pl->nm_surat ;?>
                    </p>
                  </div>
                <?php endforeach;?>


              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="<?= base_url('admin/sPermintaanSurat')?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">

            <div class="card">
              <div class="card-header ">
                <h3 class="card-title">
                  <i class="far fa-bell mr-1"></i>
                  Surat Telah di Konfirmasi terbaru
                </h3>
                <!-- tools card -->
                <!--<div class="card-tools"> -->
                  <!-- button with a dropdown -->
                  <!-- <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div> -->
                <!-- /. tools -->
              </div>
              <div class="card-body ">

                <?php foreach($slslimit as $row) :?>
                  <div class="post ">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="<?= base_url('assets/esurat/img/profile/avatar04.png')?>" alt="user image">
                      <span class="username">
                        <a href="#"><?= $row->nmmhs?></a>
                      </span>
                      <span class="description"><?= $row->nim;?> - <?= date('d F Y H:i:s', strtotime($row->permintaan_tgl));?></span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                      <?= $row->nm_surat ;?>
                    </p>
                  </div>
                <?php endforeach;?>


              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="<?= base_url('admin/sSuratSelesai')?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

          </section>
          <!-- /.content -->
        </div>

      </section>