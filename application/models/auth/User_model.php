<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_model extends CI_Model
{
	private $_table = "user";
	const SESSION_KEY = 'id_user';

	public function rules()
	{
		return [
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			]
		];
	}

	public function login($email, $password)
	{
		$this->db->where('email', $email)->where('password', $password);
		$query = $this->db->get($this->_table);
		$user = $query->row();

		if (!$user) {
			return FALSE;
		}

		$this->session->set_userdata([self::SESSION_KEY => $user->id_user]);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function register($data){
		$this->db->insert($this->_table, $data);
		$profil = [
			'id_user' => $this->db->insert_id()
		];
		$toko = [
			'id_user' => $this->db->insert_id(),
			'banner' => base_url() . "upload/toko/banner/no-image.png",
			'foto' => base_url() . "upload/toko/foto/no-image.jpg",
		];
		$this->db->insert('profil', $profil);
		$query = $this->db->insert('toko', $toko);
		return $query;
	}

	public function has_user($email){
		$check = $this->db->select('*')->from($this->_table)->where('email', $email)->get()->result();
		return $check;
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$id_user = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->_table, ['id_user' => $id_user]);
		return $query->row();
	}

	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}

	public function check_active_user($email){
		$query = $this->db->select('*')->from('user')->where('email', $email)->get()->result_array();
		return $query;
	}

	public function check_email($email){
		$query = $this->db->select('*')->from('user')->where('email', $email)->get()->result_array();
		return $query;
	}

	public function update_key($email, $data){
		$query = $this->db->where('email', $email)->update('user', $data);
		return $query;
	}

	public function update_email_key($email, $data){
		$query = $this->db->where('email', $email)->update('user', $data);
		return $query;
	}

	public function set_password($password_key){
		$query = $this->db->select('password_key')->from('user')->where('password_key', $password_key)->get()->result_array();
		return $query;
	}

	public function update_password($password_key, $data){
		$query = $this->db->where('password_key', $password_key)->update('user', $data);
		return $query;
	}

	public function set_aktif($email_key, $data){
		$query = $this->db->where('email_key', $email_key)->update('user', $data);
		return $query;
	}
}
