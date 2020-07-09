<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function index()
    {
        if ($this->session->userdata('masuk') == TRUE) {
            redirect(base_url('home'));
        } else {
            $data['title'] = "Selamat Datang";

            $this->form_validation->set_rules('nip', 'NIP', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view('auth/auth_header', $data);
                $this->load->view('auth/login');
                $this->load->view('auth/auth_footer');
            } else {
                $this->_authentication();
            }
        }
    }

    private function _authentication()
    {
        $nip      = htmlspecialchars($this->input->post('nip'));
        $password = htmlspecialchars(md5($this->input->post('password')));

        $user = $this->auth_model->getUser($nip);

        if (empty($user)) {
            $this->session->set_flashdata('msg_nip', 'NIP tidak terdaftar atau Password salah');
            redirect(base_url());
        } else {
            if ($password == $user->pass) {
                $this->session->set_userdata('masuk', TRUE);
                $this->session->set_userdata('ses_nip', $user->nip);
                $this->session->set_userdata('ses_nama', $user->nama);
                $this->session->set_userdata('ses_foto', $user->foto);
                redirect('home');
            } else {
                $this->session->set_userdata('ses_nip', $nip);
                $this->session->set_flashdata('msg_password', 'Password anda salah');
                redirect(base_url());
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $url = base_url();
        redirect($url);
    }
}
