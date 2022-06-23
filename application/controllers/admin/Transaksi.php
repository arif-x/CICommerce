<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/admin_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url().'admin/login');
		}
		$this->load->model('admin/transaksi_model', 'transaksi_model');
		$this->load->library('pagination');
	}

	public function index(){
		$data['title'] = 'Transaksi';

		$config['base_url'] = site_url('admin/transaksi/halaman');
		$config['total_rows'] = $this->db->count_all('transaksi');
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

		$data['transaksi'] = $this->transaksi_model->index($config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('layout/admin-header', $data);
		$this->load->view('admin/transaksi/transaksi');
		$this->load->view('layout/admin-sidenav');
		$this->load->view('layout/admin-footer');
	}

	public function konfirmasi_index($id_transaksi){
		$data['transaksi'] = $this->transaksi_model->edit_index($id_transaksi);
		$data['title'] = 'Transaksi - '.$data['transaksi'][0]['nama_produk'].' - Rp. '.number_format($data['transaksi'][0]['jumlah_dibayar'],0,',','.');
		$this->load->view('layout/admin-header', $data);
		$this->load->view('admin/transaksi/edit');
		$this->load->view('layout/admin-sidenav');
		$this->load->view('layout/admin-footer');
	}

	public function konfirmasi(){
		$id_transaksi = $this->input->post('id_transaksi');
		$data = [
			'status' => $this->input->post('konfirmasi'),
		];

		$this->transaksi_model->store($id_transaksi, $data);

		if($this->input->post('konfirmasi') == 3){
			$this->transaksi_model->update_stok($id_transaksi, $data);	
		}
		return redirect('admin/transaksi');
	}
}