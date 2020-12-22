<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function getMahaiswa($nim){
		$query = "SELECT * FROM tb_mhs WHERE nim LIKE '$nim' ";
		return $this->db->query($query)->row();
	}
}