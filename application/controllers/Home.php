<?php

class Home extends CI_Controller
{

    public function __construct()
    {
        parent:: __construct();
        if ($this->session->userdata('masuk') != TRUE) {
            redirect(base_url('auth'));
        }

        $this->load->model('Home_Model');
    }

    public function index ()
    {
        $data['judul'] = 'Beranda';
        $this->load->view('_templates/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('_templates/footer');
    }

    public function getHasil () {
    $data = $this->Home_Model->getHasil($this->input->post('filterTgl'));

        foreach($data as $row) {
            $output[] = [
                'tgl_penilaian' => $row['tgl_penilaian'],
                'nama_karyawan' => $row['nama_karyawan'],
                'nilai_mpe' => floatval($row['nilai_alternatif_MPE'])
            ];
        }
        echo json_encode($output);
    }

    public function getTgl () {
        $data = $this->Home_Model->getTgl();
        echo json_encode($data);
    }

    public function countKaryawan () {
        $data = $this->Home_Model->countKaryawan();
        echo json_encode($data);
    }

    public function countKriteria () {
        $data = $this->Home_Model->countKriteria();
        echo json_encode($data);
    }

    public function countSub () {
        $data = $this->Home_Model->countSub();
        echo json_encode($data);
    }
}