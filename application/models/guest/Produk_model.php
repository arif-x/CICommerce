<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produk_model extends CI_Model
{

    private $table = 'produk';
    private $toko = 'toko';
    private $kategori = 'kategori';

    public function index($limit, $start)
    {
        $query = $this->db->select('produk.*, toko.nama_toko')->from($this->table)->join($this->toko, 'toko.id_toko = produk.id_toko')->order_by('id_produk', 'desc')->limit($limit, $start)->where('toko.status', 1)->get()->result_array();
        return $query;
    }

    public function single($slug){
        $query = $this->db->select('produk.*, toko.nama_toko, kategori.slug as slug_kategori, toko.status')->from($this->table)->join($this->kategori, 'kategori.id_kategori = produk.kategori')->join($this->toko, 'toko.id_toko = produk.id_toko')->where('produk.slug', $slug)->get()->result_array();
        return $query;
    }

    public function like_data($slug){
        $query = $this->db->select('produk.*, toko.nama_toko, kategori.slug as slug_kategori')->from($this->table)->join($this->kategori, 'kategori.id_kategori = produk.kategori')->join($this->toko, 'toko.id_toko = produk.id_toko')->where('kategori.slug', $slug)->limit(10)->where('toko.status', 1)->get()->result_array();
        return $query;
    }

    public function search($nama_produk, $limit, $start){
        $query = $this->db->select('produk.*, toko.nama_toko')->from($this->table)->join($this->toko, 'toko.id_toko = produk.id_toko')->like('produk.nama_produk', $nama_produk)->limit($limit, $start)->where('toko.status', 1)->get()->result_array();
        return $query;
    }

    public function by_kategori($slug, $limit, $start){
        $query = $this->db->select('produk.*, toko.nama_toko, kategori.slug as slug_kategori')->from($this->table)->join($this->toko, 'toko.id_toko = produk.id_toko')->join($this->kategori, 'kategori.id_kategori = produk.kategori')->where('kategori.slug', $slug)->limit($limit, $start)->where('toko.status', 1)->get()->result_array();
        return $query;
    }
}
