<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('auth/user_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url().'login');
		}
		$this->load->model('user/password_model', 'password_model');
	}

	public function change_password(){
		$check = $this->password_model->check($this->auth_model->current_user()->id_user);

		if($this->input->post('old_password') != $check[0]['password']){
			$this->session->set_flashdata('success', 'Password Gagal Diedit Karena Password Lama Salah');
			return redirect('user/profil');
		} elseif ($this->input->post('password_reset') == ''){
			$this->session->set_flashdata('success', 'Pastikan Password Lama Diisi');
			return redirect('user/profil');
		} else {			
			$data = [
				'password' => $this->input->post('password_reset'),
			];

			$this->password_model->change($this->auth_model->current_user()->id_user, $data);
			$this->session->set_flashdata('success', 'Password Berhasil Diedit');
			return redirect('user/profil');
		}
	}
} 