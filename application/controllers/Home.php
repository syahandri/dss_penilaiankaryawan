<?php

class Home extends CI_Controller {

    public function index() {
        $data['judul'] = 'Beranda';
        $this->load->view('_templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('_templates/footer');
    }
}

?>