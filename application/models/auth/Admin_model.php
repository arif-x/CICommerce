<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model
{
	private $_table = "admin";
	const SESSION_KEY = 'id_admin';

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

		$this->session->set_userdata([self::SESSION_KEY => $user->id_admin]);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$id_admin = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->_table, ['id_admin' => $id_admin]);
		return $query->row();
	}

	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}
}
