<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct(){
		parent::__construct();
		is_mhs();
		//untuk mengatasi error confirm form resubmission
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('mahasiswa_model');
	}
	
	public function index(){

		$data['user'] = $this->db->get_where('tb_mhs',['nim' => $this->session->userdata('nim')])->row();
		$data['listsuratlimit'] = $this->mahasiswa_model->getListSuratHome(); //Load List Surat
		$data['statussuratlimit'] = $this->mahasiswa_model->getStatusSuratHome($this->db->get_where('tb_mhs',['nim' => $this->session->userdata('nim')])->row()->nim); //Load Status Surat by nim
		$data['countsurat'] = $this->mahasiswa_model->getCountSuratMhs();
		$data['countpermintaan'] = $this->mahasiswa_model->getCountSuratPermintaan($this->session->userdata('nim'));
		$data['countselesai'] = $this->mahasiswa_model->getCountSuratSelesai($this->session->userdata('nim'));

		$data['title'] = "Mahasiswa | Home";
		$data['parent'] = "Home";
		$data['page'] = "Home";
		$this->template->load('mahasiswa/layout/view_template','mahasiswa/modul_home/view_home',$data);
	}


	public function profile(){

		$data['user'] = $this->db->get_where('tb_mhs',['nim' => $this->session->userdata('nim')])->row();
		$data['prodi'] = $this->mahasiswa_model->getProdi(); /*-- Load Semua Data Prodi --*/
		$data['title'] = "Mahasiswa | Profile";
		$data['parent'] = "Profile";	
		$data['page'] = "Profile";
		$this->template->load('mahasiswa/layout/view_template','mahasiswa/modul_profile/view_profile',$data);

	}


	public function profileEdit($nim){

		$this->form_validation->set_rules('nim', 'NIM','trim|required|is_natural',[
			'is_natural' => 'NIM Hanya Berisi Angka']);
		$this->form_validation->set_rules('nama', 'Nama Mahasiswa','required');
		$this->form_validation->set_rules('prodi', 'Prodi','required');
		$this->form_validation->set_rules('angkatan', 'Tahun Angkatan','trim|required');
		$this->form_validation->set_rules('kelamin', 'Jenis Kelamin','required');
		$this->form_validation->set_rules('status', 'Status','required');
		// $this->form_validation->set_rules('als_status', 'Alasan Status','required');
		$this->form_validation->set_rules('tempat', 'Tempat lahir','trim|required|alpha',[
			'alpha' => 'nama Hanya Berisi Huruf Alfabet']);
		$this->form_validation->set_rules('tanggal', 'Tanggal Lahir','required');
		$this->form_validation->set_rules('alamat', 'Alamat','required');
		$this->form_validation->set_rules('ortu', 'Nama Orang Tua','required');
		$this->form_validation->set_rules('email', 'Email','required');
		$this->form_validation->set_rules('tlp', 'No Telepon','trim|required');
		$this->form_validation->set_rules('kelas', 'Kelas','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Mahasiswa | Profile";
			$data['page'] = "Profile";
			$data['page'] = "Edit Mahasiswa";
			$this->template->load('mahasiswa/layout/view_template','mahasiswa/modul_profile/view_profile',$data);

		}else{

			$data = [

				'nim' => $this->input->post('nim'),
				'nmmhs' => $this->input->post('nama'),
				'kdpro' => $this->input->post('prodi'),
				'thaka' => $this->input->post('angkatan'),
				'kel' => str_replace("_/","",$this->input->post('kelamin')),
				'status' => $this->input->post('status'),
				'alasan_status' => $this->input->post('als_status'),
				'tptlhr' => $this->input->post('tempat'),
				'tgllhr' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
				'alamat' => $this->input->post('alamat'),
				'nmortu' => $this->input->post('ortu'),
				'email' => $this->input->post('email'),
				'telp' => str_replace("-","",$this->input->post('tlp')),
				'kelas' => $this->input->post('kelas')

			];

			$this->db->where('nim', $this->input->post('zz'));
			$this->db->update('tb_mhs',$data);
			$this->toastr->success('Data Mahasiswa '.$this->input->post('nama').' Berhasil diupdate!');
			redirect('mahasiswa/profile');
		}
	}


	public function pengajuanSurat(){

		$data['user'] = $this->db->get_where('tb_mhs',['nim' => $this->session->userdata('nim')])->row();
		$data['surat'] = $this->mahasiswa_model->getListSurat(); //Load List Surat

		$data['title'] = "Mahasiswa | Pengajuan";
		$data['parent'] = "Pengajuan Surat";
		$data['page'] = "Pengajuan Surat";
		$this->template->load('mahasiswa/layout/view_template','mahasiswa/modul_pengajuanSurat/view_pengajuanSurat',$data);

	}

	public function statusSurat(){
		
		$data['user'] = $this->db->get_where('tb_mhs',['nim' => $this->session->userdata('nim')])->row();

		$data['allstatus'] = $this->mahasiswa_model->getStatusSurat($this->session->userdata('nim')); 

		$data['title'] = "Mahasiswa | Status Surat";
		$data['page'] = "Status Surat";
		$this->template->load('mahasiswa/layout/view_template','mahasiswa/modul_statusSurat/view_statusSurat',$data);

	}


	public function notification(){

		$data['user'] = $this->db->get_where('tb_mhs',['nim' => $this->session->userdata('nim')])->row();
		$data['allnotif'] = $this->mahasiswa_model->getAllNotif($this->session->userdata('nim'));
		$data['title'] = "Mahasiswa | Notifikasi";
		$data['page'] = "Notifikasi";
		$this->template->load('mahasiswa/layout/view_template','mahasiswa/modul_notif/view_notif',$data);


	}

	public function getNotif(){
		
		$view = $this->input->post('view');
		$nim = $this->db->get_where('tb_mhs',['nim' => $this->session->userdata('nim')])->row();
		$data = $this->mahasiswa_model->getNotif($nim->nim);

		echo json_encode($data);


	}


	public function updateNotif(){

		$nim = $this->input->post('nim');

		$updateComments = [ 

			'comment_status' => 1
		];

		$this->db->where('comment_to', $nim);
		$data = $this->db->update('tb_comments',$updateComments);
		echo json_encode($data);
	}


}