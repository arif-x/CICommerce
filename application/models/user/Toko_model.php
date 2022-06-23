<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class toko_model extends CI_Model
{

	private $produk = 'produk';
	private $toko = 'toko';

	public function index($id_user, $limit, $start)
	{
		$query = $this->db->select('produk.*, toko.alamat, toko.deskripsi, toko.banner, toko.nama_toko')->from($this->produk)->join('toko', 'toko.id_toko = produk.id_toko')->where('toko.id_user', $id_user)->limit($limit, $start)->order_by('id_toko', 'desc')->get()->result_array();
		return $query;
	}

	public function check($id_user)
	{
		$check = $this->db->select('*')->from($this->toko)->where('id_user', $id_user)->get()->result_array();
		return $check;
	}

	public function config($id_user)
	{
		$query = $this->db->select('*')->from($this->toko)->where('id_user', $id_user)->get()->result_array();
		return $query;
	}

	public function check_nama_toko($nama_toko, $nama_toko_lama){
		$query = $this->db->select('nama_toko')->from('toko')->where('nama_toko', $nama_toko)->where('nama_toko', $nama_toko_lama)->get()->result_array();
		return $query;
	}

	public function edit($id_user, $data)
	{
		$this->db->where('id_user', $id_user)->update($this->toko, $data);

		$id = $id_user;

		$count = 0;
		$name = url_title($this->input->post('nama_toko'));
		$slug_name = $name;

		while(true) {
			$this->db->select('id_user');
			$this->db->where('id_user !=', $id);
			$this->db->where('slug', $slug_name);
			$query = $this->db->get($this->toko);
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

		$this->db->where('id_user', $id)->update($this->toko, $slug);
		$query = $this->db->last_query();

		return $query;
	}

	public function reset_toko($id_user, $data){
		$query = $this->db->where('id_user', $id_user)->update($this->toko, $data);
		return $query;
	}
}
