<?php

class Penilaian extends CI_Controller {

    public function __construct () {
        parent:: __construct();
        if ($this->session->userdata('masuk') != TRUE) {
            redirect(base_url('auth'));
        }
        // load model kriteris
        $this->load->model('Penilaian_Model');
    }

     public function index () {
        $data['judul'] = 'Daftar Kriteria';

        $this->load->view('_templates/header', $data);
        $this->load->view('Penilaian/index', $data);
        $this->load->view('_templates/footer');
    }

    
}

?>