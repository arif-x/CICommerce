<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/user_model', 'user_model');
		if (!$this->user_model->current_user()) {
			return redirect(base_url().'login');
		}
		$this->load->model('user/keranjang_model', 'keranjang_model');
	}

	public function index(){
		$user_data = $this->user_model->current_user();
		echo json_encode($this->keranjang_model->get_count_dan_jumlah($user_data->id_user));
	}
}