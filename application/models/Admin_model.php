<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function getCountMhs(){
		$query = "SELECT COUNT(nmmhs) as nmmhs FROM tb_mhs";
		return $this->db->query($query)->row()->nmmhs;
	}

	public function getCountlist(){
		$query = "SELECT COUNT(id_surat) as surat FROM tb_surat";
		return $this->db->query($query)->row()->surat;
	}

	public function getCountPmr(){
		$query = "SELECT COUNT(id_permintaan) as permintaan FROM tb_permintaan";
		return $this->db->query($query)->row()->permintaan;
	}

	public function getCountSls(){
		$query = "SELECT COUNT(id_selesai) as selesai FROM tb_selesai";
		return $this->db->query($query)->row()->selesai;
	}

	public function getPmrLimit(){
		$query = "SELECT * FROM tb_permintaan JOIN tb_mhs ON tb_permintaan.permintaan_by = tb_mhs.nim ORDER BY id_permintaan ASC  LIMIT 5";
		return $this->db->query($query)->result();
	}

	public function getSlsLimit(){
		$query = "SELECT * FROM tb_selesai JOIN tb_mhs ON tb_selesai.permintaan_by = tb_mhs.nim ORDER BY id_selesai DESC  LIMIT 5";
		return $this->db->query($query)->result();
	}

	public function getMhs(){

		$query = "SELECT * FROM tb_mhs ";
		return $this->db->query($query)->result();

	}

	public function getOneMhs($nim){

		$query = "SELECT * FROM tb_mhs WHERE nim LIKE '$nim' ";
		return $this->db->query($query)->row();

	}

	public function getProdi(){

		$query = "SELECT * FROM tb_prodi";
		return $this->db->query($query)->result();

	}

	public function getOneProdi($kdpro){

		$query = "SELECT * FROM tb_prodi WHERE kdpro = '$kdpro'";
		return $this->db->query($query)->row();

	}

	public function getAdministrator(){

		$query = "SELECT * FROM tb_admin ";
		return $this->db->query($query)->result();

	}


	public function getOneAdministrator($id){

		$query = "SELECT * FROM tb_admin WHERE id = '$id' ";
		return $this->db->query($query)->row();

	}

	public function getDosen(){

		$query = "SELECT * FROM tb_dosen ";
		return $this->db->query($query)->result();

	}


	public function getOneDosen($id){

		$query = "SELECT * FROM tb_dosen WHERE id = '$id' ";
		return $this->db->query($query)->row();

	}

	public function getListSurat(){

		$query = "SELECT * FROM tb_surat";
		return $this->db->query($query)->result();

	}


	public function getOneListSurat($id_surat){

		$query = "SELECT * FROM tb_surat WHERE id_surat = '$id_surat' ";
		return $this->db->query($query)->row();

	}

	public function getCostumSurat(){

		$query = "SELECT * FROM tb_surat WHERE access = 1 OR access = 2 ";
		return $this->db->query($query)->result();

	}

	public function getOneCostumSurat($id_surat){

		$query = "SELECT * FROM tb_surat WHERE access = 1 OR access = 2 AND id_surat = '$id_surat'  ";
		return $this->db->query($query)->row();

	}


	public function getOnePmr($id_permintaan){

		$query = "SELECT * FROM tb_permintaan WHERE id_permintaan LIKE '$id_permintaan' ";
		return $this->db->query($query)->row();

	}

	public function getOneSls($id_selesai){

		$query = "SELECT * FROM tb_selesai WHERE id_selesai LIKE '$id_selesai' ";
		return $this->db->query($query)->row();

	}

	public function getAllMenu(){

		$query = "SELECT * FROM tb_menu";
		return $this->db->query($query)->result();

	}

	public function getAllRole(){

		$query = "SELECT * FROM tb_role";
		return $this->db->query($query)->result();

	}

}