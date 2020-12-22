<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Ajax extends CI_Controller {

	public function __construct(){

		parent::__construct();


		/*-- untuk mengatasi error confirm form resubmission  --*/
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->model('ajax_model');
		$this->load->model('admin_model');
	}


	/*-- Server-side Data Mahasiswa --*/
	public function get_data_mhs(){

		$prodi = $this->admin_model->getProdi(); 	/*-- Load Semua Data Prodi --*/
		$list = $this->ajax_model->get_mhs();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->nim;
			$row[] = $field->nmmhs;
			foreach ($prodi as $pro ) {

				if ($pro->kdpro == $field->kdpro) {

					$row[] =  $pro->prodi;

				}
			};

			$row[] = '
			<a style="margin-right:10px" href="../admin/dMahasiswaDetail/'.$this->encrypt->encode($field->nim).'" title="Detail"><i class="fas fa-eye text-primary"></i></a>
			<a style="margin-right:10px" href="../admin/dMahasiswaEdit/'.$this->encrypt->encode($field->nim).'" title="Edit"><i class="fas fa-edit text-secondary"></i></a>
			<a style="margin-right:10px" href="#" id="'.$field->nim.'" onclick="deletemhs('.$field->nim.')" title="Delete"><i class="fas fa-trash text-danger"></i></a>
			';

			$data[] = $row;

		}

		$output = array(

			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ajax_model->count_all_mhs(),
			"recordsFiltered" => $this->ajax_model->count_filtered_mhs(),
			"data" => $data,

		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);

	}


	public function dMahasiswaDelete(){

		$nim = $this->input->post("nim");
		$this->db->delete('tb_mhs',['nim' => $nim]);
		$data['nim'] = $this->input->post("nim");
		echo json_encode($data);

	}


	/*-- Server-side Data Permintaan Surat --*/
	public function get_data_pmr(){


		$list = $this->ajax_model->get_pmr();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->kd_surat;
			$row[] = $field->no_surat;
			$row[] = $field->nm_surat;
			$row[] = $field->permintaan_by;
			$row[] = date('d-m-Y', strtotime($field->permintaan_tgl));
			$row[] = '
			<div class="badge badge-warning"><i class="fa fa-info"></i>&ensp;'.$field->status_surat.'</div>
			';

			$access = $this->db->query("SELECT * FROM tb_surat WHERE kd_surat = '".$field->kd_surat."'")->row();

			$row[] = '
			<a style="margin-right:10px" href="../Pengajuan/pengajuanDetail/'
			.$this->encrypt->encode($field->kd_surat).'/' /*-- Kode Surat --*/
			.$this->encrypt->encode($field->id_permintaan).'/' /*-- Id Permintaan --*/
			.$this->encrypt->encode('permintaan'). /*-- Permintaan --*/
			'"><i class="fas fa-eye text-primary"></i></a>
			<a style="margin-right:10px" href="#" id="'.$field->id_permintaan.'" onclick="deletepmr('.$field->id_permintaan.')" title="Delete"><i class="fas fa-trash text-danger"></i></a>
			';

			$data[] = $row;

		}

		$output = array(

			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ajax_model->count_all_pmr(),
			"recordsFiltered" => $this->ajax_model->count_filtered_pmr(),
			"data" => $data,

		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);

	}

	public function pengajuanDelete(){

		$id_permintaan = $this->input->post("id_permintaan");
		$query = $this->admin_model->getOneMhs($this->admin_model->getOnePmr($id_permintaan)->permintaan_by);
		$notif = [

			'comment_subject' => 'Surat Di Tolak',
			'comment_text' => 'Surat Yang Anda Ajukan Pada tanggal '.$this->admin_model->getOnePmr($id_permintaan)->permintaan_tgl.' Di Tolak',
			'comment_surat' => 'N',
			'comment_to' => $this->admin_model->getOnePmr($id_permintaan)->permintaan_by,
			'comment_date' => $this->db->escape_str(date('Y-m-d'),true),
			'comment_status' => 0

		];

		$this->db->insert('tb_comments',$notif);
		$data['id_permintaan'] =  "Yang Diajuakan Oleh $query->nmmhs";
		$this->db->delete('tb_permintaan',['id_permintaan' => $id_permintaan]);

		echo json_encode($data);
		
	}


	/*-- Server-side Data Surat Selesai --*/
	public function get_data_sls(){


		$list = $this->ajax_model->get_sls();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->kd_surat;
			$row[] = $field->no_surat;
			$row[] = $field->nm_surat;
			$row[] = $field->permintaan_by;
			$row[] = date('d F Y', strtotime($field->permintaan_tgl));
			$row[] = '
			<div class="badge badge-success"><i class="fa fa-check"></i>&ensp;'.$field->status_surat.'</div>
			';

			$row[] = '
			<a style="margin-right:10px" href="../Selesai/selesaiDetail/'
			.$this->encrypt->encode($field->id_selesai).'/' 	/*-- ID Selesai --*/
			.$this->encrypt->encode($field->kd_surat). /*-- Kode Surat --*/
			'"><i class="fas fa-eye text-primary"></i></a>
			<a style="margin-right:10px" href="#" id="'.$field->id_selesai.'" onclick="deletesls('.$field->id_selesai.')" title="Delete"><i class="fas fa-trash text-danger"></i></a>
			<a style="margin-right:10px" href="../Prints/printSurat/'
			.$this->encrypt->encode($field->id_selesai).'/' /*-- ID Selesai --*/
			.$this->encrypt->encode($field->kd_surat). /*-- Kode Surat --*/
			'" target="_blank" title="Edit"><i class="fas fa-print text-warning"></i></a>
			';

			$data[] = $row;

		}

		$output = array(

			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ajax_model->count_all_sls(),
			"recordsFiltered" => $this->ajax_model->count_filtered_sls(),
			"data" => $data,

		);

		/*-- Output Dalam Format JSON --*/
		echo json_encode($output);

	}

	public function deleteSelesai(){

		$id_selesai = $this->input->post("id_selesai");
		$query = $this->db->get_where('tb_selesai',['id_selesai' => $id_selesai])->row();
		$data['id_selesai'] =  "Dengan No Surat $query->no_surat";
		$this->db->delete('tb_selesai',['id_selesai' => $id_selesai]);
		echo json_encode($data);
		
	}

	public function fetchAddMenu(){

		if($this->input->post('role_id')){
			echo $this->ajax_model->fetchAddMenu($this->input->post('role_id'));
		}
	}

	public function searchEn(){
		$kode = $this->input->post("kode");
		$conSurat = "Surat/Home/";
		$website = $this->input->post("website");
		$datap = str_replace($website,"", $kode);
		$pecahkode = str_replace($conSurat,"", $datap);

		$data = array('success' => false,'messages' => array());
		$this->form_validation->set_rules('kode','Chipertext','trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if($this->form_validation->run()){

			$enkriptext = $this->ajax_model->getSearchEn($pecahkode);

			{

				foreach ($_POST as $key => $value) {
					$data['messages'][$key] = form_error($key);
				}
			}
			echo json_encode($enkriptext);
		}
	}

	public function getDekripsi(){

		$kode=$this->input->post("kode");
		$n=$this->input->post("n");
		$d=$this->input->post("d");



		$data = array('success' => false,'messages' => array());
		$this->form_validation->set_rules('kode','Kode','trim|required');
		$this->form_validation->set_rules('n','N','trim|required');
		$this->form_validation->set_rules('d','D','trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if($this->form_validation->run()){

			$hasil = deskripsi($kode, $d, $n);
			$data['dekripsi'] =  $hasil;
			$data['success'] =  true;


		}else{

			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}
		}
		echo json_encode($data);
	}

}