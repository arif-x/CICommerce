<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class wishlist_model extends CI_Model {

	private $wishlist = 'wishlist';

	public function index($id_user, $limit, $start){
		$query = $this->db->select('wishlist.id_wishlist, produk.*')->from($this->wishlist)->where('wishlist.id_user', $id_user)->join('produk', 'produk.id_produk = wishlist.id_produk')->order_by('id_wishlist', 'DESC')->limit($limit, $start);
		return $query->get()->result_array();
	}

	public function store($data){
		$query = $this->db->insert($this->wishlist, $data);
		return $query;
	}

	public function destroy($id_user, $id_wishlist){
		$query = $this->db->where('id_wishlist', $id_wishlist)->where('id_user', $id_user)->delete($this->wishlist);
		return $query;
	}

	public function destroy_ajax($id_user, $id_produk){
		$query = $this->db->where('id_user', $id_user)->where('id_produk', $id_produk)->delete($this->wishlist);
		return $query;
	}

	public function check($id_produk, $id_user){
		$query = $this->db->select('id_wishlist')->from('wishlist')->where('id_produk', $id_produk)->where('id_user', $id_user)->get()->result();
		return $query;
	}
}