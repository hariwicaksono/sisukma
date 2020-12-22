<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Status extends CI_Controller {

	public function __construct(){

		parent::__construct();
		/*-- Check Session  --*/
		is_mhs();

		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('admin_model');

	}

	public function statusDetail($status = null, $id = null, $kd_surat = null){

		$data['user'] = $this->db->get_where('tb_mhs',['nim' => $this->session->userdata('nim')])->row();


		if (count($this->uri->segment_array()) > 5) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('mahasiswa/statusSurat');
		}

		if (!isset($status) || !isset($id) || !isset($kd_surat)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('mahasiswa/statusSurat');
		}

		if (is_numeric($status)||is_numeric($id) || is_numeric($kd_surat)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('mahasiswa/statusSurat');
		}

		/*----- Silahkan Memasukkan Kode Surat jika ada Kode Surat Baru -----*/

		if ( !in_array($this->encrypt->decode($kd_surat), ['SP-KP'], true ) ) {
			$this->toastr->error('Kode Surat Yang Anda Inginkan Tidak terdaftar');
			redirect('mahasiswa/statusSurat');
		}


		if(!is_numeric($this->encrypt->decode($id))){
			$this->toastr->error('Url Yang Anda Masukkan Tidak Memmpunyai ID');
			redirect('mahasiswa/statusSurat');
		}

		if ( !in_array($this->encrypt->decode($status), ['PENDING','CONFIRM'], true ) ) {
			$this->toastr->error('Status Surat Error');
			redirect('mahasiswa/statusSurat');
		}

		// /*-- Menentukan Id_permintaan & Kode Surat --*/
		// $pending = $this->db->get_where('tb_permintaan',['id_permintaan' => $id])->row();

		// /*-- Menentukan Id_selesai & Kode Surat --*/
		// $confirm = $this->db->get_where('tb_selesai',['id_selesai' => $id])->row();

		$status = $this->encrypt->decode($status);
		$id = $this->encrypt->decode($id);
		$kd_surat = $this->encrypt->decode($kd_surat);

		$mhs = $this->db->get_where('tb_mhs',['nim' => $this->session->userdata('nim')])->row();

		if($status == 'PENDING'){
			$query = "SELECT * FROM tb_permintaan WHERE id_permintaan = '".$id."'";

			$data['onedosen'] = $this->admin_model->getOneDosen($this->admin_model->getOnePmr($id)->dosen);
			$data['onepro'] = $this->admin_model->getOneProdi($this->admin_model->getOnePmr($id)->permintaan_kdpro);
			$data['onemhs'] = $this->admin_model->getOneMhs($this->admin_model->getOnePmr($id)->permintaan_by);


		}elseif($status == 'CONFIRM'){

			$query = "SELECT * FROM tb_selesai WHERE id_selesai = '".$id."'";

			$data['onedosen'] = $this->admin_model->getOneDosen($this->admin_model->getOneSls($id)->dosen);
			$data['onepro'] = $this->admin_model->getOneProdi($this->admin_model->getOneSls($id)->permintaan_kdpro);
			$data['onemhs'] = $this->admin_model->getOneMhs($this->admin_model->getOneSls($id)->permintaan_by);

		}

		$result = $this->db->query($query)->row();

		/*-- Load One Data Surat untuk View --*/
		$data['onestatus'] = $result;

		$kodeIDSurat = $this->db->get_where('tb_surat',['kd_surat' => $this->db->escape_str($kd_surat)])->row();


		if($status == 'PENDING'){

			if($id == $result->id_permintaan && $kd_surat == $result->kd_surat){

				switch ($kodeIDSurat->kd_surat) {
					case 'SP-KP':

					$data['status'] = $status;
					$data['title'] = "Mahasiswa | Status Surat";
					$data['parent'] = "Status Surat";
					$data['page'] = $kodeIDSurat->nm_surat;
					$this->template->load('mahasiswa/layout/view_template','status/SP-KP',$data);
					break;

					default:
		# code...
					break;
				}


			}else{

				$this->toastr->error('Url Yang Anda Inginkan Tidak Ada');
				redirect('mahasiswa/statusSurat');

			}


		}elseif($status == 'CONFIRM'){

			if($id == $result->id_selesai && $kd_surat == $result->kd_surat){

				switch ($kodeIDSurat->kd_surat) {
					case 'SP-KP':

					$data['status'] = $status;
					$data['title'] = "Mahasiswa | Status Surat";
					$data['parent'] = "Status Surat";
					$data['page'] = $kodeIDSurat->nm_surat;
					$this->template->load('mahasiswa/layout/view_template','status/SP-KP',$data);
					break;

					default:
		# code...
					break;
				}

				

			}else{

				$this->toastr->error('Url Yang Anda Inginkan Tidak Ada');
				redirect('mahasiswa/statusSurat');

			}

		}else{

			$this->toastr->error('Surat Yang Anda Inginkan Tidak Ada');
			redirect('mahasiswa/statusSurat');
		}

	}

}