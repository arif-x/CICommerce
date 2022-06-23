<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth/user_model', 'user_model');
		$this->load->library('form_validation');
		$this->load->helper('string');
	}

	public function index()
	{
		show_404();
	}

	public function login()
	{
		$rules = $this->user_model->rules();
		$this->form_validation->set_rules($rules);

		$data['title'] = 'Login';

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$check = $this->user_model->check_active_user($email);

		if ($this->user_model->login($email, $password)) {
			if($check[0]['active'] == 0){
				$this->user_model->logout();
				$data['title'] = 'Aktifkan Akun Anda';

				$email_key =  random_string('alnum', 50);

				$key = [
					'email_key' => $email_key
				];

				$this->user_model->update_email_key($email, $key);

				$config = array();
				$config['charset'] = 'utf-8';
				$config['useragent'] = 'Codeigniter';
				$config['protocol']= "smtp";
				$config['mailtype']= "html";
				$config['smtp_host']= "ssl://smtp.gmail.com";
				$config['smtp_user']= "ecommerceruangbit@gmail.com"; 
				$config['smtp_pass']= "akuganteng"; 
				$config['smtp_port']= "465";
				$config['smtp_timeout']= "5";
				$config['crlf']="\r\n"; 
				$config['newline']="\r\n";
				$config['charset']='iso-8859-1';
				$config['wordwrap'] = TRUE;


				$this->load->library('email', $config);

				$this->email->initialize($config);

				$this->email->from($config['smtp_user'], 'Ecommerce');
				$this->email->to($email);
				$this->email->subject("Aktivasi Akun");

				$message = "<p>Anda melakukan permintaan aktivasi akun</p>";
				$message .= "<a href='". base_url() ."aktivasi/key/". $email_key ."'>Klik Disini untuk Mengaktifkan Akun</a>";
				$this->email->message($message);

				if($this->email->send()){
					$data['title'] = 'Aktivasi Akun';
					$this->load->view('layout/header', $data);
					$this->load->view('user/profil/aktivasi');
					$this->load->view('script/keranjang');
					$this->load->view('layout/footer');
				}
				
			} else {
				$this->session->set_flashdata('success', 'Berhasil Login');
				redirect('user/profil');
			}
		} else {
			// var_dump('12');
		}

		$this->load->view('layout/header', $data);
		$this->load->view('auth/user/login');
		$this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function daftar()
	{
		$data['title'] = 'Daftar';
		$this->load->view('layout/header', $data);
		$this->load->view('auth/user/register');
		$this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function register()
	{
		$rules = $this->user_model->rules();
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header');
			$this->load->view('auth/user/register');
			$this->load->view('script/keranjang');
			$this->load->view('layout/footer');
		}

		$email = $this->input->post('email');

		$data = [
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
		];

		$check = $this->user_model->has_user($email);
		if (count($check) >= 1) {
			$this->session->set_flashdata('success', 'Email telah Digunakan');
			redirect('/register');
		} elseif ($this->user_model->register($data)) {
			$this->session->set_flashdata('success', 'Berhasil Mendaftar');
			redirect('/login');
		} else {
			// var_dump('12');
		}

		$data['title'] = 'Aktifkan Akun Anda';

		$email_key =  random_string('alnum', 50);

		$key = [
			'email_key' => $email_key
		];

		$this->user_model->update_email_key($email, $key);

		$config = array();
		$config['charset'] = 'utf-8';
		$config['useragent'] = 'Codeigniter';
		$config['protocol']= "smtp";
		$config['mailtype']= "html";
		$config['smtp_host']= "ssl://smtp.gmail.com";
		$config['smtp_user']= "ecommerceruangbit@gmail.com"; 
		$config['smtp_pass']= "akuganteng"; 
		$config['smtp_port']= "465";
		$config['smtp_timeout']= "5";
		$config['crlf']="\r\n"; 
		$config['newline']="\r\n";
		$config['charset']='iso-8859-1';
		$config['wordwrap'] = TRUE;


		$this->load->library('email', $config);

		$this->email->initialize($config);

		$this->email->from($config['smtp_user'], 'Ecommerce');
		$this->email->to($email);
		$this->email->subject("Aktivasi Akun");

		$message = "<p>Anda melakukan permintaan aktivasi akun</p>";
		$message .= "<a href='". base_url() ."aktivasi/key/". $email_key ."'>Klik Disini untuk Mengaktifkan Akun</a>";
		$this->email->message($message);

		if($this->email->send()){
			$data['title'] = 'Aktivasi Akun';
			$this->load->view('layout/header', $data);
			$this->load->view('user/profil/aktivasi');
			$this->load->view('script/keranjang');
			$this->load->view('layout/footer');
		}
	}

	public function logout()
	{
		$this->user_model->logout();
		$this->session->set_flashdata('success', 'Berhasil Logout');
		redirect(site_url());
	}

	public function reset_password_index(){
		$data['title'] = 'Reset Password';
		$this->load->view('layout/header', $data);
		$this->load->view('auth/user/reset_password');
		$this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function send_email(){
		$email = $this->input->post('email');
		$id_user = $this->user_model->check_email($email);

		if(empty($id_user[0]['email'])){
			return redirect('reset-password');
		} else {
			$reset_key =  random_string('alnum', 50);

			$key = [
				'password_key' => $reset_key
			];

			$this->user_model->update_key($email, $key);

			$config = array();
			$config['charset'] = 'utf-8';
			$config['useragent'] = 'Codeigniter';
			$config['protocol']= "smtp";
			$config['mailtype']= "html";
			$config['smtp_host']= "ssl://smtp.gmail.com";
			$config['smtp_user']= "ecommerceruangbit@gmail.com"; 
			$config['smtp_pass']= "akuganteng"; 
			$config['smtp_port']= "465";
			$config['smtp_timeout']= "5";
			$config['crlf']="\r\n"; 
			$config['newline']="\r\n";
			$config['charset']='iso-8859-1';
			$config['wordwrap'] = TRUE;


			$this->load->library('email', $config);

			$this->email->initialize($config);

			$this->email->from($config['smtp_user'], 'Ecommerce');
			$this->email->to($email);
			$this->email->subject("Permintaan Ubah Password");

			$message = "<p>Anda melakukan permintaan reset password</p>";
			$message .= "<a href='". base_url() ."reset-password/key/". $reset_key ."'>Klik Disini untuk Mengubah Password</a>";
			$this->email->message($message);

			if($this->email->send()){
				$data['title'] = 'Permintaan Email Ubah Password';
				$this->load->view('layout/header', $data);
				$this->load->view('user/password/email-send');
				$this->load->view('script/keranjang');
				$this->load->view('layout/footer');
			}
		}
	}

	public function set_password_index($reset_key){
		$data['title'] = 'Set Password';
		$data['key'] = $this->user_model->set_password($reset_key);

		$this->load->view('layout/header', $data);
		$this->load->view('auth/user/set_password');
		$this->load->view('script/keranjang');
		$this->load->view('layout/footer');		
	} 

	public function set_password(){
		$password = [
			'password' => $this->input->post('password'),
		];

		$this->user_model->update_password($this->input->post('password_key'), $password);
		$this->session->set_flashdata('success', 'Password Diganti');
		return redirect('login');
	}

	public function set_aktif($email_key){
		$active = [
			'active' => 1
		];

		$this->user_model->set_aktif($email_key, $active);
		$this->session->set_flashdata('success', 'Akun Diaktifkan');
		return redirect('login');
	} 
}
