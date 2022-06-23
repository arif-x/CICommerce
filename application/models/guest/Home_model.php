<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home_model extends CI_Model
{

    public function index_toko()
    {
        $query = $this->db->select('*')->from('toko')->order_by('id_toko', 'desc')->limit(8)->where('nama_toko is NOT NULL')->where('alamat is NOT NULL')->where('deskripsi is NOT NULL')->where('foto is NOT NULL')->where('banner is NOT NULL')->where('slug is NOT NULL')->get()->result_array();
        return $query;
    }

    public function index_produk()
    {
        $query = $this->db->select('produk.*, toko.nama_toko, toko.status')->from('produk')->join('toko', 'toko.id_toko = produk.id_toko')->where('toko.status', 1)->limit(8)->order_by('id_produk', 'desc')->get()->result_array();
        return $query;
    }

    public function kategori(){
        $query = $this->db->select('*')->from('kategori')->order_by('kategori', 'asc')->get()->result_array();
        return $query;
    }
}
