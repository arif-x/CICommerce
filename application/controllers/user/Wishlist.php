<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/user_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url().'login');
		}
		$this->load->model('user/wishlist_model', 'wishlist_model');
		$this->load->library('pagination');
	}

	public function index(){
		$user_data = $this->auth_model->current_user();
		$data['title'] = 'Wishlist';

		$config['base_url'] = site_url('user/wishlist');
		$config['total_rows'] = $this->db->where('id_user', strval($user_data->id_user))->count_all('wishlist');
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


		$data['wishlist'] = $this->wishlist_model->index($user_data->id_user, $config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('layout/header', $data);
		$this->load->view('user/wishlist/wishlist');
		$this->load->view('layout/sidenav');
        $this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function store($id_produk){
		$user_data = $this->auth_model->current_user();
		$check = $this->wishlist_model->check($id_produk, $user_data->id_user);
		if(empty($check)){
			$data = [
				'id_user' => $user_data->id_user,
				'id_produk' => $id_produk
			];

			$data = $this->wishlist_model->store($data);
			return json_encode($data);
		} elseif(!empty($check)){
			$data = $this->wishlist_model->destroy_ajax($user_data->id_user, $id_produk);
			return json_encode($data);
		}
	}

	public function destroy($id){
		$user_data = $this->auth_model->current_user();
		$this->wishlist_model->destroy($user_data->id_user, $id);
		$this->session->set_flashdata('success', 'Wishlist Dihapus');
		return redirect('user/wishlist');
	}
}