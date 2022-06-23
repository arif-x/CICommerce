<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class transaksi_model extends CI_Model {

	protected $transaksi = 'transaksi';
	protected $keranjang = 'keranjang';
	protected $produk = 'produk';

	public function index($id_user, $limit, $start){
		$query = $this->db->select('transaksi.id_transaksi, jumlah, resi, dipesan_pada, dibayar_pada, dikirim_pada, diterima_pada, bukti_bayar, status, jumlah_dibayar, produk.*')->from($this->transaksi)->join('produk', 'produk.id_produk = transaksi.id_produk')->where('transaksi.id_user', $id_user)->limit($limit, $start)->order_by('id_transaksi', 'DESC')->get()->result_array();

		return $query;
	}

	public function single($id_user, $id_transaksi){
		$query = $this->db->select('transaksi.*, nama_produk')->from($this->transaksi)->join($this->produk, 'produk.id_produk = transaksi.id_produk')->where('id_user', $id_user)->where('id_transaksi', $id_transaksi)->get()->result_array();
		return $query;
	}

	public function get_total_price($id_user, $id_keranjang){
		$query = $this->db->select('keranjang.*, produk.harga, produk.diskon, stok')->from($this->keranjang)->join($this->produk, 'produk.id_produk = keranjang.id_produk')->where('id_keranjang', $id_keranjang)->where('id_user', $id_user)->get()->result_array();
		return $query;
	}

	public function store($data){
		$query = $this->db->insert($this->transaksi, $data);
		return $query;
	}

	public function batal($id_user, $id_transaksi, $data){
		$status = array(1, 7);
		$query = $this->db->where('id_user', $id_user)->where_in('status', $status)->where('id_transaksi', $id_transaksi)->update($this->transaksi, $data);
		return $query;
	}

	public function bayar_index($id_user, $id_transaksi){
		$query = $this->db->select('id_transaksi, jumlah_dibayar, nama_produk')->from($this->transaksi)->join($this->produk, 'produk.id_produk = transaksi.id_produk')->where('id_user', $id_user)->where('id_transaksi', $id_transaksi)->get()->result_array();
		return $query;
	}

	public function bayar($id_user, $id_transaksi, $data){
		$query = $this->db->where('id_user', $id_user)->where('status', 1)->where('id_transaksi', $id_transaksi)->update($this->transaksi, $data);
	}

	public function terima($id_user, $id_transaksi, $data){
		$query = $this->db->where('id_user', $id_user)->where('id_transaksi', $id_transaksi)->update($this->transaksi, $data);
		return ($this->db->affected_rows() > 0);
	}

	public function get_stock($id_produk){
		$query = $this->db->select('stok')->from($this->produk)->where('id_produk', $id_produk)->get()->result_array();
		return $query;
	}
}