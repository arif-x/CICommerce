<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class alamat_model extends CI_Model {

	private $alamat = 'daftar_alamat';

	public function index($id_user){
		$query = $this->db->select('*')->from($this->alamat)->where('id_user', $id_user)->get()->result_array();
		return $query;
	}

	public function single($id_user, $id_alamat){
		$query = $this->db->select('*')->from($this->alamat)->where('id_user', $id_user)->where('id_alamat', $id_alamat)->get()->result_array();
		return $query;	
	}

	public function store($data){
		$query = $this->db->insert($this->alamat, $data);
		return $query;
	}

	public function edit($id_user, $id_alamat, $data){
		$query = $this->db->where('id_user', $id_user)->where('id_alamat', $id_alamat)->update($this->alamat, $data);
		return $query;
	}

	public function destroy($id_user, $id_alamat){
		$query = $this->db->where('id_user', $id_user)->where('id_alamat', $id_alamat)->delete($this->alamat);
		return $query;
	}

	public function single_ajax($id_user){
		$query = $this->db->select('id_alamat, alamat')->from($this->alamat)->where('id_user', $id_user)->get()->result_array();
		return $query;
	}
}