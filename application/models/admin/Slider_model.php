<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class slider_model extends CI_Model {

	private $slider = 'slider';

	public function index($limit, $start){
		$query = $this->db->select('*')->from($this->slider)->limit($limit, $start)->get()->result_array();
		return $query;
	}

	public function single($id_slider){
		$query = $this->db->select('*')->from($this->slider)->where('id_slider', $id_slider)->get()->result_array();
		return $query;
	}

	public function store($data){
		$query = $this->db->insert($this->slider, $data);
	}

	public function edit($id_slider, $data){
		$query = $this->db->where('id_slider', $id_slider)->update($this->slider, $data);
		return $query;
	}

	public function destroy($id_slider){
		$query = $this->db->where('id_slider', $id_slider)->delete($this->slider);
		return $query;
	}
}