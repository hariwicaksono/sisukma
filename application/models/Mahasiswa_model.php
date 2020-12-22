<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

	public function getCountSuratMhs(){
		$query = "SELECT COUNT(id_surat) as id_surat  FROM tb_surat WHERE access = 2";
		return $this->db->query($query)->row()->id_surat;
	}
	public function getCountSuratPermintaan($nim){
		$query = "SELECT COUNT(id_permintaan) as id_permintaan FROM tb_permintaan WHERE permintaan_by = '$nim'";
		return $this->db->query($query)->row()->id_permintaan;
	}

	public function getCountSuratSelesai($nim){
		$query = "SELECT COUNT(id_selesai) as id_selesai FROM tb_selesai WHERE permintaan_by = '$nim'";
		return $this->db->query($query)->row()->id_selesai;
	}
	
	public function getListSuratHome(){
		$query = "SELECT * FROM tb_surat  WHERE access = 2 LIMIT 3";
		return $this->db->query($query)->result();
	}
	public function getStatusSuratHome($nim){
		$query = "
		SELECT * FROM tb_mhs JOIN tb_selesai ON tb_mhs.nim = tb_selesai.permintaan_by WHERE tb_mhs.nim = '$nim'
		UNION SELECT * FROM tb_mhs JOIN tb_permintaan ON tb_mhs.nim = tb_permintaan.permintaan_by WHERE tb_mhs.nim = '$nim'
		ORDER BY status_surat ASC LIMIT 10";
		return $this->db->query($query)->result();
	}


	public function getProdi(){

		$query = "SELECT * FROM tb_prodi";
		return $this->db->query($query)->result();

	}

	public function getOneProdi($kdpro){

		$query = "SELECT * FROM tb_prodi WHERE kdpro = '$kdpro'";
		return $this->db->query($query)->row();

	}


	public function getListSurat(){

		$query = "SELECT * FROM tb_surat WHERE access = 2 ";
		return $this->db->query($query)->result();

	}


	public function getOneListSurat($id_surat){

		$query = "SELECT * FROM tb_surat WHERE id_surat = '$id_surat' AND access = 2 ";
		return $this->db->query($query)->row();

	}


	public function getStatusSurat($nim){
		$query = "
		SELECT * FROM tb_mhs JOIN tb_selesai ON tb_mhs.nim = tb_selesai.permintaan_by WHERE tb_mhs.nim = '$nim'
		UNION SELECT * FROM tb_mhs JOIN tb_permintaan ON tb_mhs.nim = tb_permintaan.permintaan_by WHERE tb_mhs.nim = '$nim'
		ORDER BY permintaan_tgl DESC
		";
		return $this->db->query($query)->result();
	}

	public function getNotif($nim){

		// $updateQuery= "UPDATE tb_comment SET comment_status=1 WHERE comment_status=0";


		$query = "SELECT * FROM tb_comments WHERE comment_to = '$nim' ORDER BY comment_id DESC LIMIT 5";

		$output = '';

		if($this->db->query($query)->num_rows() > 0){

			foreach ($this->db->query($query)->result() as $row) {
				$output .= '
				<a href="#" class="dropdown-item">
				<div class="media">
				<div class="media-body">';

				if($row->comment_surat == 'Y'){

					$output .= '<h3 class="dropdown-item-title text-success">
					'.$row->comment_subject.'
					</h3>';

				}else{

					$output .= '<h3 class="dropdown-item-title text-danger">
					'.$row->comment_subject.'
					</h3>';

				}

				$output .= '
				<p class="text-sm">'.$row->comment_text.'</p>
				<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>'.$row->comment_date.'</p>
				</div>
				</div>
				</a>
				<div class="dropdown-divider"></div>
				';
			}
			$output .= '
			<div class="dropdown-divider"></div>
			<a href="'.base_url('mahasiswa/notification').'" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
			';

		}else{

			$output .= '
			<span class="dropdown-item dropdown-header">Notifikasi Tidak Ditemukan</span>
			<div class="dropdown-divider"></div>
			<a href="'.base_url('mahasiswa/notification').'" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
			';

		}



		$query1 = "SELECT * FROM tb_comments WHERE comment_to = '$nim' AND comment_status=0";
		$count = $this->db->query($query1)->num_rows();

		$data = array(
			'notification' => $output,
			'unseen_notification' => $count
		);



		return $data;
	}

	public function getAllNotif($nim){

		$query = "SELECT * FROM tb_comments WHERE comment_to = '$nim' ORDER BY comment_id DESC";
		return $this->db->query($query)->result();

	}

}