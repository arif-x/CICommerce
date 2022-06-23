<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/user_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url().'login');
		}
		$this->load->model('user/transaksi_model', 'transaksi_model');
		$this->load->model('user/alamat_model', 'alamat_model');
		$this->load->model('user/keranjang_model', 'keranjang_model');
		$this->load->model('user/saldo_model', 'saldo_model');
		$this->load->library('pagination');
		$this->load->helper('date');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
		$user_data = $this->auth_model->current_user();

		$data['title'] = 'Transaksi';

		$config['base_url'] = site_url('user/keranjang');
		$config['total_rows'] = $this->db->where('id_user', strval($user_data->id_user))->count_all('keranjang');
		$config['per_page'] = 10; 
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

		$data['transaksi'] = $this->transaksi_model->index($user_data->id_user, $config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('layout/header', $data);
		$this->load->view('user/transaksi/transaksi');
		$this->load->view('layout/sidenav');
		$this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function single($id_transaksi){
		$user_data = $this->auth_model->current_user();
		$data['transaksi'] = $this->transaksi_model->single($user_data->id_user, $id_transaksi);
		$data['title'] = $data['transaksi'][0]['nama_produk'];
		$this->load->view('layout/header', $data);
		$this->load->view('user/transaksi/detail');
		$this->load->view('layout/sidenav');
		$this->load->view('layout/footer');
	}

	// FUNCTION PAKAI ID KERANJANG
	public function store($id_keranjang){
		$user_data = $this->auth_model->current_user();
		$keranjang = $this->transaksi_model->get_total_price($user_data->id_user, $id_keranjang);
		$datestring = '%d-%m-%Y %H:%i:%s';
		$time = time();
		if($keranjang[0]['stok'] < $this->input->post('jumlah')){
			return redirect('user/keranjang');
		} else {
			if($keranjang[0]['diskon'] == 0){
				$jumlah_dibayar = ($keranjang[0]['harga'] * $this->input->post('jumlah'));
			} elseif($keranjang[0]['diskon'] >= 0.001) {
				$jumlah_dibayar = ($keranjang[0]['harga'] - ($keranjang[0]['harga'] * $keranjang[0]['diskon'] / 100)) * $this->input->post('jumlah');
			}
			$data = [
				'id_user' => $user_data->id_user,
				'id_produk' => $keranjang[0]['id_produk'],
				'jumlah' => $this->input->post('jumlah'),
				'jumlah_dibayar' => $jumlah_dibayar,
				'dipesan_pada' => mdate($datestring, $time),
				'alamat' => $this->input->post('alamat'),
				'status' => 1
			];

			$this->transaksi_model->store($data);
			$this->keranjang_model->destroy($user_data->id_user, $id_keranjang);
			$this->session->set_flashdata('success', 'Produk Dipesan');
			return redirect('user/transaksi');
		}
	}

	public function bayar_index($id_transaksi){
		$user_data = $this->auth_model->current_user();
		$data['transaksi'] = $this->transaksi_model->bayar_index($user_data->id_user, $id_transaksi);
		$data['title'] = $data['transaksi'][0]['nama_produk'];

		$this->load->view('layout/header', $data);
		$this->load->view('user/transaksi/bayar');
		$this->load->view('layout/sidenav');
		$this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function bayar(){
		$user_data = $this->auth_model->current_user();

		$bukti = explode('.', $_FILES['bukti_bayar']['name']);
		$extension = end($bukti);
		$originalImgName = date("Y-m-d-H:i:s") . '.' . $extension;
		$new_name = str_replace(':', '-', $originalImgName);

		$config['upload_path']          = FCPATH . '/upload/bukti-bayar';
		$config['allowed_types']        = 'gif|jpg|png|JPG';
		$config['file_name']       		= $new_name;
		$config['overwrite']			= TRUE;

		$url_fix = base_url() . "upload/bukti-bayar/" . $new_name;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('bukti_bayar')) {
			echo "Error";
		} else {
			$id_transaksi = $this->input->post('id_transaksi');
			$datestring = '%d-%m-%Y %H:%i:%s';
			$time = time();
			$data = [
				'bukti_bayar' => $url_fix,
				'dibayar_pada' => mdate($datestring, $time),
				'status' => 2
			];
			$this->transaksi_model->bayar($user_data->id_user, $id_transaksi, $data);
			$this->session->set_flashdata('success', 'Bukti Bayar Diupload');
			return redirect('user/transaksi');
		}
	}

	public function batal($id_transaksi){
		$user_data = $this->auth_model->current_user();
		$data = [
			'status' => 0
		];
		$this->transaksi_model->batal($user_data->id_user, $id_transaksi, $data);
		$this->session->set_flashdata('success', 'Transaksi Dibatalkan');
		return redirect('user/transaksi');
	}

	public function terima($id_transaksi){
		$datestring = '%d-%m-%Y %H:%i:%s';
		$time = time();
		$user_data = $this->auth_model->current_user();
		$data = [
			'status' => 5,
			'diterima_pada' => mdate($datestring, $time),
		];

		if($this->transaksi_model->terima($user_data->id_user, $id_transaksi, $data) == TRUE){
			$detail = $this->saldo_model->get_detail_produk_from_transaksi($id_transaksi);
			$data_saldo = [
				'id_toko' => $detail[0]['id_toko'],
				'id_transaksi' => $detail[0]['id_transaksi'],
				'jenis_saldo' => 1,
				'jumlah' => $detail[0]['jumlah_dibayar'],
			];
			$this->saldo_model->execute_terima($data_saldo);
			$this->session->set_flashdata('success', 'Produk Diterima');	
			return redirect('user/transaksi');
		} else {
			echo "error";
		}
		

		// echo json_encode($this->saldo_model->get_detail_produk_from_transaksi($id_transaksi));



		// $this->saldo_model->execute_terima();
		// return redirect('user/transaksi');
	}
}