<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Ambil semua produk
    public function get_all()
    {
        return $this->db->get('products')->result();
    }

    public function search_products($keyword, $sort, $order)
    {
        $this->db->like('name', $keyword);
        if (in_array($sort, ['name', 'price', 'stock', 'is_sell'])) {
            $this->db->order_by($sort, $order);
        } else {
            $this->db->order_by('name', 'asc');
        }
        return $this->db->get('products')->result();
    }


    // Ambil produk berdasarkan ID
    public function get_by_id($id)
    {
        return $this->db->get_where('products', ['id' => $id])->row();
    }

    // Tambah produk baru
    public function insert($data)
    {
        return $this->db->insert('products', $data);
    }

    // Update produk
    public function update($id, $name, $price, $stock, $is_sell)
    {
        // Update data produk
        $data = [
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'is_sell' => $is_sell
        ];

        // Perbarui data produk
        $this->db->where('id', $id);
        $this->db->update('products', $data);
    }

    public function update_status($product_id, $status)
    {
        // Update status produk di database
        $data = [
            'is_sell' => $status
        ];

        // Proses update berdasarkan ID produk
        $this->db->where('id', $product_id);
        $this->db->update('products', $data);
    }


    public function delete($id)
    {
        return $this->db->delete('products', array('id' => $id));  // Menghapus produk berdasarkan ID
    }
}