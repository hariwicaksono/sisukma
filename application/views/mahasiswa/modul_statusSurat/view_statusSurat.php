    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $page ;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('mahasiswa')?>">Mahasiswa</a></li>
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
          </div>
          <div class="card-body table-responsive">

            <div>
              <table id="example" class="table table-bordered table-striped nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">No Surat</th>
                    <th scope="col">Jenis Surat</th>
                    <th scope="col">Tanggal Pengajuan</th>
                    <th scope="col">Status Surat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; foreach ($allstatus as $als) :  $i++;?>
                  <tr>
                    <th scope="row"><?= $i ;?></th>
                    <td>
                      <?php if($als->no_surat == NULL) {
                        echo'Unknown';
                      }else{
                        echo $als->no_surat;
                      };?>
                    </td>
                    <td><?= $als->nm_surat; ?></td>
                    <td><?= date('d F Y', strtotime($als->permintaan_tgl)); ?></td>
                    <td>
                      <?php if($als->status_surat == 'PENDING') {
                        echo '
                        <div class="badge badge-warning"><i class="fa fa-info"></i>&ensp;'.$als->status_surat.'</div>
                        ';
                      }else{
                        echo '
                        <div class="badge badge-success" ><i class="fa fa-check"></i>&ensp;'.$als->status_surat.'</div>
                        ';
                      }?>
                    </td>
                    <td>
                      <?php if($als->status_surat == 'PENDING') : ?>
                        <a style="margin-right:10px" href="<?= base_url('status/statusDetail/'.$this->encrypt->encode($als->status_surat).'/'.$this->encrypt->encode($als->id_selesai).'/'.$this->encrypt->encode($als->kd_surat).'');?>"><i class="fas fa-eye text-primary"></i></a>
                        <a style="margin-right:10px" target="blank" title="Print"><i class="fas fa-print text-warning btn-sm"></i></a>
                        <?php else : ?>
                          <a style="margin-right:10px" href="<?= base_url('status/statusDetail/'.$this->encrypt->encode($als->status_surat).'/'.$this->encrypt->encode($als->id_selesai).'/'.$this->encrypt->encode($als->kd_surat).'');?>"><i class="fas fa-eye text-primary"></i></a>
                          <a style="margin-right:10px" href="<?= base_url('Prints/printSurat/'.$this->encrypt->encode($als->id_selesai).'/'.$this->encrypt->encode($als->kd_surat))?>" target="_blank" title="Print"><i class="fas fa-print text-warning"></i></a>
                        <?php endif;?>
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

    </section>