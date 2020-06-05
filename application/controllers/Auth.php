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

            $nip = htmlspecialchars($this->input->post('nip', TRUE), ENT_QUOTES);
            $password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);
    
            $cek_admin = $this->auth_model->auth_pegawai($nip, $password);
    
            if ($cek_admin->num_rows() > 0) {
                $data = $cek_admin->row_array();
                $this->session->set_userdata('masuk', TRUE);
                // $this->session->set_userdata('akses', '1');
                // $this->session->set_userdata('ses_id', $data['nip']);
                $this->session->set_userdata('ses_nama', $data['nama']);
                $this->session->set_userdata('ses_foto', $data['foto']);
                redirect('home');
            } else {  // jika username dan password tidak ditemukan atau salah
                $url = base_url();
                echo $this->session->set_flashdata('msg', 'NIP Atau Password Salah');
                redirect($url);
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