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
        $data['title'] = "Selamat Datang";
        if ($this->session->userdata('masuk') == TRUE) {
            redirect(base_url('home'));
        } else {

            $this->load->view('auth/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('auth/auth_footer');
        }
    }

    public function authentication()
    {
        $data['title'] = "Selamat Datang";


        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('auth/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('auth/auth_footer');

        } else {

            $nip = htmlspecialchars($this->input->post('nip'));
            $password = htmlspecialchars(md5($this->input->post('password')));
        
            $loginNip = $this->auth_model->getLoginByNip($nip);
            $loginPass = $this->auth_model->getLoginByPass($password);

            if ($loginNip->num_rows() == 0) {
                if ($password == $loginPass['pass']) {
                    $this->session->set_flashdata('msg_nip', 'NIP anda tidak terdaftar');
                    redirect('auth');
                } else {
                    echo $this->session->set_flashdata('msg', 'NIP Atau Password Salah');
                    redirect('auth');   
                }
            } else {
                $loginNip = $loginNip->row_array();
                if ($password != $loginNip['pass']) {
                    $this->session->set_flashdata('msg_password', 'Password anda salah');
                    redirect('auth');
                } else {
                    $this->session->set_userdata('masuk', TRUE);
                    $this->session->set_userdata('ses_id', $loginNip['id']);
                    $this->session->set_userdata('ses_nama', $loginNip['nama']);
                    $this->session->set_userdata('ses_foto', $loginNip['foto']);
                    redirect('home');
                }
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