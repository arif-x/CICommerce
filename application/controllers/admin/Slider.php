<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth/admin_model', 'auth_model');
		if (!$this->auth_model->current_user()) {
			return redirect(base_url().'admin/login');
		}
		$this->load->model('admin/slider_model', 'slider_model');
		$this->load->library('pagination');
	}

	public function index(){
		$data['title'] = 'Slider';

		$config['base_url'] = site_url('admin/slider/halaman');
		$config['total_rows'] = $this->db->count_all('slider');
		$config['per_page'] = 10; 
		$config["uri_segment"] = 4;
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
		$data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) - 1 : 0;

		$data['slider'] = $this->slider_model->index( $config["per_page"], $data['page']);

		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('layout/admin-header', $data);
		$this->load->view('admin/slider/slider');
		$this->load->view('layout/admin-sidenav');
		$this->load->view('layout/admin-footer');
	}

	public function store_index(){
		$data['title'] = 'Slider';

		$this->load->view('layout/admin-header', $data);
		$this->load->view('admin/slider/add');
		$this->load->view('layout/admin-sidenav');
		$this->load->view('layout/admin-footer');
	}

	public function store(){

		$files = $_FILES['slider']['tmp_name'];
		$files_data = explode('.', $_FILES['slider']['name']);
		$extension = end($files_data);
		$originalImgName = date("Y-m-d-H:i:s") .'.'. $extension;
		$new_name = str_replace(':', '-', $originalImgName);

		$config['upload_path'] = FCPATH.'/upload/slider/';
		$config['allowed_types'] = 'jpeg|gif|png|jpg';
		$config['file_name'] = $new_name;
		$config['overwrite'] = true;

		$urlfix = base_url() . "upload/slider/" . $new_name;

		$this->load->library('upload', $config);

		if($this->upload->do_upload('slider')){
			$data = [
				'slider' => $urlfix,
			];

			$this->slider_model->store($data);
			return redirect(base_url().'admin/slider');
		} else {
			$data['error'] = $this->upload->display_errors();
		}
	}

	public function edit_index($id_slider){
		$data['title'] = 'Slider';
		$data['slider'] = $this->slider_model->single($id_slider);

		$this->load->view('layout/admin-header', $data);
		$this->load->view('admin/slider/edit');
		$this->load->view('layout/admin-sidenav');
		$this->load->view('layout/admin-footer');
	}

	public function edit(){
		$id_slider = $this->input->post('id_slider');

		$files = $_FILES['slider']['tmp_name'];
		$files_data = explode('.', $_FILES['slider']['name']);
		$extension = end($files_data);
		$originalImgName = date("Y-m-d-H:i:s") .'.'. $extension;
		$new_name = str_replace(':', '-', $originalImgName);

		$config['upload_path'] = FCPATH.'/upload/slider/';
		$config['allowed_types'] = 'jpeg|gif|png|jpg';
		$config['file_name'] = $new_name;
		$config['overwrite'] = true;

		$urlfix = base_url() . "upload/slider/" . $new_name;

		$this->load->library('upload', $config);

		if($this->upload->do_upload('slider')){
			$data = [
				'slider' => $urlfix,
			];

			$this->slider_model->edit($id_slider, $data);
			return redirect(base_url().'admin/slider');
		} else {
			$data['error'] = $this->upload->display_errors();
			return redirect(base_url().'admin/slider');
		}
	}

	public function destroy($id_slider){
		$this->slider_model->destroy($id_slider);
		return redirect(base_url().'admin/slider');
	}
}