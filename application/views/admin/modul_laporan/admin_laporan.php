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

        <!-- Row Form Select Tabel -->
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
              <a href="<?php echo base_url('admin');?>">
              <i class="fas fa-arrow-left"></i>&ensp;Kembali
            </a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="<?php echo base_url('admin/laporan')?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Status Surat</label>
                    <select name="status" class="form-control" value="<?= set_value('status');?>">
                      <option value="<?= set_value('status');?>">Pilih Status Surat</option>
                      <option value="PENDING">Surat Pending</option>
                      <option value="CONFIRM">Surat Selesai</option>
                    </select>
                    <?php echo form_error('status', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">NIM</label>
                    <select name="permintaan_by" class="form-control select2">
                      <option value="">Ketik Nama / NIM</option>
                      <?php
                      foreach ($nimlaporan as $row) {
                        echo '<option value="'.$row->nim.'">'.$row->nim. '/' .$row->nmmhs.'</option>';
                      }
                      ?>

                    </select>
                    <text class="text-info"><small>*Biarkan Kosong Jika Ingin menampilkan Semuanya</small></text>
                    <?php echo form_error('permintaan_by', '<small class="text-danger pl-3">', '</small>');?>
                  </div>
                  <div class="form-group">
                    <label>Periode:</label>
                    <div class="row">
                      <div class="col-md-5">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="datetime-local" name="awalPeriode" class="form-control" id="reservation" value="<?= set_value('awalPeriode');?>">
                          
                        </div>
                        <?php echo form_error('awalPeriode', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                      <div class=" text-center" style="width:  60px;">
                        <p  class="form-control">S.D</p>
                      </div>
                      <div class="col-md-5">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="datetime-local" name="akhirPeriode" class="form-control" id="akhir" value="<?= set_value('akhirPeriode');?>">

                        </div>
                        <?php echo form_error('akhirPeriode', '<small class="text-danger pl-3">', '</small>');?>
                      </div>

                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer justify-content-between">
                <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i>&ensp;Submit</button>
                  <a class="btn btn-secondary" href="<?php echo base_url('admin/laporan');?>"><i class="fas fa-times"></i>&ensp;Reset</a>
                  
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-12">
            <?php 
            $status = $this->input->post('status');
            $nim = $this->input->post('permintaan_by');
            $awal = $this->input->post('awalPeriode');
            $akhir = $this->input->post('akhirPeriode');

            switch ($status) {

              case 'PENDING':

              if($hasil == NULL){

                $out = '<div class="card">
                <div class="card-header">
                <h4 class="card-title" text-align="center"><strong>Surat pending</strong></h4>
                </div>
                <div class="card-body">
                Data Yang Anda inginkan Tidak Ada
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->';

              }else{

                $out = '<div class="card">
                <div class="card-header">
                <h3 class="card-title mt-2">
                <i class="fas fa-th mr-1"></i>';
                $out .= 'Permintaan Surat';
                $out .= '</h3>
                <div class="btn-group float-right">
                <div class="row">
                <form action="'. base_url('admin/laporanpdf').'" method="post" target="blank" >
                <input type="hidden" readonly value="permintaanSurat" name="status" class="form-control" >
                <input type="hidden" readonly value ="'.set_value('permintaan_by').'" name="b" class="form-control" >
                <input type="hidden" readonly value ="'.set_value('awalPeriode').'" name="c" class="form-control" >
                <input type="hidden" readonly value ="'.set_value('akhirPeriode').'" name="d" class="form-control" >
                <button type="submit" class="btn btn-sm btn-info float-right"><i class="fas fa-file-pdf"></i>&ensp;Export Pdf</button>
                </form>
                &ensp;
                </div>


                </div>
                </div>
                <div class="card-body">
                <div>
                <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">No Surat</th>
                <th scope="col">Jenis Surat</th>
                <th scope="col">Pengajuan By</th>
                <th scope="col">Tanggal Pengajuan</th>
                </tr>
                </thead>
                <tbody>';
                $i=0; foreach($hasil as $lap): $i++;
                $out .='<tr>';
                $out .='<th scope="row">' .$i.'</th>';                
                $out .='<td>'. $lap->no_surat .'</td>';
                $out .='<td>' .$lap->nm_surat. '</td>';
                $out .='<td>' .$lap->permintaan_by. '</td>';
                $out .='<td>' . date('d F Y', strtotime($lap->permintaan_tgl)). '</td>';
                $out .='</tr>';
              endforeach;

              $out .= '</tbody>
              </table>
              </div>
              <!-- /.row -->
              </div>
              <!-- /.card-body -->
              </div>
              <!-- /.card -->';

            }

            break;

            case 'CONFIRM':

            if($hasil == NULL){

              $out = '<div class="card">
              <div class="card-header">
              <h4 class="card-title " text-align="center"><strong>Surat Selesai</strong></h4>
              </div>
              <div class="card-body">
              Data Yang Anda inginkan Tidak Ada
              </div>
              <!-- /.card-body -->
              </div>
              <!-- /.card -->';

            }else{
              $out = '<div class="card">
              <div class="card-header">
              <h3 class="card-title mt-2">
              <i class="fas fa-th mr-1"></i>';
              $out .= 'Surat Selesai';
              $out .= '</h3>
              <div class="btn-group float-right">
              <div class="row">
              <form action="'. base_url('admin/laporanpdf').'" method="post" target="blank" >
              <input type="hidden" readonly value="suratSelesai" name="status" class="form-control" >
              <input type="hidden" readonly value ="'.set_value('permintaan_by').'" name="b" class="form-control" >
              <input type="hidden" readonly value ="'.set_value('awalPeriode').'" name="c" class="form-control" >
              <input type="hidden" readonly value ="'.set_value('akhirPeriode').'" name="d" class="form-control" >
              <button type="submit" class="btn btn-sm btn-danger float-right"><i class="fas fa-file-pdf"></i>&ensp;Export Pdf</button>
              </form>
              &ensp;

              </div>


              </div>
              </div>
              <div class="card-body">
              <div>
              <table id="example" class="table table-bordered table-striped">
              <thead>
              <tr>
              <th scope="col">#</th>
              <th scope="col">No Surat</th>
              <th scope="col">Jenis Surat</th>
              <th scope="col">Pengajuan By</th>
              <th scope="col">Tanggal Pengajuan</th>
              <th scope="col">Action</th>
              </tr>
              </thead>
              <tbody>';
              $i=0; foreach($hasil as $lap): $i++;
              $out .='<tr>';
              $out .='<th scope="row">' .$i.'</th>';                
              $out .='<td>'. $lap->no_surat .'</td>';
              $out .='<td>' .$lap->nm_surat. '</td>';
              $out .='<td>' .$lap->permintaan_by. '</td>';
              $out .='<td>' . date('d F Y', strtotime($lap->permintaan_tgl)). '</td>';
              $out .='<td>'. $lap->no_surat .'</td>';
              $out .='</tr>';
            endforeach;

            $out .= '</tbody>
            </table>
            </div>
            <!-- /.row -->
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->';
          }

          break;

          default:
          $out = '
          <div class="row">
          <div class="col-12">
          <div class="callout callout-warning bg-warning">
          <h5><i class="fas fa-info"></i> Perhatian:</h5>
          Silahkan Melengkapi Form Untuk Menampilkan Data yang di inginkan
          </div>
          </div>
          <!--/. Col -->
          </div>
          <!--/. Row -->
          ';
          break;

        };

        echo $out;
        ?>
      </div>
    </div>
    <!-- Default box -->

  </section>
<!-- /.content -->