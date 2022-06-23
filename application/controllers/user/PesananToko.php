<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PesananToko extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/user_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url().'login');
		}
		$this->load->model('user/pesanan_toko_model', 'pesanan_toko_model');
		$this->load->model('user/toko_model', 'toko_model');
		$this->load->library('pagination');
		$this->load->helper('date');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
		$user_data = $this->auth_model->current_user();
		$data['check'] = $this->toko_model->check($user_data->id_user);
		$data['title'] = 'Daftar Pesanan';
		$id_toko = $this->pesanan_toko_model->get_id_toko($user_data->id_user);
		$row = $this->pesanan_toko_model->total_row($user_data->id_user);

		$config['base_url'] = site_url('user/toko/pesanan/halaman');
		$config['total_rows'] = $row[0]['jumlah'];
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

		if ($data['check'][0]['nama_toko'] == '' || $data['check'][0]['alamat'] == '' || $data['check'][0]['deskripsi'] == '' || $data['check'][0]['banner'] == '' || $data['check'][0]['slug'] == '' || $data['check'][0]['status'] == 0) {
			$data['toko'] = $this->toko_model->config($user_data->id_user);
			return redirect('user/toko/konfigurasi');
		} else {

			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) - 1 : 0;


			$data['transaksi'] = $this->pesanan_toko_model->index($user_data->id_user, $config["per_page"], $data['page']);

			$data['pagination'] = $this->pagination->create_links();

			$this->load->view('layout/header', $data);
			$this->load->view('user/toko/pesanan/pesanan');
			$this->load->view('layout/sidenav');
			$this->load->view('script/keranjang');
			$this->load->view('layout/footer');
		}
	}

	public function single($id_transaksi){
		$user_data = $this->auth_model->current_user();
		$data['check'] = $this->toko_model->check($user_data->id_user);
		$data['transaksi'] = $this->pesanan_toko_model->single($user_data->id_user, $id_transaksi);
		if ($data['check'][0]['nama_toko'] == '' || $data['check'][0]['alamat'] == '' || $data['check'][0]['deskripsi'] == '' || $data['check'][0]['banner'] == '' || $data['check'][0]['slug'] == '' || $data['check'][0]['status'] == 0) {
			$data['toko'] = $this->toko_model->config($user_data->id_user);
			return redirect('user/toko/konfigurasi');
		} else {
			$data['title'] = 'Pesanan';
			$this->load->view('layout/header', $data);
			$this->load->view('user/toko/pesanan/detail');
			$this->load->view('layout/sidenav');
			$this->load->view('script/keranjang');
			$this->load->view('layout/footer');
		}
	}

	public function konfirmasi_index($id_transaksi){
		$user_data = $this->auth_model->current_user();
		$data['check'] = $this->toko_model->check($user_data->id_user);
		$data['resi'] = $this->pesanan_toko_model->single($user_data->id_user, $id_transaksi);
		if ($data['check'][0]['nama_toko'] == '' || $data['check'][0]['alamat'] == '' || $data['check'][0]['deskripsi'] == '' || $data['check'][0]['banner'] == '' || $data['check'][0]['slug'] == '' || $data['check'][0]['status'] == 0) {
			$data['toko'] = $this->toko_model->config($user_data->id_user);
			return redirect('user/toko/konfigurasi');
		} else {
			$data['title'] = 'Pesanan';
			$this->load->view('layout/header', $data);
			$this->load->view('user/toko/pesanan/konfirmasi');
			$this->load->view('layout/sidenav');
			$this->load->view('script/keranjang');
			$this->session->set_flashdata('success', 'Pesanan Dikonfirmasi');
			$this->load->view('layout/footer');
		}
	}

	public function konfirmasi(){
		$datestring = '%d-%m-%Y %H:%i:%s';
		$time = time();
		$user_data = $this->auth_model->current_user();
		$data = [
			'resi' => $this->input->post('resi'),
			'dikirim_pada' => mdate($datestring, $time),
		];
		$this->pesanan_toko_model->konfirmasi($user_data->id_user, $this->input->post('id_transaksi'), $data);
		return redirect('user/toko/pesanan');
		// echo "string";
	}
}