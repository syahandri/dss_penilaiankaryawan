<?php

class Profile extends CI_Controller {

    public function __construct () {
        parent::__construct();

        $this->load->model('Profile_Model');
    }

    public function index () {
        $data['judul'] = 'Pengaturan Profil';

        $this->load->view('_templates/header', $data);
        $this->load->view('profile/index');
        $this->load->view('_templates/footer');
    }
}

?>