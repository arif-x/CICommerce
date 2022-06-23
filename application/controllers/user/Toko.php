<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth/user_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url() . 'login');
		}
		$this->load->model('user/toko_model', 'toko_model');
		$this->load->library('pagination');
	}

	public function index()
	{
		$user_data = $this->auth_model->current_user();
		$data['check'] = $this->toko_model->check($user_data->id_user);
		$data['title'] = $data['check'][0]['nama_toko'];
		$data['foto'] = $data['check'][0]['foto'];
		$data['banner'] = $data['check'][0]['banner'];
		$data['deskripsi'] = $data['check'][0]['deskripsi'];
		$data['id_toko'] = $data['check'][0]['id_toko'];
		$data['no_hp'] = $data['check'][0]['no_hp'];

		$config['base_url'] = site_url('user/toko/halaman');
		$config['total_rows'] = $this->db->where('id_toko', strval($data['id_toko']))->count_all('produk');
		$config['per_page'] = 16;
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

		if ($data['check'][0]['nama_toko'] == '' || $data['check'][0]['alamat'] == '' || $data['check'][0]['deskripsi'] == '' || $data['check'][0]['banner'] == '' || $data['check'][0]['slug'] == '' || $data['check'][0]['status'] == 0) {
			$data['toko'] = $this->toko_model->config($user_data->id_user);
			$this->load->view('layout/header', $data);
			$this->load->view('user/toko/konfigurasi_toko');
			$this->load->view('layout/sidenav');
			$this->load->view('script/keranjang');
			$this->load->view('layout/footer');
		} else {

			$this->pagination->initialize($config);
			$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) - 1 : 0;

			$data['toko'] = $this->toko_model->index($user_data->id_user, $config["per_page"], $data['page']);

			$data['pagination'] = $this->pagination->create_links();

			$this->load->view('layout/header', $data);
			$this->load->view('user/toko/toko');
			$this->load->view('script/wishlist');
			$this->load->view('script/keranjang');
			$this->load->view('layout/footer');
		}
	}

	public function configuration()
	{
		$user_data = $this->auth_model->current_user();
		$data['check'] = $this->toko_model->check($user_data->id_user);
		$data['title'] = $data['check'][0]['nama_toko'];
		$data['foto'] = $data['check'][0]['foto'];
		$data['banner'] = $data['check'][0]['banner'];
		$data['deskripsi'] = $data['check'][0]['deskripsi'];
		$data['toko'] = $this->toko_model->config($user_data->id_user);
		$this->load->view('layout/header', $data);
		$this->load->view('user/toko/konfigurasi_toko');
		$this->load->view('layout/sidenav');
		$this->load->view('script/keranjang');
		$this->load->view('layout/footer');
	}

	public function edit()
	{
		$user_data = $this->auth_model->current_user();

		$files_foto = $_FILES['foto']['tmp_name'];
		$files_banner = $_FILES['banner']['tmp_name'];

		$data['check'] = $this->toko_model->check($user_data->id_user);
		$data['title'] = $data['check'][0]['nama_toko'];
		$check_nama_toko = $this->toko_model->check_nama_toko($this->input->post('nama_toko'), $data['check'][0]['nama_toko']);

		if(!empty($check_nama_toko)){
			$this->session->set_flashdata('success', 'Nama Toko Sudah Dipakai');
			return redirect('user/toko/konfigurasi');
		} else {
			if (empty($files_foto) && !empty($files_banner)) {
				$files_data = explode('.', $_FILES['banner']['name']);
				$extension = end($files_data);
				$originalImgName = date("Y-m-d-H:i:s") . '.' . $extension;
				$new_name = str_replace(':', '-', $originalImgName);

				$config['upload_path']          = FCPATH . '/upload/toko/foto';
				$config['allowed_types']        = 'gif|jpg|png|JPG';
				$config['file_name']       		= $new_name;
				$config['overwrite']			= TRUE;

				$urlfix_banner = base_url() . "upload/toko/foto/" . $new_name;
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('banner')) {
					$data = [
						'nama_toko' => $this->input->post('nama_toko'),
						'alamat' => $this->input->post('alamat'),
						'deskripsi' => $this->input->post('deskripsi'),
						'no_hp' => $this->input->post('no_hp'),
						'banner' => $urlfix_banner,
					];

					$id_user = $user_data->id_user;

					$this->toko_model->edit($id_user, $data);

					$this->session->set_flashdata('success', 'Toko Diedit');
					return redirect('user/toko');
				} else {
					
					$this->session->set_flashdata('success', 'Toko Gagal Diedit');
					return redirect('user/toko/konfigurasi');
				}
			}
			if (!empty($files_foto) && empty($files_banner)) {
				$files_data = explode('.', $_FILES['foto']['name']);
				$extension = end($files_data);
				$originalImgName = date("Y-m-d-H:i:s") . '.' . $extension;
				$new_name = str_replace(':', '-', $originalImgName);

				$config['upload_path']          = FCPATH . '/upload/toko/foto';
				$config['allowed_types']        = 'gif|jpg|png|JPG';
				$config['file_name']       		= $new_name;
				$config['overwrite']			= TRUE;

				$urlfix_foto = base_url() . "upload/toko/foto/" . $new_name;
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					$data = [
						'nama_toko' => $this->input->post('nama_toko'),
						'alamat' => $this->input->post('alamat'),
						'deskripsi' => $this->input->post('deskripsi'),
						'no_hp' => $this->input->post('no_hp'),
						'foto' => $urlfix_foto,
					];

					$id_user = $user_data->id_user;

					$this->toko_model->edit($id_user, $data);

					$this->session->set_flashdata('success', 'Toko Diedit');
					return redirect('user/toko');
				} else {
					
					$this->session->set_flashdata('success', 'Toko Gagal Diedit');
					return redirect('user/toko/konfigurasi');
				}
			}
			if (!empty($files_foto) && !empty($files_banner)) {

				$files_data = explode('.', $_FILES['banner']['name']);
				$extension = end($files_data);
				$originalImgName = date("Y-m-d-H:i:s") . '.' . $extension;
				$new_name = str_replace(':', '-', $originalImgName);

				$config = array();
				$config['upload_path']          = FCPATH . '/upload/toko/banner';
				$config['allowed_types']        = 'gif|jpg|png|JPG';
				$config['file_name']       		= $new_name;

				$urlfix_banner = base_url() . "upload/toko/banner/" . $new_name;
				$this->load->library('upload', $config, 'banner');
				$this->banner->initialize($config);
				$banner = $this->banner->do_upload('banner');

				$files_datas = explode('.', $_FILES['foto']['name']);
				$extensions = end($files_datas);
				$originalImgNames = date("Y-m-d-H:i:s") . '.' . $extensions;
				$new_names = str_replace(':', '-', $originalImgNames);

				$config = array();
				$config['upload_path']          = FCPATH . '/upload/toko/foto';
				$config['allowed_types']        = 'gif|jpg|png|JPG';
				$config['file_name']       	 = $new_names;

				$urlfix_foto = base_url() . "upload/toko/foto/" . $new_names;
				$this->load->library('upload', $config, 'foto');
				$this->foto->initialize($config);
				$foto = $this->foto->do_upload('foto');


				if ($banner && $foto) {
					echo json_encode([$new_name, $new_names]);

					$data = [
						'nama_toko' => $this->input->post('nama_toko'),
						'alamat' => $this->input->post('alamat'),
						'deskripsi' => $this->input->post('deskripsi'),
						'no_hp' => $this->input->post('no_hp'),
						'banner' => $urlfix_banner,
						'foto' => $urlfix_foto,
					];

					$id_user = $user_data->id_user;

					$this->toko_model->edit($id_user, $data);

					
					$this->session->set_flashdata('success', 'Toko Diedit');
					return redirect('user/toko');
				}
			} else {
				$data = [
					'nama_toko' => $this->input->post('nama_toko'),
					'alamat' => $this->input->post('alamat'),
					'deskripsi' => $this->input->post('deskripsi'),
					'no_hp' => $this->input->post('no_hp'),
				];

				$id_user = $user_data->id_user;

				$this->toko_model->edit($id_user, $data);
				$this->session->set_flashdata('success', 'Toko Diedit');
				return redirect('user/toko');
			}
		}
	}

	public function aktivasi(){
		$user_data = $this->auth_model->current_user();
		$id_user = $user_data->id_user;
		$data = [
			'status' => $this->input->post('aktivasi')
		];
		$this->toko_model->reset_toko($id_user, $data);
		return redirect('user/toko/konfigurasi');
	}
}
