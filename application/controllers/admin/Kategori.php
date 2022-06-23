<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/admin_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url().'admin/login');
		}
		$this->load->model('admin/kategori_model', 'kategori_model');
		$this->load->library('pagination');
	}

	public function index(){
		$data['title'] = 'Kategori';

		$config['base_url'] = site_url('admin/kategori/halaman');
		$config['total_rows'] = $this->db->count_all('kategori');
		$config['per_page'] = 10; 
		$config["uri_segment"] = 4;
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
		$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) - 1 : 0;

		$data['kategori'] = $this->kategori_model->index( $config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('layout/admin-header', $data);
		$this->load->view('admin/kategori/kategori');
		$this->load->view('layout/admin-sidenav');
		$this->load->view('layout/admin-footer');
	}

	public function store_index(){
		$data['title'] = 'Kategori';

		$this->load->view('layout/admin-header', $data);
		$this->load->view('admin/kategori/add');
		$this->load->view('layout/admin-sidenav');
		$this->load->view('layout/admin-footer');
	}

	public function store(){
		$data = [
			'kategori' => $this->input->post('kategori'),
			'slug' => mb_strtolower(url_title($this->input->post('kategori'))),
		];

		$this->kategori_model->store($data);
		return redirect(base_url().'admin/kategori');
	}

	public function edit_index($id_kategori){
		$data['title'] = 'Kategori';
		$data['kategori'] = $this->kategori_model->single($id_kategori);

		$this->load->view('layout/admin-header', $data);
		$this->load->view('admin/kategori/edit');
		$this->load->view('layout/admin-sidenav');
		$this->load->view('layout/admin-footer');
	}

	public function edit(){
		$id_kategori = $this->input->post('id_kategori');

		$data = [
			'kategori' => $this->input->post('kategori'),
			'slug' => mb_strtolower(url_title($this->input->post('kategori'))),
		];

		$this->kategori_model->edit($id_kategori, $data);
		return redirect(base_url().'admin/kategori');
	}

	public function destroy($id_kategori){
		$this->kategori_model->destroy($id_kategori);
		return redirect(base_url().'admin/kategori');
	}
}