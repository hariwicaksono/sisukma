<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Prints extends CI_Controller {

	public function __construct(){
		parent::__construct();

		//untuk mengatasi error confirm form resubmission
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('admin_model');
		$this->load->model('mahasiswa_model');
		$this->load->model('pengajuan_model');
	}


	public function printSurat($id_selesai = null, $kd_surat = null){

		if($this->session->userdata('username') == TRUE){

			$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

			/*-- Encrypt URL Kdpro --*/
			if (count($this->uri->segment_array()) > 4) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('Admin/sSuratSelesai');
			}

			if (!isset($id_selesai) || !isset($kd_surat)) {
				$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
				redirect('Admin/sSuratSelesai');
			}

			if (is_numeric($id_selesai) || is_numeric($kd_surat)) {
				$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
				redirect('Admin/sSuratSelesai');
			}

			/*----- Silahkan Memasukkan Kode Surat jika ada Kode Surat Baru -----*/

			if ( !in_array($this->encrypt->decode($kd_surat), ['SP-KP'], true ) ) {
				$this->toastr->error('Kode Surat Yang Anda Inginkan Tidak terdaftar');
				redirect('admin/sPermintaanSurat');
			}

			if(!is_numeric($this->encrypt->decode($id_selesai))){
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('Admin/sPermintaanSurat');
			}

		}else{

			$data['user'] = $this->db->get_where('tb_mhs',['nim' => $this->session->userdata('nim')])->row();

			/*-- Encrypt URL Kdpro --*/
			if (count($this->uri->segment_array()) > 4) {
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/statusSurat');
			}

			if (!isset($id_selesai) || !isset($kd_surat)) {
				$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
				redirect('mahasiswa/statusSurat');
			}

			if (is_numeric($id_selesai) || is_numeric($kd_surat)) {
				$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
				redirect('mahasiswa/statusSurat');
			}

			/*----- Silahkan Memasukkan Kode Surat jika ada Kode Surat Baru -----*/

			if ( !in_array($this->encrypt->decode($kd_surat), ['SP-KP'], true ) ) {
				$this->toastr->error('Kode Surat Yang Anda Inginkan Tidak terdaftar');
				redirect('mahasiswa/statusSurat');
			}

			if(!is_numeric($this->encrypt->decode($id_selesai))){
				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/statusSurat');
			}

		}

		/*-- Mendecode $id_selesai & $kd_surat --*/	
		$id_selesai = $this->encrypt->decode($id_selesai);
		$kd_surat = $this->encrypt->decode($kd_surat);

		/*-- Mengambil data One Selesai berdasarkan id_selesai --*/
		$data['onesls'] = $this->admin_model->getOneSls($id_selesai);
		/*-- Load One Data Dosen --*/
		$data['onedos'] = $this->admin_model->getOneDosen($this->admin_model->getOneSls($id_selesai)->ttd);
		/*-- Load One Data Mahasiswa Pada Input --*/
		$data['onemhs'] = $this->admin_model->getOneMhs($this->admin_model->getOneSls($id_selesai)->permintaan_by);
		/*-- Load One Data Prodi Pada Input --*/
		$data['onepro'] = $this->admin_model->getOneProdi($this->admin_model->getOneSls($id_selesai)->permintaan_kdpro);
		/*-- Menentukan Id_selesai & Kode Surat --*/
		$selesai = $this->db->get_where('tb_selesai',['id_selesai' => $id_selesai])->row();
		/*-- Load One Data Mahasiswa Pada Hasil Surat --*/
		$mahasiswa = $this->admin_model->getOneMhs($this->admin_model->getOneSls($id_selesai)->permintaan_by);
		/*-- Load One Data Dosen Pada Hasil Surat --*/
		$dosen = $this->admin_model->getOneDosen($this->admin_model->getOneSls($id_selesai)->dosen);
		/*-- Load One Data Prodi Pada Hasil Surat --*/
		$prodi = $this->admin_model->getOneProdi($this->admin_model->getOneSls($id_selesai)->permintaan_kdpro);


		if($selesai->id_selesai == $id_selesai && $selesai->kd_surat == $kd_surat){


			switch ($selesai->kd_surat) {
				case 'SP-KP':

				$komponenSurat = [

					'bulan' => bulan_romawi(date('Y-m-d')),
					'tahun' => date('Y'),
					'kepada' => $this->admin_model->getOneSls($id_selesai)->kepada,
					'nama_mhs' => $mahasiswa->nmmhs,
					'nim_mhs' => $mahasiswa->nim,
					'angkatan_mhs' => semester($mahasiswa->thaka),
					'prodi_mhs' => $prodi->prodi,
					'dosen' => $dosen->nama,
					'dosen_jabatan' => $dosen->jabatan,
					'no_surat' => $this->admin_model->getOneSls($id_selesai)->no_surat,
					'disetujui_tgl' => date_indo($this->admin_model->getOneSls($id_selesai)->disetujui_tgl),
					'jabatan' => $dosen->jabatan,
					'ttd' => $dosen->nama,
					'nip' => $dosen->nip

				];

				$data['isi'] = $this->admin_model->getOneSls($id_selesai)->isi_surat;
				$data['komponen'] = $komponenSurat;
				$data['jenis'] = $selesai->nm_surat;
				$data['no_surat'] = $selesai->no_surat;
				$this->load->view('print/SP-KP_print', $data);

				break;

				default:

    				# code...

				break;
			}

		}else{

			if($this->session->userdata('username') == TRUE){

				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('admin/sPermintaanSurat');

			}else{

				$this->toastr->error('Url Yang Anda Masukkan Salah');
				redirect('mahasiswa/pengajuanSurat');

			}

		}

		
	}


}