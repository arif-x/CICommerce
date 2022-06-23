<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('guest/produk_model', 'produk_model');
        $this->load->library('pagination');
    }

    public function index()
    {
        $data['title'] = "Daftar Produk";

        $config['base_url'] = site_url('produk/semua');
        $config['total_rows'] = $this->db->count_all('produk');
        $config['per_page'] = 20; 
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

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) - 1 : 0;

        $data['produk'] = $this->produk_model->index($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();


        $this->load->view('layout/header', $data);
        $this->load->view('guest/produk/produk');
        $this->load->view('script/wishlist');
        $this->load->view('script/keranjang');
        $this->load->view('layout/footer');
    }

    public function by_kategori($slug){

        $jumlah_data =  $this->db->select('count(*) as jumlah')->from('produk')->join('kategori', 'kategori.id_kategori = produk.kategori')->where('kategori.slug', $slug)->get()->result_array();

        $config['base_url'] = site_url('produk/kategori/'.$slug.'/halaman/');
        $config['total_rows'] = $jumlah_data[0]['jumlah'];
        $config['per_page'] = 20; 
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
        $data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) - 1 : 0;

        $data['produk'] = $this->produk_model->by_kategori($slug, $config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = "Daftar Produk";

        $this->load->view('layout/header', $data);
        $this->load->view('guest/produk/produk');
        $this->load->view('script/wishlist');
        $this->load->view('script/keranjang');
        $this->load->view('layout/footer');
    }

    public function search()
    {
        $data['title'] = "Daftar Produk";
        $like = $this->input->get('query');
        $config['base_url'] = site_url('produk/cari/halaman');
        $config['total_rows'] = $this->db->like('nama_produk', $like)->count_all('produk');
        $config['per_page'] = 20; 
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

        $data['produk'] = $this->produk_model->search($like, $config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('layout/header', $data);
        $this->load->view('guest/produk/produk');
        $this->load->view('script/wishlist');
        $this->load->view('script/keranjang');
        $this->load->view('layout/footer');
    }

    public function single($slug){
        $data['produk'] = $this->produk_model->single($slug);
        if(empty($data['produk'])){
            $data['title'] = 'Produk Tidak Ada';
            $this->load->view('layout/header', $data);
            $this->load->view('guest/produk/single_not_found');
            $this->load->view('layout/footer');
        } else {
            $data['title'] = $data['produk'][0]['nama_produk'];
            $data['similiar'] = $this->produk_model->like_data($data['produk'][0]['slug_kategori']); 
            $this->load->view('layout/header', $data);
            $this->load->view('guest/produk/single');
            $this->load->view('script/wishlist');
            $this->load->view('script/keranjang-single-produk');
            $this->load->view('script/keranjang');
            $this->load->view('layout/footer');
        }
    }
}
