<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password_model extends CI_Model {

	private $user = 'user';

	public function change($id_user, $data){
		$query = $this->db->where('id_user', $id_user)->update($this->user, $data);
		return $query;
	}

	public function check($id_user){
		$query = $this->db->select('password')->from($this->user)->where('id_user', $id_user)->get()->result_array();
		return $query;
	}
}