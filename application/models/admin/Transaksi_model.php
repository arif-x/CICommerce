<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class transaksi_model extends CI_Model {

	protected $transaksi = 'transaksi';

	public function index($limit, $start){
		$query = $this->db->select('transaksi.*, nama_produk')->from($this->transaksi)->join('produk', 'produk.id_produk = transaksi.id_produk')->order_by('id_transaksi', 'DESC')->limit($limit, $start)->get()->result_array();
		return $query;
	}

	public function edit_index($id_transaksi){
		$query = $this->db->select('transaksi.*, nama_produk')->from($this->transaksi)->join('produk', 'produk.id_produk = transaksi.id_produk')->where('id_transaksi', $id_transaksi)->get()->result_array();
		return $query;
	}

	public function store($id_transaksi, $data){
		$query = $this->db->where('id_transaksi', $id_transaksi)->where_in('status', [2,3,7])->update($this->transaksi, $data);
		return $query;
	}

	public function update_stok($id_transaksi){
		$produk = $this->db->select('produk.stok, produk.id_produk, transaksi.jumlah')->from($this->transaksi)->join('produk', 'produk.id_produk = transaksi.id_produk')->where('id_transaksi', $id_transaksi)->get()->result_array();

		$data = [
			'stok' => $produk[0]['stok'] - $produk[0]['jumlah'],
		];
		
		$query = $this->db->where('id_produk', $produk[0]['id_produk'])->update('produk', $data);
		return $query;
	}
}