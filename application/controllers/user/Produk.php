<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/user_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url().'login');
		}
		$this->load->model('user/produk_model', 'produk_model');
		$this->load->model('user/toko_model', 'toko_model');
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function index(){
		$user_data = $this->auth_model->current_user();
		$data['toko'] = $this->toko_model->check($user_data->id_user);
		$data['title'] = 'Produk Toko';
		$data['check'] = $this->toko_model->check($user_data->id_user);

		$config['base_url'] = site_url('user/toko/produk/halaman');
		$config['total_rows'] = $this->db->where('id_user', strval($user_data->id_user))->count_all('produk');
		$config['per_page'] = 10; 
		$config["uri_segment"] = 5;
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
		if ($data['check'][0]['nama_toko'] == '' || $data['check'][0]['alamat'] == '' || $data['check'][0]['deskripsi'] == '' || $data['check'][0]['banner'] == '' || $data['check'][0]['slug'] == '' || $data['check'][0]['status'] == 0) {
			$data['toko'] = $this->toko_model->config($user_data->id_user);
			return redirect('user/toko/konfigurasi');
		} else {
			$data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) - 1 : 0;

			$data['produk'] = $this->produk_model->index($data['toko'][0]['id_toko'], $config["per_page"], $data['page']);

			$data['pagination'] = $this->pagination->create_links();

			$this->load->view('layout/header', $data);
			$this->load->view('user/toko/produk/produk');
			$this->load->view('layout/sidenav');
			$this->load->view('layout/footer');
		}
	}

	public function single($slug){
		$user_data = $this->auth_model->current_user();
		$data['check'] = $this->toko_model->check($user_data->id_user);
		if ($data['check'][0]['nama_toko'] == '' || $data['check'][0]['alamat'] == '' || $data['check'][0]['deskripsi'] == '' || $data['check'][0]['banner'] == '' || $data['check'][0]['slug'] == '' || $data['check'][0]['status'] == 0) {
			$data['toko'] = $this->toko_model->config($user_data->id_user);
			return redirect('user/toko/konfigurasi');
			$data['produk'] = $this->produk_model->single($user_data->id_user, $slug);
		}
	}

	public function index_store(){
		$user_data = $this->auth_model->current_user();
		$data['check'] = $this->toko_model->check($user_data->id_user);
		if ($data['check'][0]['nama_toko'] == '' || $data['check'][0]['alamat'] == '' || $data['check'][0]['deskripsi'] == '' || $data['check'][0]['banner'] == '' || $data['check'][0]['slug'] == '' || $data['check'][0]['status'] == 0) {
			$data['toko'] = $this->toko_model->config($user_data->id_user);
			return redirect('user/toko/konfigurasi');
		} else {
			$data['title'] = 'Tambah Produk';
			$this->load->view('layout/header', $data);
			$this->load->view('user/toko/produk/index_store');
			$this->load->view('layout/sidenav');
			$this->load->view('layout/footer');
		}
	}

	public function store(){
		$user_data = $this->auth_model->current_user();
		$data['check'] = $this->toko_model->check($user_data->id_user);
		if ($data['check'][0]['nama_toko'] == '' || $data['check'][0]['alamat'] == '' || $data['check'][0]['deskripsi'] == '' || $data['check'][0]['banner'] == '' || $data['check'][0]['slug'] == '' || $data['check'][0]['status'] == 0) {
			$data['toko'] = $this->toko_model->config($user_data->id_user);
			return redirect('user/toko/konfigurasi');
		} else {
			$gambar = explode('.', $_FILES['gambar']['name']);
			$extension = end($gambar);
			$originalImgName = date("Y-m-d-H:i:s") . '.' . $extension;
			$new_name = str_replace(':', '-', $originalImgName);

			$config['upload_path']          = FCPATH . '/upload/toko/produk';
			$config['allowed_types']        = 'gif|jpg|png|JPG';
			$config['file_name']       		= $new_name;
			$config['overwrite']			= TRUE;

			$url_fix = base_url() . "upload/toko/produk/" . $new_name;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('gambar')) {
				$datas['toko'] = $this->toko_model->check($user_data->id_user);
				$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
				$this->form_validation->set_rules('harga', 'Harga', 'required');
				$this->form_validation->set_rules('kategori', 'Kategori', 'required');
				$this->form_validation->set_rules('stok', 'Stok', 'required');
				if ($this->form_validation->run() != FALSE){
					$data = [
						'id_toko' => $datas['toko'][0]['id_toko'],
						'nama_produk' => $this->input->post('nama_produk'),
						'deskripsi' => $this->input->post('deskripsi'),
						'diskon' => $this->input->post('diskon'),
						'harga' => $this->input->post('harga'),
						'kategori' => $this->input->post('kategori'),
						'gambar' => base_url() . "upload/toko/produk/no-image.jpg",
						'stok' => $this->input->post('stok'),
					];

					$this->produk_model->store($data);
					$this->session->set_flashdata('success', 'Produk Ditambah');
					return redirect('user/toko/produk');
				} else {
					$this->session->set_flashdata('error', 'Semua Input Harap Diisi');
					echo validation_errors();
				}
			} else {
				$datas['toko'] = $this->toko_model->check($user_data->id_user);
				$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
				$this->form_validation->set_rules('harga', 'Harga', 'required');
				$this->form_validation->set_rules('kategori', 'Kategori', 'required');
				$this->form_validation->set_rules('stok', 'Stok', 'required');
				if ($this->form_validation->run() != FALSE){
					$data = [
						'id_toko' => $datas['toko'][0]['id_toko'],
						'nama_produk' => $this->input->post('nama_produk'),
						'deskripsi' => $this->input->post('deskripsi'),
						'diskon' => $this->input->post('diskon'),
						'harga' => $this->input->post('harga'),
						'kategori' => $this->input->post('kategori'),
						'gambar' => $url_fix,
						'stok' => $this->input->post('stok'),
					];

					$this->produk_model->store($data);
					return redirect('user/toko/produk');
				} else {
					echo validation_errors();
				}
			}
		}
	}

	public function index_edit($id_produk){
		$user_data = $this->auth_model->current_user();
		$data['check'] = $this->toko_model->check($user_data->id_user);
		if ($data['check'][0]['nama_toko'] == '' || $data['check'][0]['alamat'] == '' || $data['check'][0]['deskripsi'] == '' || $data['check'][0]['banner'] == '' || $data['check'][0]['slug'] == '' || $data['check'][0]['status'] == 0) {
			return redirect('user/toko/konfigurasi');
		} else {
			$datas['toko'] = $this->toko_model->check($user_data->id_user);
			$data['produk'] = $this->produk_model->single($datas['toko'][0]['id_toko'], $id_produk);
			if(empty($data['produk'])){
				return redirect('user/toko/produk');
			} else {
				$data['title'] = 'Edit Produk';
				$this->load->view('layout/header', $data);
				$this->load->view('user/toko/produk/index_edit');
				$this->load->view('layout/sidenav');
				$this->load->view('layout/footer');
			}
		}
	}

	public function edit(){
		$user_data = $this->auth_model->current_user();
		$data['check'] = $this->toko_model->check($user_data->id_user);
		if ($data['check'][0]['nama_toko'] == '' || $data['check'][0]['alamat'] == '' || $data['check'][0]['deskripsi'] == '' || $data['check'][0]['banner'] == '' || $data['check'][0]['slug'] == '' || $data['check'][0]['status'] == 0) {
			return redirect('user/toko/konfigurasi');
		} else {
			$data['toko'] = $this->toko_model->config($user_data->id_user);
			$gambare = $_FILES['gambar']['tmp_name'];

			if(empty($gambare)){
				$id_produk = $this->input->post('id_produk');
				$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
				$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
				$this->form_validation->set_rules('harga', 'Harga', 'required');
				$this->form_validation->set_rules('kategori', 'Kategori', 'required');
				$this->form_validation->set_rules('stok', 'Stok', 'required');
				$datas['toko'] = $this->toko_model->check($user_data->id_user);
				if ($this->form_validation->run() != FALSE){
					$data = [
						'id_toko' => $datas['toko'][0]['id_toko'],
						'nama_produk' => $this->input->post('nama_produk'),
						'deskripsi' => $this->input->post('deskripsi'),
						'diskon' => $this->input->post('diskon'),
						'kategori' => $this->input->post('kategori'),
						'harga' => $this->input->post('harga'),
						'stok' => $this->input->post('stok'),
					// 'slug' => mb_strtolower(url_title(convert_accented_characters($datas['toko'][0]['nama_toko']))).'-'.mb_strtolower(url_title(convert_accented_characters($this->input->post('nama_produk')))),
					];

					$this->produk_model->edit($datas['toko'][0]['id_toko'], $id_produk, $data);
					$this->session->set_flashdata('success', 'Produk Diedit');
					return redirect('user/toko/produk');
				} else {
					$this->session->set_flashdata('error', 'Semua Input Harap Diisi');
					echo validation_errors();
				}
			} else {
				$gambar = explode('.', $_FILES['gambar']['name']);
				$extension = end($gambar);
				$originalImgName = date("Y-m-d-H:i:s") . '.' . $extension;
				$new_name = str_replace(':', '-', $originalImgName);

				$config['upload_path']          = FCPATH . '/upload/toko/produk';
				$config['allowed_types']        = 'gif|jpg|png|JPG';
				$config['file_name']       		= $new_name;
				$config['overwrite']			= TRUE;

				$url_fix = base_url() . "upload/toko/produk/" . $new_name;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('gambar')) {
					echo "Error";
				} else {
					$id_produk = $this->input->post('id_produk');
					$datas['toko'] = $this->toko_model->check($user_data->id_user);
					$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
					$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
					$this->form_validation->set_rules('harga', 'Harga', 'required');
					$this->form_validation->set_rules('kategori', 'Kategori', 'required');
					$this->form_validation->set_rules('stok', 'Stok', 'required');
					if ($this->form_validation->run() != FALSE){
						$data = [
							'id_toko' => $datas['toko'][0]['id_toko'],
							'nama_produk' => $this->input->post('nama_produk'),
							'deskripsi' => $this->input->post('deskripsi'),
							'diskon' => $this->input->post('diskon'),
							'kategori' => $this->input->post('kategori'),
							'harga' => $this->input->post('harga'),
							'gambar' => $url_fix,
							'stok' => $this->input->post('stok'),
						// 'slug' => mb_strtolower(url_title(convert_accented_characters($datas['toko'][0]['nama_toko']))).'-'.mb_strtolower(url_title(convert_accented_characters($this->input->post('nama_produk')))),
						];

						$this->produk_model->edit($datas['toko'][0]['id_toko'], $id_produk, $data);
						$this->session->set_flashdata('success', 'Produk Diedit');
						return redirect('user/toko/produk');
					} else {
						$this->session->set_flashdata('error', 'Semua Input Harap Diisi');
						echo validation_errors();
					}
				}
			}
		}
	}

	public function destroy($id_produk){
		$user_data = $this->auth_model->current_user();
		$data['check'] = $this->toko_model->check($user_data->id_user);
		if ($data['check'][0]['nama_toko'] == '' || $data['check'][0]['alamat'] == '' || $data['check'][0]['deskripsi'] == '' || $data['check'][0]['banner'] == '' || $data['check'][0]['slug'] == '' || $data['check'][0]['status'] == 0) {
			$data['toko'] = $this->toko_model->config($user_data->id_user);
			return redirect('user/toko/konfigurasi');
		} else {
			$datas['toko'] = $this->toko_model->check($user_data->id_user);
			$this->produk_model->destroy($datas['toko'][0]['id_toko'], $id_produk);
			$this->session->set_flashdata('success', 'Produk Dihapus');
			return redirect('user/toko/produk');
		}
	}

	public function get_kategori(){
		$data = $this->db->select('id_kategori, kategori')->from('kategori')->get()->result();
		echo json_encode($data);
	}

	public function single_json($id_produk){
		$user_data = $this->auth_model->current_user();
		$datas['toko'] = $this->toko_model->check($user_data->id_user);
		$data_check = $this->db->select('*, kategori.kategori as nama_kategori')->from('produk')->join('kategori', 'kategori.id_kategori = produk.kategori')->where('id_toko', $datas['toko'][0]['id_toko'])->where('id_produk', $id_produk)->get()->result();
		if(empty($data_check)){
		} else {
			$data = $this->db->select('*, kategori.kategori as nama_kategori')->from('produk')->join('kategori', 'kategori.id_kategori = produk.kategori')->where('id_toko', $datas['toko'][0]['id_toko'])->where('id_produk', $id_produk)->get()->result();
			echo json_encode($data);
		}
	}
}