    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin')?>">Mahasiswa</a></li>
              <li class="breadcrumb-item active"><?= $page ;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <?php if(validation_errors()) : ?>
          <!-- Row Perhatian -->
          <div class="row">
            <div class="col-12">
              <div class="alert callout callout-danger mt-2" role="alert">
                <h5><i class="fas fa-info"></i> Perhatian:</h5>
                <?php echo validation_errors(); ?>
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
                <?php echo $this->session->flashdata('message'); ?>
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
          <a href="<?php echo base_url('mahasiswa');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 col-md-12  order-2 order-md-1">

                    <div class="row">
                      <div class="col-12">
                        <h4>Notifikasi Terbaru</h4>

                        <?php if($allnotif == NULL) :?>
                          <div class="post clearfix">

                            <p>
                            Notifikasi Tidak Ditemukan
                           </p>
                         </div>
                         <?php else :?>


                          <?php foreach ($allnotif as $row): ?>
                            <?php if($row->comment_surat == 'Y') : ?>

                              <div class="post clearfix">

                                <span class="username">
                                  <p class="text-success"><?= $row->comment_subject?></p>
                                </span>
                                <span class="description">Surat Dikonfimasi pada Tanggal <?= $row->comment_date?></span>

                                <p>
                                  <?= $row->comment_text?>
                                </p>
                              </div>

                              <?php else : ?>

                                <div class="post clearfix">

                                  <span class="username">
                                    <p class="text-danger"><?= $row->comment_subject?></p>
                                  </span>
                                  <span class="description">Surat Di Tolak pada Tanggal <?= $row->comment_date?></span>

                                  <p>
                                    <?= $row->comment_text?>
                                  </p>
                                </div>

                              <?php endif;?>

                            <?php endforeach;?>
                            
                          <?php endif;?>


                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>

          </section>
    <!-- /.content -->