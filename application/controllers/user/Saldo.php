<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class saldo extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/user_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url().'login');
		}
		$this->load->model('user/saldo_model', 'saldo_model');
		$this->load->model('user/pesanan_toko_model', 'pesanan_toko_model');
		$this->load->model('user/toko_model', 'toko_model');
		$this->load->library('pagination');
		$this->load->helper('date');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function pemasukan(){
		$user_data = $this->auth_model->current_user();

		$data['title'] = 'Saldo Toko';
		$data['check'] = $this->toko_model->check($user_data->id_user);

		$count = $this->saldo_model->get_count($user_data->id_user);

		$config['base_url'] = site_url('user/toko/saldo/pemasukan/halaman');
		$config['total_rows'] = $count[0]['jumlah'];
		$config['per_page'] = 10; 
		$config["uri_segment"] = 6;
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
			$data['page'] = ($this->uri->segment(6)) ? $this->uri->segment(6) - 1 : 0;

			$data['saldo'] = $this->saldo_model->index($user_data->id_user, $config["per_page"], $data['page']);
			$pemasukan = $this->saldo_model->get_pemasukan($user_data->id_user);
			$total_withdraw = $this->saldo_model->get_sum_of_withdraw($user_data->id_user);
			$data['jumlah_saldo'] = ($pemasukan[0]['sum_masuk'] - $total_withdraw[0]['sum_withdraw']);

			$data['pagination'] = $this->pagination->create_links();

			$this->load->view('layout/header', $data);
			$this->load->view('user/toko/saldo/masuk');
			$this->load->view('layout/sidenav');
			$this->load->view('script/keranjang');
			$this->load->view('layout/footer');
		}
	}

	public function single_pemasukan($id_transaksi){
		$user_data = $this->auth_model->current_user();
		$data['transaksi'] = $this->pesanan_toko_model->single($user_data->id_user, $id_transaksi);
		$data['check'] = $this->toko_model->check($user_data->id_user);
		$data['title'] = 'Pesanan';
		$this->load->view('layout/header', $data);
		$this->load->view('user/toko/saldo/detail_masuk');
		$this->load->view('layout/sidenav');
		$this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function history_withdraw(){
		$user_data = $this->auth_model->current_user();
		$data['title'] = 'Pengeluaran Toko';
		$data['check'] = $this->toko_model->check($user_data->id_user);
		$count = $this->saldo_model->get_count_wd($user_data->id_user);

		$config['base_url'] = site_url('user/toko/saldo/pengeluaran/halaman');
		$config['total_rows'] = $count[0]['jumlah'];
		$config['per_page'] = 10; 
		$config["uri_segment"] = 6;
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
			$data['page'] = ($this->uri->segment(6)) ? $this->uri->segment(6) - 1 : 0;

			$data['withdraw'] = $this->saldo_model->history_withdraw($user_data->id_user, $config["per_page"], $data['page']);

			$pemasukan = $this->saldo_model->get_pemasukan($user_data->id_user);
			$total_withdraw = $this->saldo_model->get_sum_of_withdraw($user_data->id_user);
			$data['jumlah_saldo'] = ($pemasukan[0]['sum_masuk'] - $total_withdraw[0]['sum_withdraw']);

			$data['pagination'] = $this->pagination->create_links();

			$this->load->view('layout/header', $data);
			$this->load->view('user/toko/saldo/withdraw');
			$this->load->view('layout/sidenav');
			$this->load->view('script/keranjang');
			$this->load->view('layout/footer');
		}
	}

	public function withdraw_index(){
		$user_data = $this->auth_model->current_user();
		$data['check'] = $this->toko_model->check($user_data->id_user);
		if ($data['check'][0]['nama_toko'] == '' || $data['check'][0]['alamat'] == '' || $data['check'][0]['deskripsi'] == '' || $data['check'][0]['banner'] == '' || $data['check'][0]['slug'] == '' || $data['check'][0]['status'] == 0) {
			$data['toko'] = $this->toko_model->config($user_data->id_user);
			return redirect('user/toko/konfigurasi');
		} else {
			$pemasukan = $this->saldo_model->get_pemasukan($user_data->id_user);
			$total_withdraw = $this->saldo_model->get_sum_of_withdraw($user_data->id_user);
			$data['saldo'] = ($pemasukan[0]['sum_masuk'] - $total_withdraw[0]['sum_withdraw']);
			$data['title'] = 'Ajukan Withdraw/Pengeluaran';
			$this->load->view('layout/header', $data);
			$this->load->view('user/toko/saldo/withdraw_request');
			$this->load->view('layout/sidenav');
			$this->load->view('script/keranjang');
			$this->load->view('layout/footer');
		}
	}

	public function withdraw(){
		$user_data = $this->auth_model->current_user();
		$data['check'] = $this->toko_model->check($user_data->id_user);
		$data['toko'] = $this->toko_model->config($user_data->id_user);
		if ($data['check'][0]['nama_toko'] == '' || $data['check'][0]['alamat'] == '' || $data['check'][0]['deskripsi'] == '' || $data['check'][0]['banner'] == '' || $data['check'][0]['slug'] == '' || $data['check'][0]['status'] == 0) {
			// return redirect('user/toko/konfigurasi');
			echo json_encode($data);
		} else {
			$pemasukan = $this->saldo_model->get_pemasukan($user_data->id_user);
			$total_withdraw = $this->saldo_model->get_sum_of_withdraw($user_data->id_user);
			$saldo = ($pemasukan[0]['sum_masuk'] - $total_withdraw[0]['sum_withdraw']);

			if($saldo < $this->input->post('jumlah')){
				$data['title'] = 'Saldo Kurang';
				$this->load->view('layout/header', $data);
				$this->load->view('user/toko/saldo/saldo_kurang');
				$this->load->view('layout/footer');
			} else {
				$datas['check'] = $this->toko_model->check($user_data->id_user);
				$datestring = '%d-%m-%Y %H:%i:%s';
				$time = time();
				$data = [
					'id_toko' => $datas['check'][0]['id_toko'],
					'jumlah' => $this->input->post('jumlah'),
					'withdraw_pada' => mdate($datestring, $time),
					'no_rek' => $this->input->post('no_rek'),
					'status' => 0,
				];

				$this->saldo_model->store_withdraw($data);
				return redirect('user/toko/saldo/pengeluaran');
			}
		}
	}

	public function cancel_withdraw($id_withdraw){
		$user_data = $this->auth_model->current_user();
		$datas['check'] = $this->toko_model->check($user_data->id_user);
		$data = [
			'status' => 2,
		];
		$this->saldo_model->batal_withdraw($id_withdraw, $datas['check'][0]['id_toko'], $data);
		return redirect('user/toko/saldo/pengeluaran');
	}
}