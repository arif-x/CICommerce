<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alamat extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/user_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url().'login');
		}
		$this->load->model('user/alamat_model', 'alamat_model');
		$this->load->library('pagination');
	}

	public function index(){
		$user_data = $this->auth_model->current_user();
		$data['title'] = 'Daftar Alamat';

		$config['base_url'] = site_url('user/alamat');
        $config['total_rows'] = $this->db->where('id_user', strval($user_data->id_user))->count_all('daftar_alamat');
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


		$data['alamat'] = $this->alamat_model->index($user_data->id_user, $config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

		$this->load->view('layout/header', $data);
		$this->load->view('user/alamat/alamat');
		$this->load->view('layout/sidenav');
        $this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function create_page(){
		$data['title'] = 'Tambah Alamat';
		$this->load->view('layout/header', $data);
		$this->load->view('user/alamat/tambah_alamat');
		$this->load->view('layout/sidenav');
        $this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function single($id_alamat){
		$user_data = $this->auth_model->current_user();
		$data['alamat'] = $this->alamat_model->single($user_data->id_user, $id_alamat);
	}

	public function store(){
		$user_data = $this->auth_model->current_user();
		$data = [
			'id_user' => $user_data->id_user,
			'alamat' => $this->input->post('alamat'),
		];

		$this->alamat_model->store($data);

		return redirect('user/alamat');
	}

	public function edit_page($id_alamat){
		$data['title'] = 'Edit Alamat';
		$user_data = $this->auth_model->current_user();
		$data['alamat'] = $this->alamat_model->single($user_data->id_user, $id_alamat);
		$this->load->view('layout/header', $data);
		$this->load->view('user/alamat/edit_alamat');
		$this->load->view('layout/sidenav');
        $this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function edit(){
		$user_data = $this->auth_model->current_user();
		$data = [
			'alamat' => $this->input->post('alamat'),
		];

		$id_alamat = $this->input->post('id_alamat');

		$this->alamat_model->edit($user_data->id_user, $id_alamat, $data);

		return redirect('user/alamat');
	}

	public function destroy($id){
		$user_data = $this->auth_model->current_user();
		$this->alamat_model->destroy($user_data->id_user, $id);
		return redirect('user/alamat');
	}
}