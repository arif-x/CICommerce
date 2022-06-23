<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pesanan_toko_model extends CI_Model {

	protected $transaksi = 'transaksi';
	protected $produk = 'produk';
	protected $user = 'user';
	protected $toko = 'toko';

	public function index($id_user, $limit, $start){
		$query = $this->db->select('transaksi.id_transaksi, transaksi.alamat, jumlah, resi, dipesan_pada, dibayar_pada, dikirim_pada, diterima_pada, bukti_bayar, transaksi.status, jumlah_dibayar, produk.*')->from($this->transaksi)->join($this->produk, 'produk.id_produk = transaksi.id_produk')->join($this->toko, 'toko.id_toko = produk.id_toko')->where('toko.id_user', $id_user)->limit($limit, $start)->order_by('id_transaksi', 'DESC')->get()->result_array();
		return $query;
	}

	public function total_row($id_user){
		$query = $this->db->select('count(*) as jumlah', FALSE)->from($this->transaksi)->join($this->produk, 'produk.id_produk = transaksi.id_produk')->join($this->toko, 'toko.id_toko = produk.id_toko')->where('toko.id_user', $id_user)->get()->result_array();
		return $query;
	}

	public function get_id_toko($id_user){
		$query = $this->db->select('toko.id_toko')->from($this->transaksi)->join($this->produk, 'produk.id_produk = transaksi.id_produk')->join($this->toko, 'toko.id_toko = produk.id_toko')->where('toko.id_user', $id_user)->get()->result_array();
		return $query;
	}

	public function single($id_user, $id_transaksi){
		$query = $this->db->select('transaksi.id_transaksi, jumlah, resi, transaksi.alamat, dipesan_pada, dibayar_pada, dikirim_pada, diterima_pada, bukti_bayar, transaksi.status, jumlah_dibayar, produk.*')->from($this->transaksi)->join($this->produk, 'produk.id_produk = transaksi.id_produk')->join($this->toko, 'toko.id_toko = produk.id_toko')->where('toko.id_user', $id_user)->where('transaksi.id_transaksi', $id_transaksi)->get()->result_array();

		return $query;
	}

	public function konfirmasi($id_user, $id_transaksi, array $data){
		$check = $this->db->select('*')->from($this->transaksi)->join($this->produk, 'produk.id_produk = transaksi.id_produk')->join($this->toko, 'toko.id_toko = produk.id_toko')->where('toko.id_user', $id_user)->where('id_transaksi', $id_transaksi)->get()->result();
		if(empty($check)){
			echo "Data Nggak Ada";
		} else {
			$resi = $data['resi'];
			$dikirim_pada = $data['dikirim_pada'];
			$query = $this->db->set('transaksi.resi', $resi);
			$query = $this->db->set('transaksi.status', 4);
			$query = $this->db->set('transaksi.dikirim_pada', $dikirim_pada);
			$query = $this->db->where('transaksi.id_transaksi', $id_transaksi);
			$query = $this->db->where('transaksi.status', 3);
			$query = $this->db->update($this->transaksi);
			return $query;	
		}
	}
}