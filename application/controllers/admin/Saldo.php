<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/admin_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url().'login');
		}
		$this->load->model('admin/saldo_model', 'saldo_model');
		$this->load->library('pagination');
		$this->load->helper('date');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
		$user_data = $this->auth_model->current_user();
		$data['title'] = 'Daftar Penarikan Saldo Toko';

		$config['base_url'] = site_url('admin/saldo-toko/pengeluaran/halaman');
		$config['total_rows'] = $this->db->count_all('withdraw');
		$config['per_page'] = 10; 
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

		$data['withdraw'] = $this->saldo_model->index($config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('layout/admin-header', $data);
		$this->load->view('admin/saldo_toko/saldo_toko');
		$this->load->view('layout/admin-sidenav');
		$this->load->view('layout/footer');
	}

	public function store(){
		$data = [
			'status' => $this->input->post('konfirmasi'),
		];
		$this->saldo_model->execution($this->input->post('id_withdraw'), $data);
		return redirect('user/toko/saldo/pengeluaran');
	}
}