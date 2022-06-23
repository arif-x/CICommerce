<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/user_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url().'login');
		}
		$this->load->model('user/keranjang_model', 'keranjang_model');
		$this->load->model('user/alamat_model', 'alamat_model');
		$this->load->library('pagination');
	}

	public function index(){
		$user_data = $this->auth_model->current_user();
		$data['title'] = 'Keranjang';

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


		$data['keranjang'] = $this->keranjang_model->index($user_data->id_user, $config["per_page"], $data['page']);
		$data['alamat'] = $this->alamat_model->single_ajax($user_data->id_user);

		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('layout/header', $data);
		$this->load->view('user/keranjang/keranjang');
		$this->load->view('layout/sidenav');
		$this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function store($id_produk, $jumlah){
		$user_data = $this->auth_model->current_user();
		$cek_id_user = $this->keranjang_model->get_id_user_toko_produk($id_produk);
		$cek_status_toko = $this->keranjang_model->cek_status_toko($id_produk);
		$cek_stok = $this->keranjang_model->cek_stok($id_produk);
		if($cek_id_user[0]['id_user'] == $user_data->id_user){
			$message['message'] = 'Produk tidak dapat ditambahkan dalam keranjang karena membeli produknya sendiri!';
			$message['info'] = 'Info';
			echo json_encode($message);
		} elseif($cek_status_toko[0]['status'] == '0'){
			$message['message'] = 'Produk tidak dapat ditambahkan dalam keranjang karena status toko tidak aktif!';
			$message['info'] = 'Info';
			echo json_encode($message);
		} elseif($cek_stok[0]['stok'] == '0'){
			$message['message'] = 'Produk tidak dapat ditambahkan dalam keranjang karena stok habis!';
			$message['info'] = 'Info';
			echo json_encode($message);
		} else {
			$data = [
				'id_user' => $user_data->id_user,
				'id_produk' => $id_produk,
				'jumlah' => $jumlah,
			];

			$data = $this->keranjang_model->store($data);
			$message['info'] = 'Sukses';
			$message['message'] = 'Produk telah ditambahkan dalam keranjang!';
			echo json_encode($message);
		}
	}

	// public function edit_page($id){
	// 	$user_data = $this->auth_model->current_user();
	// 	$data['keranjang'] = $this->keranjang_model->single($id, $user_data->id_user);
	// 	$this->load->view('layout/header', $data);
	// 	$this->load->view('user/keranjang/edit_keranjang');
	// 	$this->load->view('layout/sidenav');
	// 	$this->load->view('layout/footer');
	// }

	// public function edit(){
	// 	$user_data = $this->auth_model->current_user();
	// 	$id_keranjang = $this->input->post('id_keranjang');
	// 	$data = [
	// 		'jumlah' => $this->input->post('jumlah'),
	// 	];

	// 	$this->keranjang_model->edit($user_data->id_user, $id_keranjang, $data);
	// 	return redirect('user/keranjang');
	// }

	public function destroy($id){
		$user_data = $this->auth_model->current_user();
		$this->keranjang_model->destroy($user_data->id_user, $id);
		$this->session->set_flashdata('success', 'Produk Dihapus dari Keranjang');
		return redirect('user/keranjang');
	}

	public function single($id_keranjang){
		$user_data = $this->auth_model->current_user();
		$data = $this->keranjang_model->single_ajax($id_keranjang, $user_data->id_user);
		echo json_encode($data);
	}

	public function get_ajax(){
		$user_data = $this->auth_model->current_user();
		$data = $this->keranjang_model->get_count_keranjang($user_data->id_user);
		echo json_encode($data);
	}

	public function destroy_ajax($id){
		$user_data = $this->auth_model->current_user();
		$data = $this->keranjang_model->destroy($user_data->id_user, $id);
		// return redirect('user/keranjang');
		return json_encode($data);
	}

}