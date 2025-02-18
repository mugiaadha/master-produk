<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dbtest extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Tambahkan ini
    }

    public function index() {
        $test = $this->db->get('products')->result();
        return var_dump($test);
    }
}
