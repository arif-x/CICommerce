<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/user_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url().'login');
		}
		$this->load->model('user/profil_model', 'profil_model');
	}

	public function index(){
		$user_data = $this->auth_model->current_user();
		
		$data['title'] = 'Profil';
		$data['profil'] = $this->profil_model->index($user_data->id_user);

		$this->load->view('layout/header', $data);
		$this->load->view('user/profil/profil');
		$this->load->view('layout/sidenav');
		$this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function edit(){
		$user_data = $this->auth_model->current_user()->id_user;

		$data = [
			'nama_lengkap' => $this->input->post('nama_lengkap'),
			'no_telp' => $this->input->post('no_telp'),
			'alamat_lengkap' => $this->input->post('alamat_lengkap'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
		];

		$data = $this->profil_model->edit($user_data, $data);
		$this->session->set_flashdata('success', 'Profil Diedit');
		return redirect('user/profil');
	}
}