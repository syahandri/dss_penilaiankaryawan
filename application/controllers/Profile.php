<?php

class Profile extends CI_Controller {

    public function __construct () {
        parent::__construct();

        $this->load->model('Profile_Model');
    }

    public function index () {
        
        $data['judul'] = 'Pengaturan Profil';

        $data['profile'] = $this->Profile_Model->getProfileById($this->input->post('id'));

        $this->load->view('_templates/header', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('_templates/footer');
    }

    public function getProfileById () {
        $data = $this->Profile_Model->getProfileById($this->input->post('id'));
        echo json_encode($data);
    }
}

?>