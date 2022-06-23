<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class keranjang_model extends CI_Model {

	private $keranjang = 'keranjang';
	private $produk = 'produk';

	public function index($id_user, $limit, $start){
		$query = $this->db->select('keranjang.id_keranjang, keranjang.jumlah, produk.*')->from($this->keranjang)->where('keranjang.id_user', $id_user)->join('produk', 'produk.id_produk = keranjang.id_produk')->limit($limit, $start)->order_by('id_keranjang', 'DESC');
		return $query->get()->result_array();
	}

	public function store($data){
		$query = $this->db->insert($this->keranjang, $data);
		return $query;
	}

	public function check($id_produk, $id_user){
		$query = $this->db->select('id_produk')->from('keranjang')->where('id_produk', $id_produk)->where('id_user', $id_user)->get()->result();
		return $query;
	}

	public function edit($id_user, $id_keranjang, $data){
		$query = $this->db->where('id_keranjang', $id_keranjang)->where('id_user', $id_user)->update($this->keranjang, $data);
		return $query;
	}

	public function single($id_keranjang, $id_user){
		$query = $this->db->select('keranjang.id_keranjang, keranjang.jumlah, produk.*')->from($this->keranjang)->join('produk', 'produk.id_produk = keranjang.id_produk')->where('keranjang.id_user', $id_user)->where('keranjang.id_keranjang', $id_keranjang);
		return $query->get()->result_array();
	}

	public function single_ajax($id_keranjang, $id_user){
		$query = $this->db->select('keranjang.id_keranjang, keranjang.jumlah, produk.*')->from($this->keranjang)->join('produk', 'produk.id_produk = keranjang.id_produk')->where('keranjang.id_user', $id_user)->where('keranjang.id_keranjang', $id_keranjang);
		return $query->get()->row();
	}

	public function destroy($id_user, $id_keranjang){
		$query = $this->db->where('id_keranjang', $id_keranjang)->where('id_user', $id_user)->delete($this->keranjang);
		return $query;
	}

	public function index_no_pagination($id_user){
		$query = $this->db->select('keranjang.id_keranjang, keranjang.jumlah, produk.*')->from($this->keranjang)->where('keranjang.id_user', $id_user)->join('produk', 'produk.id_produk = keranjang.id_produk')->order_by('id_keranjang', 'DESC')->limit(5);
		return $query->get()->result_array();
	}

	public function get_count_dan_jumlah($id_user){
		$query = $this->db->select('sum(keranjang.jumlah * produk.harga) as jumlah_bayar, count(id_keranjang) as total_row')->from($this->keranjang)->join('produk', 'produk.id_produk = keranjang.id_produk')->where('keranjang.id_user', $id_user)->order_by('id_keranjang', 'DESC');
		return $query->get()->result_array();
	}

	public function get_count_keranjang($id_user){
		$query = $this->db->select('keranjang.*, produk.nama_produk, produk.harga, produk.diskon, produk.slug, produk.gambar')->from($this->keranjang)->join($this->produk, 'produk.id_produk = keranjang.id_produk')->where('id_user', $id_user)->get()->result();
		return $query;
	}

	public function get_id_user_toko_produk($id_produk){
		$query = $this->db->select('user.id_user')->from('user')->join('toko', 'toko.id_user = user.id_user')->join('produk', 'produk.id_toko = toko.id_toko')->where('produk.id_produk', $id_produk)->get()->result_array();
		return $query;
	}

	public function cek_status_toko($id_produk){
		$query = $this->db->select('toko.status')->from('toko')->join('produk', 'produk.id_toko = toko.id_toko')->where('produk.id_produk', $id_produk)->get()->result_array();
		return $query;
	}

	public function cek_stok($id_produk){
		$query = $this->db->select('stok')->from('produk')->where('id_produk', $id_produk)->get()->result_array();
		return $query;
	}
}