<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('product');
    }

    public function index()
    {
        $data['products'] = $this->product->get_all();

        $this->load->view('products/index', $data);
    }

    public function edit($id)
    {
        $data['product'] = $this->product->get_by_id($id);
        if ($data['product']) {
            $this->load->view('products/edit', $data);
        } else {
            echo "Produk tidak ditemukan.";
        }
    }

    public function update($id)
    {
        // Ambil data dari form
        $name = $this->input->post('name');
        $price = $this->input->post('price');
        $stock = $this->input->post('stock');
        $is_sell = $this->input->post('is_sell');

        // Update data produk di database
        $this->product->update($id, $name, $price, $stock, $is_sell);

        // Redirect ke halaman produk
        redirect('products');
    }
}
