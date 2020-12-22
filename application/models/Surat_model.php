<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_model extends CI_Model {


	public function getOneSurat($enkripsi){

		$query = "SELECT * FROM tb_selesai WHERE enkripsi = '$enkripsi' ";
		return $this->db->query($query)->row();

	}


}