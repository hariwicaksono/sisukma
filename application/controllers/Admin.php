<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Admin extends CI_Controller {

	public function __construct(){

		parent::__construct();
		/*-- Check Session  --*/
		is_admin();

		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('admin_model');

	}


	public function index(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();
		$data['mhs'] = $this->admin_model->getCountMhs();
		$data['surat'] = $this->admin_model->getCountlist();
		$data['permintaan'] = $this->admin_model->getCountPmr();
		$data['selesai'] = $this->admin_model->getCountSls();
		$data['pmrlimit'] = $this->admin_model->getPmrLimit();
		$data['slslimit'] = $this->admin_model->getSlsLimit();

		$data['title'] = "Admin | Dashboard";
		$data['parent'] = "Dashboard";
		$data['page'] = "Dashboard";
		$this->template->load('admin/layout/admin_template','admin/modul_dashboard/admin_dashboard',$data);

	}


	public function dMahasiswa(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['title'] = "Admin | Data Mahasiswa";
		$data['parent'] = "Data Mahasiswa";
		$data['page'] = "Data Mahasiswa";
		$this->template->load('admin/layout/admin_template','admin/modul_mhs/admin_mhs',$data);

	}


	public function dMahasiswaDetail($nim){

		/*-- Encrypt URL NIM --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dMahasiswa');
		}
		if (!isset($nim)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dMahasiswa');
		}
		if (is_numeric($nim)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dMahasiswa');
		} 

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['onemhs'] = $this->admin_model->getOneMhs($this->encrypt->decode($nim)); /*-- Load One Data Mhs --*/

		$data['title'] = "Admin | Data Mahasiswa";
		$data['parent'] = "Data Mahasiswa";
		$data['page'] = "Detail";
		$this->template->load('admin/layout/admin_template','admin/modul_mhs/admin_mhsDetail',$data);

	}


	public function dMahasiswaEdit($nim){

		/*-- Encrypt URL NIM --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dMahasiswa');
		}
		if (!isset($nim)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai NIM');
			redirect('admin/dMahasiswa');
		}
		if (is_numeric($nim)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Terenkripsi');
			redirect('admin/dMahasiswa');
		} 

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['onemhs'] = $this->admin_model->getOneMhs($this->encrypt->decode($nim)); /*-- Load One Data Mhs --*/
		$data['prodi'] = $this->admin_model->getProdi(); /*-- Load Semua Data Prodi --*/

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

			$data['title'] = "Admin | Data Mahasiswa";
			$data['parent'] = "Data Mahasiswa";
			$data['page'] = "Edit";
			$this->template->load('admin/layout/admin_template','admin/modul_mhs/admin_mhsEdit',$data);

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
			redirect('admin/dMahasiswa');

		}
	}


	public function dAdministrator(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['adminis'] = $this->admin_model->getAdministrator(); /*-- Load Semua Data Administrator --*/

		$data['title'] = "Admin | Data Administrator";
		$data['parent'] = "Data Administrator";
		$data['page'] = "Data Administrator";
		$this->template->load('admin/layout/admin_template','admin/modul_admin/admin_administrator',$data);

	}

	public function dAdministratorAdd(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('username','Username','required|trim|is_unique[tb_admin.username]', [
			'is_unique' => 'This Username has alredy taken!'
		]);
		$this->form_validation->set_rules('password','Password','required|trim|min_length[5]|matches[repeatpassword]', [
			'matches' => 'Password dont macth!',
			'min_length' => 'Password to short, Min 5 Character!'
		]);
		$this->form_validation->set_rules('repeatpassword','Repeat Password','required|trim|matches[password]');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Data Administrator";
			$data['parent'] = "Data Administrator";
			$data['page'] = "Tambah";
			$this->template->load('admin/layout/admin_template','admin/modul_admin/admin_administratorAdd',$data);

		}else{

			$data = [

				'username' => htmlspecialchars($this->input->post('username')),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'is_active' => 0,
				'date_created' => time()

			];

			$this->db->insert('tb_admin', $data);
			$this->toastr->success('Data Administrator '.$this->input->post('username').' Telah Ditambahkan!');
			redirect('admin/dAdministrator');

		}
	}

	public function dAdministratorDetail($id){

		/*-- Encrypt URL Id --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dAdministrator');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dAdministrator');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dAdministrator');
		} 

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['oneadm'] = $this->admin_model->getOneAdministrator($this->encrypt->decode($id)); /*-- Load One Data Administrator --*/

		$data['title'] = "Admin | Data Administrator";
		$data['parent'] = "Data Administrator";
		$data['page'] = "Detail";
		$this->template->load('admin/layout/admin_template','admin/modul_admin/admin_administratorDetail',$data);

	}


	public function dAdministratorEdit($id){

		/*-- Encrypt URL Id --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dAdministrator');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dAdministrator');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dAdministrator');
		} 

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$admin = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['oneadm'] = $this->admin_model->getOneAdministrator($this->encrypt->decode($id));

		$this->form_validation->set_rules('username','Username','required|trim');
		$this->form_validation->set_rules('password','Password','trim|min_length[5]',[
			'min_length' => 'Password to short, min 5 Character!'
		]);
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');

		$data['oldpassword'] = $admin->password;

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Data Administrator";
			$data['parent'] = "Data Administrator";
			$data['page'] = "Edit";
			$this->template->load('admin/layout/admin_template','admin/modul_admin/admin_administratorEdit',$data);

		}else{

			if(password_verify($this->input->post('password'),$admin->password)) {

				$this->session->set_flashdata('message','Password yang anda masukkan sama dengan password yang anda gunakan saat ini!');
				$data['title'] = "Admin | Data Administrator";
				$data['parent'] = "Data Administrator";
				$data['page'] = "Edit Administrator";
				$this->template->load('admin/layout/admin_template','admin/modul_admin/admin_administratorEdit',$data);
				
			}else{

				/*-- check jika ada gambar yang akan diupload, "picure" itu nama inputnya --*/
				$upload_image = $_FILES['picture']['name'];

				if($upload_image){

					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']     = '5120'; /*-- dalam hitungan kilobyte(kb), aslinya 1mb itu 1024kb --*/
					$config['upload_path'] = './assets/esurat/img/profile/';

					$this->load->library('upload', $config);

					if($this->upload->do_upload('picture')){

						$old_image = $data['tb_admin']['image'];

						if($old_image != 'default.jpg'){

							unlink(FCPATH . './assets/esurat/img/profile/' . $old_image);

						}

						$new_image = $this->upload->data('file_name');
						$this->db->set('image', $new_image);

					}else{

						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
						redirect('admin/dAdministratorEdit/'.$this->encrypt->encode($id).'');

					}
				}

				$data = [

					'username' => $this->input->post('username'),
					'fullname' => $this->input->post('fullname'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'address' => $this->input->post('address'),
					'is_active' => $this->input->post('status')

				];

				$this->db->where('id', $this->input->post('zz'));
				$this->db->update('tb_admin',$data);
				$this->toastr->success('Data Administrator '.$this->input->post('username').' Berhasil Di Update!');
				redirect('admin/dAdministrator');

			}

		}
	}


	public function dAdministratorDelete($id){

		$this->db->delete('tb_admin',['id' => $this->encrypt->decode($id)]);
		$this->toastr->success('Data Administrator Telah Di Hapus!');
		redirect('admin/dAdministrator');

	}


	public function dDosen(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['dosen'] = $this->admin_model->getDosen(); /*-- Load Semua Data Dosen --*/

		$data['title'] = "Admin | Data Dosen";
		$data['parent'] = "Data Dosen";
		$data['page'] = "Data Dosen";
		$this->template->load('admin/layout/admin_template','admin/modul_dosen/admin_dosen',$data);

	}


	public function dDosenAdd(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('nama','Nama Dosen','required');
		$this->form_validation->set_rules('nip','NIP','trim|required|is_natural|is_unique[tb_dosen.nip]', [
			'is_unique' => 'This NIP Sudah Ada!',
			'is_natural' => 'NIP hanya berisi Angka'
		]);
		$this->form_validation->set_rules('jabatan','Jabatan','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Data Dosen";
			$data['parent'] = "Data Dosen";
			$data['page'] = "Tambah";
			$this->template->load('admin/layout/admin_template','admin/modul_dosen/admin_dosenAdd',$data);

		}else{

			$data = [

				'nama' => htmlspecialchars($this->input->post('nama')),
				'nip' => $this->input->post('nip'),
				'jabatan' => $this->input->post('jabatan')

			];

			$this->db->insert('tb_dosen', $data);
			$this->toastr->success('Data Dosen '.$this->input->post('nama').' Telah Ditambahkan!');
			redirect('admin/dDosen');

		}
	}


	public function dDosenDetail($id){

		/*-- Encrypt URL Id --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dDosen');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dDosen');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dDosen');
		} 

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['onedos'] = $this->admin_model->getOneDosen($this->encrypt->decode($id)); /*-- Load One Data Dosen --*/

		$data['title'] = "Admin | Data Dosen";
		$data['parent'] = "Data Dosen";
		$data['page'] = "Detail";
		$this->template->load('admin/layout/admin_template','admin/modul_dosen/admin_dosenDetail',$data);

	}


	public function dDosenEdit($id){

		/*-- Encrypt URL Id --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dDosen');
		}
		if (!isset($id)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dDosen');
		}
		if (is_numeric($id)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dDosen');
		} 

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['onedos'] = $this->admin_model->getOneDosen($this->encrypt->decode($id)); /*-- Load One Data Dosen --*/
		$this->form_validation->set_rules('nama','Nama Dosen','required');
		$this->form_validation->set_rules('nip','NIP','trim|required|is_natural',[
			'is_natural' => 'NIP Hanya Berisi Angka!']);
		$this->form_validation->set_rules('jabatan','Jabatan','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Data Dosen";
			$data['parent'] = "Data Dosen";
			$data['page'] = "Edit";
			$this->template->load('admin/layout/admin_template','admin/modul_dosen/admin_dosenEdit',$data);

		}else{

			$data = [

				'nama' => htmlspecialchars($this->input->post('nama')),
				'nip' => $this->input->post('nip'),
				'jabatan' => $this->input->post('jabatan')

			];

			$this->db->where('id', $this->input->post('zz'));
			$this->db->update('tb_dosen',$data);
			$this->toastr->success('Data Dosen '.$this->input->post('nama').' Berhasil Diudate!');
			redirect('admin/dDosen');

		}
	}


	public function dDosenDelete($id){

		$this->db->delete('tb_dosen',['id' => $this->encrypt->decode($id)]);
		$this->toastr->success('Data Dosen Telah Di Hapus!');
		redirect('admin/dDosen');

	}


	public function dProdi(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['prodi'] = $this->admin_model->getProdi(); /*-- Load Semua Data Prodi --*/

		$data['title'] = "Admin | Data Prodi";
		$data['parent'] = "Data Prodi";
		$data['page'] = "Data Prodi";
		$this->template->load('admin/layout/admin_template','admin/modul_prodi/admin_prodi',$data);

	}


	public function dProdiAdd(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('kdpro','Kode Prodi','trim|required|is_unique[tb_prodi.kdpro]',[
			'is_unique' => 'Kode Prodi Sudah Ada!']);
		$this->form_validation->set_rules('nmpro','Nama Prodi','required|is_unique[tb_prodi.prodi]',[
			'is_unique' => 'Nama Prodi Sudah Ada!']);
		$this->form_validation->set_rules('jenpro','Jenjang Prodi','required');
		$this->form_validation->set_rules('kapro','Nama Kaprodi','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Data Prodi";
			$data['parent'] = "Data Prodi";
			$data['page'] = "Tambah";
			$this->template->load('admin/layout/admin_template','admin/modul_prodi/admin_prodiAdd',$data);

		}else{

			$data = [

				'kdpro' => $this->input->post('kdpro'),
				'prodi' => $this->input->post('nmpro'),
				'jen' => $this->input->post('jenpro'),
				'kaprodi' => $this->input->post('kapro'),
				'kdmk' => $this->input->post('kdmkpro')

			];

			$this->db->insert('tb_prodi',$data);
			$this->toastr->success('Data Prodi '.$this->input->post('nmpro').' Telah Ditambahkan!');
			redirect('admin/dProdi');
		}

	}

	public function dProdiDetail($kdpro){

		/*-- Encrypt URL Kdpro --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dProdi');
		}
		if (!isset($kdpro)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dProdi');
		}
		if (is_numeric($kdpro)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dProdi');
		} 

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['onepro'] = $this->admin_model->getOneProdi($this->encrypt->decode($kdpro)); /*-- Load Semua Data Dosen --*/

		$data['title'] = "Admin | Data Prodi";
		$data['parent'] = "Data Prodi";
		$data['page'] = "Detail";
		$this->template->load('admin/layout/admin_template','admin/modul_prodi/admin_prodiDetail',$data);

	}


	public function dProdiEdit($kdpro){

		/*-- Encrypt URL Kdpro --*/
		if (count($this->uri->segment_array()) > 3) {
			$this->toastr->error('Url Yang Anda Masukkan Salah');
			redirect('admin/dProdi');
		}
		if (!isset($kdpro)) {
			$this->toastr->error('Data yang Anda Inginkan Tidak Mempunyai ID');
			redirect('admin/dProdi');
		}
		if (is_numeric($kdpro)) {
			$this->toastr->error('Url Hanya Bisa Diakses Setelah Dienkripsi');
			redirect('admin/dProdi');
		} 

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['onepro'] = $this->admin_model->getOneProdi($this->encrypt->decode($kdpro)); /*-- Load Semua Data Dosen --*/

		$this->form_validation->set_rules('kdpro','Kode Prodi','trim|required');
		$this->form_validation->set_rules('nmpro','Nama Prodi','required');
		$this->form_validation->set_rules('jenpro','Jenjang Prodi','required');
		$this->form_validation->set_rules('kapro','Nama Kaprodi','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Data Prodi";
			$data['parent'] = "Data Prodi";
			$data['page'] = "Edit Prodi";
			$this->template->load('admin/layout/admin_template','admin/modul_prodi/admin_prodiEdit',$data);

		}else{

			$data = [

				'kdpro' => $this->input->post('kdpro'),
				'prodi' => $this->input->post('nmpro'),
				'jen' => $this->input->post('jenpro'),
				'kaprodi' => $this->input->post('kapro'),
				'kdmk' => $this->input->post('kdmkpro')

			];

			$this->db->where('kdpro', $this->input->post('zz'));
			$this->db->update('tb_prodi',$data);
			$this->toastr->success('Data Prodi '.$this->input->post('nmpro').' Berhasil Diudate!');
			redirect('admin/dProdi');

		}
	}


	public function dProdiDelete($kdpro){

		$this->db->delete('tb_prodi',['kdpro' => $this->encrypt->decode($kdpro)]);
		$this->toastr->success('Data Prodi Telah Di Hapus!');
		redirect('admin/dProdi');

	}


	public function sListSurat(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['surat'] = $this->admin_model->getListSurat(); /*-- Load Semua Data List Surat --*/

		$data['title'] = "Admin | List Surat";
		$data['parent'] = "List Surat";
		$data['page'] = "List Surat";
		$this->template->load('admin/layout/admin_template','admin/modul_listSurat/admin_listSurat',$data);
	}


	public function sListSuratAdd(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$this->form_validation->set_rules('kodeSurat','Kode Surat','required');
		$this->form_validation->set_rules('namaSurat','Nama Surat','required');
		$this->form_validation->set_rules('kopSurat','Kops Kaprodi','required');
		$this->form_validation->set_rules('headerSurat','Header Surat','required');
		$this->form_validation->set_rules('isiSurat','Isi Surat','required');
		$this->form_validation->set_rules('footerSurat','Footer Surat','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | List Surat";
			$data['parent'] = "List Surat";
			$data['page'] = "Tambah";
			$this->template->load('admin/layout/admin_template','admin/modul_listSurat/admin_listSuratAdd',$data);

		}else{

			$data = [

				'kd_surat' => $this->input->post('kodeSurat'),
				'nm_surat' => $this->input->post('namaSurat'),
				'kop_surat' => $this->input->post('kopSurat'),
				'header_surat' => $this->input->post('headerSurat'),
				'isi_surat' => $this->input->post('isiSurat'),
				'footer_surat' => $this->input->post('footerSurat'),
				'access' => $this->input->post('access')

			];

			$this->db->insert('tb_Surat',$data);
			$this->toastr->success('List Surat '.$this->input->post('namaSurat').' Telah Ditambahkan!');
			$id_surat = $this->db->insert_id();
			redirect('admin/sListSuratDetail/'.$this->encrypt->encode($id_surat).'');
		}
	}


	public function sListSuratDetail($id_surat){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		/*-- Load One Data Surat --*/
		$data['onesur'] = $this->admin_model->getOneListSurat($this->encrypt->decode($id_surat)); 

		$data['title'] = "Admin | List Surat";
		$data['parent'] = "List Surat";
		$data['page'] = "Detail";
		$this->template->load('admin/layout/admin_template','admin/modul_listSurat/admin_listSuratDetail',$data);

	}


	public function sListSuratEdit($id_surat){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		/*-- Load One Data Surat --*/
		$data['onesur'] = $this->admin_model->getOneListSurat($this->encrypt->decode($id_surat)); 


		$this->form_validation->set_rules('kodeSurat','Kode Surat','required');
		$this->form_validation->set_rules('namaSurat','Nama Surat','required');
		$this->form_validation->set_rules('kopSurat','Kops Kaprodi','required');
		$this->form_validation->set_rules('headerSurat','Header Surat','required');
		$this->form_validation->set_rules('isiSurat','Isi Surat','required');
		$this->form_validation->set_rules('footerSurat','Footer Surat','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | List Surat";
			$data['parent'] = "List Surat";
			$data['page'] = "Edit";
			$this->template->load('admin/layout/admin_template','admin/modul_listSurat/admin_listSuratEdit',$data);

		}else{

			$data = [

				'kd_surat' => $this->input->post('kodeSurat'),
				'nm_surat' => $this->input->post('namaSurat'),
				'kop_surat' => $this->input->post('kopSurat'),
				'header_surat' => $this->input->post('headerSurat'),
				'isi_surat' => $this->input->post('isiSurat'),
				'footer_surat' => $this->input->post('footerSurat'),
				'access' => $this->input->post('access')

			];

			$this->db->where('id_surat', $this->input->post('zz'));
			$this->db->update('tb_surat',$data);
			$this->toastr->success('Data Prodi '.$this->input->post('namaSurat').' Berhasil Diudate!');
			redirect('admin/sListSurat');
		}
	}


	public function sListSuratDelete($id_surat){

		$this->db->delete('tb_surat',['id_surat' => $this->encrypt->decode($id_surat)]);
		$this->toastr->success('Data Surat Telah Di Hapus!');
		redirect('admin/sListSurat');

	}

	public function sListSuratPrint($id_surat){

		$data['onesur'] = $this->admin_model->getOneListSurat($this->encrypt->decode($id_surat));

		$this->load->view('admin/modul_listSurat/admin_listSuratPrint', $data);
		
	}

	public function sPermintaanSurat(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['costum'] = $this->admin_model->getCostumSurat(); /*-- Load Semua Data List Surat --*/

		$data['title'] = "Admin | Data Permintaan Surat";
		$data['parent'] = "Data Permintaan Surat";
		$data['page'] = "Permintaan Surat";
		$this->template->load('admin/layout/admin_template','admin/modul_permintaanSurat/admin_permintaanSurat',$data);

	}

	public function sSuratSelesai(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['title'] = "Admin | Data Surat Selesai";
		$data['parent'] = "Data Surat Selesai";
		$data['page'] = "Surat Selesai";
		$this->template->load('admin/layout/admin_template','admin/modul_suratSelesai/admin_suratSelesai',$data);

	}


	public function sValidasiSurat(){
		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();

		$data['title'] = "Admin | Validasi Surat";
		$data['parent'] = "Validasi Surat";
		$data['page'] = "Validasi Surat";
		$this->template->load('admin/layout/admin_template','admin/modul_validasiSurat/admin_validasiSurat',$data);
	}


	public function laporan(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();
		$data['nimlaporan'] = $this->admin_model->getMhs(); 
		$this->form_validation->set_rules('status', 'Pilih Status Surat','required');
		$this->form_validation->set_rules('permintaan_by', 'Pilih Status Surat','trim');
		$this->form_validation->set_rules('awalPeriode', 'Awal Periode','required');
		$this->form_validation->set_rules('akhirPeriode', 'Akhir Periode','required');

		if($this->form_validation->run() == false){
			$data['hasil'] = '';
			$data['title'] = "Admin | Laporan Surat";
			$data['parent'] = "Laporan Data Surat";			
			$data['page'] = "Laporan Data Surat";
			$this->output->set_header('HTTP/1.0 200 OK');
			$this->output->set_header('HTTP/1.1 200 OK');
			$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
			$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$this->output->set_header('Cache-Control: post-check=0, pre-check=0');
			$this->output->set_header('Pragma: no-cache');
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporan',$data);

		}else{

			$status = $this->input->post('status');
			$nim = $this->input->post('permintaan_by');
			$awal = $this->input->post('awalPeriode');
			// $awal = '2020-08-01 02:10:28';
			$akhir = $this->input->post('akhirPeriode');

			if($status == 'PENDING'){
				$tabel = 'tb_permintaan';
				$nametab = 'Permintaan Surat';
				$orderby = 'id_permintaan';
			}else{
				$tabel = 'tb_selesai';
				$nametab = 'Permintaan Surat';
				$orderby = 'id_selesai';
			};

			if($nim == NULL){
				$query = "SELECT * FROM $tabel WHERE (permintaan_tgl BETWEEN '$awal' AND '$akhir') ORDER BY $orderby DESC";
			}else{
				$query = "SELECT * FROM $tabel WHERE (permintaan_tgl BETWEEN '$awal' AND '$akhir') AND permintaan_by = $nim ORDER BY $orderby DESC";
			}

			$data['hasil'] = $this->db->query($query)->result();
			$data['title'] = "Admin | Laporan Surat";
			$data['page'] = "Laporan Data Surat";
			$this->template->load('admin/layout/admin_template','admin/modul_laporan/admin_laporan',$data);

		}
	}



	public function nMenu(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();
		$data['role'] = $this->db->get('tb_role')->result();
		$data['allmenu'] = $this->admin_model->getAllMenu();

		$this->form_validation->set_rules('a','Menu Title','required');
		$this->form_validation->set_rules('b','Menu For','required');
		$this->form_validation->set_rules('c','Menu Url','required');
		$this->form_validation->set_rules('d','Menu Icon','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Menu";
			$data['page'] = "Navigation";
			$data['page'] = "Menu ";
			$this->template->load('admin/layout/admin_template','admin/modul_menu/admin_menu',$data);

		}else{

			$data = [
				'title' => $this->input->post('a'),
				'role_id' => $this->input->post('b'),
				'url' => $this->input->post('c'),
				'icon' => $this->input->post('d'),
				'is_main_menu' => $this->input->post('e'),
				'is_active' => $this->input->post('f')
			];
			$this->db->insert('tb_menu',$data);
			$this->toastr->success('Menu '.$this->input->post('a').' Berhasil Ditambahkan!');
			redirect('admin/nMenu');
		}
	}

	public function nMenuEdit(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();
		$data['role'] = $this->db->get('tb_role')->result();
		$data['allmenu'] = $this->admin_model->getAllMenu();

		$this->form_validation->set_rules('a','Menu Title','required');
		$this->form_validation->set_rules('b','Menu For','required');
		$this->form_validation->set_rules('c','Menu Url','required');
		$this->form_validation->set_rules('d','Menu Icon','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Menu";
			$data['page'] = "Menu ";
			$this->template->load('admin/layout/admin_template','admin/modul_menu/admin_menu',$data);

		}else{

			$data = [
				'title' => $this->input->post('a'),
				'role_id' => $this->input->post('b'),
				'url' => $this->input->post('c'), 
				'icon' => $this->input->post('d'),
				'is_main_menu' => $this->input->post('e'),  
				'is_active' => $this->input->post('f')
			];
			$this->db->where('id_menu', $this->input->post('g'));
			$this->db->update('tb_menu',$data);
			$this->toastr->success(' Menu '.$this->input->post('a').' Berhasil Diperbarui!');
			redirect('admin/nMenu');

		}
	}

	public function nMenuDelete($id_menu){

		$this->db->delete('tb_menu',['id_menu' => $this->encrypt->decode($id_menu)]);
		$this->toastr->success(' Menu Berhasil Dihapus!');
		redirect('admin/nMenu');
	}

	public function nRole(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();
		$data['allrole'] = $this->admin_model->getAllRole();

		$this->form_validation->set_rules('a','Role Name','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Role";
			$data['page'] = "Role ";
			$this->template->load('admin/layout/admin_template','admin/modul_role/admin_role',$data);

		}else{

			$this->db->insert('tb_role',['access' => $this->input->post('a')]);
			$this->toastr->success(' Role Baru '.$this->input->post('a').' Berhasil Ditambahkan !');
			redirect('admin/nRole');
		}
	}

	public function nRoleEdit(){

		$data['user'] = $this->db->get_where('tb_admin',['username' => $this->session->userdata('username')])->row();
		$data['allrole'] = $this->admin_model->getAllRole();

		$this->form_validation->set_rules('a','Role Name','required');

		if($this->form_validation->run() == false){

			$data['title'] = "Admin | Role";
			$data['page'] = "Role ";
			$this->template->load('admin/layout/admin_template','admin/modul_role/admin_role',$data);

		}else{

			$data = [
				'access' => $this->input->post('a')
			];
			$this->db->where('id', $this->input->post('b'));
			$this->db->update('tb_role',$data);
			$this->toastr->success(' Role '.$this->input->post('a').' Diperbarui !');
			redirect('admin/nRole');
		}
	}

	public function nRoleDelete($id){

		$this->db->delete('tb_role',['id' => $id]);
		$this->toastr->success(' Role Berhasil Dihapus!');
		redirect('admin/nRole');
	}


}