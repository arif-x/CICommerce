<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/admin_model', 'admin_model');
		$this->load->library('form_validation');
	}

	public function index(){

		show_404();
	}
	
	public function login()
	{
		$data['title'] = 'Login';
		
		$rules = $this->admin_model->rules();
		$this->form_validation->set_rules($rules);

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if($this->admin_model->login($email, $password)){
			$this->session->set_flashdata('success', 'Berhasil Login');
			redirect('admin/slider');
		} else {
			// var_dump('12');
		}

		$this->load->view('layout/header', $data);
		$this->load->view('auth/admin/login');
		$this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function logout()
	{
		$this->admin_model->logout();
		$this->session->set_flashdata('success', 'Berhasil Logout');
		redirect(site_url());
	}
}
