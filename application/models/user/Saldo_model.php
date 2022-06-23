<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class saldo_model extends CI_Model {

	private $saldo = 'saldo_toko';
	private $toko = 'toko';
	private $transaksi = 'transaksi';
	private $produk = 'produk';
	private $withdraw = 'withdraw';

	public function index($id_user, $limit, $start){
		$query = $this->db->select('saldo_toko.*')->from($this->saldo)->join($this->toko, 'toko.id_toko = saldo_toko.id_toko')->where('toko.id_user', $id_user)->limit($limit, $start)->get()->result_array();
		return $query;
	}

	public function get_detail_produk_from_transaksi($id_transaksi){
		$query = $this->db->select('id_transaksi, jumlah_dibayar, id_toko')->from($this->transaksi)->join($this->produk, 'produk.id_produk = transaksi.id_produk')->where('id_transaksi', $id_transaksi)->get()->result_array();
		return $query;
	}

	public function get_count($id_user){
		$query = $this->db->select('count(id_saldo_toko) as jumlah')->from($this->saldo)->join($this->toko, 'toko.id_toko = saldo_toko.id_toko')->where('id_user', $id_user)->get()->result_array();
		return $query;
	}

	public function get_count_wd($id_user){
		$query = $this->db->select('count(id_withdraw) as jumlah')->from($this->withdraw)->join($this->toko, 'toko.id_toko = withdraw.id_toko')->where('id_user', $id_user)->get()->result_array();
		return $query;
	}

	public function get_pemasukan($id_user){
		$query = $this->db->select('sum(jumlah) as sum_masuk')->from($this->saldo)->join($this->toko, 'toko.id_toko = saldo_toko.id_toko')->where('toko.id_user', $id_user)->get()->result_array();
		return $query;
	}

	public function get_sum_of_withdraw($id_user){
		$status = array(0, 1);
		$query = $this->db->select('sum(jumlah) as sum_withdraw')->from($this->withdraw)->join($this->toko, 'toko.id_toko = withdraw.id_toko')->where('toko.id_user', $id_user)->where_in('withdraw.status', $status)->get()->result_array();
		return $query;
	}

	public function execute_terima($data){
		$query = $this->db->insert($this->saldo, $data);
		return $query;
	}

	public function store_withdraw($data){
		$query = $this->db->insert($this->withdraw, $data);
		return $query;
	}

	public function history_withdraw($id_user, $limit, $start){
		$query = $this->db->select('withdraw.*')->from($this->withdraw)->join($this->toko, 'toko.id_toko = withdraw.id_toko')->where('toko.id_user', $id_user)->get()->result_array();
		return $query;
	}

	public function batal_withdraw($id_withdraw, $id_toko, $data){
		$query = $this->db->where('id_withdraw', $id_withdraw)->where('id_toko', $id_toko)->update($this->withdraw, $data);
		return $query;
	}	
}