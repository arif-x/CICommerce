<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk_model extends CI_Model
{

	private $produk = 'produk';
	private $kategori = 'kategori';

	public function index($id_toko, $limit, $start){
		$query = $this->db->select('*, kategori.kategori as nama_kategori')->from($this->produk)->join($this->kategori, 'kategori.id_kategori = produk.kategori')->where('id_toko', $id_toko)->limit($limit, $start)->get()->result_array();
		return $query;
	}

	public function single($id_toko, $id_produk)
	{
		$query = $this->db->select('*, kategori.kategori as nama_kategori')->from($this->produk)->join($this->kategori, 'kategori.id_kategori = produk.kategori')->where('id_toko', $id_toko)->where('id_produk', $id_produk)->get();
		return $query->result_array();
	}

	public function store($data)
	{
		$this->db->insert($this->produk, $data);

		$id = $this->db->insert_id();

		$count = 0;
		$name = url_title($this->input->post('nama_produk'));
		$slug_name = $name;
		
		while(true) {
			$this->db->select('id_produk');
			$this->db->where('id_produk !=', $id);
			$this->db->where('slug', $slug_name);
			$query = $this->db->get($this->produk);
			if ($query->num_rows() == 0){
				break;
			} else {
				$slug_name = $name . '-' . (++$count);	
			}
		}

		echo $slug_name;

		$slug = [
			'slug' => $slug_name 
		];

		$this->db->where('id_produk', $id)->update($this->produk, $slug);
		$query = $this->db->last_query();
	}

	public function edit($id_toko, $id_produk, $data)
	{
		$count = 0;
		$name = url_title($this->input->post('nama_produk'));
		$slug_name = $name;
		
		while(true) {
			$this->db->select('id_produk');
			$this->db->where('id_produk !=', $id_produk);
			$this->db->where('slug', $slug_name);
			$query = $this->db->get($this->produk);
			if ($query->num_rows() == 0){
				break;
			} else {
				$slug_name = $name . '-' . (++$count);	
			}
		}

		$this->db->where('id_toko', $id_toko)->where('id_produk', $id_produk)->update($this->produk, $data);

		$slug = [
			'slug' => $slug_name 
		];

		$query = $this->db->where('id_toko', $id_toko)->where('id_produk', $id_produk)->update($this->produk, $slug);
		return $query;
	}

	public function destroy($id_toko, $id_produk)
	{
		$query = $this->db->where('id_toko', $id_toko)->where('id_produk', $id_produk)->delete($this->produk);
	}
}
