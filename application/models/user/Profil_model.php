<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profil_model extends CI_Model {

	private $table = 'profil';

	public function index($id_user){
		$this->db->select('*, user.email');
		$this->db->from($this->table);
		$this->db->join('user', 'user.id_user = profil.id_user');
		$this->db->where('profil.id_user', $id_user);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function edit($id_user, $data){
		$query = $this->db->where('id_user', $id_user)->update($this->table, $data);
		return $query;
	}
}
