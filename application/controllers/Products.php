<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('product');
    }

    // Tampilkan semua produk
    public function index()
    {
        $data['products'] = $this->product->get_all();

        $this->load->view('products/index', $data);
    }

    // Tampilkan detail produk
    public function detail($id)
    {
        $data['product'] = $this->product->get_by_id($id);
        if ($data['product']) {
            $this->load->view('products/detail', $data);
        } else {
            echo "Produk tidak ditemukan.";
        }
    }
}
