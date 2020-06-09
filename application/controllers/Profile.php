<?php

class Profile extends CI_Controller {

    public function __construct () {
        parent:: __construct();

        $this->load->model('Profile_Model');
    }

    public function index () {
        
        $data['judul'] = 'Pengaturan Profile';

        $this->load->view('_templates/header', $data);
        $this->load->view('profile/index');
        $this->load->view('_templates/footer');
    }

    public function getProfileById () {
        
        $data = $this->Profile_Model->getProfileById($this->input->post('id'));
        echo json_encode($data);
    }

      function check_nip ($nip) {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
         } else {
            $id = '';
        }
        
        $result = $this->Profile_Model->check_nip($id, $nip);
        if ($result == 0) {
            $response = true;
        } else {
            $this->form_validation->set_message('check_nip', 'Field {field} sudah terdaftar');
            $response = false;
        }
        return $response;
    }

    public function ubahProfile () {

        $rules = [
            [
                'field' => 'nipProfile',
                'label' => 'NIP',
                'rules' => 'required|numeric|callback_check_nip'
            ],
            [
                'field' => 'namaProfile',
                'label' => 'NAMA',
                'rules' => 'required|regex_match[/^([a-z\. ])+$/i]'
            ]
        ];

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE) {
             
            $data = [
                'nipProfile'  => form_error('nipProfile'),
                'namaProfile' => form_error('namaProfile')
            ];   

            echo json_encode($data);
        } else {

            if (empty($_FILES["image"]["name"])) {
                $image = $this->input->post('old_foto');
                $this->Profile_Model->ubahProfile($image);
                echo json_encode(array("status" => TRUE));
            } else {
                
                $config['upload_path']   = './assets/img/upload/';
                $config['allowed_types'] = 'jpeg|jpg|png|gif';
                // $config['file_name']     = $this->input->post('id');
                $config['overwrite']     = true;
            
                $this->load->library('upload', $config);
            
                if ($this->upload->do_upload('image')) {
                    $image = $this->upload->data("file_name");
                    $this->Profile_Model->ubahProfile($image);
                    echo json_encode(array("status" => TRUE));
                } else {
                    $error = array('error' => '* File ditolak, pastikan upload file gambar dengan format (".jpeg", ".jpg", ".png", ".gif")');
                    echo json_encode($error);
                }
                    // return "profile.png";
                    // echo json_encode(array("status" => TRUE));
            }
        }
    }
}

?>