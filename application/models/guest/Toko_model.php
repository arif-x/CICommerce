<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class toko_model extends CI_Model
{

	private $table = 'toko';
	private $produk = 'produk';

	public function index($limit, $start)
	{
		$query = $this->db->select('*')->from($this->table)->order_by('id_toko', 'desc')->limit($limit, $start)->where('nama_toko is NOT NULL')->where('alamat is NOT NULL')->where('deskripsi is NOT NULL')->where('foto is NOT NULL')->where('banner is NOT NULL')->where('slug is NOT NULL')->where('toko.status', 1)->get()->result_array();
		return $query;
	}
	
	public function single($slug, $limit, $start){
		$query = $this->db->select('produk.*, toko.alamat, toko.deskripsi, toko.banner, toko.nama_toko, toko.status')->from($this->produk)->join('toko', 'toko.id_toko = produk.id_toko')->where('toko.slug', $slug)->limit($limit, $start)->order_by('id_toko', 'desc')->get()->result_array();
		return $query;
	}

	public function check($slug){
		$query = $this->db->select('*')->from($this->table)->where('slug', $slug)->get()->result_array();
		return $query;
	}
}
