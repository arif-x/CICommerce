<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('guest/home_model', 'home_model');
	}

	public function index()
	{
		$data['title'] = 'Home';
		$data['toko'] = $this->home_model->index_toko();
		$data['produk'] = $this->home_model->index_produk();
		$data['kategori'] = $this->home_model->kategori();
		$data['slider'] = $this->db->select('slider')->from('slider')->get()->result_array();
		$this->load->view('layout/header', $data);
		$this->load->view('welcome_message', $data);
		$this->load->view('script/wishlist', $data);
		$this->load->view('script/keranjang', $data);
		$this->load->view('layout/footer');
	}
}
