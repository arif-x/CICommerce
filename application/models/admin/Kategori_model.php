<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori_model extends CI_Model {

	private $kategori = 'kategori';

	public function index($limit, $start){
		$query = $this->db->select('*')->from($this->kategori)->limit($limit, $start)->get()->result_array();
		return $query;
	}

	public function single($id_kategori){
		$query = $this->db->select('*')->from($this->kategori)->where('id_kategori', $id_kategori)->get()->result_array();
		return $query;
	}

	public function store($data){
		$query = $this->db->insert($this->kategori, $data);
	}

	public function edit($id_kategori, $data){
		$query = $this->db->where('id_kategori', $id_kategori)->update($this->kategori, $data);
		return $query;
	}

	public function destroy($id_kategori){
		$query = $this->db->where('id_kategori', $id_kategori)->delete($this->kategori);
		return $query;
	}
}