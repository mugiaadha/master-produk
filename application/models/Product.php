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

    public function search_products($keyword)
    {
        $this->db->like('name', $keyword);
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

    public function delete($id)
    {
        return $this->db->delete('products', array('id' => $id));  // Menghapus produk berdasarkan ID
    }

}