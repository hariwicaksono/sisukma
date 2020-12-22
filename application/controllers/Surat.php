<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('surat_model');
	}


	public function home($enkripsi = null){

		if (count($this->uri->segment_array()) > 3) {
			$this->session->set_flashdata('message','URL Yang Anda Masukkan Salah');
			redirect('auth');
		}
		
		$query = "SELECT * FROM tb_selesai WHERE enkripsi = '".$enkripsi."'";
		if($this->db->query($query)->num_rows() <= 0 ){
			$this->session->set_flashdata('message','Surat Yang Anda Inginkan Tidak Ada');
			redirect('auth');
		}

		if (!isset($enkripsi)) {
			$this->session->set_flashdata('message','Surat Yang Anda Inginkan Tidak Ada');
			redirect('auth');
		}

		/*-- Load One Data Permintaan Pada Input --*/
		$data['oneSurat'] = $this->surat_model->getOneSurat($enkripsi);
		$surat = $this->surat_model->getOneSurat($enkripsi);

		/*-- Load One Data Dosen Pada Input --*/
		$data['onedos'] = $this->admin_model->getOneDosen($surat->dosen);
		/*-- Load One Data Mahasiswa Pada Input --*/
		$data['onemhs'] = $this->admin_model->getOneMhs($surat->permintaan_by);
		/*-- Load One Data Prodi Pada Input --*/
		$data['onepro'] = $this->admin_model->getOneProdi($surat->permintaan_kdpro);

		/*-- Load One Data Mahasiswa Pada Hasil Surat --*/
		$mahasiswa = $this->admin_model->getOneMhs($surat->permintaan_by);
		/*-- Load One Data Dosen Pada Hasil Surat --*/
		$dosen = $this->admin_model->getOneDosen($surat->dosen);
		/*-- Load One Data Prodi Pada Hasil Surat --*/
		$prodi = $this->admin_model->getOneProdi($surat->permintaan_kdpro);

		/*-- Load Semua Data Dosen Pada Input --*/
		$data['dosenall'] = $this->admin_model->getDosen();

		switch ($surat->kd_surat) {
			case 'SP-KP':

			$komponenSurat = [

				'bulan' => bulan_romawi(date('Y-m-d')),
				'tahun' => date('Y'),
				'kepada' => $surat->kepada,
				'nama_mhs' => $mahasiswa->nmmhs,
				'nim_mhs' => $mahasiswa->nim,
				'angkatan_mhs' => semester($mahasiswa->thaka),
				'prodi_mhs' => $prodi->prodi,
				'dosen' => $dosen->nama,
				'dosen_jabatan' => $dosen->jabatan,
				'no_surat' => $surat->no_surat,
				'disetujui_tgl' => date_indo($surat->disetujui_tgl),
				'jabatan' => $dosen->jabatan,
				'ttd' => $dosen->nama,
				'nip' => $dosen->nip

			];

			$data['isi'] = $surat->isi_surat;
			$data['komponen'] = $komponenSurat;

			$data['title'] = "Detail Surat";
			$this->template->load('surat/layout/surat_template','surat/SP-KP',$data);
			break;
			
			default:
		# code...
			break;
		}

	}

}