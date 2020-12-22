    <!-- Content Header (Page header) -->
    <div class="content-header">
    	<div class="container-fluid">
    		<div class="row mb-2">
    			<div class="col-sm-6">
    				<h1 class="m-0 text-dark"><?= $page ;?> Mahasiswa</h1>
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

        <div class="row">
          <div class="col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Surat Tersedia</span>
                <span class="info-box-number"><?=$countsurat;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        
          <div class="col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pengajuan Surat Pending</span>
				<span class="info-box-number"><?= $countpermintaan; ?></span>
              </div>
			  <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

		  <div class="col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-envelope-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pengajuan Surat Selesai</span>
				<span class="info-box-number"><?= $countselesai; ?></span>
              </div>
			  <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>

			<div class="row">
			<div class="col-md-6">

			<div class="card">
    				<div class="card-header">
    					<h4 class="card-title"><i class="far fa-bell"></i> <strong>Status Surat</strong></h4>
    				</div>
    				<div class="card-body table-responsive">

    					<div>
    						<table class="table table-bordered table-striped">
    							<thead>
    								<tr>
    									<th scope="col">#</th>
    									<th scope="col">Nama Surat</th>
    									<th scope="col">Status Surat</th>
    									<th scope="col">Tanggal Pengajuan</th>

    								</tr>
    							</thead>
    							<tbody>
    								<?php $i=0; foreach ($statussuratlimit as $ssl) :  $i++;?>
    								<tr>
    									<th scope="row"><?= $i ;?></th>
    									<td><?= $ssl->nm_surat; ?></td>
    									<td>
    										<?php if($ssl->status_surat == 'PENDING') {
    											echo '<div class="badge badge-warning">
    											<i class="fa fa-info"></i>&ensp;'.$ssl->status_surat.'
    											</div>';
    										}else{
    											echo '<div class="badge badge-success">
    											<i class="fa fa-check"></i>&ensp;'.$ssl->status_surat.'
    											</div>';
    										}?>
    									</td>
    									<td><?= date('d-m-Y', strtotime($ssl->permintaan_tgl)); ?></td>
    								</tr>
    							<?php endforeach; ?>
    						</tbody>
    					</table>
    				</div>
    				<!-- /.row -->
    			</div>
    			<div class="card-footer">
    				<a href="<?= base_url('mahasiswa/statusSurat')?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-right"></i></a>
    			</div>
    			<!-- /.card-body -->
    		</div>
    		<!-- /.card -->

			</div>
		
			<div class="col-md-6">
			<div class="card">
    					<div class="card-header">
    						<h4 class="card-title"><i class="far fa-envelope"></i> <strong>Surat Tersedia</strong></h4>
    					</div>
    					<div class="card-body table-responsive">

    						<div>
    							<table class="table table-bordered table-striped">
    								<thead>
    									<tr>
    										<th scope="col">#</th>
    										<th scope="col">Kode Surat</th>
    										<th scope="col">Nama Surat</th>

    									</tr>
    								</thead>
    								<tbody>
    									<?php $i=0; foreach ($listsuratlimit as $ls) :  $i++;?>
    									<tr>
    										<th scope="row"><?= $i ;?></th>
    										<td><?= $ls->kd_surat; ?></td>
    										<td><?= $ls->nm_surat; ?></td>

    									</tr>
    								<?php endforeach; ?>
    							</tbody>
    						</table>
    					</div>
    					<!-- /.row -->
    				</div>
    				<div class="card-footer">
    					<a href="<?= base_url('mahasiswa/pengajuanSurat')?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-right"></i></a>
    				</div> 
    				<!-- /.card-body -->
    			</div>
    			<!-- /.card -->
			</div>
			
			</div>
</div><!-- /.container-fluid -->
</section>
    <!-- /.content -->