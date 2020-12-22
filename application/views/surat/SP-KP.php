	<!-- Masthead-->
	<header class="masthead">
		<div class="container h-100">
			<div class="row h-100 align-items-center justify-content-center text-center">
				<div class="col-lg-10 align-self-end">
					<h1 class="text-uppercase text-white font-weight-bold">Surat</h1>
					<hr class="divider my-4" />
				</div>
				<div class="col-lg-8 align-self-baseline">
					<p class="text-white-75 font-weight-light">Nama Surat : <?= $oneSurat->nm_surat?></p>
					<p class="text-white-75 font-weight-light">Diajukan Oleh : <?= $onemhs->nmmhs?></p>
					<p class="text-white-75 font-weight-light">Dengan NIM : <?= $oneSurat->permintaan_by?></p>
					<p class="text-white-75 font-weight-light">Pada Tanggal : <?= date('d F Y, h:i:s' ,strtotime($oneSurat->permintaan_tgl))?></p>
				</div>
			</div>
		</div>
	</header>
	<!-- About-->
	<section class="page-section" id="about">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9">
					<?= $this->parser->parse_string($isi, $komponen, TRUE);
					?>
				</div>
			</div>
		</div>
	</section>