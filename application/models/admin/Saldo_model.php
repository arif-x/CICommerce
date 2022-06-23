<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class saldo_model extends CI_Model {

	protected $withdraw = 'withdraw';

	public function index($limit, $start){
		$query = $this->db->select('*')->from($this->withdraw)->limit($limit, $start)->get()->result_array();
		return $query;
	}

	public function execution($id_withdraw, $data){
		$query = $this->db->where('id_withdraw', $id_withdraw)->update($this->withdraw, $data);
		return $query;
	}
}