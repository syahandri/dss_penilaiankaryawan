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

    // public function register()
    // {
    //     $data['title'] = "Halaman Registrasi";

    //     $this->load->view('auth/auth_header', $data);
    //     $this->load->view('auth/register');
    //     $this->load->view('auth/auth_footer');
    // }

    public function authentication()
    {
        $nip = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
        $password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

        $cek_admin = $this->auth_model->auth_pegawai($nip, $password);

        if ($cek_admin->num_rows() > 0) {
            $data = $cek_admin->row_array();
            $this->session->set_userdata('masuk', TRUE);
            // $this->session->set_userdata('akses', '1');
            // $this->session->set_userdata('ses_id', $data['nip']);
            $this->session->set_userdata('ses_nama', $data['nama']);
            redirect('home');
        } else {  // jika username dan password tidak ditemukan atau salah
            $url = base_url();
            echo $this->session->set_flashdata('msg', 'Username Atau Password Salah');
            redirect($url);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $url = base_url('');
        redirect($url);
    }
}
