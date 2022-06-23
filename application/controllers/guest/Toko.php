<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('guest/toko_model', 'toko_model');
		$this->load->library('pagination');
	}

	public function index()
	{
		$data['title'] = 'Daftar Toko';

		$config['base_url'] = site_url('toko/semua');
		$config['total_rows'] = $this->db->count_all('toko');
		$config['per_page'] = 20; 
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;

		$config['first_link']       = 'Awal';
		$config['last_link']        = 'Akhir';
		$config['next_link']        = 'Selanjutnya';
		$config['prev_link']        = 'Kembali';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';

		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) - 1 : 0;

		$data['toko'] = $this->toko_model->index($config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('layout/header', $data);
		$this->load->view('guest/toko/toko');
        $this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function single($slug){
		$data['check'] = $this->toko_model->check($slug);

		if(empty($data['check'])){
			$data['title'] = 'Toko Tidak Ada';
			$this->load->view('layout/header', $data);
			$this->load->view('guest/toko/single_not_found');
			$this->load->view('script/keranjang');
			$this->load->view('layout/footer');
		} else {


			$data['title'] = $data['check'][0]['nama_toko'];
			$data['foto'] = $data['check'][0]['foto'];
			$data['banner'] = $data['check'][0]['banner'];
			$data['deskripsi'] = $data['check'][0]['deskripsi'];
			$data['no_hp'] = $data['check'][0]['no_hp'];

			$config['base_url'] = site_url('toko/detail/'.$slug.'/halaman');
			$config['total_rows'] = $this->db->where('toko', $data['check'][0]['slug'])->count_all('produk');
			$config['per_page'] = 16;
			$config["uri_segment"] = 5;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = floor($choice);
			$config['use_page_numbers'] = TRUE;
			$config['reuse_query_string'] = TRUE;

			$config['first_link']       = 'Awal';
			$config['last_link']        = 'Akhir';
			$config['next_link']        = 'Selanjutnya';
			$config['prev_link']        = 'Kembali';
			$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
			$config['full_tag_close']   = '</ul></nav></div>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>Next</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';

			$this->pagination->initialize($config);

			$data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) - 1 : 0;

			$data['toko'] = $this->toko_model->single($slug, $config["per_page"], $data['page']);

			$data['pagination'] = $this->pagination->create_links();

			$this->load->view('layout/header', $data);
			$this->load->view('guest/toko/single');
			$this->load->view('script/wishlist');
			$this->load->view('script/keranjang');
			$this->load->view('layout/footer');
		}
	}
}
