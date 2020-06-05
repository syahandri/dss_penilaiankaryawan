<?php

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            redirect(base_url('auth'));
        }
    }

    public function index()
    {
        $data['judul'] = 'Beranda';
        $this->load->view('_templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('_templates/footer');
    }
}
