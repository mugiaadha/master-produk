<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('product');
    }

    public function index()
    {
        $keyword = $this->input->get('search');
        $sort = $this->input->get('sort');
        $order = $this->input->get('order');

        if ($keyword || $sort || $order) {
            $data['products'] = $this->product->search_products($keyword, $sort, $order);
        } else {
            $data['products'] = $this->product->get_all();
        }

        $this->load->view('products/index', $data);
    }

    public function add()
    {
        $this->load->view('products/add');
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

    public function insert()
    {
        // Tentukan aturan validasi untuk input form
        $this->form_validation->set_rules('name', 'Nama Produk', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('price', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stock', 'Jumlah Stok', 'required|numeric');
        $this->form_validation->set_rules('is_sell', 'Status Produk', 'required|in_list[0,1]'); // 0 atau 1

        if ($this->form_validation->run() === FALSE) {
            // notifikasi gagal
            $this->session->set_flashdata('error', 'Produk gagal ditambah!');

            // kembali ke form tambah produk
            $this->load->view('products/add');
        } else {
            // Menyimpan produk ke database
            $data = array(
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'stock' => $this->input->post('stock'),
                'is_sell' => $this->input->post('is_sell')
            );

            $this->product->insert($data);

            // Set flashdata success message
            $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');

            // Redirect ke halaman produk
            redirect('products');
        }
    }

    public function update($id)
    {
        // Tentukan aturan validasi untuk input form
        $this->form_validation->set_rules('name', 'Nama Produk', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('price', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('stock', 'Jumlah Stok', 'required|numeric');
        $this->form_validation->set_rules('is_sell', 'Status Produk', 'required|in_list[0,1]'); // 0 atau 1

        // Jika validasi gagal, kembalikan ke form edit dengan pesan error
        if ($this->form_validation->run() === FALSE) {
            // Ambil data produk berdasarkan ID
            $data['product'] = $this->product->get_by_id($id);
            $this->session->set_flashdata('error', 'Produk gagal diperbaharui!');
            // Tampilkan halaman edit dengan error validasi
            $this->load->view('products/edit', $data);
        } else {
            // Ambil data dari form
            $name = $this->input->post('name');
            $price = $this->input->post('price');
            $stock = $this->input->post('stock');
            $is_sell = $this->input->post('is_sell');

            // Update data produk di database
            $this->product->update($id, $name, $price, $stock, $is_sell);

            // Redirect ke halaman produk
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui!');
            redirect('products');
        }
    }

    public function update_status($product_id)
    {
        // Ambil status yang dipilih dari input POST
        $status = $this->input->post('status');

        // Validasi status yang diterima (0 atau 1)
        if ($status !== null && ($status == 0 || $status == 1)) {
            // Periksa apakah produk dengan ID yang diberikan ada di database
            $product = $this->product->get_by_id($product_id);
            if ($product) {
                // Update status produk di database
                $this->product->update_status($product_id, $status);
                $this->session->set_flashdata('success', 'Status produk berhasil diperbarui.');
            } else {
                // Jika produk tidak ditemukan
                $this->session->set_flashdata('error', 'Produk tidak ditemukan.');
            }
        } else {
            // Jika status tidak valid
            $this->session->set_flashdata('error', 'Status produk tidak valid.');
        }

        // Redirect ke halaman daftar produk
        redirect('products');
    }


    public function delete($id)
    {
        // Validasi ID produk
        if ($this->product->delete($id)) {
            // Menyimpan pesan sukses ke flash data
            $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        } else {
            // Menyimpan pesan error ke flash data
            $this->session->set_flashdata('error', 'Terjadi kesalahan, produk gagal dihapus.');
        }

        // Redirect ke halaman daftar produk
        redirect('products');
    }
}
